<x-layouts.app :title="'Edit Customer'">
    <flux:heading size="xl">Edit Customer</flux:heading>
    <form method="POST" action="{{ route('dashboard.customer.update', $customer->id) }}">
        @csrf
        @method('PUT')
        <flux:input label="Name" name="name" value="{{ old('name', $customer->name) }}" required />
        <flux:input label="Email" name="email" type="email" value="{{ old('email', $customer->email) }}" required />
        <flux:textarea label="Address" name="address">{{ old('address', $customer->address) }}</flux:textarea>

        <flux:button type="submit" icon="arrow-down-tray">Update</flux:button>
        <flux:link href="{{ route('dashboard.customer.index') }}" variant="subtle">Cancel</flux:link>
    </form>
</x-layouts.app>
