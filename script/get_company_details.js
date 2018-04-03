$('.search_results').on('click', function(e){
  e.preventDefault();

  var id = this.id;

  var queryString = "?company_id=" + id ;

  var url2 = "administration/get_company_details.php" + queryString;

  $('#myModal').fadeToggle();

  $.ajax({
    type: "POST",
    url: url2,
    timeout: 1000,

    success: function(data){
      $('.modal-body').html(data);
    }

  });

});

$('.close_search_modal').on('click', function(){
   $('#myModal').fadeToggle();
});
