<?php

namespace App\Domains\Auth\Http\Controllers\Backend\Product;

use App\Domains\Auth\Http\Requests\Backend\Product\StoreProductRequest;
use App\Domains\Auth\Http\Requests\Backend\Product\EditProductRequest;
use App\Domains\Auth\Http\Requests\Backend\Product\UpdateProductRequest;
use App\Domains\Auth\Services\ProductService;
use App\Domains\Auth\Models\Category;
use App\Domains\Auth\Models\Product;
use App\Domains\Auth\Models\User;

// use Illuminate\Http\Request;

class ProductController
{

    protected $productService;

    public function __construct(ProductService $productService)
    {
        $this->productService = $productService;
    }

    public function create()
    {
        $category = Category::all();
        return view('backend.auth.product.create')->with('category', $category);
    }

    public function store(StoreProductRequest $request)
    {
        $product =  $this->productService->store($request->validated());

        return redirect()->route('admin.auth.create', $product)->withFlashSuccess(__('The product was successfully added.'));
    }
    public function index()
    {
        $products = Product::with('category')->get();
        return view('backend.auth.product.list')->with('products',$products);
    }
    public function show(Product $product){

    }
    public function edit(EditProductRequest $request,Product $product,Category $category,User $user){
        $id = $request->id;
        $detail =$product::with('category')->find($id);
        $category =$category::pluck('id','cat_name');
        return view('backend.auth.product.edit',compact('detail','category'))->withUser($user);
    }
    public function update(UpdateProductRequest $request,Product $product,Category $category){
        $data=$request->request;
        // dd($data);
        $product =$this->productService->update($product, $request->validated(),$data);
        $product =$product::all();
        // dd($team);
        return redirect()->route('admin.auth.showproducts', ['id',$data->get('id')])->withFlashSuccess(__('The Product was successfully updated.'));
    }
    public function destroy($id){
          // dd($id);
          $product=Product::findorfail($id);
          $product->delete($product);
  
         return redirect()->route('admin.auth.showproducts')->withFlashSuccess(__('The user was successfully deleted.'));
    }
}
