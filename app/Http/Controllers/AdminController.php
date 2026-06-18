<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Brand;
use Illuminate\Support\Str;
use Intervention\Image\Laravel\Facades\Image;
use App\Models\Category;


class AdminController extends Controller
{
    public function index()
    {
        return view('admin.index');
    }

    public function brands(Request $request)
    {
        $query = Brand::query();

        if ($search = $request->query('search')) {
            $query->where(function ($sub) use ($search) {
                $sub->where('name', 'like', "%{$search}%")
                    ->orWhere('slug', 'like', "%{$search}%");
            });
        }

        if ($status = $request->query('status')) {
            if ($status === 'active') {
                $query->where('status', 1);
            } elseif ($status === 'inactive') {
                $query->where('status', 0);
            }
        }

        $brands = $query->orderBy('id', 'DESC')->paginate(10)->withQueryString();
        return view('admin.brands', compact('brands'));
    }

    public function brandAdd()
    {
        return view('admin.brand-add');
    }

    public function brandStore(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'slug' => 'nullable|string|max:255|unique:brands,slug',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'status' => 'nullable|boolean',
        ]);

        $brand = new Brand();
        $brand->name = $request->name;
        $brand->slug = $request->slug ? Str::slug($request->slug) : Str::slug($request->name);
        $brand->status = $request->has('status') ? 1 : 0;

        if ($request->hasFile('image')) {
            $imageName = time() . '_' . uniqid() . '.' . $request->image->extension();
            $request->image->move(public_path('uploads/brands'), $imageName);
            $brand->image = $imageName;
        }

        $brand->save();

        return redirect()->route('admin.brands')->with('success', 'Brand added successfully!');
    }

    public function generateThumbnailImage($image, $imageName, $folder, $width = 124, $height = 124)
    {
        $thumbnailPath = public_path($folder . '/thumbnails');
        if (!file_exists($thumbnailPath)) {
            mkdir($thumbnailPath, 0755, true);
        }

        Image::decode($image)->resize($width, $height)->save($thumbnailPath . '/' . $imageName);
    }

    public function brandEdit($id)
    {
        $brand = Brand::findOrFail($id);
        return view('admin.brand-edit', compact('brand'));
    }

    public function brandDestroy($id)
    {
        $brand = Brand::findOrFail($id);
        $brand->delete();

        return redirect()->route('admin.brands')->with('success', 'Brand deleted successfully!');
    }

    public function categories()
    {
        $query = Category::query();

        if ($search = request('search')) {
            $query->where('name', 'LIKE', "%{$search}%")
                ->orWhere('slug', 'LIKE', "%{$search}%");
        }

        if ($status = request('status')) {
            if ($status === 'active') {
                $query->where('status', 1);
            } elseif ($status === 'inactive') {
                $query->where('status', 0);
            }
        }

        $categories = $query->orderBy('id', 'DESC')->paginate(10)->withQueryString();
        return view('admin.categories', compact('categories'));
    }

    public function categoryAdd()
    {
        return view('admin.category-add');
    }

    public function categoryStore(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'slug' => 'nullable|string|max:255|unique:categories,slug',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'status' => 'nullable|boolean',
        ]);

        $category = new Category();
        $category->name = $request->name;
        $category->slug = $request->slug ? Str::slug($request->slug) : Str::slug($request->name);
        $category->status = $request->has('status') ? 1 : 0;

        if ($request->hasFile('image')) {
            $imageName = time() . '_' . uniqid() . '.' . $request->image->extension();
            $request->image->move(public_path('uploads/categories'), $imageName);
            $category->image = $imageName;
        }

        $category->save();

        return redirect()->route('admin.categories')->with('success', 'Category added successfully!');
    }

    public function categoryEdit($id)
    {
        $category = Category::findOrFail($id);
        return view('admin.category-edit', compact('category'));
    }

    public function categoryUpdate(Request $request, $id)
    {
        $category = Category::findOrFail($id);

        $request->validate([
            'name' => 'required|string|max:255',
            'slug' => 'nullable|string|max:255|unique:categories,slug,' . $category->id,
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'status' => 'nullable|boolean',
        ]);

        $category->name = $request->name;
        $category->slug = $request->slug ? Str::slug($request->slug) : Str::slug($request->name);
        $category->status = $request->has('status') ? 1 : 0;

        if ($request->hasFile('image')) {
            $imageName = time() . '_' . uniqid() . '.' . $request->image->extension();
            $request->image->move(public_path('uploads/categories'), $imageName);
            $category->image = $imageName;
        }

        $category->save();

        return redirect()->route('admin.categories')->with('success', 'Category updated successfully!');
    }

    public function categoryDestroy($id)
    {
        $category = Category::findOrFail($id);
        $category->delete();

        return redirect()->route('admin.categories')->with('success', 'Category deleted successfully!');
    }
}
