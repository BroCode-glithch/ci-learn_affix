<?php

namespace App\Controllers\Admin;

use App\Models\Blog\Category;
use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;

class BlogCategoryController extends BaseController
{
    public function index()
    {
        $model = new Category();
        $data['categories'] = $model->findAll();
        return view('admin/blog/category/index', $data);
    }

    public function create()
    {
        if ($this->request->getMethod() === 'post') {
            log_message('debug', 'We are inside the POST block.');
    
            // Define validation rules
            $rules = [
                'name' => 'required|min_length[3]|max_length[255]',
            ];
    
            if (!$this->validate($rules)) {
                log_message('debug', 'Validation failed: ' . print_r($this->validator->getErrors(), true));
                return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
            }
    
            // Save data if validation passes
            $model = new Category();
            $saveResult = $model->save([
                'name' => $this->request->getPost('name'),
                'slug' => url_title($this->request->getPost('name'), '-', true),
            ]);
    
            log_message('debug', 'Save result: ' . ($saveResult ? 'Success' : 'Failure'));
    
            if (!$saveResult) {
                log_message('error', 'DB error: ' . print_r($model->errors(), true));
            }
    
            // Redirect back to the category list with a success message
            return redirect()->to('/admin/blog/category')->with('success', 'Category created successfully!');
        }
    
        return view('admin/blog/category/create');
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
}
