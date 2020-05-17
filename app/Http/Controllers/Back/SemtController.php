<?php

namespace App\Http\Controllers\Back;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Semt;
use Illuminate\Support\Str;
use App\Models\Article;
use App\Models\City;

class SemtController extends Controller
{
    public function index()
    {
        $semts=Semt::all();
        $cities=City::all();
        return view('back.semts.index', compact('semts', 'cities'));
    }


    public function getData(Request $request)
    {
        $semt = Semt::findOrFail($request->id);
        return response()->json($semt);
    }

    public function create(Request $request)
    {
        $isExist=Semt::whereSlug(Str::slug($request->semt))->first();
        if ($isExist) {
            toastr()->error($request->semt.'adında bir kategori bulunmaktadır');
            return redirect()->back();
        }
        $semt = new Semt;
        $semt->name=$request->semt;
        $semt->city_id=$request->city;
        $semt->slug=Str::slug($request->semt);
        $semt->save();
        toastr()->success(' başarıyla oluşturuldu');
        return redirect()->back();
    }
    public function update(Request $request)
    {
        $isSlug=Semt::whereSlug(Str::slug($request->slug))->whereNotIn('id', [$request->id])->first();
        $isName=Semt::whereName($request->semt)->whereNotIn('id', [$request->id])->first();
        if ($isSlug or $isName) {
            toastr()->error($request->semt.'adında bir kategori bulunmaktadır'.$request->id);
            return redirect()->back();
        }

        $semt = Semt::findOrFail($request->id);
        $semt->name=$request->semt;
        $semt->city_id=$request->city;
        if ($semt->slug == $request->slug) {
            $semt->slug=Str::slug($request->semt);
        } else {
            $semt->slug=Str::slug($request->slug);
        }

        $semt->save();
        toastr()->success(' başarıyla oluşturuldu');
        return redirect()->back();
    }

    public function remove(Request $request)
    {
        $semt=Semt::findOrFail($request->id);
        if ($semt->id ==1) {
            toastr()->error($semt->name.' adlı kategori silinemez');
            return redirect()->back();
        }
        $count = $semt->articleCount();
        if ($count>0) {
            Article::where('semt_id', $semt->id)->update(['semt_id'=>1]);
            $defaultSemt=Semt::findOrFail(1);
            toastr()->success('bu kategoriye ait '.$count.' makale '.$defaultSemt->name.' kategorisine aktarıldı');
        }
        $semt->delete();
        toastr()->success(' başarıyla silindi');
        return redirect()->back();
    }
}
