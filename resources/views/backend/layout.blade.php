<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Admin Dashboard - Skin Care</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
<style>
    body { font-family: 'Segoe UI', sans-serif; background: #f8f9fa; margin: 0; }

    /* Sidebar */
    .sidebar {
        width: 220px;
        position: fixed;
        top: 0;
        left: 0;
        height: 100vh;
        background: #343a40;
        color: #fff;
        display: flex;
        flex-direction: column;
        padding-top: 20px;
        box-shadow: 2px 0 5px rgba(0,0,0,0.1);
    }
    .sidebar h3 {
        font-size: 1.5rem;
        border-bottom: 1px solid #495057;
        text-align: center;
        padding-bottom: 10px;
        margin-bottom: 15px;
    }
    .sidebar a {
        color: #fff;
        display: flex;
        align-items: center;
        padding: 12px 20px;
        text-decoration: none;
        border-radius: 5px;
        margin: 5px 10px;
        transition: background 0.2s, color 0.2s;
    }
    .sidebar a i { margin-right: 10px; }
    .sidebar a:hover, .sidebar a.active { background: #495057; color: #fff; }

    /* Admin Profile */
    .admin-profile {
        padding: 15px;
        background: #495057;
        border-radius: 8px;
        display: flex;
        align-items: center;
        margin-bottom: 20px;
    }
    .admin-profile h6, .admin-profile small { color: #fff; margin: 0; }

    /* Logout button */
    .sidebar form button {
        width: calc(100% - 20px);
        margin: 10px;
        padding: 10px;
        border: none;
        border-radius: 5px;
        background: #dc3545;
        color: #fff;
        cursor: pointer;
        transition: background 0.2s;
    }
    .sidebar form button:hover {
        background: #c82333;
    }

    /* Content */
    .content {
        margin-left: 220px;
        padding: 20px;
        width: calc(100% - 220px);
        min-height: 100vh;
    }

    /* Navbar */
    .navbar { box-shadow: 0 2px 4px rgba(0,0,0,0.1); background-color: #fff; }
</style>
</head>
<body>

<div class="sidebar p-3">
    <!-- Admin Profile -->
    <div class="admin-profile">
        <div class="me-3">
            <i class="bi bi-person-circle" style="font-size: 36px;"></i>
        </div>
        <div>
            <h6>AashikaPanta</h6>
            <small>Admin</small>
        </div>
    </div>

    <!-- Sidebar Links -->
    <a href="{{ route('admin.dashboard') }}" class="{{ request()->is('admin/dashboard') ? 'active' : '' }}">
        <i class="bi bi-speedometer2"></i> Dashboard
    </a>

    <a href="{{ route('admin.products.index') }}" class="{{ request()->is('admin/products*') ? 'active' : '' }}">
        <i class="bi bi-box-seam"></i> Products
    </a>

    <a href="{{ route('admin.users.index') }}" class="{{ request()->is('admin/users*') ? 'active' : '' }}">
        <i class="bi bi-person"></i> Users
    </a>

    <a href="{{ route('admin.doctors.index') }}" class="{{ request()->is('admin/doctors*') ? 'active' : '' }}">
        <i class="bi bi-person-badge"></i> Doctors
    </a>

    <!-- Logout -->
    <form action="{{ route('admin.logout') }}" method="POST">
        @csrf
        <button type="submit">Logout</button>
    </form>
</div>

<div class="content">
    <nav class="navbar navbar-expand-lg navbar-light mb-3">
        <div class="container-fluid">
            <span class="navbar-brand">Admin Panel</span>
        </div>
    </nav>

    <!-- Main Content -->
    @yield('content')
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
