<div id="content">

<form id="search_form" action="require/searcth_the_db.php" method="get" class="form-inline">

  <div class="form-group">
   <input type="text" class="form-control col-sm-4" id="entered_name" name="query" placeholder="enter the name here" required="required">
  </div>

  <div class="form-group">
   <select class="form-control" id="t" name="type">
    <option value="students"> Student </option>
    <option value="faculty"> Faculty </option>
    <option value="administration"> Administration </option>
    <option value="workers"> Workers </option>
   </select>
  </div>

  <button type="submit" class="btn btn-default"> <span class="glyphicon glyphicon-search"></span> </button>

</form>

<div id="searched_content" class="col-sm-4"></div>

<script src="script/search.js"> </script>

</div>
