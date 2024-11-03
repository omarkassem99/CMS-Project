<?php

namespace App\Repository\Dashboard\Category;

use App\Http\Resources\Dashboard\Category\CategoryResource;
use App\Models\Category;
use Illuminate\Support\Facades\Storage;

class CategoryRepo
{
    public function index()
    {
        $categories = Category::get();

        return successResponseData(CategoryResource::collection($categories));

    }
    
    public function store($request)
    {
        $data = $request->except('_token');
        $category = Category::create($data);

        return successResponseData(CategoryResource::make($category), 'Category Created Successfully');

    }

    public function update($request, $id)
    {
        $data = $request->except('_token');

        $category = Category::findOrFail($id);

        $category->update($data);

        return successResponseData(CategoryResource::make($category), 'Category Updated Successfully');
    }

    public function delete($id)
    {
        $category = Category::findOrFail($id);

        $category->delete();

        return successResponseMessage('Category Deleted');

    }



}
