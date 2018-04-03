$('#subject_list').on('change', function(){
  // console.log(456);

  $('#subject_info').html() == '';

  var main_div = $('#subject_list');

  var course_code = $('#subject_list').val();

  if(course_code.length > 0)
  {

  // console.log(course_code);

  // console.log(main_div);
  // main_div.after('<div id="subject_info"> Here comes the subject info </div>');
  // console.log("Here comes the subject info");

  var url = 'student/get_subject_info.php?course_code=' + course_code;

   $.ajax({
      type: "POST",
      url: url,
      timeout: 3000,

      beforeSend: function(){
        main_div.after('<div id="loading" class="alert alert-info"> Getting the subject details </div>');
        // $('#subject_info').html('');
      },

      complete: function(){
        $('#loading').html('');
        $('#loading').remove();
      },

      success: function(data){
        // main_div.after('<div id="subject_info"> 12456 </div>');
        // console.log(main_div);

        // console.log(data);
        // main_div.after('<div id="subject_info">' + data + '</div>');

        // main_div.after('<div id="subject_info"></div>');
        $('#subject_info').html(data);

      },

      failure: function(){
        main_div.append('<div id="failure" class="alert alert-danger"> Sorry, we are unable to get the content right now. Please try again after some time </div>');
      }

   });

  }

});

/*
$('.get_study_material').on('click', function(){
   // console.log(456);  its working

  // $('#study_material_content').html() == 'sdfsdf';

  var main_div = $('#study_material_content').val();
  console.log(main_div);

  var f_id = $('#f_id').val();
  var course_code = $('.course_code').val();

  console.log(course_code);

  if(course_code.length > 0 && f_id.length > 0)
  {

  url_data = '?course_code=' + course_code + '&f_id=' + f_id;

  var url = 'student/get_study_material.php' + url_data;
  console.log(url);

   $.ajax({
      type: "POST",
      url: url,
      timeout: 3000,

      beforeSend: function(){
        main_div.after('<div id="loading"> Getting the subject study material </div>');
      },

      complete: function(){
        $('#loading').remove();
      },

      success: function(data){
        $('#study_material_content').html(data);
      },

      failure: function(){
        main_div.append('<div id="failure" class="alert alert-danger"> Sorry, we are unable to get the content right now. Please try again after some time </div>');
      }

   });

  }

});
*/
