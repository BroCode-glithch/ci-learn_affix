<?php

namespace App\Commands;

use CodeIgniter\CLI\BaseCommand;
use CodeIgniter\CLI\CLI;
use Config\Database;

class UpdateThumbnails extends BaseCommand
{
    protected $group       = 'App';
    protected $name        = 'course:update-thumbnails';
    protected $description = 'Fetches and updates thumbnails for all courses using their course_url.';
    protected $usage       = 'course:update-thumbnails';
    protected $arguments   = [];
    protected $options     = [];

    public function run(array $params)
    {
        $db = Database::connect();
        $builder = $db->table('courses');
        $courses = $builder->select('id, course_url')->get()->getResult();

        $updated = 0;
        $skipped = 0;

        foreach ($courses as $course) {
            if (!filter_var($course->course_url, FILTER_VALIDATE_URL)) {
                CLI::write("⛔ Skipping course ID {$course->id}: Invalid URL", 'yellow');
                $skipped++;
                continue;
            }

            $thumbnail = $this->fetchThumbnail($course->course_url);

            if ($thumbnail) {
                $builder->where('id', $course->id)->update(['image' => $thumbnail]);
                CLI::write("✅ Updated course ID {$course->id}", 'green');
                $updated++;
            } else {
                CLI::write("⚠️  No thumbnail found for course ID {$course->id}", 'red');
                $skipped++;
            }
        }

        CLI::newLine();
        CLI::write("🎉 Done! Thumbnails updated: $updated | Skipped: $skipped", 'cyan');
    }

    private function fetchThumbnail($url)
    {
        $context = stream_context_create([
            'http' => [
                'header' => "User-Agent: Mozilla/5.0\r\n"
            ]
        ]);

        $html = @file_get_contents($url, false, $context);
        if (!$html) return null;

        libxml_use_internal_errors(true);
        $dom = new \DOMDocument();
        $dom->loadHTML($html);
        libxml_clear_errors();

        $xpath = new \DOMXPath($dom);
        $meta = $xpath->query("//meta[@property='og:image']");

        return ($meta->length > 0) ? $meta[0]->getAttribute('content') : null;
    }
}
