<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold">All Sales Orders</h2>
    </x-slot>

    <div class="bg-white p-4 rounded shadow">
        <table class="w-full text-sm text-left">
            <thead>
                <tr class="border-b">
                    <th class="p-2">Order #</th>
                    <th class="p-2">Salesperson</th>
                    <th class="p-2">Total</th>
                    <th class="p-2">Date</th>
                    <th class="p-2">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($orders as $order)
                    <tr class="border-b">
                        <td class="p-2 font-bold">{{ $order->order_number }}</td>
                        <td class="p-2">{{ $order->user->name }}</td>
                        <td class="p-2">₹{{ $order->total_amount }}</td>
                        <td class="p-2">{{ $order->created_at->format('d M Y') }}</td>
                        <td class="p-2">
                            <a href="{{ route('admin.orders.show', $order) }}" class="inline-block px-3 py-1 bg-blue-500 text-white rounded hover:bg-blue-600 transition">View</a>
                        </td>
                    </tr>
                @empty
                    <tr><td colspan="5" class="p-2">No orders found.</td></tr>
                @endforelse
            </tbody>
        </table>

        <div class="mt-4">
            {{ $orders->links() }}
        </div>
    </div>
</x-app-layout>
