var modalButton = document.querySelector('.user-wrapper');
var modalBG = document.querySelector('.bg-modal');
var modalClose = document.querySelector('.close-button')

modalButton.addEventListener('click' , function(){
    modalBG.classList.add('bg-activee');
});

modalClose.addEventListener('click', function (){
    modalBG.classList.remove('bg-activee');
})
window.onclick = function(event) {
if (event.target == modalBG) {
    modalBG.classList.remove('bg-activee');
}
}

/* UNG NASA BABA PARA YAN SA ADD USER FORM*/ 
var modalButton = document.querySelector('.modal-btn');
var modal = document.querySelector('.modal-bg');
var modalClose = document.querySelector('.close')

modalButton.addEventListener('click' , function(){
    modal.classList.add('bg-active');
});

modalClose.addEventListener('click', function (){
    modal.classList.remove('bg-active');
})
window.onclick = function(event) {
  if (event.target == modal) {
    modal.classList.remove('bg-active');
  }
}






