<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\Blog\Tag;
use CodeIgniter\HTTP\ResponseInterface;

class BlogTagController extends BaseController
{
// Display all tags
    public function index()
    {
        $model = new Tag();
        $data['tags'] = $model->findAll(); // Get all tags
        return view('admin/blog/tag/index', $data); // Create an index view to list tags
    }

    // Show the create tag form and handle the creation
    public function create()
    {
        if ($this->request->getMethod() === 'post') {
            // Define validation rules for the tag
            $rules = [
                'name' => 'required|min_length[3]|max_length[255]',
            ];

            if (!$this->validate($rules)) {
                // If validation fails, return the form with error messages
                return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
            }

            // If validation passes, save the tag
            $model = new Tag();
            $model->save([
                'name' => $this->request->getPost('name'),
                'slug' => url_title($this->request->getPost('name'), '-', true), // Generate slug from name
            ]);

            // Redirect with a success message after creating the tag
            return redirect()->to('/admin/blog/tag')->with('success', 'Tag created successfully!');
        }

        return view('admin/blog/tag/create'); // Return the create view
    }

    // Edit an existing tag
    public function edit($id)
    {
        $model = new Tag();
        $tag = $model->find($id); // Find the tag by id

        if (!$tag) {
            // If the tag doesn't exist, show a 404 or redirect
            throw new \CodeIgniter\Exceptions\PageNotFoundException("Tag not found");
        }

        if ($this->request->getMethod() === 'post') {
            // Define the validation rules
            $rules = [
                'name' => 'required|min_length[3]|max_length[255]',
            ];

            if (!$this->validate($rules)) {
                return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
            }

            // If validation passes, update the tag
            $model->update($id, [
                'name' => $this->request->getPost('name'),
                'slug' => url_title($this->request->getPost('name'), '-', true), // Update the slug
            ]);

            // Redirect to the index page after updating
            return redirect()->to('/admin/blog/tag')->with('success', 'Tag updated successfully!');
        }

        return view('admin/blog/tag/edit', ['tag' => $tag]); // Show the edit view with existing tag data
    }
}
