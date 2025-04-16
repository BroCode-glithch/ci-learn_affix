<?php

namespace App\Controllers\Courses;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;

class CourseThumbnail extends BaseController
{
    public function index()
    {
        
    }

    public function fetch()
    {
        $url = $this->request->getGet('url');

        if (!filter_var($url, FILTER_VALIDATE_URL)) {
            return $this->response->setJSON([
                'status' => 'error',
                'message' => 'Invalid URL'
            ]);
        }

        $thumbnail = $this->fetchDiscudemyThumbnail($url);

        if ($thumbnail) {
            return $this->response->setJSON([
                'status' => 'success',
                'thumbnail' => $thumbnail
            ]);
        }

        return $this->response->setJSON([
            'status' => 'error',
            'message' => 'Thumbnail not found'
        ]);
    }

    private function fetchDiscudemyThumbnail($course_url)
    {
        $context = stream_context_create([
            'http' => [
                'header' => "User-Agent: Mozilla/5.0\r\n"
            ]
        ]);

        $html = @file_get_contents($course_url, false, $context);

        if (!$html) return null;

        libxml_use_internal_errors(true);
        $dom = new \DOMDocument();
        $dom->loadHTML($html);
        libxml_clear_errors();

        $xpath = new \DOMXPath($dom);
        $meta = $xpath->query("//meta[@property='og:image']");

        if ($meta->length > 0) {
            return $meta[0]->getAttribute('content');
        }

        return null;
    }

    public function updateThumbnail()
    {
        $url = $this->request->getGet('url');

        if (!filter_var($url, FILTER_VALIDATE_URL)) {
            return $this->response->setJSON([
                'status' => 'error',
                'message' => 'Invalid URL'
            ]);
        }

        $thumbnail = $this->fetchDiscudemyThumbnail($url);

        if (!$thumbnail) {
            return $this->response->setJSON([
                'status' => 'error',
                'message' => 'Thumbnail not found'
            ]);
        }

        // Update the image in the database
        $db = \Config\Database::connect();
        $builder = $db->table('courses');
        $builder->where('course_url', $url);
        $update = $builder->update(['image' => $thumbnail]);

        if ($update) {
            return $this->response->setJSON([
                'status' => 'success',
                'message' => 'Thumbnail updated in database',
                'thumbnail' => $thumbnail
            ]);
        }

        return $this->response->setJSON([
            'status' => 'error',
            'message' => 'Could not update database'
        ]);
    }

}
