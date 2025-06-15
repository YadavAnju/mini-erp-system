<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold">My Orders</h2>
    </x-slot>

    <div class="bg-white p-4 rounded shadow">
        <table class="w-full text-left">
            <thead>
                <tr class="border-b">
                    <th class="p-2">Order #</th>
                    <th class="p-2">Total Amount</th>
                    <th class="p-2">Status</th>
                    <th class="p-2">Date</th>
                    <th class="p-2">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($orders as $order)
                    <tr class="border-b">
                        <td class="p-2">{{ $order->order_number }}</td>
                        <td class="p-2">₹{{ $order->total_amount }}</td>
                        <td class="p-2">{{ ucfirst($order->status) }}</td>
                        <td class="p-2">{{ $order->created_at->format('d M Y') }}</td>
                        <td class="p-2">
                            <a href="{{ route('sales.orders.show', $order) }}"
                               class="inline-block px-3 py-1 bg-blue-500 text-white rounded hover:bg-blue-600 transition">View</a>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="p-4 text-center">No orders found.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</x-app-layout>

