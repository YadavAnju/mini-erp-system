<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl">Add Product</h2>
    </x-slot>

    <div class="bg-white p-4 rounded shadow">
        <form method="POST" action="{{ route('admin.products.store') }}">
            @csrf

            <x-input-label for="name" value="Name" />
            <x-text-input id="name" name="name" value="{{ old('name', $product->name ?? '') }}" class="block w-full mb-3"/>
            <x-input-error :messages="$errors->get('name')" class="mt-1 text-sm text-red-600" />
                
            <x-input-label for="sku" value="SKU" />
            <x-text-input id="sku" name="sku" value="{{ old('sku', $product->sku ?? '') }}" class="block w-full mb-3" />
            <x-input-error :messages="$errors->get('sku')" class="mt-1" />

            <x-input-label for="price" value="Price" />
            <x-text-input id="price" name="price" type="number" step="0.01" value="{{ old('price', $product->price ?? '') }}" class="block w-full mb-3" />
            <x-input-error :messages="$errors->get('price')" class="mt-1" />

            <x-input-label for="quantity" value="Quantity" />
            <x-text-input id="quantity" name="quantity" type="number" value="{{ old('quantity', $product->quantity ?? '') }}" class="block w-full mb-3" />
            <x-input-error :messages="$errors->get('quantity')" class="mt-1" />

            <x-primary-button>Add Product</x-primary-button>
        </form>
    </div>
</x-app-layout>
