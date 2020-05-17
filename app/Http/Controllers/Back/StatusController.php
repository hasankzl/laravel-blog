<?php

namespace App\Http\Controllers\Back;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Status;
use Illuminate\Support\Str;
use App\Models\Article;

class StatusController extends Controller
{
    public function index()
    {
        $statuses=Status::all();
        return view('back.status.index', compact('statuses'));
    }


    public function getData(Request $request)
    {
        $status = Status::findOrFail($request->id);
        return response()->json($status);
    }

    public function create(Request $request)
    {
        $isExist=Status::whereSlug(Str::slug($request->status))->first();
        if ($isExist) {
            toastr()->error($request->status.'adında bir kategori bulunmaktadır');
            return redirect()->back();
        }
        $status = new Status;
        $status->name=$request->status;
        $status->slug=Str::slug($request->status);
        $status->save();
        toastr()->success(' başarıyla oluşturuldu');
        return redirect()->back();
    }
    public function update(Request $request)
    {
        $isSlug=Status::whereSlug(Str::slug($request->slug))->whereNotIn('id', [$request->id])->first();
        $isName=Status::whereName($request->status)->whereNotIn('id', [$request->id])->first();
        if ($isSlug or $isName) {
            toastr()->error($request->status.'adında bir kategori bulunmaktadır'.$request->id);
            return redirect()->back();
        }

        $status = Status::findOrFail($request->id);
        $status->name=$request->status;
        if ($status->slug == $request->slug) {
            $status->slug=Str::slug($request->status);
        } else {
            $status->slug=Str::slug($request->slug);
        }

        $status->save();
        toastr()->success(' başarıyla oluşturuldu');
        return redirect()->back();
    }

    public function remove(Request $request)
    {
        $status=Status::findOrFail($request->id);
        if ($status->id ==1) {
            toastr()->error($status->name.' adlı kategori silinemez');
            return redirect()->back();
        }
        $count = $status->articleCount();
        if ($count>0) {
            Article::where('status_id', $status->id)->update(['status_id'=>1]);
            $defaultStatus=Status::findOrFail(1);
            toastr()->success('bu kategoriye ait '.$count.' makale '.$defaultStatus->name.' kategorisine aktarıldı');
        }
        $status->delete();
        toastr()->success(' başarıyla silindi');
        return redirect()->back();
    }
}
