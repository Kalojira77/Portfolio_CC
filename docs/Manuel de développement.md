# Manuel de développement  
*Travail en cours — à compléter au fil du projet*

## Objet du document  
Ce manuel décrit la structure technique du site WordPress, l’usage des templates de pages, ainsi que la procédure correcte pour transférer des pages entre environnements locaux. Il est destiné aux interventions futures sur le projet.

---

## Structure du thème

Le développement personnalisé repose sur un thème enfant Astra, versionné dans le dépôt GitHub.

Emplacement type :

/wp-content/themes/astra-child/

Contenu principal :

- style.css  
- functions.php  
- page-profile.php  (template des pages de profil)

Le thème enfant et ses fichiers constituent la partie code du projet et doivent être versionnés.

---

## Templates de page

### Template profil : `page-profile.php`  
Rôle : afficher les pages individuelles de présentation via `the_content()`.  
Le contenu est géré dans WordPress. Le template ne contient aucune donnée statique.

### CSS associé  

Classe utilisée pour styler l’image de profil intégrée au texte :

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

## Principe fondamental

Code (thème et templates) = versionné dans GitHub  
Contenu (pages, menus, médias) = stocké dans la base WordPress

---

## Transfert de pages entre environnements

Les pages sont transférées via l’outil natif WordPress.

### Prérequis sur la machine de destination

Le thème enfant doit être installé et actif, incluant le fichier `page-profile.php`.

---

### Export sur la machine source

Dans WordPress :

Outils → Exporter → sélectionner « Pages »  
Télécharger le fichier `.xml`.

Il est possible de sélectionner uniquement certaines pages.

---

### Import sur la machine de destination

Dans WordPress :

Outils → Importer → WordPress → importer le fichier `.xml`.

Pendant l’import :

- attribuer les pages à un auteur
- importer les médias si proposé

---

### Vérifications post-import

Dans « Pages » :

- les pages transférées doivent apparaître
- le bon template doit être appliqué
- les images doivent s’afficher correctement

Si certaines images manquent, les réimporter manuellement.

---

## Menus

Les menus existants sur la machine de destination peuvent être complétés en y ajoutant les nouvelles pages.

En cas de transfert de menus, utiliser l’export / import WordPress, puis réassigner les emplacements via :

Apparence → Menus → Gérer les emplacements

---

## Formulaire de contact (travail en cours)

Plugin prévu : Fluent Forms.

Objectifs :

- formulaire simple (nom, email, message)
- envoi vers l’adresse email de la cliente
- insertion via shortcode dans la page Contact
- configuration SMTP recommandée

Les réglages définitifs seront documentés lors de la mise en place.

---

## Bonnes pratiques

- ne modifier que le thème enfant  
- ne pas versionner la base de données  
- transférer le contenu via l’export WordPress  
- maintenir la documentation  
- veiller à la lisibilité et à l’accessibilité
