
function ajax_post(){
    document.getElementById("toDoTitle").innerHTML = "processing...";
    $.post("requesthandler.php", { toDoTitle: $("#toDoTitle").val(), toDoStatus: 'setEntry' }, function(data) {
		$("#status").append(data +'<br>');
    })
}

function loadToDos(){
    $.post("requesthandler.php", { toDoTitle: $("#toDoTitle").val(), toDoStatus: 'loadEntrys' }, function(data) {
		$("#status").append(data);
    })
}
loadToDos();
