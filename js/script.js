
function ajax_post(){
    document.getElementById("toDoTitle").innerHTML = "processing...";
    $.post("requesthandler.php", { toDoTitle: $("#toDoTitle").val(), toDoStatus: 'setEntry' }, function(data) {
		$("#status").append(data +'<br>');
    })
}

function loadToDos(){
    $.post("requesthandler.php", { toDoTitle: $("#toDoTitle").val(), toDoStatus: 'loadEntrys' }, function(data) {
      var json = JSON.parse(data);
      var i = 0;
      for(item in json){
        $("#status").append(JSON.stringify(json[i]) +'<br>');
        i++;
      }
    })
}
loadToDos();
