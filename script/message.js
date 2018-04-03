$('#send_message').on('submit', function(e){
   e.preventDefault();

   // console.log(234234);

   var details = $('#send_message').serialize();
   // console.log(details);

   var msg = $('#message').val();
   // console.log(msg);

   var receivers = $('#receivers').val();
   // console.log(receivers);

   var url = "faculty/send_message.php";
   var inner_div = $('#inner_div');
   var outer_div = $('#outer_div');

   if(msg.length > 0)
   {

     $.ajax({
       url: url,
       type: "POST",
       timeout: 3000,
       data: details,

       beforeSend: function(){
          outer_div.after('<div id="loading" class="alert alert-info"> Submitting your suggestion </div>');
       },

       success: function(data){
         outer_div.html(data);
       },

       complete: function(){
         $('#loading').remove();
       },

       failure: function(){
        outer_div.html('<div id="loading_failed" class="alert alert-danger"> Please try after some time </div>');
       }

     });

   }

   else
   {
     inner_div.html("<div class='alert alert-danger col-sm-8'> Please enter the message. </div>");
   }

});
