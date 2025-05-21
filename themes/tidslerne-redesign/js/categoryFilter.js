document.cookie = "order=" + (localStorage.getItem('order') || 'desc') + "; path=/";
let order = localStorage.getItem('order') || 'desc';
const btn = document.getElementById('order-toggle');
const arrow = document.getElementById('order-arrow');
if(order === 'asc') arrow.classList.add('rotate-180');
btn.onclick = function() {
  order = (order === 'desc') ? 'asc' : 'desc';
  localStorage.setItem('order', order);
  location.reload();
}