<?php

namespace App\Http\Controllers\Back;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\District;
use Illuminate\Support\Str;
use App\Models\Article;
use App\Models\City;

class DistrictController extends Controller
{
    public function index()
    {
        $districts=District::all();
        $cities=City::all();
        return view('back.districts.index', compact('districts', 'cities'));
    }


    public function getData(Request $request)
    {
        $district = District::findOrFail($request->id);
        return response()->json($district);
    }

    public function create(Request $request)
    {
        $isExist=District::whereSlug(Str::slug($request->district))->first();
        if ($isExist) {
            toastr()->error($request->district.'adında bir kategori bulunmaktadır');
            return redirect()->back();
        }
        $district = new District;
        $district->name=$request->district;
        $district->city_id=$request->city;
        $district->slug=Str::slug($request->district);
        $district->save();
        toastr()->success(' başarıyla oluşturuldu');
        return redirect()->back();
    }
    public function update(Request $request)
    {
        $isSlug=District::whereSlug(Str::slug($request->slug))->whereNotIn('id', [$request->id])->first();
        $isName=District::whereName($request->district)->whereNotIn('id', [$request->id])->first();
        if ($isSlug or $isName) {
            toastr()->error($request->district.'adında bir ilçe bulunmaktadır'.$request->id);
            return redirect()->back();
        }

        $district = District::findOrFail($request->id);
        $district->name=$request->district;
        $district->city_id=$request->city;
        if ($district->slug == $request->slug) {
            $district->slug=Str::slug($request->district);
        } else {
            $district->slug=Str::slug($request->slug);
        }

        $district->save();
        toastr()->success(' başarıyla oluşturuldu');
        return redirect()->back();
    }

    public function remove(Request $request)
    {
        $district=District::findOrFail($request->id);
        if ($district->id ==1) {
            toastr()->error($district->name.' adlı kategori silinemez');
            return redirect()->back();
        }
        $count = $district->articleCount();
        if ($count>0) {
            Article::where('district_id', $district->id)->update(['district_id'=>1]);
            $defaultDistrict=District::findOrFail(1);
            toastr()->success('bu kategoriye ait '.$count.' makale '.$defaultDistrict->name.' kategorisine aktarıldı');
        }
        $district->delete();
        toastr()->success(' başarıyla silindi');
        return redirect()->back();
    }
}
