function toggleClassActive(id) {
    id.classList.toggle("active");
}

/* The purpose of this is to determine when the transition for the mobile menu has ended */
function menuAnimation(id, sid) {
    /* First we check if the menu is already open */
    if (id.classList.contains("active")) {
        /* If it is we add the menu_closing class */
        id.classList.add("menu_closing");
        /* When the css transition ends we remove the menu_closing class */
        sid.ontransitionend=() => {
            id.classList.remove("menu_closing");
        };
    }
    /* Similar to above but if the menu is closed */
    else {
        id.classList.add("menu_opening")
        sid.ontransitionend=() => {
            id.classList.remove("menu_opening");
        };
    }

}

/* This combines the previous two functions to create a smooth scrolling animation for the mobile menu */
function smoothScroll(id, sid) {
    /* We first call the menuAnimation function, in the css page when one of these classes is added it will trigger a transition, when that transition has ended */
    menuAnimation(id, sid);
    /* the class is removed and the active class is toggled. */
    toggleClassActive(id);
}

function scrollAnimation(pid, string) {
    if (pid.classList.contains("dashboard")) {
        pid.classList.toggle("dashboard");
        pid.classList.add(string);
        pid.classList.add("animate");
        pid.ontransitionend=() => {
            pid.classList.remove("animate");
        }
    }
    if (pid.classList.contains("appointments")) {
        pid.classList.remove("appointments");
        pid.classList.add(string);
        pid.classList.add("animate");
        pid.ontransitionend=() => {
            pid.classList.remove("animate");
        }
    }
    if (pid.classList.contains("prescriptions")) {
        pid.classList.remove("prescriptions");
        pid.classList.add(string);
        pid.classList.add("animate");
        pid.ontransitionend=() => {
            pid.classList.remove("animate");
        }
    }
    if (pid.classList.contains("tests")) {
        pid.classList.remove("tests");
        pid.classList.add(string);
        pid.classList.add("animate");
        pid.ontransitionend=() => {
            pid.classList.remove("animate");
        }
    }
}