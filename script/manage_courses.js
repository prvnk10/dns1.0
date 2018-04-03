$('#course_code').on('blur', function(){
  var course_code = $('#course_code').val();

  if(course_code != '' && course_code.length > 0 )
  {
     // console.log('its working');

     $.get("require/check_course_code.php", {cc: course_code}, function(data){
       // console.log(data);
       $('#course_code_err').html(data);

       if(data.length > 0)
       {
         $('#add_course_btn').disable();
       }
     });
  }

});

$('#add_course_form').on('submit', function(e){

  e.preventDefault();
  // console.log(456);

  var details = $('#add_course_form').serialize();

  $.post('worker/add_new_course.php', details, function(data){
    $('#add_course').html(data);
  });

});
