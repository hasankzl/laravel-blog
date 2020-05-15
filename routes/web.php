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


    // Padisah Routes
    Route::get('/padisahlar', 'Back\PadisahController@index')->name('padisah.index');
    Route::post('/padisahlar/create', 'Back\PadisahController@create')->name('padisah.create');
    Route::post('/padisahlar/update', 'Back\PadisahController@update')->name('padisah.update');
    Route::post('/padisahlar/delete', 'Back\PadisahController@remove')->name('padisah.remove');
    Route::get('/padisahlar/getData', 'Back\PadisahController@getData')->name('padisah.get.data');

    // Padisah Routes
    Route::get('/sehulislamlar', 'Back\SeyhulislamController@index')->name('seyhulislam.index');
    Route::post('/sehulislamlar/create', 'Back\SeyhulislamController@create')->name('seyhulislam.create');
    Route::post('/sehulislamlar/update', 'Back\SeyhulislamController@update')->name('seyhulislam.update');
    Route::post('/sehulislamlar/delete', 'Back\SeyhulislamController@remove')->name('seyhulislam.remove');
    Route::get('/sehulislamlar/getData', 'Back\SeyhulislamController@getData')->name('seyhulislam.get.data');


    // Architect Routes
    Route::get('/mimarlar', 'Back\ArchitectController@index')->name('architect.index');
    Route::post('/mimarlar/create', 'Back\ArchitectController@create')->name('architect.create');
    Route::post('/mimarlar/update', 'Back\ArchitectController@update')->name('architect.update');
    Route::post('/mimarlar/delete', 'Back\ArchitectController@remove')->name('architect.remove');
    Route::get('/mimarlar/getData', 'Back\ArchitectController@getData')->name('architect.get.data');

    // Century Routes
    Route::get('/yuzyillar', 'Back\CenturyController@index')->name('century.index');
    Route::post('/yuzyillar/create', 'Back\CenturyController@create')->name('century.create');
    Route::post('/yuzyillar/update', 'Back\CenturyController@update')->name('century.update');
    Route::post('/yuzyillar/delete', 'Back\CenturyController@remove')->name('century.remove');
    Route::get('/yuzyillar/getData', 'Back\CenturyController@getData')->name('century.get.data');

    // City Routes
    Route::get('/sehir', 'Back\CityController@index')->name('city.index');
    Route::post('/sehir/create', 'Back\CityController@create')->name('city.create');
    Route::post('/sehir/update', 'Back\CityController@update')->name('city.update');
    Route::post('/sehir/delete', 'Back\CityController@remove')->name('city.remove');
    Route::get('/sehir/getData', 'Back\CityController@getData')->name('city.get.data');

    // Century Routes
    Route::get('/ulkeler', 'Back\CountryController@index')->name('country.index');
    Route::post('/ulkeler/create', 'Back\CountryController@create')->name('country.create');
    Route::post('/ulkeler/update', 'Back\CountryController@update')->name('country.update');
    Route::post('/ulkeler/delete', 'Back\CountryController@remove')->name('country.remove');
    Route::get('/ulkeler/getData', 'Back\CountryController@getData')->name('country.get.data');

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
Route::get('/arama', 'Front\HomePage@search')->name('search');
Route::get('/{category}/{slug}', 'Front\HomePage@single')->name('single');
Route::get('/{sayfa}', 'Front\HomePage@page')->name('page');


// PDF Rootes

Route::get('/makale/pdf/{slug}', 'Front\HomePage@printPDF')->name('article.printPDF');
