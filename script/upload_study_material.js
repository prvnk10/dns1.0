$('#courses_list').on('blur change', function(e){
  e.preventDefault();
  // console.log(230);

  var course_code = $('#courses_list').val();
  // console.log(course_code);

  var user_file = $('#user_file').val();
  // console.log(user_file);

  // get the selected files from the input
  var files = user_file.files;
  console.log(files);

  var formData = new FormData($('#user_file').get(1));
  console.log(formData);

  /* Loop through each of the selected files.
  for (var i = 0; i < files.length; i++)
  {
    var file = files[i];

    // Check the file type.
    if (!file.type.match('pdf.*')) {
      continue;
    }

    // Add the file to the request.
    formData.append('photos[]', file, file.name);

  }
  */

  var $showContent = $('#showContent');

/*
  if(course_code != '' && user_file != '')
  {
    var details = $('upload_study_material_form').serialize();

    var url = "faculty/upload_study_material.php";

    $.ajax({
     type: "POST",
     url: url,
     timeout: 3000,
     data: details,

     beforeSend: function(){
      $showContent.append("<div id='loading'> Loading.... </div>");
     },

     success: function(data){
       // console.log(data.length);
       $showContent.html(data);
     },

     complete: function(){
       $('#loading').remove();
     },

     failure: function(){
       $showContent.html("<div id='loading_failed'> Please try after some time </div>");
     }


  });


}  */



});

$('#upload_study_material_form').on('submit', function(e){

  e.preventDefault();

  var course_code = $('#courses_list').val();
  var user_file = $('#user_file').val();

  // get the selected files from the input
  var files = user_file.files;
  console.log(files);

  var $showContent = $('#showContent');

  if(course_code != '' && user_file != '')
  {
    var details = $('#upload_study_material_form').serialize();
    console.log(details);
    var url = "faculty/upload_study_material.php";

    $.ajax({
     type: "POST",
     url: url,
     timeout: 3000,
     data: details,

     beforeSend: function(){
      $showContent.append("<div id='loading'> Loading.... </div>");
     },

     success: function(data){
       // console.log(data.length);
       $showContent.html(data);
     },

     complete: function(){
       $('#loading').remove();
     },

     failure: function(){
       $showContent.html("<div id='loading_failed'> Please try after some time </div>");
     }


  });


  }
  else
  {
    $showContent.html('');
  }


});
