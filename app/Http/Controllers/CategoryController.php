<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class CategoryController extends Controller
{
    public function index()
    {
        $category = Category::where('category_status', '1')->orderBy('category_must')->get();
        return view('Admin.Category.index')->with('categories', $category);
    }

    public function addNew()
    {

        return view('Admin.Category.addcategory');
    }

    public function saveCategory(Request $request)
    {

        $category = Category::insert([
            'category_name' => htmlspecialchars($request->category_name),
            'category_must' => $request->category_must,
            'category_slug' => Str::slug($request->category_name)
        ]);

        if ($category) {
            return redirect(route('admin.categories'))->with('success', 'Kategori başarı ile eklendi');
        }
        $request->flash();
        return redirect(route('admin.categories'))->with('error', 'Kategori ekleme başarısız');
    }

    public function edit($id)
    {
        $category['single'] = Category::find($id);
        $category['full'] = Category::all();
        return view('Admin.Category.editcategory')->with('categories', $category);
    }

    public function update(Request $request, $id)
    {

        $update = Category::where('id', $id)->update([
            'category_name' => htmlspecialchars($request->category_name),
            'category_slug' => Str::slug($request->category_name)
        ]);

        if ($update) {
            return redirect(route('admin.categories'))->with('success', 'Kategori düzenleme başarılı');
        }
        return redirect(route('admin.categories'))->with('error', 'Kategori düzenleme başarısız');

    }

    public function sortable()
    {
        foreach ($_POST['item'] as $key => $value) {
            $category = Category::find(intval($value));
            $category->category_must = intval($key);
            $category->save();
        }
        echo true;
    }
}
