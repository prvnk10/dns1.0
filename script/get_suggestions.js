$('#topic_id').on('change blur', function(e){
  e.preventDefault();

  var s_topic_id = $('#topic_id').val();
  var main_div = $('#fetched_content');

  var details = 's_topic_id=' + s_topic_id;

    if(s_topic_id == ' ')
  {
    main_div.html('');
  }
  else
  {

    var url = "administration/get_suggestions.php";

    $.ajax({
      url: url,
      type: "POST",
      timeout: 3000,
      data: details,

      beforeSend: function(){
         main_div.after('<div id="loading" class="alert alert-info"> Fetching suggestions for this topic </div>');
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

});
