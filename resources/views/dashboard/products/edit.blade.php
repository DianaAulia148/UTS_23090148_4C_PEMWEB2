<x-layouts.app :title="'Products'">
    <div class="relative mb-6 w-full">
        <flux:heading size="xl">Update Product</flux:heading>
        <flux:subheading size="lg" class="mb-6">Manage product data</flux:subheading>
        <flux:separator variant="subtle" />
    </div>

    @if(session()->has('successMessage'))
        <flux:badge color="lime" class="mb-3 w-full">{{ session()->get('successMessage') }}</flux:badge>
    @elseif(session()->has('errorMessage'))
        <flux:badge color="red" class="mb-3 w-full">{{ session()->get('errorMessage') }}</flux:badge>
    @endif

    <form action="{{ route('dashboard.products.update', $product->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <flux:input label="Product Name" name="name" value="{{ old('name', $product->name) }}" class="mb-3" required />
        @error('name')
            <span class="text-red-500 text-sm">{{ $message }}</span>
        @enderror

        <flux:input label="Slug" name="slug" value="{{ old('slug', $product->slug) }}" class="mb-3" />
        @error('slug')
            <span class="text-red-500 text-sm">{{ $message }}</span>
        @enderror

        <flux:input label="SKU" name="sku" value="{{ old('sku', $product->sku) }}" class="mb-3" />
        @error('sku')
            <span class="text-red-500 text-sm">{{ $message }}</span>
        @enderror

        <flux:textarea label="Description" name="description" class="mb-3">{{ old('description', $product->description) }}</flux:textarea>
        @error('description')
            <span class="text-red-500 text-sm">{{ $message }}</span>
        @enderror

        <flux:input label="Price" name="price" type="number" step="0.01" value="{{ old('price', $product->price) }}" class="mb-3" required />
        @error('price')
            <span class="text-red-500 text-sm">{{ $message }}</span>
        @enderror

        <flux:input label="Stock" name="stock" type="number" value="{{ old('stock', $product->stock) }}" class="mb-3" required />
        @error('stock')
            <span class="text-red-500 text-sm">{{ $message }}</span>
        @enderror

        <flux:select label="Category" name="categories_id" class="mb-3" required>
            @foreach ($category as $category)
                <option value="{{ $category->id }}" {{ old('categories_id', $product->categories_id) == $category->id ? 'selected' : '' }}>
                    {{ $category->name }}
                </option>
            @endforeach
        </flux:select>
        @error('categories_id')
            <span class="text-red-500 text-sm">{{ $message }}</span>
        @enderror

        @if($product->image)
            <div class="mb-3">
                <img src="{{ Storage::url($product->image) }}" alt="{{ $product->name }}" class="w-32 h-32 object-cover rounded">
            </div>
        @endif

        <flux:input type="file" label="Image" name="image" class="mb-3" />
        @error('image')
            <span class="text-red-500 text-sm">{{ $message }}</span>
        @enderror

        <flux:separator />

        <div class="mt-4">
            <flux:button type="submit" variant="primary">Update</flux:button>
            <flux:link href="{{ route('dashboard.products.index') }}" variant="ghost" class="ml-3">Back</flux:link>
        </div>
    </form>
</x-layouts.app>
