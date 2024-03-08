<?php

namespace App\Http\Controllers;

use App\Models\Brands;
use App\Models\Categories;
use App\Models\Product;
use Dotenv\Exception\ValidationException;
use Illuminate\Http\Request;

use Illuminate\Support\Fecades\Auth;

use App\Models\User;


class AdminController extends Controller
{
    public function redirect()
    {
        $usertype = auth()->user()->role;

        if ($usertype == 'admin') {
            return view('admin.home');
        }
    }

    public function view_category()
    {
        $data = Categories::All();
        return View('admin.category', compact('data'));
    }
    public function add_category(Request $request)
    {
        try {
            $validated = $request->validate([
                'category_name' => 'required|unique:categories,name',
                'category_img' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            ]);
            $data = new Categories;
            $data->name = $request->category_name;
            $category_image = $request->file('category_img');

            if ($category_image) {
                $category_image_name = time() . '.' . $category_image->getClientOriginalExtension();
                $full_path = 'assets/uploads/categories/' . $category_image_name;
                $category_image->move('assets/uploads/categories/', $category_image_name);
                $data->image = $full_path;
            }
            $data->save();
            return redirect()->back()->with('success', 'Category added successfully');
        } catch (ValidationException $e) {
            return redirect()->back()->withErrors($e)->withInput();
        }

    }

    public function cat_delete($id)
    {
        $data = Categories::find($id);
        $data->delete();
        return redirect()->back()->with('success', 'Category deleted successfully');

    }

    public function cat_update($id)
    {
        $data = Categories::find($id);

        return view('admin.cat_update', compact('data'));
    }
    public function view_product()
    {
        $data = Product::All();

        return view('admin.view_product', compact('data'));
    }

    public function product_delete($id)
    {
        $data = Product::find($id);
        $data->delete();
        return redirect()->back()->with('success', 'Product deleted successfully');

    }
    public function view_brand()
    {
        $data = Brands::All();

        return view('admin.view_brand', compact('data'));
    }

    public function add_brand(Request $request)
    {
        try {
            $validated = $request->validate([
                'brand_name' => 'required|unique:brands,name',
            ]);
            $data = new Brands;
            $data->name = $request->brand_name;
            $data->save();
            return redirect()->back()->with('success', 'Category added successfully');
        } catch (ValidationException $e) {
            return redirect()->back()->withErrors($e)->withInput();
        }
    }

    public function brand_delete($id)
    {
        $data = Brands::find($id);
        $data->delete();
        return redirect()->back()->with('success', 'Brand deleted successfully');

    }

    public function view_users()
    {
        $data = User::all();
        return view('admin.view_users', compact('data'));
    }
    public function user_delete($id)
    {
        $data = User::find($id);
        $data->delete();
        return redirect()->back()->with('success', 'User deleted successfully');

    }
}

