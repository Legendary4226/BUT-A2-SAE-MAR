var shared_users = document.getElementById("init-clone");
var peopleCounter = document.querySelectorAll("new-user").length;
var users = document.getElementsByClassName("space-share")[0];

var userResponse = document.getElementById("new-person").value;

var addBtn = document.getElementById("add-shared-people");

document.getElementById("add-user-form").addEventListener("submit",(event)=>{
    event.preventDefault();
    var clone = shared_users.cloneNode(true);
    clone.id = "";
    clone.children[0].value = document.getElementById("new-person").value;
    clone.children[1].for = "permission-"+peopleCounter;
    clone.children[2].name = "permission-"+peopleCounter;
    clone.children[2].id = "permission-"+peopleCounter;
    peopleCounter++;
    users.appendChild(clone);
})

var deleteBtnExample = document.getElementById("delete-button-example").children[0];

var usersForm = document.querySelector(".form-edit-space-settings .space-share")
usersForm.addEventListener("click",(event)=>{
    if(event.target.nodeName == "svg")
    {
        event.target.parentNode.parentNode.remove();
    }
    else if(event.target.parentNode.nodeName == "svg")
    {
        event.target.parentNode.parentNode.parentNode.remove();
    }
})



