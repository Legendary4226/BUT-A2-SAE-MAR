let documentModified = false

/* verify save */
addEventListener('beforeunload', (e) => {
    if (documentModified){
        e.preventDefault();
        return e.returnValue = "modified";
    }
})