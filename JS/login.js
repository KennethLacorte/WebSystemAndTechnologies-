const wrapper = document.querySelector('.wrapper');
const formBox = document.querySelector('.form-box.login'); // Corrected selector
const btnLogin = document.querySelector('.btnLogin-popup');
const iconClose = document.querySelector('.icon-close');

formBox.addEventListener('submit', (event) => {
    event.preventDefault();
    wrapper.classList.add('active');
    btnLogin.style.display = 'none';
});

btnLogin.addEventListener('click', () => {
    wrapper.classList.add('active-popup');
    btnLogin.style.display = 'none';
});

iconClose.addEventListener('click', () => {
    wrapper.classList.remove('active-popup');
    btnLogin.style.display = 'block'; 
});
