<?php

namespace App\Http\Controllers\Back;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Village;
use Illuminate\Support\Str;
use App\Models\Article;
use App\Models\District;

class VillageController extends Controller
{
    public function index()
    {
        $villages=Village::all();
        $districts=District::all();
        return view('back.villages.index', compact('villages', 'districts'));
    }


    public function getData(Request $request)
    {
        $village = Village::findOrFail($request->id);
        return response()->json($village);
    }

    public function create(Request $request)
    {
        $isExist=Village::whereSlug(Str::slug($request->village))->first();
        if ($isExist) {
            toastr()->error($request->village.'adında bir kategori bulunmaktadır');
            return redirect()->back();
        }
        $village = new Village;
        $village->name=$request->village;
        $village->district_id=$request->district;
        $village->slug=Str::slug($request->village);
        $village->save();
        toastr()->success(' başarıyla oluşturuldu');
        return redirect()->back();
    }
    public function update(Request $request)
    {
        $isSlug=Village::whereSlug(Str::slug($request->slug))->whereNotIn('id', [$request->id])->first();
        $isName=Village::whereName($request->village)->whereNotIn('id', [$request->id])->first();
        if ($isSlug or $isName) {
            toastr()->error($request->village.'adında bir kategori bulunmaktadır'.$request->id);
            return redirect()->back();
        }

        $village = Village::findOrFail($request->id);
        $village->name=$request->village;
        $village->district_id=$request->district;
        if ($village->slug == $request->slug) {
            $village->slug=Str::slug($request->village);
        } else {
            $village->slug=Str::slug($request->slug);
        }

        $village->save();
        toastr()->success(' başarıyla oluşturuldu');
        return redirect()->back();
    }

    public function remove(Request $request)
    {
        $village=Village::findOrFail($request->id);
        if ($village->id ==1) {
            toastr()->error($village->name.' adlı kategori silinemez');
            return redirect()->back();
        }
        $count = $village->articleCount();
        if ($count>0) {
            Article::where('village_id', $village->id)->update(['village_id'=>1]);
            $defaultVillage=Village::findOrFail(1);
            toastr()->success('bu kategoriye ait '.$count.' makale '.$defaultVillage->name.' kategorisine aktarıldı');
        }
        $village->delete();
        toastr()->success(' başarıyla silindi');
        return redirect()->back();
    }
}
