let contrasteAtivo = false;

document.querySelector('.contraste').addEventListener('click', function () {
    contrasteAtivo = !contrasteAtivo;
    
    if (contrasteAtivo) {
        // Alto contraste ez demais ze
        this.style.backgroundColor = 'yellow';
        this.style.color = 'black';
        document.body.style.backgroundColor = 'black';
        document.querySelector('.lorem').style.color = 'white';
        document.querySelector('footer').style.color = 'white';
        document.querySelector('header h1').style.color = 'gray';
    } else {
        // Normal
        this.style.backgroundColor = '';
        this.style.color = '';
        document.body.style.backgroundColor = '';
        document.querySelector('.lorem').style.color = '';
        document.querySelector('footer').style.color = '';
        document.querySelector('header h1').style.color = ''
    }
});