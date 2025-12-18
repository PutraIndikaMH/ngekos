<?php

namespace App\Repositories;

use app\Interfaces\CategoryRepositoryInterface;
use App\Models\Category;

class CategoryRepository implements CategoryRepositoryInterface{

    public function getAllCategories()
    {
        return Category::all();
    }

    public function getCategoryBySlug($slug)
    {
        return Category::where('slug', $slug)->firstOrFail();
    }
}
