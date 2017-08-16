$('#courses_list').on('blur change', function(e){

  var course_code = $('#courses_list').val();
  // console.log(course_code);

  var url = "faculty/upload_study_material.php?cc=" + course_code;

  $.ajax({
    typr: "POST",
    url: url,
    timeout: 3000,

    success: function(data){
    $('#content').html(data);
  }

  });

});
