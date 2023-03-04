let open = document.getElementsByClassName('open');
let modal_container = document.getElementsByClassName('modal_container');
let close = document.getElementsByClassName('close');

open.addEventListener('click', () => {
  modal_container.classList.add('show');  
});

close.addEventListener('click', () => {
  modal_container.classList.remove('show');
});