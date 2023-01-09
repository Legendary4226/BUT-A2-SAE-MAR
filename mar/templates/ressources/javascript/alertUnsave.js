let documentModified = false

/* verify save */
addEventListener('beforeunload', (e) => {
    e.preventDefault();
    if (documentModified){
        return e.returnValue = "modified";
    }
})