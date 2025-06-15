<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold">Create Sales Order</h2>
    </x-slot>

    @if (session('success'))
        <div class="bg-green-100 text-green-800 p-2 rounded mb-4">
            {{ session('success') }}
        </div>
    @endif

    @if ($errors->any())
        <div class="bg-red-100 text-red-800 p-2 rounded mb-4">
            <ul class="list-disc ml-5">
                @foreach ($errors->all() as $err)
                    <li>{{ $err }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form method="POST" action="{{ route('sales.orders.store') }}">
        @csrf

        <div class="space-y-4">
            @foreach ($products as $product)
                <div class="p-4 bg-white shadow rounded">
                    <label class="flex justify-between items-center">
                        <span>
                            {{ $product->name }} (₹{{ $product->price }})<br>
                            <small class="text-gray-500">In stock: {{ $product->quantity }}</small>
                        </span>
                        <input type="number" name="products[{{ $loop->index }}][quantity]" class="w-24 border ml-4"
                            min="0" value="0">
                        <input type="hidden" name="products[{{ $loop->index }}][product_id]"
                            value="{{ $product->id }}">
                    </label>
                </div>
            @endforeach
        </div>

        <x-primary-button class="mt-4">Submit Order</x-primary-button>
    </form>
</x-app-layout>
