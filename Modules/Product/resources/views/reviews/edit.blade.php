@extends('core::layouts.master')

@section('content')
<div class="container-fluid">
    <div class="row mb-4">
        <div class="col-12">
            <div class="d-flex justify-content-between align-items-center">
                <h2 class="mb-0">Edit Review</h2>
                <a href="{{ route('reviews.index') }}" class="btn btn-secondary">
                    Back to List
                </a>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-8 col-md-10 mx-auto">
            <div class="card shadow-sm">
                <div class="card-body">
                    <form action="{{ route('reviews.update', $review->id) }}" method="POST" id="reviewForm">
                        @csrf
                        @method('PUT')

                        <div class="mb-3">
                            <label for="product_id" class="form-label">Product <span class="text-danger">*</span></label>
                            <select 
                                class="form-select @error('product_id') is-invalid @enderror" 
                                id="product_id" 
                                name="product_id"
                                required>
                                <option value="">Select a product</option>
                                @foreach($products as $product)
                                    <option value="{{ $product->id }}" {{ old('product_id', $review->product_id) == $product->id ? 'selected' : '' }}>
                                        {{ $product->name }}
                                    </option>
                                @endforeach
                            </select>
                            @error('product_id')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="author_name" class="form-label">Author Name <span class="text-danger">*</span></label>
                            <input 
                                type="text" 
                                class="form-control @error('author_name') is-invalid @enderror" 
                                id="author_name" 
                                name="author_name" 
                                value="{{ old('author_name', $review->author_name) }}"
                                placeholder="Enter your name"
                                required>
                            @error('author_name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Rating <span class="text-danger">*</span></label>
                            <div class="star-rating-input">
                                <input type="hidden" name="rating" id="rating" value="{{ old('rating', $review->rating) }}">
                                <div class="stars-container" id="starsContainer">
                                    <span class="star-input" data-value="1">★</span>
                                    <span class="star-input" data-value="2">★</span>
                                    <span class="star-input" data-value="3">★</span>
                                    <span class="star-input" data-value="4">★</span>
                                    <span class="star-input" data-value="5">★</span>
                                </div>
                                <div class="rating-text mt-2">
                                    <span id="ratingText" class="text-muted">Click on stars to rate</span>
                                </div>
                            </div>
                            @error('rating')
                                <div class="text-danger small mt-1">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label for="comment" class="form-label">Comment <span class="text-danger">*</span></label>
                            <textarea 
                                class="form-control @error('comment') is-invalid @enderror" 
                                id="comment" 
                                name="comment" 
                                rows="5"
                                placeholder="Write your review here (minimum 10 characters)"
                                required>{{ old('comment', $review->comment) }}</textarea>
                            @error('comment')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                            <div class="form-text">Minimum 10 characters</div>
                        </div>

                        <div class="d-flex gap-2">
                            <button type="submit" class="btn btn-primary">Update Review</button>
                            <a href="{{ route('reviews.index') }}" class="btn btn-outline-secondary">Cancel</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@push('styles')
<style>
    .card {
        border: none;
        border-radius: 8px;
    }

    .star-rating-input {
        padding: 15px;
        background-color: #f8f9fa;
        border-radius: 8px;
    }

    .stars-container {
        display: flex;
        gap: 8px;
        font-size: 2.5rem;
        cursor: pointer;
    }

    .star-input {
        color: #e0e0e0;
        transition: all 0.2s ease;
        user-select: none;
    }

    .star-input:hover,
    .star-input.hover {
        color: #ffc107;
        transform: scale(1.1);
    }

    .star-input.active {
        color: #ffc107;
    }

    .rating-text {
        font-size: 1rem;
        font-weight: 500;
    }

    .rating-text .badge {
        font-size: 0.9rem;
    }
</style>
@endpush

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const starsContainer = document.getElementById('starsContainer');
        const stars = document.querySelectorAll('.star-input');
        const ratingInput = document.getElementById('rating');
        const ratingText = document.getElementById('ratingText');
        
        const ratingLabels = {
            1: 'Poor',
            2: 'Fair',
            3: 'Good',
            4: 'Very Good',
            5: 'Excellent'
        };

        // Set initial rating
        const initialRating = parseInt(ratingInput.value) || 0;
        if (initialRating > 0) {
            updateStars(initialRating);
        }

        // Click event
        stars.forEach(star => {
            star.addEventListener('click', function() {
                const value = parseInt(this.dataset.value);
                ratingInput.value = value;
                updateStars(value);
            });

            // Hover event
            star.addEventListener('mouseenter', function() {
                const value = parseInt(this.dataset.value);
                highlightStars(value);
            });
        });

        // Reset hover effect when mouse leaves container
        starsContainer.addEventListener('mouseleave', function() {
            const currentValue = parseInt(ratingInput.value) || 0;
            updateStars(currentValue);
        });

        function highlightStars(value) {
            stars.forEach((star, index) => {
                if (index < value) {
                    star.classList.add('hover');
                } else {
                    star.classList.remove('hover');
                }
            });
        }

        function updateStars(value) {
            stars.forEach((star, index) => {
                star.classList.remove('hover');
                if (index < value) {
                    star.classList.add('active');
                } else {
                    star.classList.remove('active');
                }
            });

            if (value > 0) {
                ratingText.innerHTML = `<span class="badge bg-warning text-dark">${value} ${value === 1 ? 'Star' : 'Stars'}</span> - ${ratingLabels[value]}`;
            } else {
                ratingText.innerHTML = '<span class="text-muted">Click on stars to rate</span>';
            }
        }

        // Form validation
        document.getElementById('reviewForm').addEventListener('submit', function(e) {
            const rating = parseInt(ratingInput.value);
            if (!rating || rating < 1 || rating > 5) {
                e.preventDefault();
                alert('Please select a rating between 1 and 5 stars');
                return false;
            }
        });
    });
</script>
@endpush
@endsection