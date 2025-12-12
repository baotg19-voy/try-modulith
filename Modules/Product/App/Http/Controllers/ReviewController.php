<?php

namespace Modules\Product\App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Modules\Product\App\DTO\ReviewDTO;
use Modules\Product\App\Http\Requests\ReviewRequest;
use Modules\Product\App\Models\Product;
use Modules\Product\App\Models\Review;
use Modules\Product\App\Repositories\Product\ProductRepositoryInterface;
use Modules\Product\App\Repositories\Review\ReviewRepositoryInterface;
use Modules\Product\App\Services\ProductService;
use Modules\Product\App\Services\ReviewService;

class ReviewController extends Controller
{
    public function __construct(
        protected ReviewService $reviewService,
        protected ProductService $productService
    ) {
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $reviews = $this->reviewService->getPaginatedReviews(10);

        $productIds = $reviews->pluck('product_id')->unique()->toArray();
        $products = $this->productService->getProductDictByIds($productIds);

        return view('product::reviews.index', compact('reviews', 'products'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $products = $this->productService->getAllProducts();
        return view('product::reviews.create', compact('products'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ReviewRequest $request): RedirectResponse
    {
        $request->validated();
        list($status, $message) = ['success', 'Review created successfully!'];

        try {
            $reviewDto = ReviewDTO::fromRequest($request);
            $this->reviewService->createReview($reviewDto);
        } catch (\Throwable $th) {
            Log::error("Error creating review: " . $th->getMessage());
            list($status, $message) = ['error', 'Error creating review'];
        }

        return redirect()->route('reviews.index')
            ->with($status, $message);
    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $review = Review::findOrFail($id);
        $products = $this->productService->getAllProducts();
        return view('product::reviews.edit', compact('review', 'products'));
    }

    public function update(ReviewRequest $request, $id): RedirectResponse
    {
        $review = Review::findOrFail($id);

        $request->validated();
        list($status, $message) = ['success', 'Review updated successfully!'];

        try {
            $reviewDto = ReviewDTO::fromRequest($request);
            $this->reviewService->updateReview($review->id, $reviewDto);
        } catch (\Throwable $th) {
            Log::error("Error updating review: " . $th->getMessage());
            list($status, $message) = ['error', 'Error updating review'];
        }

        return redirect()->route('reviews.index')
            ->with($status, $message);
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id): RedirectResponse
    {
        $review = Review::findOrFail($id);
        list($status, $message) = ['success', 'Review deleted successfully!'];

        try {
            $this->reviewService->deleteReview($review->id);
        } catch (\Throwable $th) {
            Log::error("Error deleting review: " . $th->getMessage());
            list($status, $message) = ['error', 'Error deleting review'];
        }

        return redirect()->route('reviews.index')
            ->with($status, $message);
    }
}
