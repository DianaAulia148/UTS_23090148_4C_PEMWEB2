<x-layouts.app :title="__('Order Detail')">
    <div class="p-6 max-w-4xl mx-auto">
        <flux:heading size="xl">Order #{{ $order->id }}</flux:heading>
        <flux:subheading size="lg" class="mb-6">Details for this transaction</flux:subheading>
        <flux:separator variant="subtle" />

        <p><strong>Customer:</strong> {{ $order->customer->name }}</p>
        <p><strong>Date:</strong> {{ $order->order_date }}</p>
        <p><strong>Status:</strong> {{ ucfirst($order->status) }}</p>
        <p><strong>Total:</strong> {{ $order->total_amount }}</p>

        <h3 class="text-lg font-semibold mt-6 mb-2">Order Items:</h3>
        <div class="overflow-x-auto">
            <table class="min-w-full text-sm">
                <thead>
                    <tr>
                        <th>Product</th>
                        <th>Qty</th>
                        <th>Unit Price</th>
                        <th>Subtotal</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($order->orderDetails as $detail)
                    <tr>
                        <td>{{ $detail->product->name }}</td>
                        <td>{{ $detail->quantity }}</td>
                        <td>{{ $detail->unit_price }}</td>
                        <td>{{ $detail->subtotal }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</x-layouts.app>
