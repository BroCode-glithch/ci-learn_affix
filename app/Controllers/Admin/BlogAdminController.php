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
        helper(['form', 'url']);
    }

    public function index()
    {
        $data['blogs'] = $this->blogModel->orderBy('created_at', 'DESC')->findAll();
        return view('admin/blog/index', $data);
    }

    public function create()
    {
        $data['categories'] = $this->categoryModel->findAll(); // Optional if you have categories
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
        $blog = $this->blogModel->find($id);
        if (!$blog) {
            return redirect()->to('/admin/blog')->with('error', 'Blog post not found.');
        }

        $data['blog'] = $blog;
        $data['categories'] = $this->categoryModel->findAll(); // Optional

        return view('admin/blog/edit', $data);
    }

    public function update($id)
    {
        $blog = $this->blogModel->find($id);
        if (!$blog) {
            return redirect()->to('/admin/blog')->with('error', 'Blog post not found.');
        }

        $validationRules = [
            'title'   => 'required|min_length[3]',
            'content' => 'required',
        ];

        if ($this->request->getFile('image')->isValid()) {
            $validationRules['image'] = 'uploaded[image]|max_size[image,2048]|is_image[image]';
        }

        if (!$this->validate($validationRules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $updateData = [
            'title'      => $this->request->getPost('title'),
            'slug'       => url_title($this->request->getPost('title'), '-', true),
            'content'    => $this->request->getPost('content'),
            'category'   => $this->request->getPost('category'),
            'updated_at' => date('Y-m-d H:i:s')
        ];

        // Handle image upload
        if ($this->request->getFile('image')->isValid()) {
            $imageFile = $this->request->getFile('image');
            $newName = $imageFile->getRandomName();
            $imageFile->move('public/assets/img/blog', $newName);
            $updateData['image'] = $newName;
        }

        $this->blogModel->update($id, $updateData);

        return redirect()->to('/admin/blog')->with('success', 'Blog post updated successfully.');
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
