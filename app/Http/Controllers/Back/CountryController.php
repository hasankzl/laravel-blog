<?php

namespace App\Http\Controllers\Back;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Country;
use Illuminate\Support\Str;
use App\Models\Article;

class CountryController extends Controller
{
    public function index()
    {
        $countries=Country::all();
        return view('back.countries.index', compact('countries'));
    }


    public function getData(Request $request)
    {
        $country = Country::findOrFail($request->id);
        return response()->json($country);
    }

    public function create(Request $request)
    {
        $isExist=Country::whereSlug(Str::slug($request->country))->first();
        if ($isExist) {
            toastr()->error($request->country.'adında bir kategori bulunmaktadır');
            return redirect()->back();
        }
        $country = new Country;
        $country->name=$request->country;
        $country->slug=Str::slug($request->country);
        $country->save();
        toastr()->success(' başarıyla oluşturuldu');
        return redirect()->back();
    }
    public function update(Request $request)
    {
        $isSlug=Country::whereSlug(Str::slug($request->slug))->whereNotIn('id', [$request->id])->first();
        $isName=Country::whereName($request->country)->whereNotIn('id', [$request->id])->first();
        if ($isSlug or $isName) {
            toastr()->error($request->country.'adında bir kategori bulunmaktadır'.$request->id);
            return redirect()->back();
        }

        $country = Country::findOrFail($request->id);
        $country->name=$request->country;
        if ($country->slug == $request->slug) {
            $country->slug=Str::slug($request->country);
        } else {
            $country->slug=Str::slug($request->slug);
        }

        $country->save();
        toastr()->success(' başarıyla oluşturuldu');
        return redirect()->back();
    }

    public function remove(Request $request)
    {
        $country=Country::findOrFail($request->id);
        if ($country->id ==1) {
            toastr()->error($country->name.' adlı kategori silinemez');
            return redirect()->back();
        }
        $count = $country->articleCount();
        if ($count>0) {
            Article::where('country_id', $country->id)->update(['country_id'=>1]);
            $defaultCountry=Country::findOrFail(1);
            toastr()->success('bu kategoriye ait '.$count.' makale '.$defaultCountry->name.' kategorisine aktarıldı');
        }
        $country->delete();
        toastr()->success(' başarıyla silindi');
        return redirect()->back();
    }
}
