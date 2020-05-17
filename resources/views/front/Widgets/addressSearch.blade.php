
<h4 class="ml-5 mb-0">Adrese Göre Arama</h4><br>
<div class="row mx-5" style="margin-bottom:15px;">

  <div class="col-lg-2 mt-2">
    <label for="country"> Ülke</label>
    <select class="form-control" name="country" onchange="location = this.value;">
      <option   @if(isset($selected['selectedCountry'])) value="{{preg_replace('/'.$selected['selectedCountry']->fullSlug.'/','',URL::full())}}" @endif>
    Ülke seçiniz
    </option>
    @foreach($countries as $country)
    <option @if(isset($selected['selectedCountry']) && $selected['selectedCountry']->id == $country->id) selected @endif  value="{{preg_match('/(ulke)/',URL::full()) ? preg_replace('/'.$selected['selectedCountry']->slug.'/',$country->slug,$_SERVER['REQUEST_URI'])
      :
      $_SERVER['REQUEST_URI'].'&ulke='.$country->slug}}">{{$country->name}}</option>
    @endforeach
    </select>
  </div>
  <div class="col-lg-2 mt-2">
    <label for="city"> Şehir</label>
    <select class="form-control" name="city" onchange="location = this.value;">
      <option  @if(isset($selected['selectedCity'])) value="{{preg_replace('/'.$selected['selectedCity']->fullSlug.'/','',URL::full())}}" @endif>
    sehir seçiniz
    </option>
    @foreach($cities as $city)
  <option @if(isset($selected['selectedCity']) && $selected['selectedCity']->id == $city->id) selected @endif value="{{preg_match('/(sehir)/',URL::full()) ? preg_replace('/'.$selected['selectedCity']->slug.'/',$city->slug,$_SERVER['REQUEST_URI'])
    :
    $_SERVER['REQUEST_URI'].'&sehir='.$city->slug}}"><a href="#">{{$city->name}}</a></option>
    @endforeach
    </select>
  </div>

  <div class="col-lg-2 mt-2">
    <label for="district"> İlçe</label>
    <select class="form-control" name="district" onchange="location = this.value;" >
      <option  @if(isset($selected['selectedDistrict'])) value="{{preg_replace('/'.$selected['selectedDistrict']->fullSlug.'/','',URL::full())}}" @endif>
    ilçe seçiniz
    </option>
    @foreach($districts as $district)
    <option  @if(isset($selected['selectedDistrict']) && $selected['selectedDistrict']->id == $district->id) selected @endif
    value="{{preg_match('/(ilce)/',URL::full()) ? preg_replace('/'.$selected['selectedDistrict']->slug.'/',$district->slug,$_SERVER['REQUEST_URI'])
      :
      $_SERVER['REQUEST_URI'].'&ilce='.$district->slug}}">{{$district->name}}</option>
    @endforeach
    </select>
  </div>
  <div class="col-lg-2 mt-2">
    <label for="semt"> Semt</label>
    <select class="form-control" name="semt" onchange="location = this.value;" >
      <option  @if(isset($selected['selectedSemt'])) value="{{preg_replace('/'.$selected['selectedSemt']->fullSlug.'/','',URL::full())}}" @endif>
    semt seçiniz
    </option>
    @foreach($semts as $semt)
    <option @if(isset($selected['selectedSemt']) && $selected['selectedSemt']->id == $semt->id) selected @endif
    value="{{preg_match('/(semt)/',URL::full()) ? preg_replace('/'.$selected['selectedSemt']->slug.'/',$semt->slug,$_SERVER['REQUEST_URI'])
      :
      $_SERVER['REQUEST_URI'].'&semt='.$semt->slug}}">{{$semt->name}}</option>
    @endforeach
    </select>
  </div>
  <div class="col-lg-2 mt-2">
    <label for="village"> Köy</label>
    <select class="form-control" name="village" onchange="location = this.value;" >
      <option  @if(isset($selected['selectedVillage'])) value="{{preg_replace('/'.$selected['selectedVillage']->fullSlug.'/','',URL::full())}}" @endif>
    köy seçiniz
    </option>
    @foreach($villages as $village)
    <option @if(isset($selected['selectedVillage']) && $selected['selectedVillage']->id == $village->id) selected @endif
    value="{{preg_match('/(koy)/',URL::full()) ? preg_replace('/'.$selected['selectedVillage']->slug.'/',$village->slug,$_SERVER['REQUEST_URI'])
      :
      $_SERVER['REQUEST_URI'].'&koy='.$village->slug}}">{{$village->name}}</option>
    @endforeach
    </select>
  </div>
  <div class="col-lg-2 mt-2">
    <label for="neighborhood"> Mahalle</label>
    <select class="form-control" name="neighborhood" onchange="location = this.value;" >
      <option  @if(isset($selected['selectedNeighborhood'])) value="{{preg_replace('/'.$selected['selectedNeighborhood']->fullSlug.'/','',URL::full())}}" @endif>
    mahalle seçiniz
    </option>
    @foreach($neighborhoods as $neighborhood)
    <option @if(isset($selected['selectedNeighborhood']) && $selected['selectedNeighborhood']->id == $neighborhood->id) selected @endif
    value="{{preg_match('/(mahalle)/',URL::full()) ? preg_replace('/'.$selected['selectedNeighborhood']->slug.'/',$neighborhood->slug,$_SERVER['REQUEST_URI'])
      :
      $_SERVER['REQUEST_URI'].'&mahalle='.$neighborhood->slug}}">{{$neighborhood->name}}</option>
    @endforeach
    </select>
  </div>
  <div class="col-lg-2 mt-2">
      <label for="avenue"> Cadde</label>
    <select class="form-control" name="avenue" onchange="location = this.value;">
      <option @if(isset($selected['selectedAvenue'])) value="{{preg_replace('/'.$selected['selectedAvenue']->fullSlug.'/','',URL::full())}}" @endif>
    cadde seçiniz
    </option>
    @foreach($avenues as $avenue)
    <option @if(isset($selected['selectedAvenue']) && $selected['selectedAvenue']->id == $avenue->id) selected @endif
    value="{{preg_match('/(cadde)/',URL::full()) ? preg_replace('/'.$selected['selectedAvenue']->slug.'/',$avenue->slug,$_SERVER['REQUEST_URI'])
      :
      $_SERVER['REQUEST_URI'].'&cadde='.$avenue->slug}}">{{$avenue->name}}</option>
    @endforeach
    </select>
  </div>
  <div class="col-lg-2 mt-2">
      <label for="street"> Sokak</label>
    <select class="form-control" name="street" onchange="location = this.value;">
      <option @if(isset($selected['selectedStreet'])) value="{{preg_replace('/'.$selected['selectedStreet']->fullSlug.'/','',URL::full())}}" @endif>
    sokak seçiniz
    </option>
    @foreach($streets as $street)
    <option @if(isset($selected['selectedStreet']) && $selected['selectedStreet']->id == $street->id) selected @endif
    value="{{preg_match('/(sokak)/',URL::full()) ? preg_replace('/'.$selected['selectedStreet']->slug.'/',$street->slug,$_SERVER['REQUEST_URI'])
      :
      $_SERVER['REQUEST_URI'].'&sokak='.$street->slug}}">{{$street->name}}</option>
    @endforeach
    </select>
  </div>
</div>
