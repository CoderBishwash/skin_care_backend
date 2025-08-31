@extends('backend.layout')

@section('content')
<div class="container py-4">
    <h1>Add New Product</h1>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>@foreach ($errors->all() as $error)<li>{{ $error }}</li>@endforeach</ul>
        </div>
    @endif

    <form action="{{ route('admin.products.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="mb-3">
            <label>Name</label>
            <input type="text" name="name" class="form-control" value="{{ old('name') }}" required>
        </div>

        <div class="mb-3">
            <label>Slug</label>
            <input type="text" name="slug" class="form-control" value="{{ old('slug') }}" required>
        </div>

        <div class="mb-3">
            <label>Description</label>
            <textarea name="description" class="form-control">{{ old('description') }}</textarea>
        </div>

        <div class="mb-3">
            <label>Expected Results</label>
            <textarea name="expected_results" class="form-control">{{ old('expected_results') }}</textarea>
        </div>

        <div class="mb-3">
            <label>Usage Instructions</label>
            <textarea name="usage_instructions" class="form-control">{{ old('usage_instructions') }}</textarea>
        </div>

        <div class="mb-3">
            <label>Time of Use</label>
            <input type="text" name="time_of_use" class="form-control" value="{{ old('time_of_use') }}">
        </div>

        <div class="mb-3">
            <label>Shelf Life</label>
            <input type="text" name="shelf_life" class="form-control" value="{{ old('shelf_life') }}">
        </div>

        <div class="mb-3">
            <label>Image</label>
            <input type="file" name="image" class="form-control" accept="image/*" onchange="previewImage(event)">
            <div class="mt-2">
                <img id="preview" src="#" alt="Preview" style="display:none; max-width:150px;">
            </div>
        </div>

        <div class="mb-3">
            <label>Incompatible Products</label>
            <input type="text" name="incompatible_products" class="form-control" value="{{ old('incompatible_products') }}">
        </div>

        <div class="mb-3">
    <label for="recommended_for" class="form-label">Recommended For</label>
    <select name="recommended_for" id="recommended_for" class="form-control" required>
        <option value="" disabled selected>-- Select Skin Type --</option>
        @foreach(['Oily','Dry','Combination','Sensitive','All skin types'] as $type)
            <option value="{{ $type }}" {{ old('recommended_for') == $type ? 'selected' : '' }}>
                {{ $type }}
            </option>
        @endforeach
    </select>
</div>


        <div class="mb-3">
            <label>Recommended By (Doctors)</label>
            <select name="recommended_by[]" class="form-control" multiple>
                @foreach($doctors as $doctor)
                    <option value="{{ $doctor->id }}" {{ in_array($doctor->id, old('recommended_by', [])) ? 'selected' : '' }}>{{ $doctor->name }}</option>
                @endforeach
            </select>
        </div>

        <button type="submit" class="btn btn-primary">Save</button>
        <a href="{{ route('admin.products.index') }}" class="btn btn-secondary">Cancel</a>
    </form>
</div>

<script>
function previewImage(event){
    var reader = new FileReader();
    reader.onload = function(){
        var output = document.getElementById('preview');
        output.src = reader.result;
        output.style.display = 'block';
    };
    reader.readAsDataURL(event.target.files[0]);
}
</script>
@endsection
