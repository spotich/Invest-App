let navItemGroup = document.getElementById("nav-item-group");
let navItems = navItemGroup.getElementsByClassName("nav-item");

const activePage = window.location.pathname;

for (let i = 0; i < navItems.length; i++) {
    let link = navItems[i].getElementsByClassName("nav-link")[0].getAttribute("href");
    if (link === activePage ) {
        navItems[i].classList.add('active-item');
    }
}