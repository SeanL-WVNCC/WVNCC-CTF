
// Functions for the dropdowns in the nav

function expandButton(elementId)  {
    element = document.getElementById(elementId);
    menu = document.getElementById(element.getAttribute("aria-controls"));
    menu.removeAttribute("hidden");
    element.setAttribute("aria-expanded", "true");
}
function unexpandButton(elementId)  {
    element = document.getElementById(elementId);
    menu = document.getElementById(element.getAttribute("aria-controls"));
    menu.setAttribute("hidden", "");
    element.setAttribute("aria-expanded", "false");
}
function toggleExpandButton(elementId)  {
    element = document.getElementById(elementId);
    if(element.getAttribute("aria-expanded") == "true") {
        unexpandButton(elementId);
    } else {
        expandButton(elementId);
    }
}
function keypressEventDisclouseButton(event) {
    if(event.code == "Escape") {
        // No one ever remembers this part
        event.preventDefault();
        console.log(event);
        disclosureButtons.forEach(button => {
            unexpandButton(button.id);
        });
        currentDisclosureButton.focus();
    } else if(event.code == "ArrowDown") {
        expandButton(currentDisclosureButton.id);
        event.preventDefault();
    } else if(event.code == "ArrowUp") {
        unexpandButton(currentDisclosureButton.id);
        event.preventDefault();
    }
}

function onPageLoad() {
    console.log(document.querySelectorAll("*[aria-expanded]"))
    //document.getElementById("").onkeydown = keypressEventDisclouseButton;
    //navItems.onkeydown = keypressEventNavItem;
}
window.onload = onPageLoad;