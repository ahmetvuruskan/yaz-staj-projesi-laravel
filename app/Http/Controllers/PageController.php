<?php

namespace App\Http\Controllers;

use App\Models\Pages;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class PageController extends Controller
{

    public function index()
    {
        $pages = Pages::all();
        return view('Admin.Pages.index')->with('pages', $pages);
    }

    public function addNew()
    {
        return view('Admin.Pages.addpages');
    }

    public function save(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'page_head' => 'bail|required',
            'page_content' => 'bail|required'
        ], [
            'page_head.required' => 'Sayfa adı alanı boş olamaz',
            'page_content.required' => 'Sayfa içeriği alanı boş olamaz'
        ]);
        if ($validator->fails()) {
            return redirect(route('admin.pages.add'))->withErrors($validator);
        }
        $insert = Pages::insert([
            'page_head' => htmlspecialchars($request->page_head),
            'page_content' => $request->page_content,
            'page_slug' => Str::slug($request->page_head)
        ]);
        if ($insert) {
            return redirect(route('admin.pages.index'))->with('success', 'Sayfa ekleme işlemi başarılı');
        }
        return redirect(route('admin.pages.index'))->with('error', 'Sayfa ekleme işlemi başarısız');
    }

    public function edit($id)
    {
        $pages = Pages::where('id', $id)->first();
        return view('Admin.Pages.editpages')->with('pages', $pages);
    }

    public function update(Request $request, $id)
    {
        $update = Pages::where('id', $id)->update([

            'page_head' => htmlspecialchars($request->page_head),
            'page_content' => $request->page_content,
            'page_slug' => Str::slug($request->page_head)
        ]);
        if ($update) {
            return redirect(route('admin.pages.index'))->with('success', 'Sayfa düzenleme işlemi başarılı');
        }
        return redirect(route('admin.pages.index'))->with('error', 'Sayfa düzenleme işlemi başarısız');
    }
}
