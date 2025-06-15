<div class="w-64 bg-white border-r min-h-screen px-4 py-6">
    <div class="text-lg font-bold mb-6">
        {{ auth()->user()->name }}
        {{-- <span class="text-xs block text-gray-500">{{ auth()->user()->getRoleNames()->first() }}</span> --}}
    </div>

    <nav class="space-y-2 text-sm">
        @if(auth()->user()->hasRole('admin'))
            <a href="{{ route('dashboard') }}" class="block px-2 py-1 rounded hover:bg-gray-100">Dashboard</a>
            <a href="{{ route('admin.products.index') }}" class="block px-2 py-1 rounded hover:bg-gray-100">Products</a>
            <a href="{{ route('admin.orders.index') }}" class="block px-2 py-1 rounded hover:bg-gray-100">Orders</a>

        @elseif(auth()->user()->hasRole('salesperson'))
            <a href="{{ route('dashboard') }}" class="block px-2 py-1 rounded hover:bg-gray-100">Dashboard</a>
            <a href="{{ route('sales.orders.create') }}" class="block px-2 py-1 rounded hover:bg-gray-100">New Order</a>
            <a href="{{ route('sales.orders.index') }}" class="block px-2 py-1 rounded hover:bg-gray-100">My Orders</a>
        @endif
    </nav>
</div>
