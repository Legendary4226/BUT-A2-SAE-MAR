let boxElements = document.querySelector(".box-elements")

boxElements.addEventListener("click", (e) => {
    let button;

    switch(e.target.tagName){
        case 'path':
            button = e.target.parentElement.parentElement
            break;
        case 'svg':
            button = e.target.parentElement
            break;
        case 'BUTTON':
            button = e.target
            break;
        default:
            return;
    }

    if (button.classList.contains("action-delete")) {
        deleteElement(button.parentElement)
    }
    if (button.classList.contains("action-add")) {
        addElement(button.parentElement)
    }
})

let elementsOrder = JSON.parse(document.getElementById("elements-order").value)
let newId = -1

let noteClone = document.getElementById("template-note").cloneNode(true);
noteClone.removeAttribute("id")
let taskClone = document.getElementById("template-task").cloneNode(true);
taskClone.removeAttribute("id")

function addElement(element) {
    let choose = prompt("Choisissez un élément :\n• 1: Une note\n• 2: Une tâche\n?", "1");
    
    let clone = null;
    let childrens;
    switch(choose)
    {
        case null:
            return;

        case "1":
            clone = noteClone.cloneNode(true);
            childrens = clone.querySelector("div.element-body").children
            
            childrens[0].name = newId
            childrens[1].name = childrens[1].name.replace(/note-ID/, newId)

            break;

        case "2":
            clone = taskClone.cloneNode(true);
            childrens = clone.querySelector("div.element-body").children

            childrens[0].name = newId
            childrens[1].name = childrens[1].name.replace(/task-ID/, newId)
            childrens[2].name = childrens[2].name.replace(/task-ID/, newId)

            break;

        default:
            return;
    }

    let elementId = childrens[0].name
    element.parentElement.insertBefore(clone, element.nextSibling)
    elementsOrder.splice(elementsOrder.indexOf(elementId), 0, String(newId))

    newId--
}

function deleteElement(element) {
    let elementBody = element.querySelector("div.element-body")
    let elementId = elementBody.children[0].name

    if (elementId < 0) {
        element.remove()
    } else {
        elementBody.children[0].value += ":deleted"
        element.classList.add("deleted")
    }
}