<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Aweseome Project</title>
    <link href="libs/third-party/bootstrap-4/css/bootstrap.min.css" rel="stylesheet">
    <link href="css/main.css" rel="stylesheet">
  </head>
  <body>
    <div class="newItemWrapper">
      <h1 class="headline">To-Do List</h1>
      <form role="form">
		      <input id="toDoTitle" placeholder="Your Task" type="text"> <button type="button" class="btn btn btn-primary" onclick="ajax_post()">Add</button> <br><br>
      </form>

      <h2>My To-Do's</h2>
      <div id="status"></div>
    </div>

    <script src="libs/third-party/jquery-3.js"></script>
    <script src="libs/third-party/tether-1.js"></script>
    <script src="libs/third-party/bootstrap-4/js/bootstrap.min.js"></script>
    <script src="js/script.js"></script>
  </body>
</html>
