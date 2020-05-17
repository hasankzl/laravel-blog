<?php

namespace App\Http\Controllers\Back;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Neighborhood;
use Illuminate\Support\Str;
use App\Models\Article;
use App\Models\District;

class NeighborhoodController extends Controller
{
    public function index()
    {
        $neighborhoods=Neighborhood::all();
        $districts=District::all();
        return view('back.neighborhoods.index', compact('neighborhoods', 'districts'));
    }


    public function getData(Request $request)
    {
        $neighborhood = Neighborhood::findOrFail($request->id);
        return response()->json($neighborhood);
    }

    public function create(Request $request)
    {
        $isExist=Neighborhood::whereSlug(Str::slug($request->neighborhood))->first();
        if ($isExist) {
            toastr()->error($request->neighborhood.'adında bir kategori bulunmaktadır');
            return redirect()->back();
        }
        $neighborhood = new Neighborhood;
        $neighborhood->name=$request->neighborhood;
        $neighborhood->district_id=$request->district;
        $neighborhood->slug=Str::slug($request->neighborhood);
        $neighborhood->save();
        toastr()->success(' başarıyla oluşturuldu');
        return redirect()->back();
    }
    public function update(Request $request)
    {
        $isSlug=Neighborhood::whereSlug(Str::slug($request->slug))->whereNotIn('id', [$request->id])->first();
        $isName=Neighborhood::whereName($request->neighborhood)->whereNotIn('id', [$request->id])->first();
        if ($isSlug or $isName) {
            toastr()->error($request->neighborhood.'adında bir kategori bulunmaktadır'.$request->id);
            return redirect()->back();
        }

        $neighborhood = Neighborhood::findOrFail($request->id);
        $neighborhood->name=$request->neighborhood;
        $neighborhood->district_id=$request->district;
        if ($neighborhood->slug == $request->slug) {
            $neighborhood->slug=Str::slug($request->neighborhood);
        } else {
            $neighborhood->slug=Str::slug($request->slug);
        }

        $neighborhood->save();
        toastr()->success(' başarıyla oluşturuldu');
        return redirect()->back();
    }

    public function remove(Request $request)
    {
        $neighborhood=Neighborhood::findOrFail($request->id);
        if ($neighborhood->id ==1) {
            toastr()->error($neighborhood->name.' adlı kategori silinemez');
            return redirect()->back();
        }
        $count = $neighborhood->articleCount();
        if ($count>0) {
            Article::where('neighborhood_id', $neighborhood->id)->update(['neighborhood_id'=>1]);
            $defaultNeighborhood=Neighborhood::findOrFail(1);
            toastr()->success('bu kategoriye ait '.$count.' makale '.$defaultNeighborhood->name.' kategorisine aktarıldı');
        }
        $neighborhood->delete();
        toastr()->success(' başarıyla silindi');
        return redirect()->back();
    }
}
