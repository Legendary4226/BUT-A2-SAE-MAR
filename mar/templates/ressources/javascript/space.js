let sharedUserInputs = document.getElementById("init-clone").cloneNode(true);
sharedUserInputs.removeAttribute("id")
let id = -1;
let usersFieldset = document.getElementsByClassName("space-share")[0];

/* Add shared user */
document.getElementById("add-user-form").addEventListener("submit",(event)=>{
    event.preventDefault();

    let clone = sharedUserInputs.cloneNode(true);
    clone.children[0].value = document.getElementById("new-person").value;
    clone.children[0].name = id;

    clone.children[1].for = id + ":permission";
    clone.children[2].id = id + ":permission";

    clone.children[2].name = id + ":permission";

    id--;
    usersFieldset.appendChild(clone);
})


/* Delete Shared User */
usersFieldset.addEventListener("click",(event)=>{
    let toDelete = false
    let clickedButton = event.target.parentElement
    let span = clickedButton.parentElement
    if (event.target.nodeName == "svg") {
        toDelete = true
    }
    if(event.target.nodeName == "path") {
        toDelete = true
        clickedButton = clickedButton.parentElement
        span = span.parentElement
    }

    if (toDelete) {
        let input = span.querySelector("input[type='email']")
        
        if (input.name < 0) {
            clickedButton.parentElement.remove()
            console.log(clickedButton.parentElement)
        } else {
            documentModified = true
            clickedButton.parentElement.classList.toggle("user-deleted")
            input.name += ":deleted"
        }
    }
})

/* Add Space */
let linkCreateSpace = document.getElementById("create-space");
linkCreateSpace.addEventListener("click", (event) => {
    let spaceName = prompt("Entrez le nom du nouvel espace :")

    if (spaceName == null || spaceName == "") {
        event.preventDefault();
        if (spaceName == "") alert("Erreur lors de votre saisie.")
        
    } else {
        documentModified = true
        linkCreateSpace.href += spaceName
    }
})

let saveBtn = document.getElementById("save-modification")

/* Save space share */
document.getElementById("save-modifications").addEventListener("click", () => {
    documentModified = false
    document.getElementById("submit-space-share").dispatchEvent(new MouseEvent("click"))
})