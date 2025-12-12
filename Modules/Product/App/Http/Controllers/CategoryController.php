<?php

namespace Modules\Product\App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Log;
use Modules\Product\App\DTO\CategoryDTO;
use Modules\Product\App\Http\Requests\CategoryRequest;
use Modules\Product\App\Models\Category;
use Modules\Product\App\Services\CategoryService;

class CategoryController extends Controller
{
    public function __construct(
        protected CategoryService $categoryService
    ) {
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories = $this->categoryService->getPaginatedCategories(10);
        return view('product::categories.index', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('product::categories.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CategoryRequest $request): RedirectResponse
    {
        $validated = $request->validated();
        list($status, $message) = ['success', 'Category created successfully!'];

        try {
            $categoryDto = new CategoryDTO(...$validated);
            $this->categoryService->createCategory($categoryDto);
        } catch (\Throwable $th) {
            Log::error("Error creating category: " . $th->getMessage());
            list($status, $message) = ['error', 'Error creating category'];
        }

        return redirect()->route('categories.index')
            ->with($status, $message);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $category = Category::findOrFail($id);
        return view('product::categories.edit', compact('category'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(CategoryRequest $request, $id): RedirectResponse
    {
        $category = Category::findOrFail($id);

        $validated = $request->validated();
        list($status, $message) = ['success', 'Category updated successfully!'];

        try {
            $categoryDto = new CategoryDTO(...$validated);
            $this->categoryService->updateCategory($category->id, $categoryDto);
        } catch (\Throwable $th) {
            Log::error("Error updating category: " . $th->getMessage());
            list($status, $message) = ['error', 'Error updating category'];
        }

        return redirect()->route('categories.index')
            ->with($status, $message);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id): RedirectResponse
    {
        $category = Category::findOrFail($id);
        list($status, $message) = ['success', 'Category deleting successfully!'];

        try {
            $this->categoryService->deleteCategory($category->id);
        } catch (\Throwable $th) {
            Log::error("Error deleting category: " . $th->getMessage());
            list($status, $message) = ['error', 'Error deleting category'];
        }

        return redirect()->route('categories.index')
            ->with($status, $message);
    }
}
