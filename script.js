let ligneEnCours = 0;
let caseEnCours = 1; 
let motEcrit = firstLetter;

function writeLetter(letter) {
    if (caseEnCours < LONGUEUR_MOT) {
        let caseCible = document.getElementById("case-" + ligneEnCours + "-" + caseEnCours);
        caseCible.innerText = letter;
        caseEnCours++;
        motEcrit += letter;
    }
}

function deleteLetter() {
    if (caseEnCours > 1) { 
        caseEnCours--;
        let caseCible = document.getElementById("case-" + ligneEnCours + "-" + caseEnCours);
        caseCible.innerText = "";
        motEcrit = motEcrit.slice(0, -1);
    }
}

function validerMot() {

    if (caseEnCours === LONGUEUR_MOT) {
        
        console.log("Envoi PHP :", motEcrit);
        fetch('verif.php?motTape=' + motEcrit).then(reponse => reponse.json()).then(donnees => {

            console.log("Réponse du serveur :", donnees);

            if (donnees === "Nodico") {

                const element = document.getElementById('errcard');
                element.style.display = 'block';
                element.innerText = 'Ce mot n\'existe pas mon gourmand';
                setTimeout(() => { element.style.display = 'none'; }, 5000);

                return 0;

            }
            
            for (let i = 0; i < LONGUEUR_MOT; i++) {
                
                let caseCible = document.getElementById("case-" + ligneEnCours + "-" + i);
                let statutPHP = donnees[i + 1]; 

                let lettreCase = caseCible.innerText;
                let toucheVeriff = document.getElementById("letter-" + lettreCase);
                
                if (statutPHP === "Valide") {
                    caseCible.className = "rouge";
                    toucheVeriff.className = "rouge";
                } 
                else if (statutPHP === "Presente") {
                    caseCible.className = "jaune";
                    toucheVeriff.className = "jaune";
                }
                else if (statutPHP === "Invalide") {
                    toucheVeriff.className = "grisee";
                }
                else {
                    // Le grand vide
                }
            }

            ligneEnCours++; 
            let premiereCaseNouvelleLigne = document.getElementById("case-" + ligneEnCours + "-0");
            
            if (premiereCaseNouvelleLigne) {
                caseEnCours = 1; 
                motEcrit = firstLetter; 
                premiereCaseNouvelleLigne.innerText = firstLetter; 
            } else {
                console.log("Fin du jeu !");
            }

        })
        .catch(erreur => {
            console.error("Erreur Fetch :", erreur);
        });

    } else {
        console.log("Le mot n'est pas complet !");
    }

}

// Clavier physique ----------------------------------------------------------------------------

document.addEventListener("keydown", function(event) {
    
    let touche = event.key.toUpperCase(); 

    if (touche.match(/^[A-Z]$/)) {
        writeLetter(touche);
    }

    if (event.key === "Backspace") {
        deleteLetter();
    }

    if (event.key === "Enter") {
        validerMot();
    }
});


// ---------------------------------------------------------------------------------------------

// Clavier virtuel -----------------------------------------------------------------------------

const toutesLesTouches = document.querySelectorAll('keyboard table tr *');
toutesLesTouches.forEach((touche) => {
    touche.addEventListener('click', (evenement) => {

        if (evenement.target.textContent === '↺') {
            deleteLetter();
        }
        else if (evenement.target.textContent === '➔') {
            validerMot();
        }
        else {
            writeLetter(evenement.target.textContent);
        }

    });
});

// ---------------------------------------------------------------------------------------------

let btnReset = document.getElementById("reset");
btnReset.addEventListener('click', (evenement) => {

    window.location.replace("reset.php");

});