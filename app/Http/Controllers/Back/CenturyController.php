<?php

namespace App\Http\Controllers\Back;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Century;
use Illuminate\Support\Str;
use App\Models\Article;

class CenturyController extends Controller
{
    public function index()
    {
        $centuries=Century::all();
        return view('back.centuries.index', compact('centuries'));
    }


    public function getData(Request $request)
    {
        $century = Century::findOrFail($request->id);
        return response()->json($century);
    }

    public function create(Request $request)
    {
        $isExist=Century::whereSlug(Str::slug($request->century))->first();
        if ($isExist) {
            toastr()->error($request->century.'adında bir yuzyil bulunmaktadır');
            return redirect()->back();
        }
        $century = new Century;
        $century->name=$request->century;
        $century->slug=Str::slug($request->century);
        $century->save();
        toastr()->success(' başarıyla oluşturuldu');
        return redirect()->back();
    }
    public function update(Request $request)
    {
        $isSlug=Century::whereSlug(Str::slug($request->slug))->whereNotIn('id', [$request->id])->first();
        $isName=Century::whereName($request->century)->whereNotIn('id', [$request->id])->first();
        if ($isSlug or $isName) {
            toastr()->error($request->century.'adında bir yüzyıl bulunmaktadır'.$request->id);
            return redirect()->back();
        }

        $century = Century::findOrFail($request->id);
        $century->name=$request->century;
        if ($century->slug == $request->slug) {
            $century->slug=Str::slug($request->century);
        } else {
            $century->slug=Str::slug($request->slug);
        }

        $century->save();
        toastr()->success(' başarıyla oluşturuldu');
        return redirect()->back();
    }

    public function remove(Request $request)
    {
        $century=Century::findOrFail($request->id);
        if ($century->id ==1) {
            toastr()->error($century->name.' adlı yüzyıl silinemez');
            return redirect()->back();
        }
        $count = $century->articleCount();
        if ($count>0) {
            Article::where('century_id', $century->id)->update(['century_id'=>1]);
            $defaultCentury=Century::findOrFail(1);
            toastr()->success('bu yüzyılye ait '.$count.' makale '.$defaultCentury->name.' yüzyılına aktarıldı');
        }
        $century->delete();
        toastr()->success(' başarıyla silindi');
        return redirect()->back();
    }
}
