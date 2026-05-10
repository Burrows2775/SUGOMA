let ligneEnCours = 0;
let caseEnCours = 1; 
let motEcrit = firstLetter;

if (sauvegarde) {

    fetch('../include/sauvegarde.php')
        .then(reponse => reponse.json())
        .then(donnees => {

        donnees.forEach((tableau) => {
            tableau.forEach((valeur) => {
                let tab = valeur.split(";");

                let caseCible = document.getElementById("case-" + ligneEnCours + "-" + tab[1]);
                
                caseCible.innerText = tab[0];

                if (tab[2] == "V") { caseCible.className = "rouge"; }
                else if (tab[2] == "P") { caseCible.className = "jaune"; }
                else { caseCible.className == "bleu"; }

            });
            ligneEnCours++;
        });

        let ddd = document.getElementById("case-" + ligneEnCours + "-0");
        ddd.innerText = firstLetter;

    })

    .catch(erreur => {
        console.error("Erreur Fetch :", erreur);
    });

}

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
        
        console.log("Envoi :", motEcrit);

        fetch('../include/verif.php?motTape=' + motEcrit)
            .then(reponse => reponse.json())
            .then(donnees => {

            console.log("Réponse : ", donnees);

            if (donnees === "Nodico") {

                const element = document.getElementById('errcard');
                element.style.display = 'block';
                element.innerText = 'Ce mot n\'est point dans le dictionnaire';
                setTimeout(() => { element.style.display = 'none'; }, 5000);

                return 0;

            }
            
            for (let i = 0; i < LONGUEUR_MOT; i++) {
                
                let caseCible = document.getElementById("case-" + ligneEnCours + "-" + i);
                let statutPHP = donnees[0][i+1]; 

                let lettreCase = caseCible.innerText;
                let toucheVeriff = document.getElementById("letter-" + lettreCase);
                
                if (statutPHP === "V") {
                    caseCible.className = "rouge";
                    toucheVeriff.className = "rouge";
                } 
                else if (statutPHP === "P") {
                    caseCible.className = "jaune";
                    toucheVeriff.className = "jaune";
                }
                else {
                    toucheVeriff.className = "grisee";
                }
            }

            ligneEnCours++; 
            let premiereCaseNouvelleLigne = document.getElementById("case-" + ligneEnCours + "-0");
            
            if (premiereCaseNouvelleLigne) {
                caseEnCours = 1; 
                motEcrit = firstLetter; 
                premiereCaseNouvelleLigne.innerText = firstLetter; 
            } else {
                const element = document.getElementById('errcard');
                element.style.display = 'block';
                element.innerText = 'Fin de la partie !!!!!!!! Le mot était ' + donnees[1] + '.';
            }

        })
        .catch(erreur => {
            console.error("Erreur Fetch :", erreur);
        });

    } else {
            const element = document.getElementById('errcard');
            element.style.display = 'block';
            element.innerText = 'Le mot n\'est pas complet';
            setTimeout(() => { element.style.display = 'none'; }, 5000);
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

        const texteTouche = evenement.target.textContent.trim();

        if (evenement.target.textContent === '↺') {
            deleteLetter();
        }
        else if (evenement.target.textContent === '➔') {
            validerMot();
        }
        else if (texteTouche.match(/^[A-Z]$/)) {
            writeLetter(evenement.target.textContent);
        }

    });
});

// ---------------------------------------------------------------------------------------------

let btnReset = document.getElementById("reset");
btnReset.addEventListener('click', (evenement) => {

    window.location.replace("include/reset.php");

});