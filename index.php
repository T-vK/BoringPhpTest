<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Todo list</title>
    <link href="libs/third-party/bootstrap-4/css/bootstrap.min.css" rel="stylesheet">
    <style>
      body {
        margin: 0;
        padding: 20px;
        min-width: 700px;
      }
      .btn {
        cursor: pointer;
      }
    </style>
  </head>
    
  <body>

    <div class="card">
      <div class="card-header">
        ToDo List
      </div>
      <div class="card-block">
        <ul class="list-group list-group-flush">
          <li class="list-group-item" style="overflow-y: scroll; max-height:400px">
              <table class="table" id="todos">
                <thead>
                  <tr>
                    <th>#</th>
                    <th>Description</th>
                    <th>Done</th>
                    <th></th>
                    <th></th>
                  </tr>
                </thead>
                <tbody>
                  <!--<tr>
                    <th scope="row">1</th>
                    <td>Mark</td>
                    <td>Otto</td>
                    <td>@mdo</td>
                  </tr>-->
                </tbody>
              </table>
          </li>
          <li class="list-group-item">
              <div class="input-group">
                <input type="text" class="form-control" placeholder="New ToDo..." id="newTodoText">
                <span class="input-group-btn">
                  <button class="btn btn-success" type="button" id="newTodoButton">Add</button>
                </span>
              </div>
          </li>
        </ul>
      </div>
    </div>

    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="libs/third-party/jquery-3.js"></script>
    <script src="libs/third-party/tether-1.js"></script>
    <script src="libs/third-party/bootstrap-4/js/bootstrap.min.js"></script>
    <script>
        function renderTodos(todos) {
            todos.forEach( todo => {
                $('#todos tr:last').after(`
                    <tr>
                        <td>${todo.entryId}</td>
                        <td>${todo.entryTitle}</td>
                        <td>${todo.entryStatus}</td>
                        <td><button type="button" class="btn btn-sm btn-primary">Toggle Status</button></td>
                        <td><button type="button" class="btn btn-sm btn-danger">Delete</button></td>
                    </tr>
                `)
            })
        }
    
        $.post("requesthandler.php", { toDoTitle: "", toDoStatus: 'loadEntrys' }, data => {
            let todos = JSON.parse(data)
            renderTodos(todos)
        })
        $("#newTodoButton").click( () => {
            $.post("requesthandler.php", { toDoTitle: $("#newTodoText").val(), toDoStatus: 'setEntry' }, data => {
                let todos = JSON.parse(data)
                renderTodos(todos)
            })
        })
    </script>
  </body>
</html>
