<?php

namespace Modules\Product\App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Log;
use Modules\Product\App\DTO\ProductDTO;
use Modules\Product\App\Http\Requests\ProductRequest;
use Modules\Product\App\Models\Product;
use Modules\Product\App\Services\CategoryService;
use Modules\Product\App\Services\ProductService;

class ProductController extends Controller
{
    public function __construct(
        protected ProductService $productService,
        protected CategoryService $categoryService
    ) {
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $products = $this->productService->getPaginatedProducts(10);
        return view('product::index', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = $this->categoryService->getAllCategories();
        return view('product::create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ProductRequest $request): RedirectResponse
    {
        $request->validated();
        list($status, $message) = ['success', 'Product created successfully!'];

        try {
            $productDto = ProductDTO::fromRequest($request);
            $this->productService->createProduct($productDto);
        } catch (\Throwable $th) {
            Log::error("Error creating product: " . $th->getMessage());
            list($status, $message) = ['error', 'Error creating product'];
        }

        return redirect()->route('products.index')
            ->with($status, $message);
    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $product = Product::findOrFail($id);
        $categories = $this->categoryService->getAllCategories();
        return view('product::edit', compact('product', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ProductRequest $request, $id): RedirectResponse
    {
        $product = Product::findOrFail($id);

        $request->validated();
        list($status, $message) = ['success', 'Product updated successfully!'];

        try {
            $productDto = ProductDTO::fromRequest($request);
            $this->productService->updateProduct($product->id, $productDto);
        } catch (\Throwable $th) {
            Log::error("Error updating product: " . $th->getMessage());
            list($status, $message) = ['error', 'Error updating product'];
        }

        return redirect()->route('products.index')
            ->with($status, $message);
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id): RedirectResponse
    {
        $product = Product::findOrFail($id);
        list($status, $message) = ['success', 'Product deleted successfully!'];

        try {
            $this->productService->deleteProduct($product->id);
        } catch (\Throwable $th) {
            Log::error("Error deleting product: " . $th->getMessage());
            list($status, $message) = ['error', 'Error deleting product'];
        }

        return redirect()->route('products.index')
            ->with($status, $message);
    }
}
