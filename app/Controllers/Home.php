<?php

namespace App\Controllers;

use App\Models\System;
use App\Models\About\About;
use App\Models\Team\TeamModel;
use App\Models\Courses\Courses;
use GuzzleHttp\Client;

class Home extends BaseController
{
    public function index(): string
    {
        $system = new System();
        $data['systems '] = $system->findAll();

        $courses = new Courses();
        // Fetch courses from the database
        $data['courses_data'] = $courses->orderBy('id', 'DESC')->findAll(6);  

        // Fetch distinct categories with images from the database
        $data['categories'] = $courses->select('DISTINCT(category), category_image, image')->findAll(3);

        // Fetch images for categories from Unsplash dynamically
        foreach ($data['categories'] as &$category) {
            // Check if the category_image is empty
            if (empty($category['category_image'])) {
                // Fetch the image URL from Unsplash for this category
                $imageUrl = $this->getUnsplashImage($category['category']);
                
                // Log the fetched image URL for debugging
                log_message('debug', 'Fetched Image URL for category ' . $category['category'] . ': ' . $imageUrl);
                
                // Only proceed if the image URL is valid (not the default one)
                if ($imageUrl !== 'default-image.jpg') {
                    // Update the correct column: category_image
                    $result = $courses->where('category', $category['category'])
                                      ->set(['category_image' => $imageUrl])  // Ensure we're setting category_image
                                      ->update();
                    
                    // Log the result of the update operation
                    log_message('debug', 'Update Result for category ' . $category['category'] . ': ' . ($result ? 'Success' : 'Failure'));
                    
                    // Update the local array for the view (this is for displaying the image)
                    $category['category_image'] = $imageUrl;
                } else {
                    log_message('debug', 'No valid image found for category ' . $category['category']);
                }
            }
        }        

        // Fetch other data for the page
        $aboutModel = new About();
        $data['about'] = $aboutModel->first();

        $teamModel = new TeamModel();
        $teams = $teamModel->orderBy('id', 'DESC')->findAll();
        $data['teams'] = $teams;

        // Pass data to the view
        return view('home', $data);
    }

    private function getUnsplashImage($category)
    {
        $client = new Client();
        $accessKey = env('UNSPLASH_ACCESS_KEY'); // Use your Access Key here
        $url = "https://api.unsplash.com/photos/random?query=" . urlencode($category) . "&client_id=" . $accessKey;
    
        try {
            $response = $client->request('GET', $url);
            $data = json_decode($response->getBody()->getContents(), true);
    
            // Log the API response for debugging
            log_message('debug', 'Unsplash API Response for category "' . $category . '": ' . json_encode($data));
    
            if (!empty($data) && isset($data[0]['urls']['regular'])) {
                // Return the image URL if it's valid
                return $data[0]['urls']['regular'];
            } else {
                log_message('debug', 'No valid image found for category "' . $category . '"');
            }
        } catch (\Exception $e) {
            log_message('error', 'Error fetching image from Unsplash for category "' . $category . '": ' . $e->getMessage());
            return 'default-image.jpg'; // Fallback if there's an error
        }
    
        return 'default-image.jpg'; // Fallback if no image is found
    }
    
}
