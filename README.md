# 🟥 SUGOMA

> Un clone de [SUTOM](https://sutom.nocle.fr) — lui-même inspiré du célèbre jeu télévisé **MOTUS** et également Wordle, avec quelques petites libertés bienvenues.

---

## C'est quoi SUGOMA ?

SUGOMA, c'est SUTOM, mais pour ceux qui veulent jouer à leur rythme.

Le principe reste le même : deviner un mot mystère lettre par lettre, en un nombre limité d'essais, avec des indicateurs colorés pour vous guider. La première lettre est toujours donnée. Le reste, c'est à vous.

Mais SUGOMA ajoute quelques twists :

- ⌨️ **Saisie au clavier physique** — plus besoin de cliquer sur chaque lettre dans le clavier virtuel, tapez directement depuis votre clavier.
- 🔄 **Reset à volonté** — marre du mot en cours ? Changez-en sans attendre minuit. Autant de fois que vous voulez.

---

## Fonctionnalités

| Fonctionnalité | État |
|---|---|
| Grille de jeu interactive | ✅ Disponible |
| Saisie au clavier physique | ✅ Disponible |
| Clavier virtuel cliquable | ✅ Disponible |
| Reset du mot à la demande | ✅ Disponible |
| Retour coloré (bonne place / mauvaise place / absent) | ✅ Disponible |
| Vérification du mot avant validation | 🚧 En cours |
| Écran de fin de partie (victoire / défaite) | 🚧 En cours |
| Notifications visuelles | 🚧 En cours |
| Animations & polish UI | 🚧 En cours |

---

## Captures d'écran

<img width="300" height=auto alt="Capture d’écran 2026-05-03 113610" src="https://github.com/user-attachments/assets/0566a8fb-c8cb-4956-a8bd-407132dcd68a" />

---

## Installation & lancement

jsp utilisez wamp ou laragon ou demandez à votre ia favorite

---

## Comment jouer ?

1. La première lettre du mot est affichée — c'est votre point de départ.
2. Tapez votre proposition au **clavier physique** (ou cliquez sur le clavier virtuel).
3. Appuyez sur **Entrée** pour valider.
4. Les cases changent de couleur :
   - 🟥 **Rouge** — bonne lettre, bonne position
   - 🟡 **Jaune** — lettre présente, mauvaise position
   - 🟦 **Bleu** — lettre absente du mot
5. Vous avez 6 essais pour trouver le mot.
6. Pas satisfait du mot ? Cliquez sur **Reset** pour en tirer un nouveau, sans attendre demain.

---

## Stack technique

- HTML / CSS / JavaScript vanille
- Aucun framework, aucune lib externe
- Quasi entièrement codé à la mano

---

## Roadmap

Les prochaines fonctionnalités prévues :

- [ ] Vérification que le mot proposé existe avant validation (dictionnaire)
- [ ] Écran de fin : victoire avec le nombre d'essais, défaite avec le mot révélé
- [ ] Notifications visuelles (mot invalide, mauvaise longueur, etc.)
- [ ] Animations sur les tuiles
- [ ] Statistiques de partie
- [ ] Mode sombre / clair

---

## Inspirations & crédits

- [SUTOM](https://sutom.nocle.fr) par [JonathanMM](https://framagit.org/JonathanMM/sutom).
- **MOTUS**, le jeu télévisé original diffusé sur France 2.

---
