<x-layouts.app :title="'Add Customer'">
    <flux:heading size="xl">Add Customer</flux:heading>
    <form method="POST" action="{{ route('dashboard.customer.store') }}">
        @csrf
        <flux:input label="Name" name="name" value="{{ old('name') }}" required />
        <flux:input label="Email" name="email" type="email" value="{{ old('email') }}" required />
        <flux:textarea label="Address" name="address">{{ old('address') }}</flux:textarea>

        <flux:button type="submit" icon="arrow-down-tray">Save</flux:button>
        <flux:link href="{{ route('dashboard.customer.index') }}" variant="subtle">Cancel</flux:link>
    </form>
</x-layouts.app>
