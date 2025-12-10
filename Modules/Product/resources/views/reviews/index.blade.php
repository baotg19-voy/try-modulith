@extends('core::layouts.master')

@section('content')
<div class="container-fluid">
    <div class="row mb-4">
        <div class="col-12">
            <div class="d-flex justify-content-between align-items-center">
                <h2 class="mb-0">Manage Reviews</h2>
                <a href="{{ route('reviews.create') }}" class="btn btn-primary">
                    <i class="bi bi-plus-circle"></i> Create Review
                </a>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-12">
            @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            <div class="card shadow-sm">
                <div class="card-body">
                    @if($reviews->isEmpty())
                        <div class="alert alert-info text-center" role="alert">
                            No reviews found. Create your first review!
                        </div>
                    @else
                        <div class="table-responsive">
                            <table class="table table-hover align-middle">
                                <thead class="table-light">
                                    <tr>
                                        <th style="width: 200px;">ID</th>
                                        <th style="width: 200px;">Product</th>
                                        <th style="width: 180px;">Author</th>
                                        <th style="width: 120px;">Rating</th>
                                        <th>Comment</th>
                                        <th style="width: 150px;">Date</th>
                                        <th style="width: 200px;" class="text-end">Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($reviews as $review)
                                        <tr>
                                            <td>
                                                <code class="text-muted small">{{ $review->id }}</code>
                                            </td>
                                            <td>
                                                @if(isset($products[$review->product_id]))
                                                    <div>
                                                        <span class="badge bg-info">ID: {{ $review->product_id }}</span>
                                                        <div class="small text-muted mt-1">{{ $products[$review->product_id]->name }}</div>
                                                    </div>
                                                @else
                                                    <span class="badge bg-secondary">Product #{{ $review->product_id }}</span>
                                                    <div class="small text-danger mt-1">Product not found</div>
                                                @endif
                                            </td>
                                            <td>
                                                <div class="fw-semibold">{{ $review->author_name }}</div>
                                            </td>
                                            <td>
                                                <div class="rating-stars">
                                                    @for($i = 1; $i <= 5; $i++)
                                                        @if($i <= $review->rating)
                                                            <span class="star filled">★</span>
                                                        @else
                                                            <span class="star empty">★</span>
                                                        @endif
                                                    @endfor
                                                    <span class="ms-1 text-muted">({{ $review->rating }})</span>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="text-truncate" style="max-width: 350px;" title="{{ $review->comment }}">
                                                    {{ $review->comment }}
                                                </div>
                                            </td>
                                            <td>
                                                <small class="text-muted">{{ \Carbon\Carbon::parse($review->created_at)->format('M d, Y') }}</small>
                                            </td>
                                            <td class="text-end">
                                                <div class="btn-group btn-group-sm" role="group">
                                                    <a href="{{ route('reviews.edit', $review->id) }}" 
                                                       class="btn btn-outline-primary" 
                                                       title="Edit">
                                                        Edit
                                                    </a>
                                                    <a href="{{ route('reviews.destroy', $review->id) }}" 
                                                       class="btn btn-outline-danger"
                                                       onclick="return confirm('Are you sure you want to delete this review?')"
                                                       title="Delete">
                                                        Delete
                                                    </a>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>

                        <!-- Pagination -->
                        <div class="pagination-container d-flex justify-content-between align-items-center mt-4 flex-grow-1">
                            {{ $reviews->links() }}
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>

@push('styles')
<style>
    .table .text-truncate {
        overflow: hidden;
        text-overflow: ellipsis;
        white-space: nowrap;
    }
    
    .btn-group-sm .btn {
        padding: 0.25rem 0.75rem;
        font-size: 0.875rem;
    }
    
    .card {
        border: none;
        border-radius: 8px;
    }

    .badge {
        font-weight: 500;
        padding: 0.375rem 0.625rem;
    }

    .pagination-container {
        padding-top: 1rem;
        border-top: 1px solid #e9ecef;
    }

    .rating-stars {
        display: flex;
        align-items: center;
    }

    .rating-stars .star {
        font-size: 1.2rem;
        margin-right: 2px;
    }

    .rating-stars .star.filled {
        color: #ffc107;
    }

    .rating-stars .star.empty {
        color: #e0e0e0;
    }

    code.text-muted {
        background-color: #f8f9fa;
        padding: 4px 8px;
        border-radius: 4px;
        font-size: 0.75rem;
        display: inline-block;
        max-width: 200px;
        overflow: hidden;
        text-overflow: ellipsis;
        white-space: nowrap;
    }
</style>
@endpush
@endsection