<?php

namespace App\Controllers\Courses;

use App\Models\Courses\Courses;
use App\Controllers\BaseController;
use App\Models\Courses\UserUnlockedCourses;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\Exceptions\PageNotFoundException;
use GuzzleHttp\Client;

class CourseController extends BaseController
{
    public function index()
    {
        helper(filenames: 'course');

        $courseModel = new Courses();
    

        // Fetch courses from the database
        $data['courses_data'] = $courseModel->orderBy('id', 'DESC')->findAll();  
    
        // Fetch distinct topics
        // $data['topics'] = $courseModel->getTopics();
    
        // Fetch all courses
        $data['courses'] = $courseModel->orderBy('id', 'DESC')->findAll(6); 

        $data['categories'] = $courseModel->select('DISTINCT(category), image')->findAll(3);

        // Fetch images for categories from Unsplash dynamically
        foreach ($data['categories'] as &$category) {
            if (empty($category['image'])) {
                $imageUrl = $this->getUnsplashImage($category['category']);
        
                // Save image to the DB for this category
                $courses->where('category', $category['category'])
                        ->set(['image' => $imageUrl])
                        ->update();
        
                // Update the local array for the view
                $category['image'] = $imageUrl;
            }
        }


        // Initialize unlocked_courses array
        $data['unlocked_courses'] = [];

        if (auth()->loggedIn()) {
            $unlockModel = new UserUnlockedCourses();
            $unlockedRows = $unlockModel
                ->where('user_id', auth()->user()->id)
                ->findAll();

            foreach ($unlockedRows as $row) {
                $data['unlocked_courses'][$row['course_id']] = true;
            }
        }
    
        // Fetch featured (highlighted) courses
        $data['highlighted_courses'] = $courseModel->where('is_featured', 1)->orderBy('id', 'DESC')->findAll(6);
    
        return view("courses/course", $data);
    }

    public function category($category)
    {
        helper('text'); // ✅ Load the text helper to enable word_limiter()
    
        $courseModel = new Courses();
     
        // Decode category name from URL
        $category = urldecode($category);
    
        // Fetch courses based on category with correct chaining
        $data['courses'] = $courseModel->where('category', $category)
                                       ->orderBy('id', 'DESC')
                                       ->findAll();
        
        $data['category_name'] = $category;
    
        return view("courses/course-category", $data);
    }    

    public function allCategories()
    {
        $courseModel = new Courses();  // Use a single model consistently
    
        // Fetch distinct categories with images
        $data['categories'] = $courseModel->select('DISTINCT(category), image')->findAll();
    
        // Dynamically fetch Unsplash images if image field is empty
        foreach ($data['categories'] as &$category) {
            if (empty($category['image'])) {
                $imageUrl = $this->getUnsplashImage($category['category']);
    
                // Save to DB
                $courseModel->where('category', $category['category'])
                            ->set(['image' => $imageUrl])
                            ->update();
    
                $category['image'] = $imageUrl;
            }
        }
    
        return view('courses/all-categories', $data);
    }
    

    private function getUnsplashImage($category)
    {
        $client = new Client();
        $accessKey = env('UNSPLASH_ACCESS_KEY'); // Use your Access Key here
        $url = "https://api.unsplash.com/photos/random?query=" . urlencode($category) . "&client_id=" . $accessKey;

        try {
            $response = $client->request('GET', $url);
            $data = json_decode($response->getBody()->getContents(), true);

            if (!empty($data)) {
                return $data[0]['urls']['regular']; // Fetching the regular-sized image URL
            }
        } catch (\Exception $e) {
            return 'default-image.jpg'; // Fallback if there's an error
        }

        return 'default-image.jpg'; // Fallback if no image is found
    }
    
    public function show($id)
    {
        helper(['text']); // for word_limiter etc.
        
        $courseModel = new Courses();
        $unlockModel = new UserUnlockedCourses();
    
        $course = $courseModel->find($id);
    
        if (!$course) {
            throw PageNotFoundException::forPageNotFound("Course not found");
        }
    
        // Optional: log view (you can store to DB or write to log file)
        log_message('info', 'Course viewed: ' . $course['title'] . ' (ID: ' . $id . ')');
    
        $data = [
            'course' => $course,
            '_course' => $course, // Just in case it's used in views
            'other_courses' => $courseModel
                ->where('id !=', $id)
                ->orderBy('created_at', 'DESC')
                ->findAll(5), // fetch 5 other courses
            'is_unlocked' => false,
        ];
    
        // If logged in, check if the course is unlocked
        if (auth()->loggedIn()) {
            $userId = auth()->user()->id;
            $unlocked = $unlockModel
                ->where('user_id', $userId)
                ->where('course_id', $id)
                ->first();
    
            $data['is_unlocked'] = !empty($unlocked);
        }
    
        return view('courses/course-details', $data);
    }
    

    public function coursePage()
    {
        $model = new Courses();
        
        // Fetch all categories
        $data['categories'] = $model->select('DISTINCT(category)', false)->findAll();
    
        // Fetch featured courses correctly
        $data['highlighted_courses'] = $model->where('is_featured', 1)->orderBy('id', 'DESC')->findAll(6);
    
        // Debugging: Uncomment to check the fetched courses
        dd($data['highlighted_courses']); 
    
        return view('courses/course', $data);
    }  
    
    
    public function unlock($courseId)
    {
        if (!auth()->loggedIn()) {
            return redirect()->to(base_url('login'));
        }

        $userId = auth()->user()->id;
        $unlockModel = new UserUnlockedCourses();
        $existing = $unlockModel->where('user_id', $userId)->where('course_id', $courseId)->first();

        if (!$existing) {
            $unlockModel->insert([
                'user_id' => $userId,
                'course_id' => $courseId,
                'unlocked_at' => date('Y-m-d H:i:s')
            ]);
        }

        $course = (new Courses())->find($courseId);

        if ($course && !empty($course['affiliate_url'])) {
            return redirect()->to($course['affiliate_url']);
        }

        return redirect()->to(base_url('course/' . $courseId));
    }

}
