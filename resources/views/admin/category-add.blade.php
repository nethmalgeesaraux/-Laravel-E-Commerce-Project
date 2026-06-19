<x-admin-layout>
    <main class="flex-1 p-6 overflow-y-auto">
        <div class="flex items-center justify-between mb-6">
            <h1 class="text-2xl font-bold text-gray-800">Add New Category</h1>
            <a href="{{ route('admin.categories') }}" class="border border-gray-300 bg-white hover:bg-gray-50 text-gray-700 px-5 py-2.5 rounded-lg text-sm font-medium transition flex items-center gap-2">
                <i class="fa-solid fa-arrow-left"></i> Back to Categories
            </a>
        </div>

        <div class="max-w-3xl mx-auto">
            <form action="{{ route('admin.categories.store') }}" method="POST" enctype="multipart/form-data" class="p-8 space-y-6 bg-white border border-gray-100 shadow-sm rounded-xl">
                @csrf

                <div class="grid grid-cols-1 gap-6 md:grid-cols-2">
                    <div>
                        <label class="block mb-1 text-sm font-medium text-gray-700">Category Name</label>
                        <input type="text" id="name" name="name" placeholder="e.g. Electronics" value="{{ old('name') }}" class="w-full px-4 py-2 border rounded-lg outline-none focus:ring-1 focus:ring-primary">
                        @error('name')
                        <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                        @enderror
                    </div>
                    <div>
                        <label class="block mb-1 text-sm font-medium text-gray-700">Category Slug</label>
                        <input type="text" id="slug" name="slug" placeholder="electronics" value="{{ old('slug') }}" class="w-full px-4 py-2 border rounded-lg outline-none bg-gray-50">
                        @error('slug')
                        <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <div>
                    <label class="block mb-1 text-sm font-medium text-gray-700">Parent Category</label>
                    <select name="parent_id" class="w-full px-4 py-2 border rounded-lg outline-none focus:ring-1 focus:ring-primary">
                        <option value="">-- None (Top-level category) --</option>
                        @foreach($parentCategories as $parentCategory)
                        <option value="{{ $parentCategory->id }}" {{ old('parent_id') == $parentCategory->id ? 'selected' : '' }}>{{ $parentCategory->name }}</option>
                        @endforeach
                    </select>
                    @error('parent_id')
                    <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label class="block mb-2 text-sm font-medium text-gray-700">Category Image</label>
                    <div class="relative flex items-center justify-center w-full h-40">
                        <label for="category-image" class="relative flex flex-col items-center justify-center w-full h-full overflow-hidden transition border-2 border-gray-300 border-dashed rounded-lg cursor-pointer bg-gray-50 hover:bg-gray-100">
                            <div id="upload-content" class="z-10 flex flex-col items-center justify-center pt-5 pb-6">
                                <i class="mb-2 text-3xl text-gray-400 fa-solid fa-image"></i>
                                <p class="text-sm text-gray-500">Upload category image (PNG/JPG)</p>
                            </div>
                            <img id="image-preview" class="absolute inset-0 z-20 hidden object-contain w-full h-full p-2 bg-white" src="" alt="Image Preview">
                            <input id="category-image" name="image" type="file" class="hidden" accept="image/png, image/jpeg, image/jpg, image/webp" />
                        </label>
                        <button type="button" id="remove-image-btn" class="absolute z-30 hidden w-8 h-8 text-red-500 transition-colors bg-white border border-gray-200 rounded-full shadow-md top-2 right-2 hover:text-white hover:bg-red-500" title="Remove image">
                            <i class="fa-solid fa-xmark"></i>
                        </button>
                    </div>
                    @error('image')
                    <p class="mt-2 text-sm text-red-500">{{ $message }}</p>
                    @enderror
                </div>

                <div class="flex items-center gap-2">
                    <input type="checkbox" id="status" name="status" class="w-4 h-4 border-gray-300 rounded text-primary focus:ring-primary" {{ old('status') ? 'checked' : '' }}>
                    <label for="status" class="text-sm text-gray-700">Set as Active Category</label>
                </div>

                <div class="flex justify-end gap-3 pt-4 border-t">
                    <a href="{{ route('admin.categories') }}" class="px-6 py-2 text-sm transition border rounded-lg hover:bg-gray-50">Cancel</a>
                    <button type="submit" class="px-6 py-2 text-sm font-medium text-white transition rounded-lg shadow-sm bg-primary hover:bg-blue-600">Save Category</button>
                </div>
            </form>
        </div>
    </main>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const imageInput = document.getElementById('category-image');
            const uploadContent = document.getElementById('upload-content');
            const imagePreview = document.getElementById('image-preview');
            const removeBtn = document.getElementById('remove-image-btn');

            imageInput.addEventListener('change', function(event) {
                const file = event.target.files[0];
                if (file && file.type.startsWith('image/')) {
                    imagePreview.src = URL.createObjectURL(file);
                    uploadContent.classList.add('hidden');
                    imagePreview.classList.remove('hidden');
                    removeBtn.classList.remove('hidden');
                } else {
                    resetImageState();
                }
            });

            removeBtn.addEventListener('click', function(event) {
                event.preventDefault();
                resetImageState();
            });

            function resetImageState() {
                imageInput.value = '';
                imagePreview.src = '';
                uploadContent.classList.remove('hidden');
                imagePreview.classList.add('hidden');
                removeBtn.classList.add('hidden');
            }

            const nameInput = document.getElementById('name');
            const slugInput = document.getElementById('slug');

            nameInput.addEventListener('input', function() {
                const slug = this.value.toLowerCase().trim().replace(/[^a-z0-9 -]/g, '').replace(/\s+/g, '-').replace(/-+/g, '-');
                slugInput.value = slug;
            });
        });
    </script>
</x-admin-layout>
