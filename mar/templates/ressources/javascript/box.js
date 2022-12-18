/* Display / Hide the Left Box Menu */
let leftBoxMenu = document.getElementById("left-box-menu")
document.getElementById("left-box-button").addEventListener("click", () => {
    leftBoxMenu.classList.toggle("show")
})


/* Make SELECT trigger SUBMIT on change of value */
let selectSpaceForm = document.getElementsByClassName("form-choose-space")[0]
let selectSpace = document.getElementById("select-space")
selectSpace.addEventListener("change", () => {
    selectSpaceForm.dispatchEvent(new Event("submit"))
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

    if (event.target.nodeName == "svg") {
        event.preventDefault()
        
        // TODO DELETE ELEMENT
    }
})


/* Add Box */


