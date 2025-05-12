@extends('layouts.admin')

@section('content')
<div class="row">
    <div class="col-lg-12">
        <div class="card welcome-card mb-4">
            <div class="card-body d-flex align-items-center">
                <img src="{{ asset('images/logo chef.png') }}" alt="Dashboard Icon" class="welcome-icon me-3">
                <div>
                    <h3 class="card-title mb-1">Selamat Datang di <strong>TelkomResto Admin Panel</strong>!</h3>
                    <p class="card-text">Kelola pesanan, keuangan, dan akun kasir dengan mudah dan cepat.</p>
                </div>
            </div>
        </div>

        <div class="row g-3">
            <div class="col-md-4">
                <div class="card stat-card">
                    <div class="card-body text-center">
                        <i class="fas fa-shopping-cart stat-icon"></i>
                        <h5 class="card-title">Pesanan Hari Ini</h5>
                        <p class="stat-value">25</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card stat-card">
                    <div class="card-body text-center">
                        <i class="fas fa-money-bill-wave stat-icon"></i>
                        <h5 class="card-title">Total Pendapatan</h5>
                        <p class="stat-value">Rp 1.500.000</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card stat-card">
                    <div class="card-body text-center">
                        <i class="fas fa-users stat-icon"></i>
                        <h5 class="card-title">Kasir Aktif</h5>
                        <p class="stat-value">3 Orang</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
