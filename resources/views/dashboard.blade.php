@extends('layout')

@section('content')
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow-lg">
                <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
                    <span>{{ __('Dashboard') }}</span>
                    <i class="fas fa-tachometer-alt"></i>
                </div>

                <div class="card-body">
                    <h1 class="mb-4">Hello, {{ auth()->user()->name }}</h1>
                    @if (session('success'))
                    <div class="alert alert-success" role="alert">
                        {{ session('success') }}
                    </div>
                    @endif

                    <!-- Running Text -->
                    <div class="running-text-container mb-4">
                        <div class="running-text">
                            Welcome to the Admin Dashboard! Stay tuned for updates and announcements.
                        </div>
                    </div>

                    <div class="row mb-4">
                        <div class="col-6">
                            <div class="card border-0 shadow-sm text-center">
                                <div class="card-body">
                                    <h5 class="card-title">
                                        <i class="fas fa-shopping-cart"></i> Total Transactions
                                    </h5>
                                    <h1 class="display-4">{{ $cBooking }}</h1>
                                </div>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="card border-0 shadow-sm text-center">
                                <div class="card-body">
                                    <h5 class="card-title">
                                        <i class="fas fa-users"></i> Total Users
                                    </h5>
                                    <h1 class="display-4">{{ $cUser }}</h1>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-12 mb-4">
                            <div class="card p-4 bg-light shadow-sm">
                                {!! $chart->container() !!}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="{{ $chart->cdn() }}"></script>
{{ $chart->script() }}

<style>
    .running-text-container {
        overflow: hidden;
        white-space: nowrap;
        box-sizing: border-box;
    }
    .running-text {
        display: inline-block;
        padding-left: 100%;
        animation: running-text 15s linear infinite;
    }
    @keyframes running-text {
        0% {
            transform: translateX(100%);
        }
        100% {
            transform: translateX(-100%);
        }
    }
    .card-title i {
        margin-right: 10px;
    }
</style>
@endsection
