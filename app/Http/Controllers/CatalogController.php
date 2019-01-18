<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Category;
use App\Offer;
use App\Product;

class CatalogController extends Controller
{
    public function index() {
        // $categories = Category::all();
        $categories = Category::with('children')->get();
        return view('index', compact(
            'categories'
        ));
    }
}
