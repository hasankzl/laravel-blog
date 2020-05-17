<?php

namespace App\Http\Controllers\Back;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Avenue;
use Illuminate\Support\Str;
use App\Models\Article;
use App\Models\Neighborhood;

class AvenueController extends Controller
{
    public function index()
    {
        $avenues=Avenue::all();
        $neighborhoods=Neighborhood::all();
        return view('back.avenues.index', compact('avenues', 'neighborhoods'));
    }


    public function getData(Request $request)
    {
        $neighborhood = Avenue::findOrFail($request->id);
        return response()->json($neighborhood);
    }

    public function create(Request $request)
    {
        $isExist=Avenue::whereSlug(Str::slug($request->avenue))->first();
        if ($isExist) {
            toastr()->error($request->avenue.'adında bir kategori bulunmaktadır');
            return redirect()->back();
        }
        $avenue = new Avenue;
        $avenue->name=$request->avenue;
        $avenue->neighborhood_id=$request->neighborhood;
        $avenue->slug=Str::slug($request->avenue);
        $avenue->save();
        toastr()->success(' başarıyla oluşturuldu');
        return redirect()->back();
    }
    public function update(Request $request)
    {
        $isSlug=Avenue::whereSlug(Str::slug($request->slug))->whereNotIn('id', [$request->id])->first();
        $isName=Avenue::whereName($request->avenue)->whereNotIn('id', [$request->id])->first();
        if ($isSlug or $isName) {
            toastr()->error($request->avenue.'adında bir kategori bulunmaktadır'.$request->id);
            return redirect()->back();
        }

        $avenue = Avenue::findOrFail($request->id);
        $avenue->name=$request->avenue;
        $avenue->neighborhood_id=$request->neighborhood;
        if ($avenue->slug == $request->slug) {
            $avenue->slug=Str::slug($request->avenue);
        } else {
            $avenue->slug=Str::slug($request->slug);
        }

        $avenue->save();
        toastr()->success(' başarıyla oluşturuldu');
        return redirect()->back();
    }

    public function remove(Request $request)
    {
        $neighborhood=Avenue::findOrFail($request->id);
        if ($neighborhood->id ==1) {
            toastr()->error($neighborhood->name.' adlı kategori silinemez');
            return redirect()->back();
        }
        $count = $neighborhood->articleCount();
        if ($count>0) {
            Article::where('neighborhood_id', $neighborhood->id)->update(['neighborhood_id'=>1]);
            $defaultAvenue=Avenue::findOrFail(1);
            toastr()->success('bu kategoriye ait '.$count.' makale '.$defaultAvenue->name.' kategorisine aktarıldı');
        }
        $neighborhood->delete();
        toastr()->success(' başarıyla silindi');
        return redirect()->back();
    }
}
