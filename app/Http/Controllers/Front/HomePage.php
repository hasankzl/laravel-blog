<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Mail;
use Validator;
use Illuminate\Support\Arr;
// Models
use App\Models\Category;
use App\Models\Article;
use App\Models\Page;
use App\Models\Contact;
use App\Models\Config;
use App\Models\Maker;
use App\Models\City;
use App\Models\Padisah;
use App\Models\Seyhulislam;
use App\Models\Architect;
use App\Models\Century;
use PDF;

class HomePage extends Controller
{
    public function __construct()
    {
        if (Config::find(1)->active==0) {
            return redirect()->to('aktif-degil')->send();
        }
        view()->share('pages', Page::orderBy('order', 'ASC')->whereStatus(1)->get());
        view()->share('categories', Category::orderBy('name', 'ASC')->where('status', 1)->get());
        view()->share('makers', Maker::orderBy('name', 'ASC')->where('status', 1)->get());
        view()->share('cities', City::orderBy('name', 'ASC')->get());
        view()->share('padisahs', Padisah::orderBy('name', 'ASC')->get());
        view()->share('seyhulislams', Seyhulislam::orderBy('name', 'ASC')->get());
        view()->share('architects', Architect::orderBy('name', 'ASC')->get());
        view()->share('centuries', Century::orderBy('name', 'ASC')->get());
        view()->share('config', Config::find(1));
    }
    public function index()
    {
        $data['articles']=Article::with('getCategory')->where('status', 1)->whereHas(
            'getCategory',
            function ($query) {
                $query->where('status', 1);
            }
        )
      ->orderBy('created_at', 'DESC')->paginate(10);
        $data['articles']->withPath(url('/sayfa'));
        return view('front.homepage', $data);
    }

    public function single($category, $slug)
    {
        $cat = Category::whereSlug($category)->first() ?? abort(403, "Böyle bir kategori bulunamadı");
        $article=Article::whereSlug($slug)->whereCategoryId($cat->id)->first() ?? abort(403, "Böyle bir yazı bulunamadı");

        $data['article']=$article;
        $article->increment('hit');

        return view('front.single', $data);
    }

    public function search(Request $request)
    {
        $whereArray=[];
        $data['selected']=[];
        if ($request->ad) {
            $where=['title','like',$request->ad.'%'];
            array_push($whereArray, $where);
        }
        if ($request->kategori) {
            $category = Category::whereSlug($request->kategori)->first() ?? abort(403, 'Böyle bir kategori bulunamadı');
            $category->fullSlug='kategori='.$category->slug;
            $data['selected']['selectedCategory']=$category;

            $whereArray=Arr::add($whereArray, 'category_id', $category->id);
        }
        if ($request->yaptiran) {
            $maker = Maker::whereSlug($request->yaptiran)->first() ?? abort(403, 'Böyle bir kategori bulunamadı');
            $maker->fullSlug='yaptiran='.$maker->slug;
            $data['selected']['selectedMaker']=$maker;
            $whereArray=Arr::add($whereArray, 'maker_id', $maker->id);
        }
        if ($request->padisah) {
            $padisah = Padisah::whereSlug($request->padisah)->first() ?? abort(403, 'Böyle bir padisah bulunamadı');
            $padisah->fullSlug ='padisah='.$padisah->slug;
            $data['selected']['selectedPadisah']=$padisah;
            $whereArray=Arr::add($whereArray, 'padisah_id', $padisah->id);
        }
        if ($request->seyhulislam) {
            $seyhulislam = Seyhulislam::whereSlug($request->seyhulislam)->first() ?? abort(403, 'Böyle bir şeyhülislam bulunamadı');
            $seyhulislam->fullSlug='seyhulislam='.$seyhulislam->slug;
            $data['selected']['selectedSeyhulislam']=$seyhulislam;
            $whereArray=Arr::add($whereArray, 'seyhulislam_id', $seyhulislam->id);
        }
        if ($request->mimar) {
            $architect = Architect::whereSlug($request->mimar)->first() ?? abort(403, 'Böyle bir mimar bulunamadı');
            $architect->fullSlug='mimar='.$architect->slug;
            $data['selected']['selectedArchitect']=$architect;
            $whereArray=Arr::add($whereArray, 'architect_id', $architect->id);
        }
        if ($request->yuzyil) {
            $century = Century::whereSlug($request->yuzyil)->first() ?? abort(403, 'Böyle bir yüzyıl bulunamadı');
            $century->fullSlug='yuzyil='.$century->slug;
            $data['selected']['selectedCentury']=$century;
            $whereArray=Arr::add($whereArray, 'century_id', $century->id);
        }
        if ($request->sehir) {
            $city = City::whereSlug($request->sehir)->first() ?? abort(403, 'Böyle bir sehir bulunamadı');
            $city->fullSlug='sehir='.$city->slug;
            $data['selected']['selectedCity']=$city;
            $whereArray=Arr::add($whereArray, 'city_id', $city->id);
        }
        $data['articles'] = Article::where($whereArray)->whereStatus(1)->orderBy('created_at', 'DESC')->paginate(8);
        return view('front.search', $data);
    }

    public function page($slug)
    {
        $page=Page::whereSlug($slug)->first() ?? abort(403, "Böyle bir sayfa bulunamadı.");
        $data['page']=$page;
        return view("front.page", $data);
    }
    public function contact()
    {
        return view('front.contact');
    }
    public function contactPost(Request $request)
    {
        $rules=[
        'name'=>'required|min:5',
        'email'=>'required|email',
        'topic'=>'required',
        'message'=>'required|min:10'
      ];
        $validate= Validator::make($request->post(), $rules);

        if ($validate->fails()) {
            return redirect()->route('contact')->withErrors($validate)->withInput();
        } else {
            Mail::send([], [], function ($message) use ($request) {
                $message->from('iletisim@blogsitesi.com', 'Blog Sitesi');
                $message->to('iletisim@blogsitesi.com');
                $message->setBody('Mesajı gönderen :'.$request->name.'</br>
                      Mesajı gönderen Mail : '.$request->mail.'</br>
                      Mesaj Konusu : '.$request->topic.'</br>
                      Mesaj : '.$request->message.'</br>
                      Mesaj Gönderilme Tarihi : '.now(), 'text/html');
                $message->subject($request->name.' iletişimden mesaj gönderdi');
            });
            $contact = new Contact;
            $contact->name=$request->name;
            $contact->email=$request->email;
            $contact->topic=$request->topic;
            $contact->message=$request->message;
            $contact->save();
        }
        return redirect()->route('contact')->with('success', 'Mesajınız bize iletildi, teşekkürler :)');
    }

    public function printPDF($slug)
    {
        $article = Article::where('slug', $slug)->first();

        $pdf = PDF::loadView('front\print_pdf', $article);
        return $pdf->download($slug.'.pdf');
    }
}
