// src/BlogBundle/Ressource/public/js/script.js

$(document).ready(function () {

    // Gestion du clignotement de l'alerte des commentaires signalé
    var value = false;
    setInterval(function(){
        value = !value;
        $(".signaled").css('opacity', Number(value))
    }, 500);
});
