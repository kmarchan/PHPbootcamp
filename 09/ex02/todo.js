
function newToDo() {
    var    info = prompt("TO DO");
    var     l = info.length;
    if (info != null && l >= 1) {
        console.log(info);
        var toDo = document.createElement('div');
        
        
        toDo.id = 'toDo';
        toDo.classname = 'toDo';
        text = document.createTextNode(info);
        toDo.appendChild(text);
        ft_list.insertBefore(toDo, ft_list.firstChild);
        toDo.addEventListener("click", delToDo);
    }
}

function delToDo() {
    if (confirm("Task Complete?")) {
        this.parentElement.removeChild(this);
    }      
}
