<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CategoryController extends Controller
{

    public function index()
    {
        $categories = Category::join('members', 'member_id',  'members.id')
            ->where('members.organization_id', Auth::user()->member->organization_id)
            ->select(['categories.*'])
        ->paginate(10);
        return view("categories.index", compact("categories"));
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
        $isExist = Category::join('members', 'member_id',  'members.id')
            ->where('members.organization_id', Auth::user()->member->organization_id)
            ->where('title',  $request->title)
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
        $category = Category::join('members', 'categories.member_id',  'members.id')
            ->where('members.organization_id',  Auth::user()->member->organization_id)
            ->where('categories.id', $id)
            ->get(['categories.*'])->first();
        if ($category != null)
            return view('categories.edit', compact('category'));
        return back()->with('error', 'هذا التصنيف غير موجود');
    }
    public function update(Request $request, string $id)
    {
        try {
            $request->validate([
                "title" => "required",
            ]);
        } catch (\Throwable $th) {
            return back()->with("error", 'عنوان التصنيف مطلوب');
        }

        $isExist = Category::join('members', 'member_id',  'members.id')
            ->where('members.organization_id', Auth::user()->member->organization_id)
            ->where('title',  $request->title)
            ->get(['categories.*'])
            ->first();
        if ($isExist != null)
            return back()->with('error', 'التصنيف المدخل موجود مسبقا.');

        $category = Category::join('members', 'categories.member_id',  'members.id')
            ->where('members.organization_id',  Auth::user()->member->organization_id)
            ->where('categories.id', $id)
            ->get(['categories.*'])->first();
        if ($category) {
            $category['member_id'] = Auth::user()->member->id;
            $category['title'] = $request->title;
            $category->update($category->toArray());
            return redirect()->route('categories.index')->with('success', 'تم تحديث البيانات بنجاح');
        }
        return back()->with('error', 'لم تتم علمية تحديث بيانات التصنيف ');
    }
    public function destroy(string $id)
    {
        $category = Category::join('members', 'categories.member_id',  'members.id')
            ->where('members.organization_id',  Auth::user()->member->organization_id)
            ->where('categories.id', $id)
            ->get(['categories.*'])->first();
        if ($category) {
            $category->delete();
            return redirect()->route('categories.index')->with('success', 'تم حذف البيانات بنجاح');
        }
        return back()->with('error', 'عملية الحذف فشلت. لا يمكن العثور على البانات ');
    }
}
