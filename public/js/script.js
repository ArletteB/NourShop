
// ANIMATION DU TEXTE DE BIENVENUE

const textAnim = document.querySelector('.welcome');

new Typewriter(textAnim, {})

.typeString('Bienvenue sur NourShop')
.pauseFor(1000)
.start();

// Menu Toggle Navebar
const menuToggle = document.querySelector('#menu-btn')
if(menuToggle){
  menuToggle.addEventListener('click',toggleMenu)
function toggleMenu() {
    var x = document.querySelector(".menu-links");
    if (x.style.display === "flex") {
      x.style.display = "none";
    } else {
      x.style.display = "flex";
    }
  }
}





// Menu Toggle Dasboard

let toggle = document.querySelector('.toggle');
let navigationDash = document.querySelector('.navigationDash');
let main = document.querySelector('.main');

if (toggle){
  toggle.onclick = function(){
    navigationDash.classList.toggle('active');
    main.classList.toggle('active');
  }
  
}


//  Ajouter une class survolée dans l'élément de liste selectionné
let list = document.querySelectorAll('.navigationDash li');
function activeLink(){
    list.forEach((item) =>
    item.classList.remove('hovered'));
    this.classList.add('hovered');
}
if(list){
  list.forEach((item) =>
  item.addEventListener('mouseover', activeLink));
}


// Suprimer des Articles

let supprimer = document.querySelectorAll(".delete");
if(supprimer){
  
  for(let bouton of supprimer ) {
      bouton.addEventListener("click", function(){
        document.querySelector(".modal-footer a").href = `/admin/${this.dataset.id}/supprimer`
        document.querySelector(".modal-body").innerText = `Êtes-vous sûr(e) de vouloir supprimer l'article "${this.dataset.nom}"`
      })
  }
}





