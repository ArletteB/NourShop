
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

// let toggle = document.querySelector('.toggle');
// let navigationDash = document.querySelector('.navigationDash');
// let main = document.querySelector('.main');

// if (toggle){
//   toggle.onclick = function(){
//     navigationDash.classList.toggle('active');
//     main.classList.toggle('active');
//   }
  
// }





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

let sidebar = document.querySelector(".sidebar");
let closeBtn = document.querySelector("#btn");
if (closeBtn){
  
  closeBtn.addEventListener("click", ()=>{
    sidebar.classList.toggle("open");
    menuBtnChange();//calling the function(optional)
  });
}

if(menuBtnChange){
  
  function menuBtnChange() {
   if(sidebar.classList.contains("open")){
     closeBtn.classList.replace("fa-bars", "fa-bars-alt-right");//replacing the iocns class
   }else {
     closeBtn.classList.replace("fa-bars-alt-right","fa-bars");//replacing the iocns class
   }
  }
}

// following are the code to change sidebar button(optional)





