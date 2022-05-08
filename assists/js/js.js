let log = document.querySelector('#log');
let login = document.querySelector('#login');
let regester = document.querySelector('#regester');
let sign = document.querySelector('#sign');

regester.style.display = "none";

log.addEventListener('click' , (e)=>{
    e.preventDefault();
    login.style.display =   "block";
    regester.style.display = "none";
})

sign.addEventListener('click' , (e)=>{
    e.preventDefault();
    login.style.display =   "none";
    regester.style.display = "block";
})