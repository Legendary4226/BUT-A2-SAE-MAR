/* Display / Hide the Left Box Menu */
let leftBoxMenu = document.getElementById("left-box-menu")
document.getElementById("left-box-button").addEventListener("click", () => {
    leftBoxMenu.classList.toggle("show")
})


/* Make SELECT trigger SUBMIT on change of value to SWITCH SPACE */
let selectSpace = document.getElementById("select-space")
selectSpace.addEventListener("change", () => {
    document.getElementById("submit-space-switch").click()
})

/* Add Box */
let formBoxs = document.getElementsByClassName("form-boxs")[0]
let submitBoxsChange = document.getElementById("submit-boxs-change")
let addBoxClone = document.getElementById("add-box-clone").cloneNode(true)
addBoxClone.removeAttribute("id")
let newBoxsId = -1

document.getElementById("add-box").addEventListener("click", () => {
    addBoxClone.querySelector("input").name = newBoxsId
    newBoxsId--
    formBoxs.appendChild(addBoxClone.cloneNode(true))
})


/* Cancel <a> click event on <input> of Boxs */
let selectBoxForm = document.getElementsByClassName("form-boxs")[0]
selectBoxForm.addEventListener("click", (event) => {
    if (event.target.nodeName == "INPUT") {
        event.preventDefault()

        if (event.detail === 2) {
            event.target.select()
        }
    }


    /* Delete Box */
    let trash = false
    let aParent = null
    if (event.target.nodeName == "svg" && event.target.classList.contains("svg-icon-trash-can")) {
        event.preventDefault()
        aParent = event.target.parentElement
        trash = true
    }
    if (event.target.nodeName == "path" && event.target.parentElement.classList.contains("svg-icon-trash-can")) {
        event.preventDefault()
        aParent = event.target.parentElement.parentElement
        trash = true
    }

    if (trash) {
        aParent.classList.toggle("deleted")
        if (aParent.querySelector("input").name < 0) {
            aParent.remove()
        } else {
            aParent.querySelector("input").name += "-deleted"
        }
    }
})


/* Save boxs change */
document.getElementById("save-boxs-change").addEventListener("click", () => {
    submitBoxsChange.dispatchEvent(new MouseEvent("click"))
})

