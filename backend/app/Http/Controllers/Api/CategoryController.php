<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Categories;
use Exception;
use Illuminate\Http\Request;
use Psy\Readline\Hoa\FileException;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use App\Models\Product;
use App\Http\Resources\productResource;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Categories::paginate(10);
        return response()->json($categories, 200);
    }
    public function show($id)
    {
        $category = Categories::find($id);
        if ($category) {
            return response()->json($category, 200);
        } else
            return response()->json('category not found');
    }
    public function store(Request $request)
    {
        $category = new Categories();

        try {
            $validated = $request->validate([
                'name' => 'required|unique:categories,name,',
                'image' => 'required',
            ]);

            if ($request->hasFile('image')) {
                $path = 'assets/uploads/categories/' . $category->image;


            }
            $file = $request->file('image');
            $ext = $file->getClientOriginalExtension();
            $fileName = time() . '.' . $ext;

            try {
                $file->move('assets/uploads/categories', $fileName);
            } catch (FileException $e) {
                return response()->json('An error occurred while processing your request', 500);
            }

            $category->image = $path . $fileName;
            $category->name = $request->name;
            $category->save();
            return response()->json('category added successfully', 201);
        } catch (Exception $e) {
            return response()->json($e, 500);
        }
    }

    public function update_category($id, Request $request)
    {
        $category = Categories::find($id);

        if ($category) {
            try {
                $validated = $request->validate([
                    'name' => 'required',
                    'image' => 'required',
                ]);

                if ($request->hasFile('image')) {
                    $path = 'assets/uploads/categories/';
                    $file = $request->file('image');
                    $ext = $file->getClientOriginalExtension();
                    $fileName = time() . '.' . $ext;

                    try {
                        $file->move($path, $fileName);
                    } catch (FileException $e) {
                        return response()->json('An error occurred while processing your request', 500);
                    }

                    Categories::where('id', $id)->update(['image' => $path . $fileName]);

                }

                Categories::where('id', $id)->update(['name' => $request->name]);
                $category->save();

                return response()->json('Category updated successfully', 200);
            } catch (Exception $e) {
                return response()->json($e, 500);
            }
        } else {
            return response()->json('Category not found', 404);
        }
    }




    public function delete_category($id)
    {
        $category = Categories::find($id);
        if ($category) {
            $category->delete();
            return response()->json('category Deleted successfully', 200);
        } else
            return response()->json('category not found', 404);
    }


    public function getProducts($id)
    {
        $category = Categories::find($id);

    if (!$category) {
        return response()->json(['error' => 'Category not found'], 404);
    }
        $products = Product::where('category_id', $id)->get();

        return response()->json(['products' => productResource::collection($products)]);
    }
}
