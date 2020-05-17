<?php

namespace App\Http\Controllers\Back;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Street;
use Illuminate\Support\Str;
use App\Models\Article;
use App\Models\Avenue;

class StreetController extends Controller
{
    public function index()
    {
        $streets=Street::all();
        $avenues=Avenue::all();
        return view('back.streets.index', compact('streets', 'avenues'));
    }


    public function getData(Request $request)
    {
        $avenue = Street::findOrFail($request->id);
        return response()->json($avenue);
    }

    public function create(Request $request)
    {
        $isExist=Street::whereSlug(Str::slug($request->street))->first();
        if ($isExist) {
            toastr()->error($request->street.'adında bir kategori bulunmaktadır');
            return redirect()->back();
        }
        $street = new Street;
        $street->name=$request->street;
        $street->avenue_id=$request->avenue;
        $street->slug=Str::slug($request->street);
        $street->save();
        toastr()->success(' başarıyla oluşturuldu');
        return redirect()->back();
    }
    public function update(Request $request)
    {
        $isSlug=Street::whereSlug(Str::slug($request->slug))->whereNotIn('id', [$request->id])->first();
        $isName=Street::whereName($request->street)->whereNotIn('id', [$request->id])->first();
        if ($isSlug or $isName) {
            toastr()->error($request->street.'adında bir kategori bulunmaktadır'.$request->id);
            return redirect()->back();
        }

        $street = Street::findOrFail($request->id);
        $street->name=$request->street;
        $street->avenue_id=$request->avenue;
        if ($street->slug == $request->slug) {
            $street->slug=Str::slug($request->street);
        } else {
            $street->slug=Str::slug($request->slug);
        }

        $street->save();
        toastr()->success(' başarıyla oluşturuldu');
        return redirect()->back();
    }

    public function remove(Request $request)
    {
        $avenue=Street::findOrFail($request->id);
        if ($avenue->id ==1) {
            toastr()->error($avenue->name.' adlı kategori silinemez');
            return redirect()->back();
        }
        $count = $avenue->articleCount();
        if ($count>0) {
            Article::where('avenue_id', $avenue->id)->update(['avenue_id'=>1]);
            $defaultStreet=Street::findOrFail(1);
            toastr()->success('bu kategoriye ait '.$count.' makale '.$defaultStreet->name.' kategorisine aktarıldı');
        }
        $avenue->delete();
        toastr()->success(' başarıyla silindi');
        return redirect()->back();
    }
}
