<x-admin-layout>
    <main class="flex-1 p-6 overflow-y-auto bg-gray-100">

        <div class="flex flex-col items-start justify-between gap-4 mb-6 sm:flex-row sm:items-center">
            <div>
                <h1 class="text-2xl font-bold text-gray-800">Brands</h1>
                <p class="text-sm text-gray-500">Manage product brands and partners</p>
            </div>
            <a href="{{route('admin.brand.add')}}" class="bg-primary hover:bg-blue-600 text-white px-5 py-2.5 rounded-lg text-sm font-medium transition flex items-center gap-2 shadow-sm">
                <i class="fa-solid fa-plus"></i> Add New Brand
            </a>
        </div>

        <div class="p-4 mb-6 bg-white border border-gray-100 shadow-sm rounded-xl">
            <div class="flex flex-col justify-between gap-4 md:flex-row">
                <div class="flex flex-col w-full gap-4 md:flex-row md:w-auto">
                    <div class="relative w-full md:w-64">
                        <span class="absolute inset-y-0 left-0 flex items-center pl-3">
                            <i class="text-gray-400 fa-solid fa-search"></i>
                        </span>
                        <input type="text" class="w-full py-2 pl-10 pr-4 text-sm border rounded-lg focus:outline-none focus:border-primary focus:ring-1 focus:ring-primary" placeholder="Search brand...">
                    </div>

                    <select class="w-full px-3 py-2 text-sm text-gray-600 bg-white border rounded-lg md:w-40 focus:outline-none focus:border-primary">
                        <option value="">All Status</option>
                        <option value="active">Active</option>
                        <option value="inactive">Inactive</option>
                    </select>
                </div>
            </div>
        </div>

        <div class="overflow-hidden bg-white border border-gray-100 shadow-sm rounded-xl">
            <div class="overflow-x-auto">
                <table class="w-full text-left whitespace-nowrap">
                    <thead class="text-xs font-semibold text-gray-500 uppercase bg-gray-50">
                        <tr>
                            <th class="px-6 py-4">ID</th>
                            <th class="px-6 py-4">Logo</th>
                            <th class="px-6 py-4">Brand Name</th>
                            <th class="px-6 py-4">Slug</th>
                            <th class="px-6 py-4">Products</th>
                            <th class="px-6 py-4">Status</th>
                            <th class="px-6 py-4 text-right">Action</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100">
                        @forelse ($brands as $brand)
                        <tr class="transition hover:bg-gray-50">
                            <td class="px-6 py-4 text-sm text-gray-500">{{ $brand->id }}</td>
                            <td class="px-6 py-4">
                                <div class="flex items-center justify-center w-12 h-12 border rounded-lg bg-gray-50">
                                    <img src="{{asset('uploads/brands/thumbnails')}}/{{ $brand->image }}" class="max-w-[30px] max-h-[30px] object-contain" alt="{{ $brand->name }}" onerror="this.src='https://placehold.co/40x40?text=B'">
                                </div>
                            </td>
                            <td class="px-6 py-4">
                                <span class="font-semibold text-gray-800">{{ $brand->name }}</span>
                            </td>
                            <td class="px-6 py-4 text-sm text-gray-600">{{ $brand->slug }}</td>
                            <td class="px-6 py-4">
                                <span class="px-2 py-1 text-xs font-semibold text-blue-700 rounded bg-blue-50">0</span>
                            </td>
                            <td class="px-6 py-4">
                                @if($brand->status)
                                <span class="bg-green-100 text-green-700 px-2.5 py-1 rounded-full text-xs font-semibold">Active</span>
                                @else
                                <span class="bg-red-100 text-red-700 px-2.5 py-1 rounded-full text-xs font-semibold">Inactive</span>
                                @endif

                            </td>
                            <td class="px-6 py-4 text-right">
                                <div class="flex items-center justify-end gap-2">
                                    <a href="{{ route('admin.brand.edit', $brand->id) }}" class="flex items-center justify-center w-8 h-8 text-blue-500 transition rounded-full hover:bg-gray-100" title="Edit">
                                        <i class="fa-solid fa-pen-to-square"></i>
                                    </a>
                                    <button class="flex items-center justify-center w-8 h-8 text-red-500 transition rounded-full hover:bg-gray-100" onclick="deleteBrand(this, 'Samsung', 101)" title="Delete">
                                        <i class="fa-solid fa-trash"></i>
                                    </button>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="7" class="px-6 py-12 text-center">
                                <div class="flex flex-col items-center justify-center text-gray-500">
                                    <i class="mb-3 text-4xl text-gray-300 fa-solid fa-boxes-stacked"></i>
                                    <h3 class="text-lg font-medium text-gray-900">Brands not available</h3>
                                    <p class="mt-1 text-sm">You haven't added any brands to your store yet.</p>
                                    <a href="{{route('admin.brand.add')}}" class="mt-4 text-sm font-medium text-primary hover:underline">
                                        Add your first brand
                                    </a>
                                </div>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <div class="flex flex-col items-center justify-between gap-4 px-6 py-4 border-t border-gray-100 sm:flex-row">
                {{ $brands->links() }}
            </div>
        </div>

    </main>
</x-admin-layout>