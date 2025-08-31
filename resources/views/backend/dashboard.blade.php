@extends('backend.layout')

@section('content')
<div class="container-fluid">
    <h1 class="mb-4">Welcome to Skin Care Admin Dashboard</h1>

    <div class="row g-4">
        <!-- Products Card (Blue) -->
        <div class="col-md-4">
            <div class="card shadow-sm border-0 h-100 text-white bg-primary">
                <div class="card-body d-flex align-items-center">
                    <div class="me-3">
                        <i class="bi bi-box-seam" style="font-size: 3rem;"></i>
                    </div>
                    <div>
                        <h5 class="card-title">Products</h5>
                        <h2 class="card-text">{{ $productsCount ?? 0 }}</h2>
                    </div>
                </div>
            </div>
        </div>

        <!-- Users Card (Green) -->
        <div class="col-md-4">
            <div class="card shadow-sm border-0 h-100 text-white bg-success">
                <div class="card-body d-flex align-items-center">
                    <div class="me-3">
                        <i class="bi bi-people-fill" style="font-size: 3rem;"></i>
                    </div>
                    <div>
                        <h5 class="card-title">Users</h5>
                        <h2 class="card-text">{{ $usersCount ?? 0 }}</h2>
                    </div>
                </div>
            </div>
        </div>
 <div class="col-md-4">
            <div class="card shadow-sm border-0 h-100 text-white bg-secondary">
                <div class="card-body d-flex align-items-center">
                    <div class="me-3">
                        <i class="bi bi-people-fill" style="font-size: 3rem;"></i>
                    </div>
                    <div>
                        <h5 class="card-title">Doctors</h5>
                        <h2 class="card-text">{{ $doctorsCount ?? 0 }}</h2>
                    </div>
                </div>
            </div>
        </div>
       
    </div>
</div>
@endsection
