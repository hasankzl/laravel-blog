<?php

use Illuminate\Support\Facades\Route;

/*
Backend Rootes
*/
Route::get('/aktif-degil', function () {
    return view('front.offline');
})->name('offline');
Route::prefix('admin')->name('admin.')->middleware('isLogin')->group(function () {
    Route::get('giris', 'Back\AuthController@login')->name('login');
    Route::post('giris', 'Back\AuthController@loginPost')->name('login.post');
});
Route::prefix('admin')->name('admin.')->middleware('isAdmin')->group(function () {
    Route::get('panel', 'Back\Dashboard@index')->name('dashboard');
    Route::get('cikis', 'Back\AuthController@logout')->name('logout');
    // Makale Root
    Route::get('/makaleler/silinenler', 'Back\ArticleController@trashed')->name('trashed.article');
    Route::resource('makaleler', 'Back\ArticleController');
    Route::get('/switch', 'Back\ArticleController@switch')->name('article.switch');
    Route::get('/deleteArticle/{id}', 'Back\ArticleController@delete')->name('delete.article');
    Route::get('/hardDeleteArticle/{id}', 'Back\ArticleController@hardDelete')->name('hard.delete.article');
    Route::get('/recoverArticle/{id}', 'Back\ArticleController@recover')->name('recover.article');

    // Kategori Routes
    Route::get('/kategoriler', 'Back\CategoryController@index')->name('category.index');
    Route::post('/kategoriler/create', 'Back\CategoryController@create')->name('category.create');
    Route::post('/kategoriler/update', 'Back\CategoryController@update')->name('category.update');
    Route::post('/kategoriler/delete', 'Back\CategoryController@remove')->name('category.remove');
    Route::get('/kategoriler/status', 'Back\CategoryController@switch')->name('category.switch');
    Route::get('/kategoriler/getData', 'Back\CategoryController@getData')->name('category.get.data');


    // Maker Routes
    Route::get('/yaptiranlar', 'Back\MakerController@index')->name('maker.index');
    Route::post('/yaptiranlar/create', 'Back\MakerController@create')->name('maker.create');
    Route::post('/yaptiranlar/update', 'Back\MakerController@update')->name('maker.update');
    Route::post('/yaptiranlar/delete', 'Back\MakerController@remove')->name('maker.remove');
    Route::get('/yaptiranlar/getData', 'Back\MakerController@getData')->name('maker.get.data');


    //Pages Routes
    Route::get('/sayfalar', 'Back\PageController@index')->name('page.index');
    Route::get('/sayfalar/switch', 'Back\PageController@switch')->name('page.switch');
    Route::get('/sayfa/olustur', 'Back\PageController@create')->name('page.create');
    Route::post('/sayfa/olustur', 'Back\PageController@store')->name('page.store');
    Route::get('/sayfa/guncelle/{id}', 'Back\PageController@edit')->name('page.edit');
    Route::post('/sayfa/guncelle/{id}', 'Back\PageController@update')->name('page.update');
    Route::get('/sayfa/sil/{id}', 'Back\PageController@delete')->name('page.delete');
    Route::get('/sayfa/siralama', 'Back\PageController@orders')->name('page.orders');

    // Config Routes
    Route::post('/ayarlar/guncelle', 'Back\ConfigController@update')->name('config.update');
    Route::get('/ayarlar', 'Back\ConfigController@index')->name('config.index');
});


/*
front Rootes
*/
Route::get('/', 'Front\HomePage@index')->name('homepage');
Route::get('/sayfa', 'Front\HomePage@index')->name('homepage');
Route::get('/iletisim', 'Front\HomePage@contact')->name('contact');
Route::post('/iletisim', 'Front\HomePage@contactPost')->name('contact.post');
Route::get('/kategori/{category}', 'Front\HomePage@category')->name('category');
Route::get('/{category}/{slug}', 'Front\HomePage@single')->name('single');
Route::get('/{sayfa}', 'Front\HomePage@page')->name('page');
