<?php

namespace App\Controllers\Courses;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use App\Models\Courses\Courses;
use CodeIgniter\Exceptions\PageNotFoundException;

class CourseController extends BaseController
{
    public function index()
    {
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
        helper(['text']); // Load the text helper

        $courseModel = new Courses();
        $course = $courseModel->find($id);

        if (!$course) {
            throw PageNotFoundException::forPageNotFound("Course not found");
        }

        // Fetch other courses excluding the current one
        $other_courses = $courseModel->where('id !=', $id)->orderBy('id', 'DESC')->findAll(5);

        // Pass data to the view
        return view('courses/course-details', [
            'course' => $course,
            'other_courses' => $other_courses,
            '_course' => $course
        ]);
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
}
