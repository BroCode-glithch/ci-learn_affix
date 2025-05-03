<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\Blog\Blog;
use App\Models\Blog\Category;
use CodeIgniter\HTTP\ResponseInterface;

class BlogAdminController extends BaseController
{
    protected $blogModel;
    protected $categoryModel;

    public function __construct()
    {
        $this->blogModel = new Blog();
        $this->categoryModel = new Category(); // if you have it
        helper(['form', 'url', 'uri']);
    }

    public function index()
    {
        $data['blogs'] = $this->blogModel->orderBy('created_at', 'DESC')->findAll();
        return view('admin/blog/index', $data);
    }

    public function create()
    {
        // Passing the URI to the view
        // Get the second URI segment
        $data['current_uri'] = service('uri')->getSegment(2, '');

        // Fetch distinct categories from the blogs table (assuming category is a string or integer column)
        $data['categories'] = $this->blogModel->distinct()->select('category')->findAll();
    
        return view('admin/blog/create', $data);
    }   

    public function store()
    {
        $validation = $this->validate([
            'title'   => 'required|min_length[3]',
            'content' => 'required',
            'image'   => 'uploaded[image]|max_size[image,2048]|is_image[image]',
        ]);

        if (!$validation) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        // Upload image
        $imageFile = $this->request->getFile('image');
        $newName = $imageFile->getRandomName();
        $imageFile->move('public/assets/img/blog', $newName);

        $this->blogModel->save([
            'title'      => $this->request->getPost('title'),
            'slug'       => url_title($this->request->getPost('title'), '-', true),
            'content'    => $this->request->getPost('content'),
            'category'   => $this->request->getPost('category'),
            'image'      => $newName,
            'created_at' => date('Y-m-d H:i:s')
        ]);

        return redirect()->to('/admin/blog')->with('success', 'Blog post created successfully.');
    }

    public function edit($id)
    {
        // Fetch the blog with its category data
        $blog = $this->blogModel->select('blogs.*, categories.id as category_id, categories.name as category_name')
            ->join('categories', 'categories.id = blogs.category_id', 'left')
            ->where('blogs.id', $id)
            ->first();

        // Fetch all categories for the dropdown
        $categories = $this->categoryModel->findAll();

        // Pass both blog and categories to the view
        return view('admin/blog/edit', [
            'blog' => $blog,
            'categories' => $categories
        ]);
    }    

    public function update($id)
    {
        $model = new Blog();  // Replace with your actual model name
    
        // Get the current post from the database
        $post = $model->find($id);
    
        // If the post does not exist, redirect
        if (!$post) {
            return redirect()->to('/admin/blog')->with('error', 'Post not found');
        }
    
        // Validate form input
        $rules = [
            'title'   => 'required|min_length[3]|max_length[255]',
            'content' => 'required|min_length[3]',
            'category' => 'required|is_natural_no_zero',
        ];
    
        // Check if validation fails
        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }
    
        // Process the image upload if a new image is provided
        $image = $this->request->getFile('image');
        if ($image && $image->isValid()) {
            // Upload the new image and replace the old one if needed
            $imageName = $image->getRandomName();
            $image->move(WRITEPATH . 'uploads', $imageName);
    
            // Optionally, delete the old image if you want
            if ($post['image']) {
                unlink(WRITEPATH . 'uploads/' . $post['image']);
            }
        } else {
            // Keep the old image if no new image is uploaded
            $imageName = $post['image'];
        }
    
        // Prepare data for updating
        $data = [
            'title'   => $this->request->getPost('title'),
            'content' => $this->request->getPost('content'),
            'category_id' => $this->request->getPost('category'),
            'image' => $imageName,
        ];
    
        // Update the post in the database
        $model->update($id, $data);
    
        // Redirect to the blog list page with success message
        return redirect()->to('/admin/blog')->with('success', 'Blog post updated successfully!');
    }

    public function delete($id)
    {
        $blog = $this->blogModel->find($id);
        if (!$blog) {
            return redirect()->to('/admin/blog')->with('error', 'Blog post not found.');
        }

        $this->blogModel->delete($id);
        return redirect()->to('/admin/blog')->with('success', 'Blog post deleted successfully.');
    }
}
