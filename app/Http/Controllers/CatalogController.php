<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Category;
use App\Offer;
use App\Product;

class CatalogController extends Controller
{
    public function index(Request $request) {
        $categories = Category::with('children')->get();
        $topProducts = Product::limit(20)->get();

        $searchString = $request->input('searchString');
        $findProducts = [];
        if ($searchString) {
            $findProducts = Product::latest()
                ->search($searchString)
                ->paginate(50);
        }

        return view('index', compact(
            'categories',
            'topProducts',
            'searchString',
            'findProducts'
        ));
    }

    public function categories($categoryAlias = null, $subcategoryAlias = null) {
        $alias = $subcategoryAlias ?? $categoryAlias;
        $category = null;

        if ($alias) {
            $category = Category::where('alias', $alias)->first();
            $products = $category->products()->get();
        } else {
            $products = Product::paginate(50);
        }

        $categoryTitle = $category
            ? $category->title
            : null;

        return view('categories', compact(
            'categoryTitle',
            'products'
        ));
    }
}
