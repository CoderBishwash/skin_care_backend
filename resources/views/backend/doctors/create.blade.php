

@extends('backend.layout')

@section('content')
<div class="container py-4">
    <h1>Add New Doctor</h1>

    {{-- Display validation errors --}}
    @if($errors->any())
        <div class="alert alert-danger">
            <ul>
            @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('admin.doctors.store') }}" method="POST">
        @csrf

        <div class="mb-3">
            <label>Name</label>
            <input type="text" name="name" class="form-control" value="{{ old('name') }}" required>
        </div>

        <div class="mb-3">
            <label>Email</label>
            <input type="email" name="email" class="form-control" value="{{ old('email') }}">
        </div>

        <div class="mb-3">
            <label>Phone</label>
            <input type="text" name="phone" class="form-control" value="{{ old('phone') }}">
        </div>

        <div class="mb-3">
            <label>Specialization</label>
            <input type="text" name="specialization" class="form-control" value="{{ old('specialization') }}">
        </div>

        <div class="mb-3">
            <label>Recommended Products</label>
            <select name="recommended_products[]" class="form-control" multiple>
                @foreach($products as $product)
                    <option value="{{ $product->id }}" 
                        {{ in_array($product->id, old('recommended_products', [])) ? 'selected' : '' }}>
                        {{ $product->name }}
                    </option>
                @endforeach
            </select>
            <small class="text-muted">Hold Ctrl (Cmd on Mac) to select multiple products</small>
        </div>

        <button type="submit" class="btn btn-primary">Save</button>
        <a href="{{ route('admin.doctors.index') }}" class="btn btn-secondary">Cancel</a>
    </form>
</div>
@endsection
