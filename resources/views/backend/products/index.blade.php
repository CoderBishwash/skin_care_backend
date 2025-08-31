@extends('backend.layout')

@section('content')
<div class="container py-4">

    {{-- Header --}}
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="h3 fw-bold">Product Management</h1>
        <a href="{{ route('admin.products.create') }}" class="btn btn-primary shadow-sm">
            <i class="bi bi-plus-circle me-1"></i> Add Product
        </a>
    </div>

    {{-- Success Alert --}}
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    {{-- Product Table --}}
    <div class="table-responsive shadow-sm rounded">
        <table class="table table-hover align-middle text-center">
            <thead class="table-dark">
                <tr>
                    <th>Id</th>
                    <th>Image</th>
                    <th>Name</th>
                    <th>Slug</th>
                    <th>Description</th>
                    <th>Expected</th>
                    <th>Usage</th>
                    <th>Time</th>
                    <th>Shelf Life</th>
                    <th>Incompatible</th>
                    <th>Recommended For</th>
                    <th>Recommended By</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($products as $key => $product)
                    <tr>
                        <td>{{ $key + 1 }}</td>

                        {{-- Product Image --}}
                        <td>
                            @if($product->image && file_exists(public_path($product->image)))
                                <img src="{{ asset($product->image) }}" width="80" height="80" style="object-fit: cover; border-radius: 8px;">
                            @else
                                <span class="text-muted">No Image</span>
                            @endif
                        </td>

                        <td>{{ $product->name }}</td>
                        <td>{{ $product->slug }}</td>
                        <td>{{ Str::limit($product->description ?? '-', 40) }}</td>
                        <td>{{ Str::limit($product->expected_results ?? '-', 30) }}</td>
                        <td>{{ Str::limit($product->usage_instructions ?? '-', 30) }}</td>
                        <td>{{ $product->time_of_use ?? '-' }}</td>
                        <td>{{ $product->shelf_life ?? '-' }}</td>

                        {{-- Incompatible Products --}}
                        <td>
                            @if($product->incompatible_products)
                                @foreach(explode(',', $product->incompatible_products) as $item)
                                    <span class="badge bg-warning text-dark">{{ trim($item) }}</span>
                                @endforeach
                            @else
                                <span class="text-muted">None</span>
                            @endif
                        </td>

                        <td>{{ $product->recommended_for ?? '-' }}</td>

                        {{-- Recommended By --}}
                        <td>
                            @if($product->recommendedByDoctors->count())
                                @foreach($product->recommendedByDoctors as $doctor)
                                    <span class="badge bg-info text-dark">{{ $doctor->name }}</span>
                                @endforeach
                            @else
                                <span class="text-muted">None</span>
                            @endif
                        </td>

                        {{-- Actions --}}
                        <td>
                            <div class="dropdown">
                                <button class="btn btn-sm btn-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown">
                                    <i class="bi bi-gear"></i>
                                </button>
                                <ul class="dropdown-menu dropdown-menu-end">
                                    <li>
                                        <a class="dropdown-item" href="{{ route('admin.products.edit', $product->id) }}">
                                            <i class="bi bi-pencil-square me-1"></i> Edit
                                        </a>
                                    </li>
                                    <li>
                                        <form action="{{ route('admin.products.destroy', $product->id) }}" method="POST" onsubmit="return confirm('Are you sure?');">
                                            @csrf
                                            @method('DELETE')
                                            <button class="dropdown-item text-danger"><i class="bi bi-trash me-1"></i> Delete</button>
                                        </form>
                                    </li>
                                </ul>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="13" class="text-center text-muted">No products found.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

</div>
@endsection
