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

        // ✅ Fetch latest record per category (ensures the image is correct)
        $builder = $courses->builder();
        $subQuery = $builder
            ->select('category, MAX(id) as max_id')
            ->groupBy('category')
            ->getCompiledSelect();

        $data['categories'] = $builder
            ->select('courses.category, courses.category_image')
            ->join("($subQuery) as latest", 'courses.category = latest.category AND courses.id = latest.max_id')
            ->orderBy('courses.id', 'DESC')
            ->get(3)
            ->getResultArray();

        // ✅ Fetch images for categories only if missing, and save
        foreach ($data['categories'] as &$category) {
            if (empty($category['category_image'])) {
                $imageUrl = $this->getUnsplashImage($category['category']);

                log_message('debug', 'Fetched Image URL for category ' . $category['category'] . ': ' . $imageUrl);

                if ($imageUrl !== 'default-image.jpg') {
                    // ✅ Correct DB update
                    $result = $courses->set(['category_image' => $imageUrl])
                        ->where('category', $category['category'])
                        ->update();

                    log_message('debug', 'Update Result for category ' . $category['category'] . ': ' . ($result ? 'Success' : 'Failure'));

                    // Update for view
                    $category['category_image'] = $imageUrl;
                } else {
                    log_message('debug', 'No valid image found for category ' . $category['category']);
                }
            }
        }

        // Fetch other data
        $aboutModel = new About();
        $data['about'] = $aboutModel->first();

        $teamModel = new TeamModel();
        $data['teams'] = $teamModel->orderBy('id', 'DESC')->findAll();

        return view('home', $data);
    }

    private function getUnsplashImage($category)
    {
        $client = new Client();
        $accessKey = env('UNSPLASH_ACCESS_KEY');
        $url = "https://api.unsplash.com/photos/random?query=" . urlencode($category) . "&client_id=" . $accessKey;

        try {
            $response = $client->request('GET', $url);
            $data = json_decode($response->getBody()->getContents(), true);

            log_message('debug', 'Unsplash API Response for category "' . $category . '": ' . json_encode($data));

            if (!empty($data) && isset($data['urls']['regular'])) {
                return $data['urls']['regular'];
            } else {
                log_message('debug', 'No valid image found for category "' . $category . '"');
            }
        } catch (\Exception $e) {
            log_message('error', 'Error fetching image from Unsplash for category "' . $category . '": ' . $e->getMessage());
        }

        return 'default-image.jpg';
    }
}
