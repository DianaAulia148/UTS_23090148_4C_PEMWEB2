<x-layouts.app :title="'Create Product'">
    <div class="max-w-4xl mx-auto">
        <flux:heading size="xl" class="text-center mb-4">Add New Product</flux:heading>
        <flux:subheading size="lg" class="text-center mb-6">Fill in the product details below</flux:subheading>
        <flux:separator variant="subtle" class="mb-6" />

        <form action="{{ route('dashboard.products.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
            @csrf

            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <flux:input name="name" label="Product Name" placeholder="e.g. iPhone 15" value="{{ old('name') }}" required />
                    @error('name')
                        <span class="text-red-500 text-sm">{{ $message }}</span>
                    @enderror
                </div>

                <div>
                    <flux:input name="sku" label="SKU" placeholder="e.g. IP15-001" value="{{ old('sku') }}" />
                    @error('sku')
                        <span class="text-red-500 text-sm">{{ $message }}</span>
                    @enderror
                </div>

                <div>
                    <flux:input name="price" label="Price" type="number" step="0.01" value="{{ old('price') }}" required />
                    @error('price')
                        <span class="text-red-500 text-sm">{{ $message }}</span>
                    @enderror
                </div>

                <div>
                    <flux:input name="stock" label="Stock" type="number" value="{{ old('stock') }}" required />
                    @error('stock')
                        <span class="text-red-500 text-sm">{{ $message }}</span>
                    @enderror
                </div>

                <div>
                    <flux:select name="is_active" label="Status" required>
                        <option value="1" {{ old('is_active') == '1' ? 'selected' : '' }}>Active</option>
                        <option value="0" {{ old('is_active') == '0' ? 'selected' : '' }}>Inactive</option>
                    </flux:select>
                    @error('is_active')
                        <span class="text-red-500 text-sm">{{ $message }}</span>
                    @enderror
                </div>

                <div>
                    <flux:select name="categories_id" label="Category" required>
                        <option value="">Select a Category</option>
                        @foreach($category as $category)
                            <option value="{{ $category->id }}" {{ old('categories_id') == $category->id ? 'selected' : '' }}>
                                {{ $category->name }}
                            </option>
                        @endforeach
                    </flux:select>
                    @error('categories_id')
                        <span class="text-red-500 text-sm">{{ $message }}</span>
                    @enderror
                </div>

                <div class="md:col-span-2">
                    <flux:input name="image" label="Product Image" type="file" />
                    @error('image')
                        <span class="text-red-500 text-sm">{{ $message }}</span>
                    @enderror
                </div>
            </div>

            <div class="flex justify-end space-x-2">
                <flux:link href="{{ route('dashboard.products.index') }}" variant="subtle">Cancel</flux:link>
                <flux:button icon="check" type="submit" class="bg-teal-600 hover:bg-teal-700 text-white">Save Product</flux:button>
            </div>
        </form>
    </div>
</x-layouts.app>
