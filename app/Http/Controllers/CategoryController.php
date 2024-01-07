<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CategoryController extends Controller
{

    public function index()
    {
        $categories = Category::all();
        return view("categories.index", compact("categories"));
        //
    }
    public function create()
    {
        return view("categories.create");
    }
    public function store(Request $request)
    {
        $category = $request->validate([
            "title" => "required",
        ]);
        if (Category::where("title", $request->title)->first() != null)
            return back()->with('error', 'التصنيف المدخل موجود مسبقا.');
        
        $category['member_id'] = Auth::user()->member->id;
        Category::create($category);
        return redirect()->route('categories.index')->with('success', 'تمت الإضافة بنجاح');
    }
    public function edit(string $id)
    {
        $category = Category::find($id);
        return view('categories.edit', compact('category'));
    }
    public function update(Request $request, string $id)
    {
        $request->validate([
            "title" => "required",
        ]);
        $category = Category::find($id);
        if ($category) {
            $category->update($request->all());
            return redirect()->route('categories.index')->with('success', 'تم تحديث البيانات بنجاح');
        }
        return back()->with('error', 'لم تتم علمية تحديث بيانات التصنيف ');
    }
    public function destroy(string $id)
    {
        $category = Category::find($id);
        if ($category) {
            $category->delete();
            return redirect()->route('categories.index')->with('success', 'تم حذف البيانات بنجاح');
        }
        return back()->with('error', 'عملية الحذف فشلت. لا يمكن العثور على بيانات التصنيف ');
    }
}
