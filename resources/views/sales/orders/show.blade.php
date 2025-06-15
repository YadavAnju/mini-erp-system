<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold">Order {{ $order->order_number }}</h2>
    </x-slot>

    <div class="bg-white p-6 rounded shadow space-y-4">
        <div class="text-sm text-gray-500">Date: {{ $order->created_at->format('d M Y') }}</div>
        <a href="{{ route('sales.orders.pdf', $order) }}" class="inline-block px-3 py-1 bg-blue-500 text-white rounded hover:bg-blue-600 transition" target="_blank">Download PDF</a>

        <table class="w-full text-left">
            <thead>
                <tr class="border-b">
                    <th class="p-2">Product</th>
                    <th class="p-2">Price</th>
                    <th class="p-2">Qty</th>
                    <th class="p-2">Line Total</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($order->items as $item)
                    <tr class="border-b">
                        <td class="p-2">{{ $item->product->name }}</td>
                        <td class="p-2">₹{{ $item->price }}</td>
                        <td class="p-2">{{ $item->quantity }}</td>
                        <td class="p-2">₹{{ $item->line_total }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <div class="text-right mt-4 text-xl font-bold">
            Total: ₹{{ $order->total_amount }}
        </div>
    </div>
</x-app-layout>
