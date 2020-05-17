<?php

namespace App\Http\Controllers\Back;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Article;
use App\Models\Category;
use App\Models\Architect;
use App\Models\Padisah;
use App\Models\Seyhulislam;
use App\Models\Century;
use App\Models\Maker;
use App\Models\City;
use App\Models\Image;
use App\Models\Country;
use App\Models\Semt;
use App\Models\Street;
use App\Models\Neighborhood;
use App\Models\Avenue;
use App\Models\District;
use App\Models\Village;
use App\Models\Status;

use Illuminate\Support\Str;
use Illuminate\Support\Facades\File;

class ArticleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $articles=Article::orderBy('created_at', 'ASC')->get();

        return view('back.articles.index', compact('articles'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories=Category::All();
        $makers=Maker::All();
        $cities=City::All();
        $padisahs=Padisah::All();
        $seyhulislams=Seyhulislam::All();
        $centuries=Century::All();
        $countries=Country::All();
        $architects=Architect::All();
        $avenues=Avenue::All();
        $streets=Street::All();
        $semts=Semt::All();
        $neighborhoods=Neighborhood::All();
        $districts=District::All();
        $villages=Village::All();
        $statuses=Status::All();
        return view(
            'back.articles.create',
            compact('categories', 'makers', 'cities', 'padisahs', 'seyhulislams', 'centuries', 'architects', 'countries', 'avenues', 'streets', 'semts', 'neighborhoods', 'districts', 'villages', 'statuses')
        );
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
          'title'=>'min:3',
          'image'=>'required|image|mimes:jpeg,png,jpg|max:2048'
        ]);
        $checkArticle= Article::where('title', $request->title)->get();

        if (count($checkArticle)>=1) {
            toastr()->warning('Bu isimde makale bulundu', 'hata');
            return redirect()->back();
        }
        $article = new Article();
        $article->title=$request->title;
        $article->category_id=$request->category;
        $article->padisah_id=$request->padisah;
        $article->seyhulislam_id=$request->seyhulislam;
        $article->architect_id=$request->architect;
        $article->century_id=$request->century;
        $article->year=$request->year;
        $article->content=$request->content;
        $article->maker_id=$request->maker;
        $article->country_id=$request->country;
        $article->city_id=$request->city;
        $article->semt_id=$request->semt;
        $article->neighborhood_id=$request->neighborhood;
        $article->avenue_id=$request->avenue;
        $article->street_id=$request->street;
        $article->district_id=$request->district;
        $article->village_id=$request->village;
        $article->status_id=$request->status;
        $article->fullAddress=$request->fullAddress;
        $article->slug=Str::slug($request->title);



        if ($request->hasFile('image')) {
            $imageName=Str::slug($request->title).'.'.$request->image->getClientOriginalExtension();
            $request->image->move(public_path('uploads'), $imageName);
            $article->image='uploads/'.$imageName;
        }

        $article->save();

        if ($request->hasFile('file')) {
            $lastArticle = Article::where('slug', $article->slug)->get();

            foreach ($request->file as $key=> $file) {
                $image = new Image();
                $imageName=Str::slug($request->title).$key.'.'.$file->getClientOriginalExtension();
                $image->article_id=$lastArticle[0]->id;
                $image->size=$file->getSize();
                $file->move(public_path('uploads'), $imageName);
                $image->name = 'uploads/'.$imageName;
                $image->save();
            }
        }
        toastr()->success('Makale Başarıyla Oluşturuldu', 'Başarılı');
        return redirect()->route('admin.makaleler.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }
    public function switch(Request $request)
    {
        $article=Article::findOrFail($request->id);
        $article->status=$request->statu=="true" ? 1:0;

        $article->save();
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $article=Article::findOrFail($id);
        $categories=Category::All();
        $makers=Maker::All();
        $padisahs=Padisah::All();
        $seyhulislams=Seyhulislam::All();
        $centuries=Century::All();
        $countries=Country::All();
        $architects=Architect::All();
        $cities=City::All();
        $avenues=Avenue::All();
        $streets=Street::All();
        $semts=Semt::All();
        $neighborhoods=Neighborhood::All();
        $districts=District::All();
        $villages=Village::All();
        $statuses=Status::All();
        return view(
            'back.articles.update',
            compact('categories', 'makers', 'cities', 'article', 'padisahs', 'seyhulislams', 'centuries', 'architects', 'countries', 'avenues', 'streets', 'semts', 'neighborhoods', 'districts', 'villages', 'statuses')
        );
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
        'title'=>'min:3',
        'image'=>'image|mimes:jpeg,png,jpg|max:2048'
      ]);

        $article = Article::findOrFail($id);
        if ($article->title != $request->title) {
            $checkArticle= Article::where('title', $request->title)->get();
            if (count($checkArticle)>=1) {
                toastr()->warning('Bu isimde makale bulundu', 'hata');
                return redirect()->back();
            }
        }
        $article->title=$request->title;
        $article->category_id=$request->category;
        $article->padisah_id=$request->padisah;
        $article->seyhulislam_id=$request->seyhulislam;
        $article->architect_id=$request->architect;
        $article->century_id=$request->century;
        $article->year=$request->year;
        $article->content=$request->content;
        $article->maker_id=$request->maker;
        $article->country_id=$request->country;
        $article->city_id=$request->city;
        $article->semt_id=$request->semt;
        $article->neighborhood_id=$request->neighborhood;
        $article->avenue_id=$request->avenue;
        $article->street_id=$request->street;
        $article->district_id=$request->district;
        $article->village_id=$request->village;
        $article->status_id=$request->status;
        $article->fullAddress=$request->fullAddress;
        $article->slug=Str::slug($request->title);


        if ($request->hasFile('image')) {
            $imageName=Str::slug($request->title).'.'.$request->image->getClientOriginalExtension();
            $request->image->move(public_path('uploads'), $imageName);
            $article->image='uploads/'.$imageName;
        }

        $article->save();

        if ($request->hasFile('file')) {
            $lastArticle = Article::where('slug', $article->slug)->first();
            foreach ($lastArticle->getImages as $img) {
                file::delete(public_path()."\\".$img->name);
                Image::findorFail($img->id)->delete();
            }
            foreach ($request->file as $key=> $file) {
                $image = new Image();
                $imageName=Str::slug($request->title).$key.'.'.$file->getClientOriginalExtension();
                $image->article_id=$lastArticle->id;
                $image->size=$file->getSize();
                $file->move(public_path('uploads'), $imageName);
                $image->name = 'uploads/'.$imageName;
                $image->save();
            }
        }
        toastr()->success('Makale Başarıyla Güncellendi', 'Başarılı');
        return redirect()->route('admin.makaleler.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function delete($id)
    {
        Article::findOrFail($id)->delete();

        toastr()->success('Makale, geri dönüşüme taşındı');
        return redirect()->route('admin.makaleler.index');
    }

    public function trashed()
    {
        $articles = Article::onlyTrashed()->orderBy('deleted_at', 'desc')->get();
        return view('back.articles.trashed', compact('articles'));
    }

    public function recover($id)
    {
        $articles = Article::onlyTrashed()->find($id)->restore();

        toastr()->success('Makale başarıyla kurtarıldı');
        return redirect()->back();
    }

    public function hardDelete($id)
    {
        $article =  Article::onlyTrashed()->findOrFail($id);
        if (File::exists($article->image)) {
            File::delete(public_path($article->image));
        }
        foreach ($article->getImages as $img) {
            file::delete(public_path()."\\".$img->name);
            Image::findorFail($img->id)->delete();
        }
        $article->forceDelete();

        toastr()->success('Makale başarıyla silindi');
        return redirect()->route('admin.makaleler.index');
    }
}
