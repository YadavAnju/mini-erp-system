<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl">Product List</h2>
    </x-slot>

    <div class="bg-white p-4 rounded shadow">
        <a href="{{ route('admin.products.create') }}" class="inline-block px-3 py-1 bg-blue-500 text-white rounded hover:bg-blue-600 transition">+ Add
            Product</a>

        @if (session('success'))
            <div class="bg-green-100 p-2 rounded text-green-700 mb-3">{{ session('success') }}</div>
        @endif

        <table class="w-full text-left">
            <thead>
                <tr class="border-b">
                    <th class="p-2">Name</th>
                    <th class="p-2">SKU</th>
                    <th class="p-2">Price</th>
                    <th class="p-2">Quantity</th>
                    <th class="p-2">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($products as $product)
                    <tr class="border-b">
                        <td class="p-2">{{ $product->name }}</td>
                        <td class="p-2">{{ $product->sku }}</td>
                        <td class="p-2">₹{{ $product->price }}</td>
                        <td class="p-2">{{ $product->quantity }}</td>
                        <td class="p-2 space-x-2 flex items-center">
                            <a href="{{ route('admin.products.edit', $product) }}"
                                class="inline-block px-3 py-1 bg-blue-500 text-white rounded hover:bg-blue-600 transition">
                                Edit
                            </a>

                            <form method="POST" action="{{ route('admin.products.destroy', $product) }}"
                                onsubmit="return confirm('Delete this product?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit"
                                    class="inline-block px-3 py-1 bg-red-500 text-white rounded hover:bg-red-600 transition">
                                    Delete
                                </button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="p-2">No products found.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>

        <div class="mt-4">{{ $products->links() }}</div>
    </div>
</x-app-layout>
