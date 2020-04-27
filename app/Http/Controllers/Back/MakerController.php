<?php

namespace App\Http\Controllers\Back;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Maker;
use Illuminate\Support\Str;
use App\Models\Article;

class MakerController extends Controller
{
    public function index()
    {
        $makers=Maker::all();
        return view('back.makers.index', compact('makers'));
    }


    public function getData(Request $request)
    {
        $maker = Maker::findOrFail($request->id);
        return response()->json($maker);
    }

    public function create(Request $request)
    {
        $isExist=Maker::whereSlug(Str::slug($request->maker))->first();
        if ($isExist) {
            toastr()->error($request->maker.'adında bir kategori bulunmaktadır');
            return redirect()->back();
        }
        $maker = new Maker;
        $maker->name=$request->maker;
        $maker->slug=Str::slug($request->maker);
        $maker->save();
        toastr()->success(' başarıyla oluşturuldu');
        return redirect()->back();
    }
    public function update(Request $request)
    {
        $isSlug=Maker::whereSlug(Str::slug($request->slug))->whereNotIn('id', [$request->id])->first();
        $isName=Maker::whereName($request->maker)->whereNotIn('id', [$request->id])->first();
        if ($isSlug or $isName) {
            toastr()->error($request->maker.'adında bir kategori bulunmaktadır'.$request->id);
            return redirect()->back();
        }

        $maker = Maker::findOrFail($request->id);
        $maker->name=$request->maker;
        if ($maker->slug == $request->slug) {
            $maker->slug=Str::slug($request->maker);
        } else {
            $maker->slug=Str::slug($request->slug);
        }

        $maker->save();
        toastr()->success(' başarıyla oluşturuldu');
        return redirect()->back();
    }

    public function remove(Request $request)
    {
        $maker=Maker::findOrFail($request->id);
        if ($maker->id ==1) {
            toastr()->error($maker->name.' adlı kategori silinemez');
            return redirect()->back();
        }
        $count = $maker->articleCount();
        if ($count>0) {
            Article::where('maker_id', $maker->id)->update(['maker_id'=>1]);
            $defaultMaker=Maker::findOrFail(1);
            toastr()->success('bu kategoriye ait '.$count.' makale '.$defaultMaker->name.' kategorisine aktarıldı');
        }
        $maker->delete();
        toastr()->success(' başarıyla silindi');
        return redirect()->back();
    }
}
