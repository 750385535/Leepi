
// Firefox, Google Chrome, Opera, Safari, Internet Explorer from version 9
function OnInput(event) {
//            alert ("The new content: " + event.target.value);
}

// Internet Explorer
function OnPropChanged(event) {
    if (event.propertyName.toLowerCase() == "value") {
//                alert ("The new content: " + event.srcElement.value);
    }
}