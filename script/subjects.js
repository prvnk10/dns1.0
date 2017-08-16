$('#subject_list').on('change', function(){
  // console.log(456);

  var course_code = $('#subject_list').val();
  if(course_code.length > 0)
  {

  // console.log(course_code);

  var main_div = $('#subject_list');
  // console.log(main_div);
  // main_div.after('<div id="subject_info"> Here comes the subject info </div>');
  // console.log("Here comes the subject info");



  var url = 'student/get_subject_info.php?course_code=' + course_code;

   $.ajax({
      type: "POST",
      url: url,
      timeout: 3000,

      beforeSend: function(){
        main_div.after('<div id="loading"> Getting the subject details </div>');
        // $('#subject_info').html('');
      },

      complete: function(){
        $('#loading').remove();
      },

      success: function(data){
        // main_div.after('<div id="subject_info"> 12456 </div>');
        // console.log(main_div);

        console.log(data);
        // main_div.after('<div id="subject_info">' + data + '</div>');

        main_div.after('<div id="subject_info"></div>');
        $('#subject_info').html(data);

      },

      failure: function(){
        main_div.append('<div id="failure"> Sorry, we are unable to get the content right now. Please rty again after some time </div>');
      }

   });

  }

});
