<?php

namespace App\Domains\Auth\Http\Controllers\Backend\Product;

use App\Domains\Auth\Http\Requests\Backend\Product\StoreProductRequest;
use App\Domains\Auth\Services\ProductService;
use App\Domains\Auth\Models\Category;

// use Illuminate\Http\Request;

class ProductController
{

    protected $productService;

    public function __construct(ProductService $productService)
    {
        $this->productService = $productService;
    }

    public function create(){
        $category= Category::all();
        return view('backend.auth.product.create')->with('category',$category);
    }
    
    public function store(StoreProductRequest $request){
        $this->productService->store($request->validated());
       
    }
}
