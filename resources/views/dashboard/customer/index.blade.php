<x-layouts.app :title="'Customer'">
    <div class="relative mb-6 w-full">
        <flux:heading size="xl">Customers</flux:heading>
        <flux:subheading size="lg" class="mb-6">Manage customer data</flux:subheading>
        <flux:separator variant="subtle" />
    </div>

    <div class="flex justify-between items-center mb-4">
        <div>
            <form action="{{ route('dashboard.customer.index') }}" method="get">
                <flux:input icon="magnifying-glass" name="q" value="{{ request('q') }}" placeholder="Search Customers" />
            </form>
        </div>
        <div>
            <flux:button icon="plus">
                <flux:link href="{{ route('dashboard.customer.create') }}" variant="subtle">Add New Customer</flux:link>
            </flux:button>
        </div>
    </div>

    @if(session()->has('success'))
        <flux:badge color="lime" class="mb-3 w-full">{{ session('success') }}</flux:badge>
    @endif

    <!-- Tambahan w-full pada pembungkus dan table -->
    <div class="overflow-x-auto w-full">
        <table class="w-full leading-normal border border-gray-200 rounded">
            <thead class="bg-gray-100">
                <tr>
                    <th class="px-4 py-2 text-left">No</th>
                    <th class="px-4 py-2 text-left">Name</th>
                    <th class="px-4 py-2 text-left">Email</th>
                    <th class="px-4 py-2 text-left">Address</th>
                    <th class="px-4 py-2 text-left">Created At</th>
                    <th class="px-4 py-2 text-left">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($customers as $index => $customer)
                    <tr class="border-t">
                        <td class="px-4 py-2">{{ $index + 1 }}</td>
                        <td class="px-4 py-2">{{ $customer->name }}</td>
                        <td class="px-4 py-2">{{ $customer->email }}</td>
                        <td class="px-4 py-2">{{ $customer->address }}</td>
                        <td class="px-4 py-2">{{ $customer->created_at->format('Y-m-d') }}</td>
                        <td class="px-4 py-2">
                            <flux:dropdown>
                                <flux:button icon:trailing="chevron-down">Actions</flux:button>
                                <flux:menu>
                                    <flux:menu.item icon="pencil" href="{{ route('dashboard.customer.edit', $customer->id) }}">Edit</flux:menu.item>
                                    <flux:menu.item icon="trash" variant="danger" onclick="event.preventDefault(); if(confirm('Are you sure?')) document.getElementById('delete-{{ $customer->id }}').submit();">Delete</flux:menu.item>
                                    <form id="delete-{{ $customer->id }}" action="{{ route('dashboard.customer.destroy', $customer->id) }}" method="POST" style="display: none;">
                                        @csrf
                                        @method('DELETE')
                                    </form>
                                </flux:menu>
                            </flux:dropdown>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="text-center py-4">No customers found.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</x-layouts.app>
