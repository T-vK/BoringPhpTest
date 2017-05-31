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
                    <th>Status</th>
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
                  <button class="btn btn-success" type="button" onclick="TodoList.add($('#newTodoText').val())">Add</button>
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
        'use strict'
        
        class TodoList {
            static refresh() {
                $.get('requesthandler.php', todos => {
                    $('#todos tr:not(:first)').remove()
                    todos.forEach( todo => {
                        $('#todos tr:last').after(`
                            <tr>
                                <td>${todo.ID}</td>
                                <td>${todo.Title}</td>
                                <td>${todo.Status}</td>
                                <td><button type="button" class="btn btn-sm btn-primary toggleStatusButton" onclick="TodoList.toggleStatus(${todo.ID})">Toggle Status</button></td>
                                <td><button type="button" class="btn btn-sm btn-danger" onclick="TodoList.delete(${todo.ID})">Delete</button></td>
                            </tr>
                        `)
                    })
                })
            }
            static add(title) {
                $.post('requesthandler.php', {Title:title}, data => {
                    TodoList.refresh()
                })
            }
            static toggleStatus(id) {
                $.ajax({
                    url: 'requesthandler.php',
                    type: 'PUT',
                    data: {ID:id},
                    success: function(data) {
                        TodoList.refresh()
                    }
                });
            }
            static delete(id) {
                $.ajax({
                    url: 'requesthandler.php',
                    type: 'DELETE',
                    data: {ID:id},
                    success: function(data) {
                        TodoList.refresh()
                    }
                });
            }
        }
        
        TodoList.refresh()        
    </script>
  </body>
</html>
