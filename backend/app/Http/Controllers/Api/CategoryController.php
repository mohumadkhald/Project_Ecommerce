<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Categories;
use Exception;
use Illuminate\Http\Request;
use Psy\Readline\Hoa\FileException;

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

            $category->image = $fileName;
            $category->name = $request->name;
            $category->save();
            return response()->json('category added successfully', 201);
        } catch (Exception $e) {
            return response()->json($e, 500);
        }
    }

    public function update_category(Request $request, $id)
    {
        $category = Categories::find($id);
        try {
            $validated = $request->validate([
                'name' => 'required|unique:categories,name,' . $id,
                'image' => 'required'

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

            $category->image = $fileName;
            $category->name = $request->name;
            $category->update();

            return response()->json('category Updated successfully', 200);
        } catch (Exception $e) {
            return response()->json($e, 500);
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
}
