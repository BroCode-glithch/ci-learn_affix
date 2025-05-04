<?php

namespace App\Controllers\Admin;

use App\Models\Blog\Category;
use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;

class BlogCategoryController extends BaseController
{
    protected $categoryModel;

    public function __construct()
    {
        $this->categoryModel = new Category();
    }

    public function index()
    {
        $model = new Category();
        $data['categories'] = $model->findAll();
        return view('admin/blog/category/index', $data);
    }

    public function create()
    {    
        return view('admin/blog/category/create');
    }    

    public function store()
    {
        $validation = $this->validate([
           'name' => 'required|min_length[3]|max_length[255]',
        ]);
    
        if (!$validation) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }
    
        $model = new Category();
        $model->save([
            'name' => $this->request->getPost('name'),
            'slug' => url_title($this->request->getPost('name'), '-', true),
        ]);
    
        return redirect()->to('/admin/blog/category')->with('success', 'Category created successfully.');
    }
        
    public function edit($id)
    {
        $model = new Category();
        $category = $model->find($id);

        if ($this->request->getMethod() === 'post') {
            $model->update($id, [
                'name' => $this->request->getPost('name'),
                'slug' => url_title($this->request->getPost('name'), '-', true),
            ]);
            return redirect()->to('/admin/blog/category');
        }
        return view('admin/blog/category/edit', ['category' => $category]);
    }

    public function delete($id)
    {
        $category = $this->categoryModel->find($id);
        if (!$category) {
            return redirect()->to('/admin/blog/category')->with('error', 'Category not found.');
        }

        $this->categoryModel->delete($id);
        return redirect()->to('/admin/blog/category')->with('success', 'Category deleted successfully.');
    }
}
