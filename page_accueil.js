const btn = document.getElementById("btn");
const topRow = document.querySelector(".top");
const midRow = document.querySelector(".mid");
const botRow = document.querySelector(".bot");
const responsiveNav = document.querySelector(".nav-list");

let open = false;

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
    open = !open;
});

const applyCardMouseEffect = (el) => {
    el.addEventListener("mousemove", (e) => {
        let elRect = el.getBoundingClientRect();
        let x = e.clientX - elRect.x;
        let y = e.clientY - elRect.y;
        let midCardHeight = elRect.width / 2;
        let midCardWidth = elRect.width / 2;
        let angleY = -(x - midCardWidth) / 2;
        let angleX = (y - midCardHeight) / 2;
        el.children[0].style.transform = `rotateX(${angleX}deg) rotateY(${angleY}deg) scale(1)`;
    });

    el.addEventListener("mouseleave", () => {
        el.children[0].style.transform = "rotateX(0) rotateY(0)";
    });
};

const card = document.querySelectorAll(".card");
card.forEach(applyCardMouseEffect);

const card2 = document.querySelectorAll(".card2");
card2.forEach(applyCardMouseEffect);
