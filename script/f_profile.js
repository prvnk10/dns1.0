$('.f_p_nav_links a').on('click', function(e){
  e.preventDefault();

  // console.log(this);

  var url = this.href;
  // console.log(url);

  var $showContent = $('#showContent');

  $('a.active').removeClass('active');
  $(this).addClass('active');

  $.ajax({
    type: "POST",
    url: url,
    timeout: 3000,

    beforeSend: function(){
     $showContent.append("<div id='loading'> Loading.... </div>");
    },

    success: function(data){
      // console.log(data.length);
      $showContent.html($(data).find('#content')).hide().fadeIn(1000);
    },

    complete: function(){
      $('#loading').remove();
    },

    failure: function(){
      $showContent.html("<div id='loading_failed'> Please try after some time </div>");
    }

  });
});
