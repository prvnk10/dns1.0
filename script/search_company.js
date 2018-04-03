$('#company_name').on('input blur', function(){
  var details = $('#search_company_form').serialize();
  // console.log(234);

  $.get('administration/search_company.php', details, function(data){
     $('#searched_content').html(data);
  });

});

$('#programme_id').on('change', function(e){
   e.preventDefault();
   // console.log(456);

  var p_id = $('#programme_id').val();

  var $showContent = $('#placed_stats');

  if(p_id == '')
  {
    $showContent.html(' ');
  }

  else
  {

   var temp = "?p_id=" + p_id ;
   var url = "administration/search_company.php" + temp;
   // console.log(temp);

  $.ajax({
   type: "POST",
   url: url,
   timeout: 1000,

   beforeSend: function(){
    $showContent.append('<div id="loading"> Loading..... </div>');
   },

   complete: function(){
    $('#loading').remove();
   },

   success: function(data){
    $showContent.html($(data)).hide().fadeIn(1000);
   },

   failure: function(){
    $showContent.html('<div id="loading_failed"> Please try after some time </div>');
   }

  });

 }

});


$('#search_company_form').on('submit', function(e){
  e.preventDefault();
  // console.log(456);

  var form_details = $('#search_company_form').serialize();

  var query = $('#company_name').val();

  var temp = "?query=" + query ;

  var url = "administration/search_company.php" + temp;

  var $showContent = $('#searched_content');

  $.ajax({
   type: "POST",
   url: url,
   timeout: 1000,

   beforeSend: function(){
    $showContent.append('<div id="loading"> Loading..... </div>');
   },

   complete: function(){
    $('#loading').remove();
   },

   success: function(data){
    $showContent.html($(data)).hide().fadeIn(1000);
   },

   failure: function(){
    $showContent.html('<div id="loading_failed"> Please try after some time </div>');
   }

  });

});
