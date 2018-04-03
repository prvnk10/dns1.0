$('#department_id').on('change', function(){

  //  console.log(34);

   var main_div = $('#workers_list');

   var d_id = $('#department_id').val();

  if(d_id != '')
  {

    console.log(d_id);

    var details = 'd_id=' + d_id;



    var url = 'administration/get_workers_list.php';

    $.ajax({
      url: url,
      type: "POST",
      timeout: 3000,
      data: details,

      beforeSend: function(){
       main_div.after('<div id="loading" class="alert alert-info"> Fetching workers list </div>');
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
  else
  {
    main_div.html('');
  }

});
