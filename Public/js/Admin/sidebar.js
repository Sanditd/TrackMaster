// JavaScript for Sidebar Expansion
const sidebar = document.getElementById("sidebar");
const logo = document.querySelector(".sidebar-logo");

logo.addEventListener("mouseenter", () => {
    sidebar.classList.add("expanded");
});

sidebar.addEventListener("mouseleave", () => {
    sidebar.classList.remove("expanded");
});
