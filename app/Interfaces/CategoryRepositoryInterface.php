<?php

namespace app\Interfaces;

interface CategoryRepositoryInterface{
    public function getAllCategories();
    public function getCategoryBySlug($slug);
}