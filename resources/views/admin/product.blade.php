<x-admin-layout>

    <main class="flex-1 p-6 overflow-y-auto bg-gray-100">

        <div class="flex flex-col items-start justify-between gap-4 mb-6 sm:flex-row sm:items-center">
            <div>
                <h1 class="text-2xl font-bold text-gray-800">Products</h1>
                <p class="text-sm text-gray-500">Manage your product catalog</p>
            </div>
            <a href="{{ route('admin.product.add') }}" class="bg-primary hover:bg-blue-600 text-white px-5 py-2.5 rounded-lg text-sm font-medium transition flex items-center gap-2 shadow-sm">
                <i class="fa-solid fa-plus"></i> Add New Product
            </a>
        </div>

        <div class="p-4 mb-6 bg-white border border-gray-100 shadow-sm rounded-xl">
            <form action="{{ route('admin.products') }}" method="GET">
                <div class="flex flex-col justify-between gap-4 md:flex-row">
                    <div class="flex flex-col w-full gap-4 md:flex-row md:w-auto">
                        <div class="relative w-full md:w-64">
                            <span class="absolute inset-y-0 left-0 flex items-center pl-3">
                                <i class="text-gray-400 fa-solid fa-search"></i>
                            </span>
                            <input name="search" value="{{ request('search') }}" type="text" class="w-full py-2 pl-10 pr-4 text-sm border rounded-lg focus:outline-none focus:border-primary focus:ring-1 focus:ring-primary" placeholder="Search product name...">
                        </div>

                        <select name="category" class="w-full px-3 py-2 text-sm text-gray-600 bg-white border rounded-lg md:w-48 focus:outline-none focus:border-primary">
                            <option value="">All Categories</option>
                            @foreach($categories as $category)
                            <option value="{{ $category->id }}" {{ request('category') == $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
                            @endforeach
                        </select>

                        <select name="status" class="w-full px-3 py-2 text-sm text-gray-600 bg-white border rounded-lg md:w-40 focus:outline-none focus:border-primary">
                            <option value="">All Status</option>
                            <option value="active" {{ request('status') === 'active' ? 'selected' : '' }}>Published</option>
                            <option value="draft" {{ request('status') === 'draft' ? 'selected' : '' }}>Draft</option>
                            <option value="instock" {{ request('status') === 'instock' ? 'selected' : '' }}>In Stock</option>
                            <option value="outofstock" {{ request('status') === 'outofstock' ? 'selected' : '' }}>Out of Stock</option>
                        </select>
                    </div>

                    <div class="flex gap-2">
                        <button type="submit" class="flex items-center justify-center gap-2 px-4 py-2 text-sm font-medium text-gray-600 transition border border-gray-300 rounded-lg hover:bg-gray-50">
                            <i class="fa-solid fa-search"></i> Search
                        </button>
                        <a href="{{ route('admin.products') }}" class="inline-flex items-center justify-center gap-2 px-4 py-2 text-sm font-medium text-gray-600 transition border border-gray-300 rounded-lg hover:bg-gray-50">
                            Reset
                        </a>
                    </div>
                </div>
            </form>
        </div>

        <div class="overflow-hidden bg-white border border-gray-100 shadow-sm rounded-xl">
            <div class="overflow-x-auto">
                <table class="w-full text-left whitespace-nowrap">
                    <thead class="text-xs font-semibold text-gray-500 uppercase bg-gray-50">
                        <tr>
                            <th class="px-6 py-4">
                                <input type="checkbox" class="border-gray-300 rounded text-primary focus:ring-primary">
                            </th>
                            <th class="px-6 py-4">Product Name</th>
                            <th class="px-6 py-4">Category</th>
                            <th class="px-6 py-4">Price</th>
                            <th class="px-6 py-4">Stock</th>
                            <th class="px-6 py-4">Status</th>
                            <th class="px-6 py-4 text-right">Action</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100">
                        @forelse($products as $product)
                        <tr class="transition hover:bg-gray-50">
                            <td class="px-6 py-4">
                                <input type="checkbox" class="border-gray-300 rounded text-primary focus:ring-primary">
                            </td>
                            <td class="px-6 py-4">
                                <div class="flex items-center gap-3">
                                    <div class="w-12 h-12 overflow-hidden border rounded-lg bg-gray-50">
                                        <img src="{{ $product->image ? asset('uploads/products/' . $product->image) : 'https://placehold.co/48x48?text=P' }}" class="object-cover w-full h-full" alt="{{ $product->name }}">
                                    </div>
                                    <div>
                                        <p class="text-sm font-semibold text-gray-800">{{ $product->name }}</p>
                                        <p class="text-xs text-gray-500">SKU: {{ $product->SKU }}</p>
                                    </div>
                                </div>
                            </td>
                            <td class="px-6 py-4 text-sm text-gray-600">{{ $product->category?->name ?? '—' }}</td>
                            <td class="px-6 py-4 text-sm font-medium text-gray-800">${{ number_format($product->regular_price, 2) }}</td>
                            <td class="px-6 py-4 text-sm text-gray-600">{{ $product->quantity }}</td>
                            <td class="px-6 py-4">
                                @if($product->status)
                                <span class="bg-green-100 text-green-700 px-2.5 py-1 rounded-full text-xs font-semibold">Published</span>
                                @else
                                <span class="bg-red-100 text-red-700 px-2.5 py-1 rounded-full text-xs font-semibold">Draft</span>
                                @endif
                            </td>
                            <td class="px-6 py-4 text-right">
                                <div class="flex items-center justify-end gap-2">
                                    <a href="{{ route('admin.product.edit', $product->id) }}" class="flex items-center justify-center w-8 h-8 text-blue-500 transition rounded-full hover:bg-gray-100" title="Edit">
                                        <i class="fa-solid fa-pen-to-square"></i>
                                    </a>
                                    <button type="button" onclick="deleteProduct(this)" data-product-name="{{ $product->name }}" data-product-id="{{ $product->id }}" class="flex items-center justify-center w-8 h-8 text-red-500 transition rounded-full hover:bg-gray-100" title="Delete">
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
                                    <h3 class="text-lg font-medium text-gray-900">Products not available</h3>
                                    <p class="mt-1 text-sm">You haven't added any products to your store yet.</p>
                                    <a href="{{ route('admin.product.add') }}" class="mt-4 text-sm font-medium text-primary hover:underline">
                                        Add your first product
                                    </a>
                                </div>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <div class="flex flex-col items-center justify-between gap-4 px-6 py-4 border-t border-gray-100 sm:flex-row">
                <span class="text-sm text-gray-500">Showing <span class="font-bold text-gray-700">{{ $products->firstItem() ?? 0 }}</span> to <span class="font-bold text-gray-700">{{ $products->lastItem() ?? 0 }}</span> of <span class="font-bold text-gray-700">{{ $products->total() }}</span> products</span>

                <div>
                    {{ $products->links() }}
                </div>
            </div>
        </div>

    </main>

    <div id="deleteModal" class="fixed inset-0 z-50 hidden" aria-labelledby="modal-title" role="dialog" aria-modal="true">
        <div class="fixed inset-0 transition-opacity bg-gray-500 bg-opacity-75 backdrop-blur-sm"></div>

        <div class="fixed inset-0 z-10 w-screen overflow-y-auto">
            <div class="flex items-end justify-center min-h-full p-4 text-center sm:items-center sm:p-0">
                <div class="relative overflow-hidden text-left transition-all transform bg-white shadow-xl rounded-xl sm:my-8 sm:w-full sm:max-w-md">
                    <div class="px-4 pt-5 pb-4 bg-white sm:p-6 sm:pb-4">
                        <div class="sm:flex sm:items-start">
                            <div class="flex items-center justify-center flex-shrink-0 w-12 h-12 mx-auto bg-red-100 rounded-full sm:mx-0 sm:h-10 sm:w-10">
                                <i class="text-red-600 fa-solid fa-triangle-exclamation"></i>
                            </div>
                            <div class="mt-3 text-center sm:ml-4 sm:mt-0 sm:text-left">
                                <h3 class="text-lg font-semibold leading-6 text-gray-900" id="modal-title">Delete Product</h3>
                                <div class="mt-2">
                                    <p class="text-sm text-gray-500">Are you sure you want to delete <strong id="delete-product-name" class="text-gray-800">this product</strong>? All of its data will be permanently removed. This action cannot be undone.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="px-4 py-3 bg-gray-50 sm:flex sm:flex-row-reverse sm:px-6">
                        <button type="button" id="confirmDeleteBtn" class="inline-flex justify-center w-full px-4 py-2 text-sm font-semibold text-white transition bg-red-600 rounded-lg shadow-sm hover:bg-red-500 sm:ml-3 sm:w-auto">Delete</button>
                        <button type="button" id="cancelDeleteBtn" class="inline-flex justify-center w-full px-4 py-2 mt-3 text-sm font-semibold text-gray-900 transition bg-white rounded-lg shadow-sm ring-1 ring-inset ring-gray-300 hover:bg-gray-50 sm:mt-0 sm:w-auto">Cancel</button>
                    </div>
                </div>
            </div>
        </div>

        <form id="deleteProductForm" method="POST" class="hidden">
            @csrf
            @method('DELETE')
        </form>

        <script>
            // Modal Elements
            const deleteModal = document.getElementById('deleteModal');
            const deleteProductForm = document.getElementById('deleteProductForm');
            const deleteProductBase = "{{ url('admin/products') }}";
            const confirmBtn = document.getElementById('confirmDeleteBtn');
            const cancelBtn = document.getElementById('cancelDeleteBtn');
            const productNameSpan = document.getElementById('delete-product-name');

            // Variables to hold the state of what we are deleting
            let productIdToDelete = null;

            // Function triggered when the trash icon is clicked
            function deleteProduct(button) {
                const productName = button.dataset.productName;
                const productId = button.dataset.productId;
                productIdToDelete = productId;

                // Update the modal text dynamically
                productNameSpan.textContent = productName || "this product";

                // Show the modal by removing the 'hidden' class
                deleteModal.classList.remove('hidden');
            }

            // Close Modal Function
            function closeModal() {
                deleteModal.classList.add('hidden');
                productIdToDelete = null;
            }

            // Handle Cancel Button
            cancelBtn.addEventListener('click', closeModal);

            // Handle clicking outside the modal to close it
            deleteModal.addEventListener('click', function(event) {
                // If the user clicks on the backdrop (not the panel), close it
                if (event.target === this || event.target.classList.contains('bg-opacity-75')) {
                    closeModal();
                }
            });

            // Handle Confirm Delete Button
            confirmBtn.addEventListener('click', function() {
                if (productIdToDelete) {
                    deleteProductForm.action = `${deleteProductBase}/${productIdToDelete}`;
                    deleteProductForm.submit();
                }
            });
        </script>
</x-admin-layout>