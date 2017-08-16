$('.search_results').on('click', function(e){
  e.preventDefault();

  var id = this.id;

  // console.log(id);

  var t = $('#t').val();

  var queryString = "?username=" + id + "&type=" + t;

  var url2 = "require/get_details.php" + queryString;

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
