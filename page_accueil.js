const btn = document.getElementById("btn");
const topRow = document.querySelector(".top");
const midRow = document.querySelector(".mid");
const botRow = document.querySelector(".bot");
const responsiveNav = document.querySelector(".nav-list");


let open = false 
btn.addEventListener("click", () => {
    if (open === false) {
        topRow.style.transform = "translate(-10%, 15%) rotate(45deg)";
        midRow.style.display = "none";
        botRow.style.transform = "translate(-15%, -15%) rotate(-45deg)";
        responsiveNav.style.right = "-4.5rem";
    } else {
        topRow.style.transform = "translate(0, 0) rotate(0)";
        midRow.style.display = "block";
        botRow.style.transform = "translate(0, 0) rotate(0)";
        responsiveNav.style.right = "-100%";
    }
    open = !open
});
