$('#form_check_current_pw').on('submit', function(e){

  e.preventDefault();
  // console.log(3453);

  var details = $('#form_check_current_pw').serialize();
  // console.log(details);

  // var d = JSON.stringify(details);
  // console.log(d);

  var url = "require/check_current_password.php";
  var main_div = $('#inner_div');

  $.ajax({
    url: url,
    type: "POST",
    timeout: 3000,
    data: details,

    beforeSend: function(){
       main_div.after('<div id="loading" class="alert alert-info"> Loading </div>');
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

});


$('#form_enter_new_pw').on('submit', function(e){
  e.preventDefault();

  var details = $('#form_enter_new_pw').serialize();
  // console.log(details);

  var url = "require/update_password.php";
  var main_div = $('#inner_div');

  $.ajax({
    url: url,
    type: "POST",
    timeout: 3000,
    data: details,

    beforeSend: function(){
       main_div.after('<div id="loading" class="alert alert-info"> Sending update request </div>');
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

});
