<?php

namespace App\Http\Controllers\Back;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Padisah;
use Illuminate\Support\Str;
use App\Models\Article;

class PadisahController extends Controller
{
    public function index()
    {
        $padisahs=Padisah::all();
        return view('back.padisahs.index', compact('padisahs'));
    }


    public function getData(Request $request)
    {
        $padisah = Padisah::findOrFail($request->id);
        return response()->json($padisah);
    }

    public function create(Request $request)
    {
        $isExist=Padisah::whereSlug(Str::slug($request->padisah))->first();
        if ($isExist) {
            toastr()->error($request->padisah.'adında bir kategori bulunmaktadır');
            return redirect()->back();
        }
        $padisah = new Padisah;
        $padisah->name=$request->padisah;
        $padisah->slug=Str::slug($request->padisah);
        $padisah->save();
        toastr()->success(' başarıyla oluşturuldu');
        return redirect()->back();
    }
    public function update(Request $request)
    {
        $isSlug=Padisah::whereSlug(Str::slug($request->slug))->whereNotIn('id', [$request->id])->first();
        $isName=Padisah::whereName($request->padisah)->whereNotIn('id', [$request->id])->first();
        if ($isSlug or $isName) {
            toastr()->error($request->padisah.'adında bir kategori bulunmaktadır'.$request->id);
            return redirect()->back();
        }

        $padisah = Padisah::findOrFail($request->id);
        $padisah->name=$request->padisah;
        if ($padisah->slug == $request->slug) {
            $padisah->slug=Str::slug($request->padisah);
        } else {
            $padisah->slug=Str::slug($request->slug);
        }

        $padisah->save();
        toastr()->success(' başarıyla oluşturuldu');
        return redirect()->back();
    }

    public function remove(Request $request)
    {
        $padisah=Padisah::findOrFail($request->id);
        if ($padisah->id ==1) {
            toastr()->error($padisah->name.' adlı kategori silinemez');
            return redirect()->back();
        }
        $count = $padisah->articleCount();
        if ($count>0) {
            Article::where('padisah_id', $padisah->id)->update(['padisah_id'=>1]);
            $defaultPadisah=Padisah::findOrFail(1);
            toastr()->success('bu kategoriye ait '.$count.' makale '.$defaultPadisah->name.' kategorisine aktarıldı');
        }
        $padisah->delete();
        toastr()->success(' başarıyla silindi');
        return redirect()->back();
    }
}
