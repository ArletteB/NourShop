
// ANIMATION DU TEXTE DE BIENVENUE

const textAnim = document.querySelector('.welcome');

new Typewriter(textAnim, {})

.typeString('Bienvenue sur NourShop')
.pauseFor(1000)
.start();

const menuToggle = document.querySelector('#menu-btn')
menuToggle.addEventListener('click',toggleMenu)
function toggleMenu() {
    var x = document.querySelector(".menu-links");
    if (x.style.display === "flex") {
      x.style.display = "none";
    } else {
      x.style.display = "flex";
    }
  }






