# Manuel de développement

## Objet du document
Ce manuel décrit la structure technique du site WordPress, l’usage des templates et Custom Post Types, ainsi que la procédure correcte pour transférer le site entre environnements.
Il est destiné aux interventions futures sur le projet.

---

## Principe fondamental

**Code = dans le thème enfant = versionné dans GitHub**  
**Contenu = dans WordPress = dans la base de données**

Exemples de *code* :
- thème enfant Astra
- templates PHP
- fonctions et CPT

Exemples de *contenu* :
- pages
- films
- menus
- médias
- formulaires

---

## Structure du thème

Le développement personnalisé repose sur un **thème enfant Astra**.

Emplacement :

```
/wp-content/themes/astra-child/
```

Fichiers principaux :

- `style.css`
- `functions.php`
- `single-film.php` (template d’affichage des films)
- `page-profile.php` (template des pages profil)

> Le thème enfant est versionné dans GitHub.

---

## Custom Post Type — Films

Un **Custom Post Type `film`** permet de gérer les fiches de films.

### Champs natifs WordPress
- **Titre**
- **Contenu / description**
- **Image mise en avant**

### Champs personnalisés (tous facultatifs)
- Année
- Titre original
- Durée
- Réalisation
- Scénario
- Image (direction photo)
- Son
- Montage
- Musique
- Production
- Coproduction
- Diffuseur
- Sélections / festivals
- Prix
- **URL Vimeo (lecteur intégré en bas de page)**

### Rendu

Le fichier `single-film.php` :
- affiche uniquement les champs renseignés
- insère un lecteur Vimeo en bas de page si une URL est fournie

---

## Templates de page

### `page-profile.php`
Template utilisé pour les pages profil et basé sur `the_content()`.

### CSS associé à l’image profil

```css
.bp-profile-photo {
  float: left;
  width: 260px;
  max-width: 45%;
  margin: 0 1.5rem 1rem 0;
  border-radius: var(--bp-radius);
  object-fit: cover;
}

@media(max-width: 700px) {
  .bp-profile-photo {
    float: none;
    width: 100%;
    max-width: 100%;
    margin: 0 0 1rem 0;
  }
}
```

---

## Transfert de contenu entre environnements

Le contenu est transféré via **Outils → Exporter / Importer**.

### Pré-requis sur la destination
- thème enfant installé et actif
- CPT `film` déclaré dans `functions.php`
- templates présents

### Export
Outils → Exporter → sélectionner les types à exporter  
→ télécharger le fichier `.xml`.

### Import
Outils → Importer → WordPress  
→ importer le `.xml`  
→ assigner un auteur  
→ importer les médias si proposé.

### Vérifications
- pages affichées
- films présents
- images visibles
- bons templates assignés

---

## Menus

Réglage dans : **Apparence → Menus → Gérer les emplacements**

---

## Formulaire de contact

Plugin : **Fluent Forms**

- formulaire simple (nom, email, message)
- affiché via shortcode
- envoi par SMTP **configuré en production**

---

## Hébergement et mise en ligne

### Développement
Effectué en local.

### Mise en ligne

1. acheter domaine + hébergement
2. installer WordPress en ligne
3. installer thème enfant
4. installer plugins
5. importer contenu
6. tester

### Exigences techniques
- PHP 8+
- SSL actif
- sauvegardes automatiques
- SMTP actif

---

## Bonnes pratiques

- ne modifier que le thème enfant
- versionner uniquement le code
- transférer contenu via export WP
- tester formulaire après migration
- vérifier accessibilité et performance
- optimiser les images

---

## Historique de version
- v1.1 — ajout CPT Films + Vimeo
- v1.0 — version initiale
