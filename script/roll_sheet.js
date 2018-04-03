$('#courses_list').on('change', function(e){

  var main_div = $('#courses_list');
  var content_div = $('#roll_sheet');

   var course_code = $('#courses_list').val();

   if(course_code != '')
   {

   var details = "course_code=" + course_code;

  // var cc = '<?php echo $_SESSION['username']; ?>';
  // console.log(cc);

   console.log(details);

   var url = "faculty/get_roll_sheet.php";

   $.ajax({
     type: "POST",
     url: url,
     timeout: 3000,
     data: details,

     beforeSend: function(){
      main_div.append("<div id='loading'> Loading.... </div>");
     },

     success: function(data){
       // console.log(data.length);
       content_div.html(data);
     },

     complete: function(){
       $('#loading').remove();
     },

     failure: function(){
       content_div.html("<div id='loading_failed'> Please try after some time </div>");
     }

   });

 }

 else
 {
   content_div.html('');
 }

});


$('user_roll_no').on('click', function(e){
  e.preventDefault();
   console.log(234);
});
