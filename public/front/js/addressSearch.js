$('select[name="country"]').on('change',function(){
  var countryID = $(this).val();
  if(countryID){
    $.ajax({
      url:"{{route('address.cities','')}}"+"/"+countryID,
      type:"GET",
      dataType:"json",
      success:function(data)
      {
        $('select[name="city"]').empty();
$('select[name="city"]').append('<option value="1">Belirtilmedi</option>');
        jQuery.each(data,function(key,value){
          $('select[name="city"]').append('<option value="'+key+'">'+value+'</option>')
        })
      }
    })
  }
  else{
    $('select[name="city"]').empty();
$('select[name="city"]').append('<option value="1">Belirtilmedi</option>');
  }
});
