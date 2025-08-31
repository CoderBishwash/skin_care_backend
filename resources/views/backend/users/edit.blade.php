@extends('backend.layout')

@section('content')
<div class="container">
    <h2>Edit User</h2>
    <a href="{{ route('admin.users.index') }}" class="btn btn-secondary mb-3">Back to Users</a>

    @if($errors->any())
        <div class="alert alert-danger">
            <ul>@foreach($errors->all() as $error) <li>{{ $error }}</li> @endforeach</ul>
        </div>
    @endif

    <form action="{{ route('admin.users.update', $user->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label class="form-label">Username</label>
            <input type="text" name="username" class="form-control" value="{{ old('username', $user->username) }}" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Email</label>
            <input type="email" name="email" class="form-control" value="{{ old('email', $user->email) }}" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Age</label>
            <input type="number" name="age" class="form-control" value="{{ old('age', $user->age) }}" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Gender</label>
            <select name="gender" class="form-control" required>
                <option value="male" {{ old('gender', $user->gender)=='male' ? 'selected' : '' }}>Male</option>
                <option value="female" {{ old('gender', $user->gender)=='female' ? 'selected' : '' }}>Female</option>
                <option value="other" {{ old('gender', $user->gender)=='other' ? 'selected' : '' }}>Other</option>
            </select>
        </div>

        <div class="mb-3">
            <label class="form-label">Password (leave blank to keep current)</label>
            <input type="password" name="password" class="form-control">
        </div>

        <div class="mb-3">
            <label class="form-label">Confirm Password</label>
            <input type="password" name="password_confirmation" class="form-control">
        </div>

                <button type="submit" class="btn btn-success">Update User</button>
    </form>
</div>
@endsection

