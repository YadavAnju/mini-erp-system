<x-app-layout>
    <x-slot name="header">
        <h2 class="fw-semibold h4 text-dark">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="container py-4">
        @if(auth()->user()->hasRole('admin'))
            {{-- Admin Dashboard --}}
            <div class="row">
                <div class="col-md-4 mb-3">
                    <div class="card border-success shadow">
                        <div class="card-body text-success">
                            <h5 class="card-title">Total Sales</h5>
                            <p class="card-text fs-4">₹{{ $totalSales }}</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 mb-3">
                    <div class="card border-primary shadow">
                        <div class="card-body text-primary">
                            <h5 class="card-title">Total Orders</h5>
                            <p class="card-text fs-4">{{ $totalOrders }}</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 mb-3">
                    <div class="card border-warning shadow">
                        <div class="card-body text-warning">
                            <h5 class="card-title">Low Stock Products</h5>
                            <p class="card-text fs-4">{{ $lowStockCount }}</p>
                        </div>
                    </div>
                </div>
            </div>
        @elseif(auth()->user()->hasRole('salesperson'))
            {{-- Sales Dashboard --}}
            <div class="row">
                <div class="col-md-4 mb-3">
                    <div class="card border-info shadow">
                        <div class="card-body text-info">
                            <h5 class="card-title">Your Orders</h5>
                            <p class="card-text fs-4">{{ $myOrders }}</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 mb-3">
                    <div class="card border-success shadow">
                        <div class="card-body text-success">
                            <h5 class="card-title">Your Sales</h5>
                            <p class="card-text fs-4">₹{{ $mySales }}</p>
                        </div>
                    </div>
                </div>
            </div>
        @else
            <div class="alert alert-warning">No dashboard available for your role.</div>
        @endif
    </div>
</x-app-layout>
