<?php

namespace App\Http\Controllers;

use App\Models\Brands;
use App\Models\Categories;
use App\Models\Product;
use App\Models\Purchase;
use App\Models\PurchasedProduct;
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
            $total_prodct = Product::all()->count();
            $total_order = Purchase::all()->count();

            $total_buyers = User::where('role', 'LIKE', 'buyer')->count();
            $total_sellers = User::where('role', 'seller')->count();

            $order_delivered = Purchase::where('state', 'delivered')->count();
            $order_not_delivered = Purchase::where('state', 'not delivered')->count();


            $purchase_products = PurchasedProduct::all();
            $total_revenue = 0;
            $order_price = 0;

            foreach ($purchase_products as $product) {
                $order_price = Product::find($product->product_id)->price;
                $total_revenue = $total_revenue + $order_price * $product->quantity;

            }

            return view('admin.home', compact('order_delivered', 'order_not_delivered', 'total_prodct', 'total_order', 'total_buyers', 'total_sellers', 'total_revenue'));
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

    public function order()
    {
        $orders = PurchasedProduct::all();
        return view('admin.order', compact('orders'));
    }

    public function search(Request $request)
    {
        $search = $request->search;
        $search_id = null;

        if ($search) {
            $search_user = User::where('name', 'LIKE', "%$search%")->first();

            if ($search_user) {
                $search_id = $search_user->id;
            }
        }

        $data = Product::where('title', 'LIKE', "%$search%")
            ->orWhere('user_id', $search_id)
            ->get();

        return view('admin.view_product', compact('data'));
    }
}

