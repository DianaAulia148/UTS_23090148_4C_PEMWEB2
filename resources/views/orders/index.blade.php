<x-layouts.app :title="__('Orders')">
    <div class="p-6 max-w-7xl mx-auto">
        <flux:heading size="xl">Orders</flux:heading>
        <flux:subheading size="lg" class="mb-6">All Order Transactions</flux:subheading>
        <flux:separator variant="subtle" />

        <div class="overflow-x-auto">
            <table class="min-w-full text-sm">
                <thead>
                    <tr>
                        <th>#ID</th>
                        <th>Customer</th>
                        <th>Date</th>
                        <th>Status</th>
                        <th>Total</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($orders as $order)
                    <tr>
                        <td>{{ $order->id }}</td>
                        <td>{{ $order->customer->name }}</td>
                        <td>{{ $order->order_date }}</td>
                        <td>{{ ucfirst($order->status) }}</td>
                        <td>{{ $order->total_amount }}</td>
                        <td>
                            <a href="{{ route('orders.show', $order) }}">Details</a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</x-layouts.app>
