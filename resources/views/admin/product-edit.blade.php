<x-admin-layout>
    <main class="flex-1 p-6 overflow-y-auto bg-gray-100">
                
                <div class="flex items-center justify-between mb-6">
                    <h1 class="text-2xl font-bold text-gray-800">Edit Product</h1>
                    <div class="flex gap-2">
                        <a href="{{ route('admin.products') }}" class="border border-gray-300 bg-white hover:bg-gray-50 text-gray-700 px-5 py-2.5 rounded-lg text-sm font-medium transition">
                            Cancel
                        </a>
                        <button type="button" onclick="if(confirm('Delete this product?')) { document.getElementById('deleteProductForm').submit(); }" class="bg-red-500 hover:bg-red-600 text-white px-5 py-2.5 rounded-lg text-sm font-medium transition shadow-sm">
                            <i class="fa-solid fa-trash"></i> Delete
                        </button>
                    </div>
                </div>

                <form action="{{ route('admin.product.update', $product->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="grid grid-cols-1 gap-8 lg:grid-cols-3">
                        
                        <div class="space-y-6 lg:col-span-2">
                            <div class="p-6 bg-white border border-gray-100 shadow-sm rounded-xl">
                                <h3 class="pb-2 mb-4 font-bold text-gray-800 border-b">Basic Information</h3>
                                <div class="space-y-4">
                                <div>
                                        <label class="block mb-1 text-sm font-medium text-gray-700">Product Name *</label>
                                        <input type="text" id="product-name" name="name" value="{{ old('name', $product->name) }}" class="w-full px-4 py-2 text-sm border rounded-lg focus:outline-none focus:border-primary" required>
                                    </div>
                                    <div>
                                        <label class="block mb-1 text-sm font-medium text-gray-700">Slug</label>
                                        <input type="text" id="product-slug" name="slug" value="{{ old('slug', $product->slug) }}" class="w-full px-4 py-2 text-sm border rounded-lg focus:outline-none focus:border-primary bg-gray-50">
                                    </div>
                                    <div>
                                        <label class="block mb-1 text-sm font-medium text-gray-700">Short Description</label>
                                        <textarea id="short_description" name="short_description" rows="3" class="w-full px-4 py-2 text-sm border rounded-lg focus:outline-none focus:border-primary">{{ old('short_description', $product->short_description) }}</textarea>
                                    </div>
                                    <div>
                                        <label class="block mb-1 text-sm font-medium text-gray-700">Description</label>
                                        <textarea id="description" name="description" rows="6" class="w-full px-4 py-2 text-sm border rounded-lg focus:outline-none focus:border-primary">{{ old('description', $product->description) }}</textarea>
                                    </div>
                                </div>
                            </div>

                            <div class="p-6 bg-white border border-gray-100 shadow-sm rounded-xl">
                                <h3 class="pb-2 mb-4 font-bold text-gray-800 border-b">Pricing & Inventory</h3>
                                <div class="grid grid-cols-1 gap-6 md:grid-cols-2">
                                    <div>
                                        <label class="block mb-1 text-sm font-medium text-gray-700">Regular Price ($)</label>
                                        <input type="number" id="regular_price" name="regular_price" value="{{ old('regular_price', $product->regular_price) }}" placeholder="0.00" class="w-full px-4 py-2 text-sm border rounded-lg focus:outline-none focus:border-primary">
                                    </div>
                                    <div>
                                        <label class="block mb-1 text-sm font-medium text-gray-700">Sale Price ($)</label>
                                        <input type="number" id="sale_price" name="sale_price" value="{{ old('sale_price', $product->sale_price) }}" placeholder="0.00" class="w-full px-4 py-2 text-sm border rounded-lg focus:outline-none focus:border-primary">
                                    </div>
                                    <div>
                                        <label class="block mb-1 text-sm font-medium text-gray-700">SKU</label>
                                        <input type="text" id="SKU" name="SKU" value="{{ old('SKU', $product->SKU) }}" placeholder="Product SKU" class="w-full px-4 py-2 text-sm border rounded-lg focus:outline-none focus:border-primary">
                                    </div>
                                    <div>
                                        <label class="block mb-1 text-sm font-medium text-gray-700">Stock Status</label>
                                        <select id="stock_status" name="stock_status" class="w-full px-4 py-2 text-sm bg-white border rounded-lg focus:outline-none focus:border-primary">
                                            <option value="instock" {{ old('stock_status', $product->stock_status) === 'instock' ? 'selected' : '' }}>In Stock</option>
                                            <option value="outofstock" {{ old('stock_status', $product->stock_status) === 'outofstock' ? 'selected' : '' }}>Out of Stock</option>
                                        </select>
                                    </div>
                                    <div>
                                        <label class="block mb-1 text-sm font-medium text-gray-700">Quantity</label>
                                        <input type="number" id="quantity" name="quantity" value="{{ old('quantity', $product->quantity) }}" placeholder="Total items" class="w-full px-4 py-2 text-sm border rounded-lg focus:outline-none focus:border-primary">
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
                                            <option value="0" {{ old('status', $product->status) == 0 ? 'selected' : '' }}>Draft</option>
                                            <option value="1" {{ old('status', $product->status) == 1 ? 'selected' : '' }}>Published</option>
                                        </select>
                                    </div>
                                    <div class="flex items-center gap-2 pt-2">
                                        <input type="checkbox" id="featured" name="featured" value="1" {{ old('featured', $product->featured) ? 'checked' : '' }} class="border-gray-300 rounded text-primary focus:ring-primary">
                                        <label for="featured" class="text-sm text-gray-700 cursor-pointer">This is a featured product</label>
                                    </div>
                                    <button class="w-full py-2 mt-4 text-sm font-medium text-white transition rounded-lg shadow bg-primary hover:bg-blue-600">Update Product</button>
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
                                            <option value="{{ $category->id }}" {{ old('category_id', $product->category_id) == $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div>
                                        <label class="block mb-1 text-sm font-medium text-gray-700">Brand</label>
                                        <select id="brand_id" name="brand_id" class="w-full px-4 py-2 text-sm bg-white border rounded-lg focus:outline-none focus:border-primary">
                                            <option value="">Select Brand</option>
                                            @foreach($brands as $brand)
                                            <option value="{{ $brand->id }}" {{ old('brand_id', $product->brand_id) == $brand->id ? 'selected' : '' }}>{{ $brand->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <div class="p-6 bg-white border border-gray-100 shadow-sm rounded-xl">
                                <h3 class="pb-2 mb-4 font-bold text-gray-800 border-b">Product Image (Main)</h3>
                                
                                <label for="product-image" id="single-upload-label" class="block p-6 mb-4 text-center transition border-2 border-gray-300 border-dashed rounded-lg cursor-pointer hover:bg-gray-50">
                                    <i class="mb-2 text-3xl text-gray-400 fa-solid fa-cloud-arrow-up"></i>
                                    <p class="text-sm text-gray-500">Upload New Main Image</p>
                                    <input type="file" id="product-image" name="image" class="hidden" accept="image/png, image/jpeg, image/jpg, image/webp">
                                </label>

                                <div id="single-new-preview-container" class="relative hidden h-40 mb-6 overflow-hidden border border-blue-200 rounded shadow-sm bg-gray-50 group">
                                    <img id="single-image-preview" src="" class="object-contain max-w-full max-h-full">
                                    <button type="button" id="remove-single-new-btn" class="absolute flex items-center justify-center text-sm text-white transition bg-red-500 rounded-md shadow-md top-2 right-2 w-7 h-7 hover:bg-red-600 focus:outline-none">
                                        <i class="fa-solid fa-xmark"></i>
                                    </button>
                                </div>

                                <h4 class="pb-1 mb-3 text-sm font-medium text-gray-700 border-b">Existing Image</h4>
                                <div class="grid grid-cols-3 gap-2">
                                    @if($product->image)
                                    <div class="relative h-24 overflow-hidden bg-gray-100 border rounded existing-image-wrapper group">
                                        <img src="{{ asset('uploads/products/' . $product->image) }}" class="object-cover w-full h-full" alt="{{ $product->name }}">
                                        <div class="absolute inset-0 items-center justify-center hidden text-white transition-opacity bg-black bg-opacity-50 cursor-pointer remove-existing-btn group-hover:flex" data-input-name="delete_main_image" data-image="{{ $product->image }}">
                                            <i class="pointer-events-none fa-solid fa-trash"></i>
                                        </div>
                                    </div>
                                    @else
                                    <div class="col-span-3 p-4 text-sm text-gray-500 border rounded bg-gray-50">No main image uploaded.</div>
                                    @endif
                                </div>
                            </div>

                            <div class="p-6 bg-white border border-gray-100 shadow-sm rounded-xl">
                                <h3 class="pb-2 mb-4 font-bold text-gray-800 border-b">Product Gallery Images</h3>
                                
                                <label for="product-images" class="block p-6 mb-4 text-center transition border-2 border-gray-300 border-dashed rounded-lg cursor-pointer hover:bg-gray-50">
                                    <i class="mb-2 text-3xl text-gray-400 fa-solid fa-cloud-arrow-up"></i>
                                    <p class="text-sm text-gray-500">Upload New Gallery Images</p>
                                    <input type="file" id="product-images" name="images[]" class="hidden" multiple accept="image/png, image/jpeg, image/jpg, image/webp">
                                </label>

                                <div id="gallery-new-preview-container" class="grid grid-cols-3 gap-2 mb-6"></div>

                                <h4 class="pb-1 mb-3 text-sm font-medium text-gray-700 border-b">Existing Gallery Images</h4>
                                <div class="grid grid-cols-3 gap-2">
                                    @php $galleryImages = json_decode($product->images, true) ?: []; @endphp
                                    @forelse($galleryImages as $galleryImage)
                                    <div class="relative h-20 overflow-hidden bg-gray-100 border rounded existing-image-wrapper group">
                                        <img src="{{ asset('uploads/products/' . $galleryImage) }}" class="object-cover w-full h-full" alt="Gallery image">
                                        <div class="absolute inset-0 items-center justify-center hidden text-white transition-opacity bg-black bg-opacity-50 cursor-pointer remove-existing-btn group-hover:flex" data-input-name="deleted_gallery_images[]" data-image="{{ $galleryImage }}">
                                            <i class="pointer-events-none fa-solid fa-trash"></i>
                                        </div>
                                    </div>
                                    @empty
                                    <div class="col-span-3 p-4 text-sm text-gray-500 border rounded bg-gray-50">No gallery images available.</div>
                                    @endforelse
                                </div>
                            </div>

                            <div id="deleted-existing-images-container" class="hidden"></div>

                        </div>

                    </div>
                </form>

                <form id="deleteProductForm" action="{{ route('admin.product.destroy', $product->id) }}" method="POST" class="hidden">
                    @csrf
                    @method('DELETE')
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
            // 2. SINGLE NEW IMAGE UPLOAD (MAIN)
            // ==========================================
            const singleImageInput = document.getElementById('product-image');
            const singleUploadLabel = document.getElementById('single-upload-label');
            const singlePreviewContainer = document.getElementById('single-new-preview-container');
            const singleImagePreview = document.getElementById('single-image-preview');
            const removeSingleNewBtn = document.getElementById('remove-single-new-btn');

            if (singleImageInput) {
                singleImageInput.addEventListener('change', function(event) {
                    const file = event.target.files[0];
                    if (file && file.type.startsWith('image/')) {
                        singleImagePreview.src = URL.createObjectURL(file);
                        singleUploadLabel.classList.add('hidden');
                        singlePreviewContainer.classList.remove('hidden');
                        singlePreviewContainer.classList.add('flex');
                    } else {
                        resetSingleNewImage();
                    }
                });
            }

            if (removeSingleNewBtn) {
                removeSingleNewBtn.addEventListener('click', function(e) {
                    e.preventDefault();
                    resetSingleNewImage();
                });
            }

            function resetSingleNewImage() {
                singleImageInput.value = '';
                singleImagePreview.src = '';
                singlePreviewContainer.classList.add('hidden');
                singlePreviewContainer.classList.remove('flex');
                singleUploadLabel.classList.remove('hidden');
            }

            // ==========================================
            // 3. MULTIPLE NEW IMAGE UPLOAD (GALLERY)
            // ==========================================
            const galleryInput = document.getElementById('product-images');
            const galleryPreviewContainer = document.getElementById('gallery-new-preview-container');
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
                    updateGalleryPreviews();
                });
            }

            function updateGalleryPreviews() {
                // Sync the HTML input
                const dataTransfer = new DataTransfer();
                selectedGalleryFiles.forEach(file => dataTransfer.items.add(file));
                galleryInput.files = dataTransfer.files;

                // Clear current previews
                galleryPreviewContainer.innerHTML = '';

                // Re-render
                selectedGalleryFiles.forEach((file, index) => {
                    const objectUrl = URL.createObjectURL(file);
                    
                    const div = document.createElement('div');
                    div.className = 'relative h-20 bg-gray-50 rounded border border-blue-200 flex items-center justify-center overflow-hidden group shadow-sm';
                    
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
                        updateGalleryPreviews();
                        URL.revokeObjectURL(objectUrl);
                    });

                    div.appendChild(img);
                    div.appendChild(removeBtn);
                    galleryPreviewContainer.appendChild(div);
                });
            }

            // ==========================================
            // 4. REMOVE EXISTING IMAGES (TRACK FOR BACKEND)
            // ==========================================
            const removeExistingBtns = document.querySelectorAll('.remove-existing-btn');
            const deletedImagesContainer = document.getElementById('deleted-existing-images-container');

            removeExistingBtns.forEach(btn => {
                btn.addEventListener('click', function() {
                    // We pull the input name dynamically so PHP knows if it's the main image or a gallery array
                    const inputName = this.getAttribute('data-input-name'); 
                    const imageName = this.getAttribute('data-image');
                    const wrapper = this.closest('.existing-image-wrapper');
                    
                    // Hide the image from the UI
                    wrapper.style.display = 'none';
                    
                    // Create a hidden input for PHP
                    const hiddenInput = document.createElement('input');
                    hiddenInput.type = 'hidden';
                    hiddenInput.name = inputName;
                    hiddenInput.value = imageName;
                    
                    deletedImagesContainer.appendChild(hiddenInput);
                });
            });

        });
    </script>
</x-admin-layout>