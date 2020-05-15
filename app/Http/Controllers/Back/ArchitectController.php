<?php

namespace App\Http\Controllers\Back;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Architect;
use Illuminate\Support\Str;
use App\Models\Article;

class ArchitectController extends Controller
{
    public function index()
    {
        $architects=Architect::all();
        return view('back.architects.index', compact('architects'));
    }


    public function getData(Request $request)
    {
        $architect = Architect::findOrFail($request->id);
        return response()->json($architect);
    }

    public function create(Request $request)
    {
        $isExist=Architect::whereSlug(Str::slug($request->architect))->first();
        if ($isExist) {
            toastr()->error($request->architect.'adında bir kategori bulunmaktadır');
            return redirect()->back();
        }
        $architect = new Architect;
        $architect->name=$request->architect;
        $architect->slug=Str::slug($request->architect);
        $architect->save();
        toastr()->success(' başarıyla oluşturuldu');
        return redirect()->back();
    }
    public function update(Request $request)
    {
        $isSlug=Architect::whereSlug(Str::slug($request->slug))->whereNotIn('id', [$request->id])->first();
        $isName=Architect::whereName($request->architect)->whereNotIn('id', [$request->id])->first();
        if ($isSlug or $isName) {
            toastr()->error($request->architect.'adında bir kategori bulunmaktadır'.$request->id);
            return redirect()->back();
        }

        $architect = Architect::findOrFail($request->id);
        $architect->name=$request->architect;
        if ($architect->slug == $request->slug) {
            $architect->slug=Str::slug($request->architect);
        } else {
            $architect->slug=Str::slug($request->slug);
        }

        $architect->save();
        toastr()->success(' başarıyla oluşturuldu');
        return redirect()->back();
    }

    public function remove(Request $request)
    {
        $architect=Architect::findOrFail($request->id);
        if ($architect->id ==1) {
            toastr()->error($architect->name.' adlı kategori silinemez');
            return redirect()->back();
        }
        $count = $architect->articleCount();
        if ($count>0) {
            Article::where('architect_id', $architect->id)->update(['architect_id'=>1]);
            $defaultArchitect=Architect::findOrFail(1);
            toastr()->success('bu kategoriye ait '.$count.' makale '.$defaultArchitect->name.' kategorisine aktarıldı');
        }
        $architect->delete();
        toastr()->success(' başarıyla silindi');
        return redirect()->back();
    }
}
