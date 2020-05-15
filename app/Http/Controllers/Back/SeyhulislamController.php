<?php

namespace App\Http\Controllers\Back;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Seyhulislam;
use Illuminate\Support\Str;
use App\Models\Article;

class SeyhulislamController extends Controller
{
    public function index()
    {
        $seyhulislams=Seyhulislam::all();
        return view('back.seyhulislams.index', compact('seyhulislams'));
    }


    public function getData(Request $request)
    {
        $seyhulislam = Seyhulislam::findOrFail($request->id);
        return response()->json($seyhulislam);
    }

    public function create(Request $request)
    {
        $isExist=Seyhulislam::whereSlug(Str::slug($request->seyhulislam))->first();
        if ($isExist) {
            toastr()->error($request->seyhulislam.'adında bir kategori bulunmaktadır');
            return redirect()->back();
        }
        $seyhulislam = new Seyhulislam;
        $seyhulislam->name=$request->seyhulislam;
        $seyhulislam->slug=Str::slug($request->seyhulislam);
        $seyhulislam->save();
        toastr()->success(' başarıyla oluşturuldu');
        return redirect()->back();
    }
    public function update(Request $request)
    {
        $isSlug=Seyhulislam::whereSlug(Str::slug($request->slug))->whereNotIn('id', [$request->id])->first();
        $isName=Seyhulislam::whereName($request->seyhulislam)->whereNotIn('id', [$request->id])->first();
        if ($isSlug or $isName) {
            toastr()->error($request->seyhulislam.'adında bir kategori bulunmaktadır'.$request->id);
            return redirect()->back();
        }

        $seyhulislam = Seyhulislam::findOrFail($request->id);
        $seyhulislam->name=$request->seyhulislam;
        if ($seyhulislam->slug == $request->slug) {
            $seyhulislam->slug=Str::slug($request->seyhulislam);
        } else {
            $seyhulislam->slug=Str::slug($request->slug);
        }

        $seyhulislam->save();
        toastr()->success(' başarıyla oluşturuldu');
        return redirect()->back();
    }

    public function remove(Request $request)
    {
        $seyhulislam=Seyhulislam::findOrFail($request->id);
        if ($seyhulislam->id ==1) {
            toastr()->error($seyhulislam->name.' adlı kategori silinemez');
            return redirect()->back();
        }
        $count = $seyhulislam->articleCount();
        if ($count>0) {
            Article::where('seyhulislam_id', $seyhulislam->id)->update(['seyhulislam_id'=>1]);
            $defaultSeyhulislam=Seyhulislam::findOrFail(1);
            toastr()->success('bu kategoriye ait '.$count.' makale '.$defaultSeyhulislam->name.' kategorisine aktarıldı');
        }
        $seyhulislam->delete();
        toastr()->success(' başarıyla silindi');
        return redirect()->back();
    }
}
