/*
 * Welcome to your app's main JavaScript file!
 *
 * We recommend including the built version of this JavaScript file
 * (and its CSS file) in your base layout (base.html.twig).
 */

// any CSS you import will output into a single css file (app.css in this case)
import './styles/app.css';

// start the Stimulus application
// import './bootstrap';

/* RESERVATION FORM */
/* Manage dateChaleurs input */
let input_femelle = document.getElementById('reservation_animal_sexe_1');
let input_sterilisation = document.getElementById('reservation_animal_sterilisation_1');
let chaleurs_group = document.querySelector('.chaleurs-group');
let date_chaleurs = document.getElementById('reservation_animal_dateChaleurs');

function manageDateChaleurs() {
    if (input_femelle.checked == true && input_sterilisation.checked == true) {
        chaleurs_group.style.visibility = 'visible';
        date_chaleurs.type = 'text';

    } else {
        chaleurs_group.style.visibility = 'hidden';
        date_chaleurs.type = 'hidden';
        date_chaleurs.value = '';
    }
}

let choix_sexe_sterilisation = document.querySelectorAll('input[name="reservation[animal][sexe]"], input[name="reservation[animal][sterilisation]"]');

choix_sexe_sterilisation.forEach((element) => {
    element.onclick = () => {
        manageDateChaleurs();
    }
})

/* Manage ordonnanceFile / traitement */
let input_medical = document.getElementById('reservation_animal_medical_0');
let file_group = document.querySelector('.file-group');
let file_input = document.getElementById('reservation_animal_ordonnance');
let traitement_group = document.querySelector('.traitement-group');
let traitement_input = document.getElementById('reservation_animal_traitement');

function manageOrdonnanceFile() {
    if (input_medical.checked == true) {
        file_group.style.visibility = 'visible';
        file_input.type = 'file';
        traitement_group.style.visibility = 'visible';
        traitement_input.required = true;
    } else {
        file_group.style.visibility = 'hidden';
        file_input.type = 'hidden';
        traitement_group.style.visibility = 'hidden';
        traitement_input.checked = false;
        traitement_input.required = false;
    }
}

let choix_medical = document.querySelectorAll('input[name="reservation[animal][medical]"]');

choix_medical.forEach((element) => {
    element.onclick = () => {
        manageOrdonnanceFile();
    }
})

/* Manage prix input */
let input_chien = document.getElementById('reservation_animal_type_0');
let input_chat = document.getElementById('reservation_animal_type_1');
let date_debut = document.getElementById('reservation_dateDebut');
let date_fin = document.getElementById('reservation_dateFin');
let prix_sejour = document.getElementById('reservation_prix');

function managePrix() {
    /* choix formule */
    let prix_choix_formule;
    if (input_chien.checked == true) {
        prix_choix_formule = 19;
    } else if (input_chat.checked == true) {
        prix_choix_formule = 16;
    } else {
        prix_choix_formule = 0;
    }

    /* split J-M-A date_debut */
    let jour_date_debut = date_debut.value.split('/')[0];
    let mois_date_debut = date_debut.value.split('/')[1];
    let annee_date_debut = date_debut.value.split('/')[2];

    /* split J-M-A date_fin */
    let jour_date_fin = date_fin.value.split('/')[0];
    let mois_date_fin = date_fin.value.split('/')[1];
    let annee_date_fin = date_fin.value.split('/')[2];

    /* format date_debut et date_fin */
    let format_date_debut = new Date(`${annee_date_debut}/${mois_date_debut}/${jour_date_debut}`);
    let format_date_fin = new Date(`${annee_date_fin}/${mois_date_fin}/${jour_date_fin}`);

    if (format_date_debut > format_date_fin) {
        alert("Erreur ! La date d'arrivée ne doit pas être postérieure à la date de départ !");
    }

    /* durée du séjour en nombre de jour (entre date_debut(inclut) et date_fin(inclut)) */
    let duree_sejour = 0;
    if (date_debut.value !== "" && date_fin.value !== "") {
        duree_sejour = Math.ceil(Math.abs(format_date_debut - format_date_fin) / (1000 * 60 * 60 * 24)) + 1;
    }

    /* Prix */
    let prix_total = prix_choix_formule * duree_sejour;
    let prix_final = prix_total.toFixed(2);
    prix_sejour.value = prix_final + " €";
}

let choix_type_date = document.querySelectorAll('input[name="reservation[animal][type]"], #reservation_dateDebut, #reservation_dateFin');

choix_type_date.forEach((element) => {
    element.onclick = () => {
        managePrix();
    }
    element.onchange = () => {
        managePrix();
    }
})

if (input_femelle) {
    onload = () => {
        manageDateChaleurs();
        manageOrdonnanceFile();
        managePrix();
    }
}

/* Calendrier dates input */
$(function () {
    $(".datepicker").datepicker({
        firstDay: 1,
        changeMonth: true,
        changeYear: true,
        dateFormat: "dd/mm/yy",
        dayNamesMin: ["Dim", "Lun", "Mar", "Mer", "Jeu", "Ven", "Sam"],
        monthNamesShort: ["Janvier", "Février", "Mars", "Avril", "Mai", "Juin", "Juillet", "Août", "Septembre", "Octobre", "Novembre", "Décembre"],
        yearRange: "2000:2050"
    });
});

/* MES RESERVATIONS */
/* Nombre de réservation */
let inputNbrReservation = document.querySelector(".nbrReservation");
let allStatus = document.querySelectorAll(".status");
let allReservationRow = document.querySelectorAll(".reservation-row");
let totalReservation = allReservationRow.length;
if(inputNbrReservation){
inputNbrReservation.textContent = totalReservation;
}

/* Menu Status */
if (allStatus[0]) {
    allStatus[0].onclick = () => {
        allReservationRow.forEach((element) => {
            if (element.childNodes[7].textContent === "Demande en cours de traitement") {
                element.style.visibility = "visible";
            } else {
                element.style.visibility = "collapse";
            }
        })
    }

    allStatus[1].onclick = () => {
        allReservationRow.forEach((element) => {
            if (element.childNodes[7].textContent === "Réservation validée") {
                element.style.visibility = "visible";
            } else {
                element.style.visibility = "collapse";
            }
        })
    }

    allStatus[2].onclick = () => {
        allReservationRow.forEach((element) => {
            if (element.childNodes[7].textContent === "Réservation refusée") {
                element.style.visibility = "visible";
            } else {
                element.style.visibility = "collapse";
            }
        })
    }

    allStatus[3].onclick = () => {
        allReservationRow.forEach((element) => {
            if (element.childNodes[7].textContent === "Réservation annulée") {
                element.style.visibility = "visible";
            } else {
                element.style.visibility = "collapse";
            }
        })
    }
}

/* Manage status box / Manage bouton modifier */
allReservationRow.forEach((element) => {
    if (element.childNodes[7].textContent === "Réservation validée") {
        element.childNodes[7].style.background = "rgb(40, 255, 112)";
        element.childNodes[9].style.display = "none";
    } else if (element.childNodes[7].textContent === "Réservation refusée") {
        element.childNodes[7].style.background = "rgb(234, 40, 255)";
        element.childNodes[9].style.display = "none";
    } else if (element.childNodes[7].textContent === "Réservation annulée") {
        element.childNodes[7].style.background = "rgb(255, 40, 40)";
        element.childNodes[9].style.display = "none";
    } else {
        element.childNodes[7].style.background = "#137edb";
        element.childNodes[9].style.display = "block";
    }
})

/* Debloquage avis client en fin de réservation */
let date_now = Date.now();

allReservationRow.forEach((element) => {

    let dateFin = element.childNodes[5].textContent;

    let jour_dateFin = dateFin.split('/')[0];
    let mois_dateFin = dateFin.split('/')[1];
    let annee_dateFin = dateFin.split('/')[2];

    dateFin = new Date(`${annee_dateFin}/${mois_dateFin}/${jour_dateFin}`);

    if (dateFin < date_now) {
        element.childNodes[9].style.display = "none";
        element.childNodes[11].style.display = "block";
    } else {
        element.childNodes[9].style.display = "block";
        element.childNodes[11].style.display = "none";
    }
})

/* Edit reservation -> Manage boutons */
let btn_submit = document.querySelector("#reservation_submit");
let btn_annuler = document.querySelector("#reservation_annuler");
let btn_valider = document.querySelector("#reservation_valider");
let btn_refuser = document.querySelector("#reservation_refuser");

if (btn_submit && btn_valider) {
    if (btn_submit.textContent === "Enregistrer les modifications") {
        btn_annuler.style.display = "block";
        btn_valider.style.display = "block";
        btn_refuser.style.display = "block";
    } else {
        btn_annuler.style.display = "none";
        btn_valider.style.display = "none";
        btn_refuser.style.display = "none";
    }
}