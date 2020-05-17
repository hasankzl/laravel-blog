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

    // Architect Routes
    Route::get('/durum', 'Back\StatusController@index')->name('status.index');
    Route::post('/durum/create', 'Back\StatusController@create')->name('status.create');
    Route::post('/durum/update', 'Back\StatusController@update')->name('status.update');
    Route::post('/durum/delete', 'Back\StatusController@remove')->name('status.remove');
    Route::get('/durum/getData', 'Back\StatusController@getData')->name('status.get.data');


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

    // Semt Routes
    Route::get('/semt', 'Back\SemtController@index')->name('semt.index');
    Route::post('/semt/create', 'Back\SemtController@create')->name('semt.create');
    Route::post('/semt/update', 'Back\SemtController@update')->name('semt.update');
    Route::post('/semt/delete', 'Back\SemtController@remove')->name('semt.remove');
    Route::get('/semt/getData', 'Back\SemtController@getData')->name('semt.get.data');

    // NeighborHood Routes
    Route::get('/mahalle', 'Back\NeighborhoodController@index')->name('neighborhood.index');
    Route::post('/mahalle/create', 'Back\NeighborhoodController@create')->name('neighborhood.create');
    Route::post('/mahalle/update', 'Back\NeighborhoodController@update')->name('neighborhood.update');
    Route::post('/mahalle/delete', 'Back\NeighborhoodController@remove')->name('neighborhood.remove');
    Route::get('/mahalle/getData', 'Back\NeighborhoodController@getData')->name('neighborhood.get.data');

    // Avenue Routes
    Route::get('/cadde', 'Back\AvenueController@index')->name('avenue.index');
    Route::post('/cadde/create', 'Back\AvenueController@create')->name('avenue.create');
    Route::post('/cadde/update', 'Back\AvenueController@update')->name('avenue.update');
    Route::post('/cadde/delete', 'Back\AvenueController@remove')->name('avenue.remove');
    Route::get('/cadde/getData', 'Back\AvenueController@getData')->name('avenue.get.data');

    // Street Routes
    Route::get('/sokak', 'Back\StreetController@index')->name('street.index');
    Route::post('/sokak/create', 'Back\StreetController@create')->name('street.create');
    Route::post('/sokak/update', 'Back\StreetController@update')->name('street.update');
    Route::post('/sokak/delete', 'Back\StreetController@remove')->name('street.remove');
    Route::get('/sokak/getData', 'Back\StreetController@getData')->name('street.get.data');


    // district Routes
    Route::get('/ilce', 'Back\DistrictController@index')->name('district.index');
    Route::post('/ilce/create', 'Back\DistrictController@create')->name('district.create');
    Route::post('/ilce/update', 'Back\DistrictController@update')->name('district.update');
    Route::post('/ilce/delete', 'Back\DistrictController@remove')->name('district.remove');
    Route::get('/ilce/getData', 'Back\DistrictController@getData')->name('district.get.data');

    // Village Routes
    Route::get('/koy', 'Back\VillageController@index')->name('village.index');
    Route::post('/koy/create', 'Back\VillageController@create')->name('village.create');
    Route::post('/koy/update', 'Back\VillageController@update')->name('village.update');
    Route::post('/koy/delete', 'Back\VillageController@remove')->name('village.remove');
    Route::get('/koy/getData', 'Back\VillageController@getData')->name('village.get.data');

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

Route::get('/adres/sehirler/{id}', 'AddressController@getCities')->name('address.cities');
Route::get('/adres/semtler/{id}', 'AddressController@getSemts')->name('address.semts');
Route::get('/adres/ilceler/{id}', 'AddressController@getDistricts')->name('address.districts');
Route::get('/adres/mahalleler/{id}', 'AddressController@getNeighborhoods')->name('address.neighborhoods');
Route::get('/adres/koyler/{id}', 'AddressController@getVillages')->name('address.villages');
Route::get('/adres/caddeler/{id}', 'AddressController@getAvenues')->name('address.avenues');
Route::get('/adres/sokaklar/{id}', 'AddressController@getStreets')->name('address.streets');

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

// Address Routes


// PDF Rootes

Route::get('/makale/pdf/{slug}', 'Front\HomePage@printPDF')->name('article.printPDF');
