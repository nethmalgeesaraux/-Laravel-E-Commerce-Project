<x-admin-layout>
    <main class="flex-1 p-6 overflow-y-auto">
        <div class="flex items-center justify-between mb-6">
            <h1 class="text-2xl font-bold text-gray-800">Edit Brand</h1>
            <a href="brands.php" class="border border-gray-300 bg-white hover:bg-gray-50 text-gray-700 px-5 py-2.5 rounded-lg text-sm font-medium transition flex items-center gap-2">
                <i class="fa-solid fa-arrow-left"></i> Back to Brands
            </a>
        </div>
        <div class="max-w-3xl mx-auto">
            <form action="{{ route('admin.brands.store') }}" method="POST" enctype="multipart/form-data" class="p-8 space-y-6 bg-white border border-gray-100 shadow-sm rounded-xl">
                @csrf
                <div class="grid grid-cols-1 gap-6 md:grid-cols-2">
                    <div>
                        <label class="block mb-1 text-sm font-medium text-gray-700">Brand Name </label>
                        <input type="text" id="name" name="name" placeholder="e.g. Samsung" class="w-full px-4 py-2 border rounded-lg outline-none focus:ring-1 focus:ring-primary" value="{{$brand->name}}" required>
                        @error('name')
                        <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                        @enderror
                    </div>
                    <div>
                        <label class="block mb-1 text-sm font-medium text-gray-700">Brand Slug</label>
                        <input type="text" id="slug" name="slug" placeholder="samsung" class="w-full px-4 py-2 border rounded-lg outline-none bg-gray-50" value="{{$brand->slug}}" required>
                        @error('slug')
                        <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                
                <div class="flex flex-col items-start gap-8 pt-4 md:flex-row">
                    <div class="w-full md:w-1/3">
                        <label class="block mb-2 text-sm font-medium text-gray-700">Current Logo</label>
                        <div class="flex items-center justify-center w-full h-40 p-4 bg-white border rounded-lg">
                            <img src="uploads/brands/1.png" class="object-contain max-w-full max-h-full" alt="Brand Logo">
                        </div>
                    </div>

                    <div class="w-full md:w-2/3">
                        <label class="block mb-2 text-sm font-medium text-gray-700">Change Brand Logo</label>

                        <div class="relative w-full h-40">
                            <label for="brand-image" class="relative flex flex-col items-center justify-center w-full h-full overflow-hidden transition border-2 border-gray-300 border-dashed rounded-lg cursor-pointer bg-gray-50 hover:bg-gray-100">

                                <div id="upload-content" class="z-10 text-center">
                                    <i class="mb-2 text-3xl text-gray-300 fa-solid fa-image"></i>
                                    <p class="text-sm text-gray-500">Upload new logo</p>
                                </div>

                                <img id="image-preview" class="absolute inset-0 z-20 hidden object-contain w-full h-full p-2 bg-white" src="" alt="New Logo Preview">

                                <input type="file" id="brand-image" name="images" class="hidden" accept="image/png, image/jpeg, image/jpg, image/webp" />
                            </label>

                            <button type="button" id="remove-logo-btn" class="absolute z-30 flex items-center justify-center hidden w-8 h-8 text-red-500 transition-colors bg-white border border-gray-200 rounded-full shadow-md top-2 right-2 hover:text-white hover:bg-red-500 focus:outline-none" title="Remove new image">
                                <i class="fa-solid fa-xmark"></i>
                            </button>
                        </div>
                    </div>
                </div>

                
                <div class="flex items-center gap-2">
                    <input type="checkbox" id="status" name="status" class="w-4 h-4 border-gray-300 rounded text-primary focus:ring-primary">
                    <label for="status" class="text-sm text-gray-700">Set as Active Brand</label>
                </div>

                <div class="flex justify-end gap-3 pt-4 border-t">
                    <a href="{{route('admin.brands')}}" class="px-6 py-2 text-sm transition border rounded-lg hover:bg-gray-50">Cancel</a>
                    <button type="submit" class="px-6 py-2 text-sm font-medium text-white transition rounded-lg shadow-sm bg-primary hover:bg-blue-600">Save Brand</button>
                </div>
            </form>
        </div>
    </main>


    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const logoInput = document.getElementById('brand-image');
            const uploadContent = document.getElementById('upload-content');
            const imagePreview = document.getElementById('image-preview');
            const removeBtn = document.getElementById('remove-logo-btn');

            // Handle file selection
            logoInput.addEventListener('change', function(event) {
                const file = event.target.files[0];

                if (file && file.type.startsWith('image/')) {
                    // Show preview
                    imagePreview.src = URL.createObjectURL(file);
                    uploadContent.classList.add('hidden');
                    imagePreview.classList.remove('hidden');
                    removeBtn.classList.remove('hidden'); // Show the 'X' button
                } else {
                    // Invalid file or canceled
                    resetImageState();
                }
            });

            // Handle remove button click
            removeBtn.addEventListener('click', function(event) {
                event.preventDefault(); // Prevent form submission if inside a form
                resetImageState();
            });

            // Helper function to reset the UI to its default state
            function resetImageState() {
                logoInput.value = ''; // Clear the actual file input
                imagePreview.src = '';

                // Toggle visibility classes back to default
                uploadContent.classList.remove('hidden');
                imagePreview.classList.add('hidden');
                removeBtn.classList.add('hidden');
            }

            // --- Slug Auto-Generation ---
            const brandNameInput = document.getElementById('name');
            const brandSlugInput = document.getElementById('slug');

            brandNameInput.addEventListener('input', function() {
                const name = this.value;

                // Generate the slug
                const slug = name.toLowerCase()
                    .trim() // Remove whitespace from both ends
                    .replace(/[^a-z0-9 -]/g, '') // Remove invalid characters
                    .replace(/\s+/g, '-') // Replace spaces with hyphens
                    .replace(/-+/g, '-'); // Replace multiple hyphens with a single one

                brandSlugInput.value = slug;
            });
        });
    </script>
</x-admin-layout>