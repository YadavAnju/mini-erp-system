<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold">Order: {{ $order->order_number }}</h2>
    </x-slot>

    <div class="bg-white p-4 rounded shadow space-y-4">
        <div>
            <strong>Salesperson:</strong> {{ $order->user->name }}<br>
            <strong>Date:</strong> {{ $order->created_at->format('d M Y h:i A') }}
        </div>

        <div>
            <h3 class="font-semibold text-md mb-2">Items:</h3>
            <ul>
                @foreach ($order->items as $item)
                    <li class="border-b py-1">
                        {{ $item->product->name }} — ₹{{ $item->price }} × {{ $item->quantity }}
                        = ₹{{ $item->line_total }}
                    </li>
                @endforeach
            </ul>
        </div>

        <div class="text-right font-bold text-lg">
            Total Amount: ₹{{ $order->total_amount }}
        </div>
    </div>
</x-app-layout>
