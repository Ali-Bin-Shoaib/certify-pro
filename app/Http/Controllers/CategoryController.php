<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Symfony\Component\VarDumper\VarDumper;

class CategoryController extends Controller
{

    public function index()
    {

        $categories = Category::join('members', 'member_id', '=', 'members.id')
            ->where('organization_id', '=', Auth::user()->member->organization_id)
            ->get(['categories.*'])
            ->sortby('categories.created_at');
        // dd($categories);
        // $categories = Category::all();
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
        $isExist = Category::join('members', 'member_id', '=', 'members.id')
            ->where('organization_id', '=', Auth::user()->member->organization_id)
            ->where('title', '=', $request->title)
            ->get(['categories.*'])
            ->first();

        if ($isExist != null)
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
        $category = Category::join('members', 'member_id', '=', 'members.id')
            ->where('organization_id', '=', Auth::user()->member->organization_id)
            ->where('categories.id', '=', $id)->first();

        // $category = Category::find($id);
        // dd([$id, $category]);
        // VarDumper::dump($id, $category);

        if ($category) {
            $category['member_id'] = Auth::user()->member->id;
            $category->update($category->toArray());
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
