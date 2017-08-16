$('#suggestion_form').on('submit', function(e){
  e.preventDefault();

  console.log(124350);

  var details = $('#suggestion_form').serialize();

  var msg = $('#suggestion_msg').val();

  if(msg.length > 0)
  {
    // console.log("bangu");

    /*
    $.post('require/submit_suggestion.php', details, function(data){
      $('#inner_div').html(data);
    });
    */

    $.ajax({
      url: 'require/submit_suggestion.php';
      type: "POST",
      timeout: 3000,

      beforeSend: function(){
         $('#content').after('<div id="loading"> Subitting your suggestion </div>');
      },

      success: function(data){
        $('#content').html(data);
      },

      complete: function(){
        $('#loading').remove();
      }

    });

  }

  else
  {
    console.log('chawal');
  }

});
