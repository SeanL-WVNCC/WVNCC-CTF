/*
    script.js
    Javascript for all of the pages. Currently, only controls the drop-down menus.
    Much of this code requires knowledge of the WAI-ARIA disclosure pattern. (https://www.w3.org/WAI/ARIA/apg/patterns/disclosure/)
*/

disclosureButtons = [];
currentDisclosureButton = null;
menuIsOpen = false;
/*
    HACK: Use the system time to prevent an opened menu from being immediately closed.
    If a menu is open, mousing over a closed menu closes the open menu and opens the hovered menu instead.
    Problem is — this does not play nice with touch devices which may trigger a brief hover event immediatly before a tap.
    We could check for touch input directly, but some devices (laptops) have both touch and mouse input.
*/
lastMenuOpenTime = Date.now();

/**
 * Expands the drop-down menu of a button that implements 
 * @param {Node} button HTML button element that opens the drop down.
 */
function expandButton(button)  {

    closeAllMenus();
    menuIsOpen = true;
    menu = document.getElementById(button.getAttribute("aria-controls"));
    if(menu) {
        menu.removeAttribute("hidden");
        button.setAttribute("aria-expanded", "true");
    }
    currentDisclosureButton = button;
    button.focus();
}

/**
 * Collapses the drop-down menu of a discosure button.
 * @param {Node} button HTML button element that opens the drop down.
 */
function unexpandButton(button)  {

    if(Date.now() - lastMenuOpenTime < 250) {
        return;
    }
    menuIsOpen = false;
    menu = document.getElementById(button.getAttribute("aria-controls"));
    if(menu) {
        menu.setAttribute("hidden", "");
        button.setAttribute("aria-expanded", "false");
    }
}

/**
 * Toggles the drop-down menu of a discosure button.
 * @param {Node} button HTML button element that opens the drop down.
 */
function toggleExpandButton(button)  {
    if(button.getAttribute("aria-expanded") == "true") {
        unexpandButton(button);
    } else {
        expandButton(button);
    }
}

/**
 * Handles onkeykeydown events for disclosure buttons.
 * @param {*} event An onkeydown event.
 */
function keypressEventDisclouseButton(event) {

    // Escape closes all open menues
    if(event.code == "Escape") {
        event.preventDefault();
        closeAllMenus();
        currentDisclosureButton.focus();
    
    // Down arrow expands the currently focused menu
    } else if(event.code == "ArrowDown") {
        event.preventDefault();
        expandButton(currentDisclosureButton);
        lastMenuOpenTime = Date.now();
    
    // Up arrow collapses the currently focused menu
    } else if(event.code == "ArrowUp") {
        event.preventDefault();
        unexpandButton(currentDisclosureButton);
    }
}

/**
 * Closes all of the drop down menus.
 */
function closeAllMenus() {
    disclosureButtons.forEach(button => {
        unexpandButton(button);
    });
}

function onPageLoad() {
    disclosureButtons = document.querySelectorAll("*[aria-expanded]");
    disclosureButtons.forEach(button => {
        button.onkeydown = keypressEventDisclouseButton;
        button.onclick = function(){
            if(!menuIsOpen) {
                lastMenuOpenTime = Date.now();
            }
            toggleExpandButton(button)
        };
        button.onmouseover = function() {
            if(menuIsOpen) {
                closeAllMenus();
                expandButton(button);
                menuIsOpen = true;
                lastMenuOpenTime = Date.now();
            }
        };
        button.onfocus = function() {
            currentDisclosureButton = button
        }
        containingElement = button.parentNode;
        containingElement.addEventListener('focusout', function(event) {
            if (!event.currentTarget.contains(event.relatedTarget)) {
                unexpandButton(button);
            }
        })
    });
}

window.onload = onPageLoad;
