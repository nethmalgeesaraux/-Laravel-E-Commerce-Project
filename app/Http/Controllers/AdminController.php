<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Brand;
use Illuminate\Support\Str;
use Intervention\Image\Laravel\Facades\Image;
use App\Models\Category;
use App\Models\User;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;


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
        $parentCategories = Category::where('parent_id', null)->orderBy('name', 'ASC')->get();
        return view('admin.category-add', compact('parentCategories'));
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
        $query = Category::with('parent');

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
        $parentCategories = Category::whereNull('parent_id')->orderBy('name', 'ASC')->get();
        return view('admin.category-add', compact('parentCategories'));
    }

    public function categoryStore(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'slug' => 'nullable|string|max:255|unique:categories,slug',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'status' => 'nullable|boolean',
            'parent_id' => 'nullable|exists:categories,id',
        ]);

        $category = new Category();
        $category->name = $request->name;
        $category->slug = $request->slug ? Str::slug($request->slug) : Str::slug($request->name);
        $category->status = $request->has('status') ? 1 : 0;
        $category->parent_id = $request->parent_id;

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
        $parentCategories = Category::whereNull('parent_id')->where('id', '!=', $category->id)->orderBy('name', 'ASC')->get();
        return view('admin.category-edit', compact('category', 'parentCategories'));
    }

    public function categoryUpdate(Request $request, $id)
    {
        $category = Category::findOrFail($id);

        $request->validate([
            'name' => 'required|string|max:255',
            'slug' => 'nullable|string|max:255|unique:categories,slug,' . $category->id,
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'status' => 'nullable|boolean',
            'parent_id' => 'nullable|exists:categories,id',
        ]);

        $category->name = $request->name;
        $category->slug = $request->slug ? Str::slug($request->slug) : Str::slug($request->name);
        $category->status = $request->has('status') ? 1 : 0;
        $category->parent_id = $request->parent_id;

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

    // -------- Additional admin sections --------
    public function users()
    {
        $users = User::orderBy('created_at', 'DESC')->paginate(15);
        return view('admin.users', compact('users'));
    }

    public function userShow($id)
    {
        $user = User::findOrFail($id);
        return view('admin.user-show', compact('user'));
    }

    public function orders()
    {
        // If orders table doesn't exist, return empty collection
        if (!Schema::hasTable('orders')) {
            $orders = collect();
            return view('admin.orders', compact('orders'));
        }

        $orders = DB::table('orders')->orderBy('created_at', 'DESC')->paginate(15);
        return view('admin.orders', compact('orders'));
    }

    public function orderShow($id)
    {
        if (!Schema::hasTable('orders')) {
            abort(404);
        }

        $order = DB::table('orders')->where('id', $id)->first();
        if (!$order) abort(404);
        return view('admin.order-show', compact('order'));
    }

    public function reviews()
    {
        if (!Schema::hasTable('reviews')) {
            $reviews = collect();
            return view('admin.reviews', compact('reviews'));
        }

        $reviews = DB::table('reviews')->orderBy('created_at', 'DESC')->paginate(15);
        return view('admin.reviews', compact('reviews'));
    }

    public function reviewDestroy($id)
    {
        if (!Schema::hasTable('reviews')) {
            return redirect()->route('admin.reviews')->with('error', 'Reviews table not present');
        }

        DB::table('reviews')->where('id', $id)->delete();
        return redirect()->route('admin.reviews')->with('success', 'Review deleted');
    }

    public function settings()
    {
        $path = storage_path('app/settings.json');
        $settings = [];
        if (file_exists($path)) {
            $settings = json_decode(file_get_contents($path), true) ?: [];
        }

        return view('admin.settings', compact('settings'));
    }

    public function settingsUpdate(Request $request)
    {
        $data = $request->validate([
            'site_name' => 'nullable|string|max:255',
            'contact_email' => 'nullable|email|max:255',
        ]);

        $path = storage_path('app/settings.json');
        file_put_contents($path, json_encode($data, JSON_PRETTY_PRINT));

        return redirect()->route('admin.settings')->with('success', 'Settings saved');
    }
}
