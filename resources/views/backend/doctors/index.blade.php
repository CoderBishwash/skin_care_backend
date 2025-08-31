@extends('backend.layout')

@section('content')
<div class="container py-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="h3">Doctors</h1>
        <a href="{{ route('admin.doctors.create') }}" class="btn btn-success">+ Add Doctor</a>
    </div>

    {{-- Success message --}}
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="table-responsive">
        <table class="table table-striped table-hover text-center align-middle">
            <thead class="table-dark">
                <tr>
                    <th>Id</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Phone</th>
                    <th>Specialization</th>
                    <th>Recommended Products</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
            @forelse($doctors as $index => $doctor)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $doctor->name }}</td>
                    <td>{{ $doctor->email ?? '-' }}</td>
                    <td>{{ $doctor->phone ?? '-' }}</td>
                    <td>{{ $doctor->specialization ?? '-' }}</td>
                    <td>
                        @forelse($doctor->products as $product)
                            <span class="badge bg-info text-dark">{{ $product->name }}</span>
                        @empty
                            <span class="text-muted">None</span>
                        @endforelse
                    </td>
                    <td>
                        <a href="{{ route('admin.doctors.edit', $doctor->id) }}" class="btn btn-sm btn-primary">
                            Edit
                        </a>
                        <form action="{{ route('admin.doctors.destroy', $doctor->id) }}" method="POST" style="display:inline-block">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-sm btn-danger" onclick="return confirm('Are you sure you want to delete this doctor?')">
                                Delete
                            </button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="7" class="text-center text-muted">No doctors found.</td>
                </tr>
            @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
