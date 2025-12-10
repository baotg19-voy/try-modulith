@extends('core::layouts.master')

@section('content')
<div class="container-fluid">
    <div class="row mb-4">
        <div class="col-12">
            <div class="d-flex justify-content-between align-items-center">
                <h2 class="mb-0">Manage Categories</h2>
                <a href="{{ route('categories.create') }}" class="btn btn-primary">
                    <i class="bi bi-plus-circle"></i> Create Category
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
                    @if($categories->isEmpty())
                        <div class="alert alert-info text-center" role="alert">
                            No categories found. Create your first category!
                        </div>
                    @else
                        <div class="table-responsive">
                            <table class="table table-hover align-middle">
                                <thead class="table-light">
                                    <tr>
                                        <th style="width: 80px;">ID</th>
                                        <th>Name</th>
                                        <th>Slug</th>
                                        <th style="width: 200px;" class="text-end">Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($categories as $category)
                                        <tr>
                                            <td class="fw-bold text-muted">#{{ $category->id }}</td>
                                            <td>{{ $category->name }}</td>
                                            <td>
                                                <code class="text-secondary">{{ $category->slug }}</code>
                                            </td>
                                            <td class="text-end">
                                                <div class="btn-group btn-group-sm" role="group">
                                                    <a href="{{ route('categories.edit', $category->id) }}" 
                                                       class="btn btn-outline-primary" 
                                                       title="Edit">
                                                        Edit
                                                    </a>
                                                    <a href="{{ route('categories.destroy', $category->id) }}" 
                                                       class="btn btn-outline-danger"
                                                       onclick="return confirm('Are you sure you want to delete this category?')"
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
                            {{ $categories->links() }}
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>

@push('styles')
<style>
    .table code {
        background-color: #f8f9fa;
        padding: 2px 6px;
        border-radius: 4px;
        font-size: 0.875rem;
    }
    
    .btn-group-sm .btn {
        padding: 0.25rem 0.75rem;
        font-size: 0.875rem;
    }
    
    .card {
        border: none;
        border-radius: 8px;
    }
</style>
@endpush
@endsection