var batiment = document.querySelectorAll('.batiment');
var flux = document.querySelector('.flux');

for(var i = 0; i< batiment.length; i++) {
    batiment[i].addEventListener('click', function(e){
        // j'empeche la redirection vers une autre Component, comportement par default d'un lien
        e.preventDefault();

        // je declare mon objet httpRequest qui est une instanciation de l'objet XMLHttpRequest
        var httpRequest = new XMLHttpRequest;

        // je cree une fontion pour executer du code a executer a fin du chargement
        httpRequest.onreadystatechange = function () {
            if(httpRequest.readyState === 4) {
                flux.innerHTML = httpRequest.responseText;
            }
        }

        // je cree la requete puis je l'envoie
        httpRequest.open('GET', this.getAttribute('href'), true);
        httpRequest.send();
    });
}  