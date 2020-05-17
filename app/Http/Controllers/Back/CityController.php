<?php

namespace App\Http\Controllers\Back;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\City;
use Illuminate\Support\Str;
use App\Models\Article;
use App\Models\Country;

class CityController extends Controller
{
    public function index()
    {
        $cities=City::all();
        $countries=Country::all();
        return view('back.cities.index', compact('cities', 'countries'));
    }


    public function getData(Request $request)
    {
        $city = City::findOrFail($request->id);
        return response()->json($city);
    }

    public function create(Request $request)
    {
        $isExist=City::whereSlug(Str::slug($request->city))->first();
        if ($isExist) {
            toastr()->error($request->city.'adında bir kategori bulunmaktadır');
            return redirect()->back();
        }
        $city = new City;
        $city->name=$request->city;
        $city->country_id=$request->country;
        $city->slug=Str::slug($request->city);
        $city->save();
        toastr()->success(' başarıyla oluşturuldu');
        return redirect()->back();
    }
    public function update(Request $request)
    {
        $isSlug=City::whereSlug(Str::slug($request->slug))->whereNotIn('id', [$request->id])->first();
        $isName=City::whereName($request->city)->whereNotIn('id', [$request->id])->first();
        if ($isSlug or $isName) {
            toastr()->error($request->city.'adında bir kategori bulunmaktadır'.$request->id);
            return redirect()->back();
        }

        $city = City::findOrFail($request->id);
        $city->name=$request->city;
        $city->country_id=$request->country;
        if ($city->slug == $request->slug) {
            $city->slug=Str::slug($request->city);
        } else {
            $city->slug=Str::slug($request->slug);
        }

        $city->save();
        toastr()->success(' başarıyla oluşturuldu');
        return redirect()->back();
    }

    public function remove(Request $request)
    {
        $city=City::findOrFail($request->id);
        if ($city->id ==1) {
            toastr()->error($city->name.' adlı kategori silinemez');
            return redirect()->back();
        }
        $count = $city->articleCount();
        if ($count>0) {
            Article::where('city_id', $city->id)->update(['city_id'=>1]);
            $defaultCity=City::findOrFail(1);
            toastr()->success('bu kategoriye ait '.$count.' makale '.$defaultCity->name.' kategorisine aktarıldı');
        }
        $city->delete();
        toastr()->success(' başarıyla silindi');
        return redirect()->back();
    }
}
