<?php

namespace App\Http\Controllers\Back;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Page;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\File;

class PageController extends Controller
{
    public function orders(Request $request)
    {
        foreach ($request->get('page') as $key=> $order) {
            Page::where('id', $order)->update(['order'=>$key]);
        }
    }
    public function index()
    {
        $pages=Page::all();
        return view('back.pages.index', compact('pages'));
    }
    public function create()
    {
        return view('back.pages.create');
    }
    public function store(Request $request)
    {
        $last=Page::orderBy('order', 'desc')->first();
        $request->validate([
          'title'=>'min:3',
          'image'=>'required|image|mimes:jpeg,png,jpg|max:2048'
        ]);
        $page = new Page();
        $page->title=$request->title;
        $page->order=$last->order+1;
        $page->content=$request->content;
        $page->slug=Str::slug($request->title);


        if ($request->hasFile('image')) {
            $imageName=Str::slug($request->title).'.'.$request->image->getClientOriginalExtension();
            $request->image->move(public_path('uploads'), $imageName);
            $page->image='uploads/'.$imageName;
        }

        $page->save();
        toastr()->success('Sayfa Başarıyla Oluşturuldu', 'Başarılı');
        return redirect()->route('admin.page.index');
    }
    public function edit(Request $request)
    {
        $page=Page::findOrFail($request->id);

        return view('back.pages.update', compact('page'));
    }
    public function update(Request $request)
    {
        $last=Page::orderBy('order', 'desc')->first();
        $request->validate([
          'title'=>'min:3',
          'image'=>'image|mimes:jpeg,png,jpg|max:2048'
        ]);
        $page =Page::findOrFail($request->id);
        $page->title=$request->title;
        $page->order=$last->order+1;
        $page->content=$request->content;
        $page->slug=Str::slug($request->title);


        if ($request->hasFile('image')) {
            $imageName=Str::slug($request->title).'.'.$request->image->getClientOriginalExtension();
            $request->image->move(public_path('uploads'), $imageName);
            $page->image='uploads/'.$imageName;
        }

        $page->save();
        toastr()->success('Sayfa Başarıyla güncellendi', 'Başarılı');
        return redirect()->route('admin.page.index');
    }
    public function switch(Request $request)
    {
        $page=Page::findOrFail($request->id);
        $page->status=$request->statu=="true" ? 1:0;
        $page->save();
    }
    public function delete($id)
    {
        $page = Page::findOrFail($id);
        if (File::exists($page->image)) {
            File::delete(public_path($page->image));
        }
        $page->forceDelete();

        toastr()->success('Sayfa başarıyla silindi');
        return redirect()->route('admin.page.index');
    }
}
