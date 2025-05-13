<x-layout> 
   <x-slot:title>{{ $title }}</x-slot> 
   
   <flux:main>
    <div class="p-6 max-w-7xl mx-auto">
        <h1 class="text-2xl font-bold mb-1">Categories</h1>
        <p class="text-gray-500 dark:text-gray-400 mb-6">Manage data Product Categories</p>

        <div class="flex justify-between items-center mb-4">
            <div class="w-1/3">
                <input type="text" placeholder="Search Product Categories"
                    class="w-full rounded-lg border border-gray-300 px-4 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500">
            </div>
            <a href="{{ route('dashboard.categories.create') }}"
                class="inline-flex items-center gap-2 bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700 transition">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M12 4v16m8-8H4" />
                </svg>
                Add New Category
            </a>
        </div>

        <div class="overflow-x-auto">
            <table class="min-w-full text-sm border divide-y divide-gray-200 dark:divide-gray-700">
                <thead class="bg-gray-50 dark:bg-zinc-800">
                    <tr>
                        <th class="px-4 py-2 text-left">ID</th>
                        <th class="px-4 py-2 text-left">Name</th>
                        <th class="px-4 py-2 text-left">Slug</th>
                        <th class="px-4 py-2 text-left">Description</th>
                        <th class="px-4 py-2 text-left">Created At</th>
                        <th class="px-4 py-2 text-left">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100 dark:divide-gray-700">
                    {{-- Loop Data Category --}}
                    @foreach ($categories as $category)
                        <tr>
                            <td class="px-4 py-2">{{ $category->id }}</td>
                            <td class="px-4 py-2">{{ $category->name }}</td>
                            <td class="px-4 py-2">{{ $category->slug }}</td>
                            <td class="px-4 py-2">{{ $category->description }}</td>
                            <td class="px-4 py-2">{{ $category->created_at }}</td>
                            <td class="px-4 py-2">
                                {{-- Edit/Delete Buttons --}}
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</flux:main>

</x-layout> 