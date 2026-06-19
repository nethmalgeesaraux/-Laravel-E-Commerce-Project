<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use App\Models\Brand;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;

class ProductController extends Controller
{
    public function products(Request $request)
    {
        $query = Product::with(['category', 'brand']);

        if ($search = $request->query('search')) {
            $query->where(function ($sub) use ($search) {
                $sub->where('name', 'like', "%{$search}%")
                    ->orWhere('slug', 'like', "%{$search}%")
                    ->orWhere('SKU', 'like', "%{$search}%");
            });
        }

        if ($request->query('category')) {
            $query->where('category_id', $request->query('category'));
        }

        if ($status = $request->query('status')) {
            if ($status === 'active') {
                $query->where('status', 1);
            } elseif ($status === 'draft') {
                $query->where('status', 0);
            } elseif (in_array($status, ['instock', 'outofstock'], true)) {
                $query->where('stock_status', $status);
            }
        }

        $products = $query->orderBy('created_at', 'DESC')->paginate(10)->withQueryString();
        $categories = Category::orderBy('name', 'ASC')->get();

        return view('admin.product', compact('products', 'categories'));
    }

    public function create()
    {
        $categories = Category::orderBy('name', 'ASC')->get();
        $brands = Brand::orderBy('name', 'ASC')->get();

        return view('admin.product-add', compact('categories', 'brands'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'slug' => 'nullable|string|max:255|unique:products,slug',
            'short_description' => 'nullable|string',
            'information' => 'nullable|string',
            'description' => 'required|string',
            'regular_price' => 'required|numeric|min:0',
            'sale_price' => 'nullable|numeric|min:0|lte:regular_price',
            'SKU' => 'required|string|max:255|unique:products,SKU',
            'stock_status' => 'required|in:instock,outofstock',
            'featured' => 'nullable|boolean',
            'quantity' => 'required|integer|min:0',
            'category_id' => 'nullable|exists:categories,id',
            'brand_id' => 'nullable|exists:brands,id',
            'status' => 'nullable|boolean',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'images.*' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $product = new Product();
        $product->name = $request->name;
        $product->slug = $request->slug ? Str::slug($request->slug) : Str::slug($request->name);
        $product->short_description = $request->short_description;
        $product->information = $request->information;
        $product->description = $request->description;
        $product->regular_price = $request->regular_price;
        $product->sale_price = $request->sale_price;
        $product->SKU = $request->SKU;
        $product->stock_status = $request->stock_status;
        $product->featured = $request->has('featured') ? 1 : 0;
        $product->quantity = $request->quantity;
        $product->category_id = $request->category_id;
        $product->brand_id = $request->brand_id;
        $product->status = $request->has('status') ? 1 : 0;

        if ($request->hasFile('image')) {
            $imageName = time() . '_main_' . uniqid() . '.' . $request->image->extension();
            $request->image->move(public_path('uploads/products'), $imageName);
            $product->image = $imageName;
        }

        $galleryImages = [];
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $file) {
                $galleryName = time() . '_gallery_' . uniqid() . '.' . $file->extension();
                $file->move(public_path('uploads/products'), $galleryName);
                $galleryImages[] = $galleryName;
            }
        }

        $product->images = $galleryImages ? json_encode($galleryImages) : null;
        $product->save();

        return redirect()->route('admin.products')->with('success', 'Product added successfully!');
    }

    public function edit($id)
    {
        $product = Product::findOrFail($id);
        $categories = Category::orderBy('name', 'ASC')->get();
        $brands = Brand::orderBy('name', 'ASC')->get();

        return view('admin.product-edit', compact('product', 'categories', 'brands'));
    }

    public function update(Request $request, $id)
    {
        $product = Product::findOrFail($id);

        $request->validate([
            'name' => 'required|string|max:255',
            'slug' => 'nullable|string|max:255|unique:products,slug,' . $product->id,
            'short_description' => 'nullable|string',
            'information' => 'nullable|string',
            'description' => 'required|string',
            'regular_price' => 'required|numeric|min:0',
            'sale_price' => 'nullable|numeric|min:0|lte:regular_price',
            'SKU' => 'required|string|max:255|unique:products,SKU,' . $product->id,
            'stock_status' => 'required|in:instock,outofstock',
            'featured' => 'nullable|boolean',
            'quantity' => 'required|integer|min:0',
            'category_id' => 'nullable|exists:categories,id',
            'brand_id' => 'nullable|exists:brands,id',
            'status' => 'nullable|boolean',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'images.*' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'deleted_gallery_images.*' => 'nullable|string',
            'delete_main_image' => 'nullable|string',
        ]);

        $product->name = $request->name;
        $product->slug = $request->slug ? Str::slug($request->slug) : Str::slug($request->name);
        $product->short_description = $request->short_description;
        $product->information = $request->information;
        $product->description = $request->description;
        $product->regular_price = $request->regular_price;
        $product->sale_price = $request->sale_price;
        $product->SKU = $request->SKU;
        $product->stock_status = $request->stock_status;
        $product->featured = $request->has('featured') ? 1 : 0;
        $product->quantity = $request->quantity;
        $product->category_id = $request->category_id;
        $product->brand_id = $request->brand_id;
        $product->status = $request->has('status') ? 1 : 0;

        if ($request->filled('delete_main_image') && $product->image) {
            $existingPath = public_path('uploads/products/' . $product->image);
            if (File::exists($existingPath)) {
                File::delete($existingPath);
            }
            $product->image = null;
        }

        if ($request->hasFile('image')) {
            if ($product->image) {
                $existingPath = public_path('uploads/products/' . $product->image);
                if (File::exists($existingPath)) {
                    File::delete($existingPath);
                }
            }
            $imageName = time() . '_main_' . uniqid() . '.' . $request->image->extension();
            $request->image->move(public_path('uploads/products'), $imageName);
            $product->image = $imageName;
        }

        $galleryImages = json_decode($product->images, true) ?: [];

        if ($request->has('deleted_gallery_images')) {
            foreach ((array) $request->input('deleted_gallery_images') as $deletedImage) {
                if (in_array($deletedImage, $galleryImages, true)) {
                    $path = public_path('uploads/products/' . $deletedImage);
                    if (File::exists($path)) {
                        File::delete($path);
                    }
                    $galleryImages = array_values(array_filter($galleryImages, fn ($image) => $image !== $deletedImage));
                }
            }
        }

        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $file) {
                $galleryName = time() . '_gallery_' . uniqid() . '.' . $file->extension();
                $file->move(public_path('uploads/products'), $galleryName);
                $galleryImages[] = $galleryName;
            }
        }

        $product->images = $galleryImages ? json_encode($galleryImages) : null;
        $product->save();

        return redirect()->route('admin.products')->with('success', 'Product updated successfully!');
    }

    public function destroy($id)
    {
        $product = Product::findOrFail($id);

        if ($product->image) {
            $imagePath = public_path('uploads/products/' . $product->image);
            if (File::exists($imagePath)) {
                File::delete($imagePath);
            }
        }

        $galleryImages = json_decode($product->images, true) ?: [];
        foreach ($galleryImages as $image) {
            $path = public_path('uploads/products/' . $image);
            if (File::exists($path)) {
                File::delete($path);
            }
        }

        $product->delete();

        return redirect()->route('admin.products')->with('success', 'Product deleted successfully!');
    }
}
