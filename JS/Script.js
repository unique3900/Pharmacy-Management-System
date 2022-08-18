// Sidebar ko open/close icon lai responce dina
// function opensidemenu() {
//     document.getElementById('side').style.width = '280px';
//
// }
//
// function closesidemenu() {
//     document.getElementById('side').style.width = '0px';
//
// }

//toggle Sidebar
const menuBar = document.querySelector('.side_btn');
const sidebar = document.getElementById('sidebar');

menuBar.addEventListener('click', function () {
sidebar.classList.toggle('hide');
})

// Dark Teme ra light Theme ko lagi Js

/*
var icon=document.getElementById("icon");
var icon_logo=document.getElementById("icon_logo");
icon.onclick=function(){
document.body.classList.toggle("dark-theme");
if(document.body.classList.contains("dark-theme")){
    icon_logo.src="icons/sun.svg";
}
else{
    icon_logo.src="icons/moon.svg";
}
}
forEach((item, i) => {

});



// add hovered in selected List items
let list = document.querySelectorAll('.top_menu li');
function activeLink(){
  list.forEach((item) =>
    item.classList.remove('hovered'));
    this.classList.add('hovered');
  }
    list.forEach((item) =>
      item.addEventListener('mouseover',activeLink));
*/