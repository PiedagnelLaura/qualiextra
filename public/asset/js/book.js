//Ajout fichier JS pour lancer l'action de réserver le package

//on sélectionne le formulaire de réservation
const btnReservation = document.querySelector("#form-book");

//place un écouteur au submit
btnReservation.addEventListener("submit", handleCalendarShow);

function handleCalendarShow(e) {
    //bloque le rechargement de la page à l'envoi
    e.preventDefault();

    //TODO il faut dynamiser le lien url du fetch car en dur pour le moment
    fetch('/packages/2', {
        method: "POST",
        body: JSON.stringify({
            "date": e.target[0].value
        })
      })
      //Permet de scroll vers le haut pour voir notre message flash
    .then(() => window.scrollTo(0,0))
    //permet de reload automatiquement la page pour afficher le message flash sans être redirigé
    .then(() => location.reload())

 

}  
