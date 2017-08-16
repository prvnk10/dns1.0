$('#entered_name , #t').on('input blur', function(){
  var details = $('#search_form').serialize();
  // console.log(234);

  $.get('require/search_the_db.php', details, function(data){
     $('#searched_content').html(data);
  });

});


$('#search_form').on('submit', function(e){
  e.preventDefault();
  // console.log(456);

  var form_details = $('#search_form').serialize();

  var query = $('#entered_name').val();
  var type = $('#t').val();

  var temp = "?query=" + query + "&type=" + type;

  var url = "require/search_the_db.php" + temp;

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
