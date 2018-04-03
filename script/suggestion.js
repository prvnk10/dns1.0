/*

$('#suggestion_msg').on('input', function(){
  console.log('ekuchand chia wala');
});

*/

$('#suggestion_form').on('submit', function(e){
  e.preventDefault();

  var details = $('#suggestion_form').serialize();
  // console.log(details);

  var msg = $('#suggestion_msg').val();
  // console.log(msg);

  if(msg.length > 0)
  {
    /*
    $.post('require/submit_suggestion.php', details, function(data){
      $('#inner_div').html(data);
    });

    */

    var url = "require/submit_suggestion.php?" + details;

    var main_div = $('#inner_div');


    $.ajax({
      url: url,
      type: "POST",
      timeout: 3000,

      beforeSend: function(){
         main_div.after('<div id="loading" class="alert alert-info"> Submitting your suggestion </div>');
      },

      success: function(data){
        main_div.html(data);
      },

      complete: function(){
        $('#loading').remove();
      },

      failure: function(){
       main_div.html('<div id="loading_failed" class="alert alert-danger"> Please try after some time </div>');
      }

    });

  }

  else
  {
    $('#content').html("Please input the suggestion.");
  }

});
