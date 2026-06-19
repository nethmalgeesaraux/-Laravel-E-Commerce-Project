<x-admin-layout>
   <main class="flex-1 p-6 overflow-y-auto bg-gray-100">
                
                <div class="flex items-center justify-between mb-6">
                    <h1 class="text-2xl font-bold text-gray-800">Add New Product</h1>
                    <a href="products.php" class="border border-gray-300 bg-white hover:bg-gray-50 text-gray-700 px-5 py-2.5 rounded-lg text-sm font-medium transition flex items-center gap-2">
                        <i class="fa-solid fa-arrow-left"></i> Back to Products
                    </a>
                </div>

                <form action="{{ route('admin.products.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="grid grid-cols-1 gap-8 lg:grid-cols-3">
                        
                        <div class="space-y-6 lg:col-span-2">
                            <div class="p-6 bg-white border border-gray-100 shadow-sm rounded-xl">
                                <h3 class="pb-2 mb-4 font-bold text-gray-800 border-b">Basic Information</h3>
                                <div class="space-y-4">
                                    <div>
                                        <label class="block mb-1 text-sm font-medium text-gray-700">Product Name *</label>
                                        <input type="text" id="product-name" name="name" value="{{ old('name') }}" placeholder="e.g. Modern Sofa" class="w-full px-4 py-2 text-sm border rounded-lg focus:outline-none focus:border-primary focus:ring-1 focus:ring-primary" required>
                                        @error('name')<p class="mt-2 text-sm text-red-500">{{ $message }}</p>@enderror
                                    </div>
                                    <div>
                                        <label class="block mb-1 text-sm font-medium text-gray-700">Slug</label>
                                        <input type="text" id="product-slug" name="slug" value="{{ old('slug') }}" placeholder="e.g. modern-sofa" class="w-full px-4 py-2 text-sm border rounded-lg focus:outline-none focus:border-primary focus:ring-1 focus:ring-primary bg-gray-50">
                                        @error('slug')<p class="mt-2 text-sm text-red-500">{{ $message }}</p>@enderror
                                    </div>
                                    <div>
                                        <label class="block mb-1 text-sm font-medium text-gray-700">Short Description</label>
                                        <textarea id="short_description" name="short_description" rows="3" placeholder="Brief summary..." class="w-full px-4 py-2 text-sm border rounded-lg focus:outline-none focus:border-primary focus:ring-1 focus:ring-primary">{{ old('short_description') }}</textarea>
                                        @error('short_description')<p class="mt-2 text-sm text-red-500">{{ $message }}</p>@enderror
                                    </div>
                                    <div>
                                        <label class="block mb-1 text-sm font-medium text-gray-700">Description</label>
                                        <textarea id="description" name="description" rows="18" placeholder="Detailed description..." class="w-full px-4 py-2 text-sm border rounded-lg focus:outline-none focus:border-primary focus:ring-1 focus:ring-primary">{{ old('description') }}</textarea>
                                        @error('description')<p class="mt-2 text-sm text-red-500">{{ $message }}</p>@enderror
                                    </div>
                                </div>
                            </div>

                            <div class="p-6 bg-white border border-gray-100 shadow-sm rounded-xl">
                                <h3 class="pb-2 mb-4 font-bold text-gray-800 border-b">Pricing & Inventory</h3>
                                <div class="grid grid-cols-1 gap-6 md:grid-cols-2">
                                    <div>
                                        <label class="block mb-1 text-sm font-medium text-gray-700">Regular Price ($)</label>
                                        <input type="number" id="regular_price" name="regular_price" value="{{ old('regular_price') }}" placeholder="0.00" class="w-full px-4 py-2 text-sm border rounded-lg focus:outline-none focus:border-primary">
                                        @error('regular_price')<p class="mt-2 text-sm text-red-500">{{ $message }}</p>@enderror
                                    </div>
                                    <div>
                                        <label class="block mb-1 text-sm font-medium text-gray-700">Sale Price ($)</label>
                                        <input type="number" id="sale_price" name="sale_price" value="{{ old('sale_price') }}" placeholder="0.00" class="w-full px-4 py-2 text-sm border rounded-lg focus:outline-none focus:border-primary">
                                        @error('sale_price')<p class="mt-2 text-sm text-red-500">{{ $message }}</p>@enderror
                                    </div>
                                    <div>
                                        <label class="block mb-1 text-sm font-medium text-gray-700">SKU</label>
                                        <input type="text" id="SKU" name="SKU" value="{{ old('SKU') }}" placeholder="Product SKU" class="w-full px-4 py-2 text-sm border rounded-lg focus:outline-none focus:border-primary">
                                        @error('SKU')<p class="mt-2 text-sm text-red-500">{{ $message }}</p>@enderror
                                    </div>
                                    <div>
                                        <label class="block mb-1 text-sm font-medium text-gray-700">Stock Status</label>
                                        <select id="stock_status" name="stock_status" class="w-full px-4 py-2 text-sm bg-white border rounded-lg focus:outline-none focus:border-primary">
                                            <option value="instock" {{ old('stock_status', 'instock') === 'instock' ? 'selected' : '' }}>In Stock</option>
                                            <option value="outofstock" {{ old('stock_status') === 'outofstock' ? 'selected' : '' }}>Out of Stock</option>
                                        </select>
                                        @error('stock_status')<p class="mt-2 text-sm text-red-500">{{ $message }}</p>@enderror
                                    </div>
                                    <div>
                                        <label class="block mb-1 text-sm font-medium text-gray-700">Quantity</label>
                                        <input type="number" id="quantity" name="quantity" value="{{ old('quantity') }}" placeholder="Total items" class="w-full px-4 py-2 text-sm border rounded-lg focus:outline-none focus:border-primary">
                                        @error('quantity')<p class="mt-2 text-sm text-red-500">{{ $message }}</p>@enderror
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="space-y-6">
                            <div class="p-6 bg-white border border-gray-100 shadow-sm rounded-xl">
                                <h3 class="pb-2 mb-4 font-bold text-gray-800 border-b">Publish</h3>
                                <div class="space-y-3">
                                    <div class="flex items-center justify-between">
                                        <span class="text-sm text-gray-600">Status:</span>
                                        <select id="status" name="status" class="px-2 py-1 text-sm bg-white border rounded focus:outline-none">
                                            <option value="0" {{ old('status') === '0' ? 'selected' : '' }}>Draft</option>
                                            <option value="1" {{ old('status') === '1' ? 'selected' : '' }}>Published</option>
                                        </select>
                                        @error('status')<p class="mt-2 text-sm text-red-500">{{ $message }}</p>@enderror
                                    </div>
                                    <div class="flex items-center gap-2 pt-2">
                                        <input type="checkbox" id="featured" name="featured" value="1" {{ old('featured') ? 'checked' : '' }} class="border-gray-300 rounded text-primary focus:ring-primary">
                                        <label for="featured" class="text-sm text-gray-700 cursor-pointer">This is a featured product</label>
                                    </div>
                                    <button class="w-full py-2 mt-4 text-sm font-medium text-white transition rounded-lg shadow bg-primary hover:bg-blue-600">Save Product</button>
                                </div>
                            </div>

                            <div class="p-6 bg-white border border-gray-100 shadow-sm rounded-xl">
                                <h3 class="pb-2 mb-4 font-bold text-gray-800 border-b">Organization</h3>
                                <div class="space-y-4">
                                    <div>
                                        <label class="block mb-1 text-sm font-medium text-gray-700">Category</label>
                                        <select id="category_id" name="category_id" class="w-full px-4 py-2 text-sm bg-white border rounded-lg focus:outline-none focus:border-primary">
                                            <option value="">Select Category</option>
                                            @foreach($categories as $category)
                                            <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
                                            @endforeach
                                        </select>
                                        @error('category_id')<p class="mt-2 text-sm text-red-500">{{ $message }}</p>@enderror
                                    </div>
                                    <div>
                                        <label class="block mb-1 text-sm font-medium text-gray-700">Brand</label>
                                        <select id="brand_id" name="brand_id" class="w-full px-4 py-2 text-sm bg-white border rounded-lg focus:outline-none focus:border-primary">
                                            <option value="">Select Brand</option>
                                            @foreach($brands as $brand)
                                            <option value="{{ $brand->id }}" {{ old('brand_id') == $brand->id ? 'selected' : '' }}>{{ $brand->name }}</option>
                                            @endforeach
                                        </select>
                                        @error('brand_id')<p class="mt-2 text-sm text-red-500">{{ $message }}</p>@enderror
                                    </div>
                                </div>
                            </div>

                            <div class="p-6 bg-white border border-gray-100 shadow-sm rounded-xl">
                                <h3 class="pb-2 mb-4 font-bold text-gray-800 border-b">Product Image (Main)</h3>
                                
                                <label for="product-image" id="single-upload-label" class="block p-6 text-center transition border-2 border-gray-300 border-dashed rounded-lg cursor-pointer hover:bg-gray-50">
                                    <i class="mb-2 text-3xl text-gray-400 fa-solid fa-cloud-arrow-up"></i>
                                    <p class="text-sm text-gray-500">Click to upload main image</p>
                                    <input type="file" id="product-image" name="image" class="hidden" accept="image/png, image/jpeg, image/jpg, image/webp">
                                </label>

                                @error('image')<p class="mt-2 text-sm text-red-500">{{ $message }}</p>@enderror

                                <div id="single-preview-container" class="relative items-center justify-center hidden h-48 mt-4 overflow-hidden border border-gray-200 rounded-lg shadow-sm bg-gray-50 group">
                                    <img id="single-image-preview" src="" class="object-contain max-w-full max-h-full">
                                    <button type="button" id="remove-single-image" class="absolute flex items-center justify-center text-sm text-white transition bg-red-500 rounded-md shadow-md top-2 right-2 w-7 h-7 hover:bg-red-600 focus:outline-none">
                                        <i class="fa-solid fa-xmark"></i>
                                    </button>
                                </div>
                            </div>

                            <div class="p-6 bg-white border border-gray-100 shadow-sm rounded-xl">
                                <h3 class="pb-2 mb-4 font-bold text-gray-800 border-b">Product Gallery Images</h3>
                                
                                <label for="product-images" class="block p-6 text-center transition border-2 border-gray-300 border-dashed rounded-lg cursor-pointer hover:bg-gray-50">
                                    <i class="mb-2 text-3xl text-gray-400 fa-solid fa-cloud-arrow-up"></i>
                                    <p class="text-sm text-gray-500">Click to upload multiple gallery images</p>
                                    <input type="file" id="product-images" name="images[]" class="hidden" multiple accept="image/png, image/jpeg, image/jpg, image/webp">
                                </label>

                                @error('images.*')<p class="mt-2 text-sm text-red-500">{{ $message }}</p>@enderror

                                <div id="gallery-preview-container" class="grid grid-cols-3 gap-3 mt-4"></div>
                            </div>
                        </div>

                    </div>
                </form>

            </main>


             <script>
        document.addEventListener('DOMContentLoaded', function() {
            
            // ==========================================
            // 1. AUTO-SLUG GENERATOR
            // ==========================================
            const productNameInput = document.getElementById('product-name');
            const productSlugInput = document.getElementById('product-slug');

            if (productNameInput && productSlugInput) {
                productNameInput.addEventListener('input', function() {
                    const slug = this.value.toLowerCase()
                        .trim()
                        .replace(/[^a-z0-9 -]/g, '')
                        .replace(/\s+/g, '-')
                        .replace(/-+/g, '-');
                    productSlugInput.value = slug;
                });
            }

            // ==========================================
            // 2. SINGLE IMAGE UPLOAD (Main Product Image)
            // ==========================================
            const singleImageInput = document.getElementById('product-image');
            const singleUploadLabel = document.getElementById('single-upload-label');
            const singlePreviewContainer = document.getElementById('single-preview-container');
            const singleImagePreview = document.getElementById('single-image-preview');
            const removeSingleBtn = document.getElementById('remove-single-image');

            if (singleImageInput) {
                singleImageInput.addEventListener('change', function(event) {
                    const file = event.target.files[0];
                    if (file && file.type.startsWith('image/')) {
                        singleImagePreview.src = URL.createObjectURL(file);
                        singleUploadLabel.classList.add('hidden');
                        singlePreviewContainer.classList.remove('hidden');
                        singlePreviewContainer.classList.add('flex'); // Keep flex layout active
                    } else {
                        resetSingleImage();
                    }
                });
            }

            if (removeSingleBtn) {
                removeSingleBtn.addEventListener('click', function(event) {
                    event.preventDefault();
                    resetSingleImage();
                });
            }

            function resetSingleImage() {
                singleImageInput.value = '';
                singleImagePreview.src = '';
                singlePreviewContainer.classList.add('hidden');
                singlePreviewContainer.classList.remove('flex');
                singleUploadLabel.classList.remove('hidden');
            }

            // ==========================================
            // 3. MULTIPLE IMAGE UPLOAD (Gallery Images)
            // ==========================================
            const galleryInput = document.getElementById('product-images');
            const galleryPreviewContainer = document.getElementById('gallery-preview-container');
            
            let selectedGalleryFiles = []; // Array to store multiple files

            if (galleryInput && galleryPreviewContainer) {
                galleryInput.addEventListener('change', function(event) {
                    const files = Array.from(event.target.files);
                    
                    files.forEach(file => {
                        if (file.type.startsWith('image/')) {
                            // Prevent duplicates
                            const isDuplicate = selectedGalleryFiles.some(f => f.name === file.name && f.size === file.size);
                            if (!isDuplicate) {
                                selectedGalleryFiles.push(file);
                            }
                        }
                    });

                    updateGalleryInputAndPreviews();
                });
            }

            function updateGalleryInputAndPreviews() {
                // Sync HTML input with tracking array
                const dataTransfer = new DataTransfer();
                selectedGalleryFiles.forEach(file => dataTransfer.items.add(file));
                galleryInput.files = dataTransfer.files;

                // Clear current previews
                galleryPreviewContainer.innerHTML = '';

                // Re-render previews
                selectedGalleryFiles.forEach((file, index) => {
                    const objectUrl = URL.createObjectURL(file);
                    
                    const div = document.createElement('div');
                    div.className = 'relative h-24 bg-gray-50 rounded-lg border border-gray-200 flex items-center justify-center overflow-hidden group shadow-sm';
                    
                    const img = document.createElement('img');
                    img.src = objectUrl;
                    img.className = 'w-full h-full object-cover';
                    
                    const removeBtn = document.createElement('button');
                    removeBtn.type = 'button';
                    removeBtn.className = 'absolute top-1 right-1 bg-red-500 text-white rounded-md w-6 h-6 flex items-center justify-center text-xs opacity-0 group-hover:opacity-100 transition-opacity focus:outline-none shadow-md';
                    removeBtn.innerHTML = '<i class="fa-solid fa-xmark"></i>';
                    
                    removeBtn.addEventListener('click', function(e) {
                        e.preventDefault();
                        selectedGalleryFiles.splice(index, 1);
                        updateGalleryInputAndPreviews();
                        URL.revokeObjectURL(objectUrl);
                    });

                    div.appendChild(img);
                    div.appendChild(removeBtn);
                    galleryPreviewContainer.appendChild(div);
                });
            }
        });
    </script>
    
</x-admin-layout>