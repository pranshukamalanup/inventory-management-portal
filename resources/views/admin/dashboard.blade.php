@extends('admin.layouts.app')

@section('title', 'Admin Dashboard')

@section('content')

<div class="container-fluid">

    {{-- Welcome --}}
    <div class="mb-4">
        <h3 class="fw-bold mb-1">
            Welcome, {{ auth('admin')->user()->name }}
        </h3>
        <p class="text-muted mb-0">
            Admin Control Panel Overview
        </p>
    </div>

    {{-- Stats Cards --}}
    <div class="row g-4 mb-4">

        {{-- Total Products --}}
        <div class="col-md-4">
            <a href="/admin/products" class="text-decoration-none">
                <div class="card stat-card bg-primary text-white">
                    <div class="card-body d-flex justify-content-between align-items-center">
                        <div>
                            <small class="text-white-50">Total Products</small>
                            <h2 class="fw-bold mb-0">{{ $totalProducts }}</h2>
                        </div>
                        <div class="icon">📦</div>
                    </div>
                </div>
            </a>
        </div>

        {{-- Online Customers --}}
        <div class="col-md-4">
            <a href="#" class="text-decoration-none">
                <div class="card stat-card bg-success text-white">
                    <div class="card-body d-flex justify-content-between align-items-center">
                        <div>
                            <small class="text-white-50">Online Customers</small>
                            <h2 id="online-customers" class="fw-bold mb-0">
                                {{ $onlineCustomers }}
                            </h2>
                        </div>
                        <div class="icon">👤</div>
                    </div>
                </div>
            </a>
        </div>

        {{-- Online Admins --}}
        <div class="col-md-4">
            <a href="#" class="text-decoration-none">
                <div class="card stat-card bg-dark text-white">
                    <div class="card-body d-flex justify-content-between align-items-center">
                        <div>
                            <small class="text-white-50">Online Admins</small>
                            <h2 id="online-admins" class="fw-bold mb-0">
                                {{ $onlineAdmins }}
                            </h2>
                        </div>
                        <div class="icon">🛡️</div>
                    </div>
                </div>
            </a>
        </div>

    </div>

    {{-- Product Management --}}
    <div class="row">
        <div class="col-12">
            <div class="card shadow-sm border-0">
                <div class="card-body d-flex justify-content-between align-items-center">
                    <div>
                        <h5 class="fw-bold mb-1">Product Management</h5>
                        <p class="text-muted mb-0">
                            Create, update, import and manage products
                        </p>
                    </div>
                    <div class="d-flex gap-2">
                        <a href="/admin/products/import" class="btn btn-outline-primary">
                            Import Products
                        </a>
                        <a href="/admin/products" class="btn btn-primary">
                            Manage Products
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>

    {{-- ===============================
     Real-time Listener (JS)
     =============================== --}}
    <script>
    document.addEventListener('DOMContentLoaded', function () {

        console.log('Dashboard JS loaded');

        // Echo available check
        if (typeof window.Echo === 'undefined') {
            console.error('Echo is NOT available');
            return;
        }

        console.log('Echo detected', window.Echo);

        // Join channel
        const channel = Echo.channel('admin-dashboard');

        console.log('Listening on channel: admin-dashboard');

        channel.listen('.presence.updated', (e) => {
            console.log('Presence event received:', e);

            const adminEl = document.getElementById('online-admins');
            const customerEl = document.getElementById('online-customers');

            if (adminEl) {
                adminEl.innerText = e.onlineAdmins;
                console.log('Updated admins:', e.onlineAdmins);
            } else {
                console.warn('Admin element not found');
            }

            if (customerEl) {
                customerEl.innerText = e.onlineCustomers;
                console.log('Updated customers:', e.onlineCustomers);
            } else {
                console.warn('Customer element not found');
            }
        });

    });
    </script>


{{-- Small UI polish --}}
<style>
    .stat-card {
        border-radius: 14px;
        transition: transform .15s ease, box-shadow .15s ease;
        min-height: 120px;
    }

    .stat-card:hover {
        transform: translateY(-3px);
        box-shadow: 0 12px 25px rgba(0,0,0,0.15);
    }

    .stat-card .icon {
        font-size: 2.8rem;
        opacity: .45;
    }
</style>

@endsection
