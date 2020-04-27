<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Mail;
use Validator;

// Models
use App\Models\Category;
use App\Models\Article;
use App\Models\Page;
use App\Models\Contact;
use App\Models\Config;

class HomePage extends Controller
{
    public function __construct()
    {
        if (Config::find(1)->active==0) {
            return redirect()->to('aktif-degil')->send();
        }
        view()->share('pages', Page::orderBy('order', 'ASC')->whereStatus(1)->get());
        view()->share('categories', Category::where('status', 1)->get());
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

    public function category($slug)
    {
        $category = Category::whereSlug($slug)->first() ?? abort(403, "Böyle bir kategori bulunamadı.");
        $data['category']=$category;
        $data['articles'] = Article::whereCategoryId($category->id)->whereStatus(1)->orderBy('created_at', 'DESC')->paginate(3);
        return view('front.category', $data);
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
}
