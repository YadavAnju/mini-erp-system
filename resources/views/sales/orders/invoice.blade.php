<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Invoice - {{ $order->order_number }}</title>
    <style>
        body { font-family: DejaVu Sans,sans-serif; font-size: 14px; }
        .header { text-align: center; margin-bottom: 20px; }
        .table { width: 100%; border-collapse: collapse; margin-top: 10px; }
        .table th, .table td { border: 1px solid #000; padding: 8px; }
        .right { text-align: right; }
    </style>
    
</head>
<body>
    <div class="header">
        <h2>Invoice</h2>
        <p>Order #: {{ $order->order_number }}</p>
        <p>Date: {{ $order->created_at->format('d M Y') }}</p>
    </div>

    <table class="table">
        <thead>
            <tr>
                <th>Product</th>
                <th class="right">Price</th>
                <th class="right">Qty</th>
                <th class="right">Line Total</th>
            </tr>
        </thead>
        <tbody>
            @foreach($order->items as $item)
                <tr>
                    <td>{{ $item->product->name }}</td>
                    <td class="right">₹{{ number_format($item->price, 2) }}</td>
                    <td class="right">{{ $item->quantity }}</td>
                    <td class="right">₹{{ number_format($item->line_total, 2) }}</td>
                </tr>
            @endforeach
            <tr>
                <td colspan="3" class="right"><strong>Total</strong></td>
                <td class="right"><strong>₹{{ number_format($order->total_amount, 2) }}</strong></td>
            </tr>
        </tbody>
    </table>
</body>
</html>
