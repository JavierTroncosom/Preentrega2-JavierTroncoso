/*Estas funciones son para abrir y cerrar el menu del header en el celular*/
const menu = document.querySelector(".menu");
const openMenuBtn = document.querySelector(".open-menu");
const closeMenuBtn = document.querySelector(".close-menu"); 

function toggleMenu(){
    menu.classList.toggle("menu_abierto");
}

openMenuBtn.addEventListener("click",toggleMenu);
closeMenuBtn.addEventListener("click",toggleMenu);