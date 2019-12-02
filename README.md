# S01E01 Exercice

## Traitement d'une requête en PHP

### Objectifs

Réaliser le code minimal pour traiter une requête Web, dans l'esprit du Model-View-Controller et veillez à le faire en objet.

Les fonctionnalités de l'application sont :
- Afficher la page d'accueil : `/` ou `/index.php`
- Afficher une page contact : `/?page=contact` ou `/index.php?page=contact`

### Préalables

On va utiliser une classe App pour y mettre les quelques fonctions qui servent à organiser notre MVC fait maison. Il nous faut donc une classe App dans un fichier App.php

### Besoins #1

#### Intercepter une requête


> :hand: Via le protocole HTTP, la _matière première_ est **la requête**. Nous devons nous appuyer dessus pour identifier l'action à effectuer (selon ce que nous avons conçu évidemment).

- Créer une méthode `getRoute()` qui retourne la page à appeler, depuis le pamamètre `GET` `?page=nomdelapage`
- Appeler cette méthode pour récupérer la page demandée.
- Page par défaut
    - Si le paramètre GET de page n'est pas fourni, _la page à appeler est la page par défaut_ (`home`).
    - Par ex. `/index.php` (ou `/`)
- _L'afficher pour debug_, puis continuer une fois que cette étape est OK.

```php
// Exemple d'utilisation de la fonction
$page = $this->getRoute();
echo $page; // Affiche "home" ou "contact" etc.
```

#### Appeler la page correspondante

> :hand: Une fois la requête interceptée, on passe la main à une fonction qui va se charger d'exécuter la fonctionnalité attendue. Le _dispatcher_ va se charge de cet appel. Créons-le.
> Le dispatcher va appeler une méthode d'une autre classe, Controller

- Créer une méthode `App::dispatchRoute($page)` qui _appelle la page concernée via une fonction_, par ex. `Controller::home()`. On pourra faire usage : 
    - D'une suite de conditions.
    - ou De la fonction PHP [call_user_func](https://www.php.net/manual/fr/function.call-user-func.php#refsect1-function.call-user-func-examples).

#### Renvoyer une réponse

> :hand: L'objectif final de toute requête HTTP est le retour d'une réponse. Générons et affichons cette réponse.

- A l'intérieur de la fonction appelée, on pourra _retourner_, pour le moment :
    - Une vue HTML, en renvoyant du HTML (méthode `App::displayHtml()`).
        - On souhaite modifier le titre et le contenu de la page HTML.
        - On peut inclure des pages ou afficher du HTML directement.
            - Si besoin on séparera le header, le footer, le contenu.

### Besoins #2

#### Gestion des erreurs

> :hand: La gestion des erreurs ou cas limites doit toujours être appliquée avant de poursuivre trop avant. Ici on a deux cas d'erreurs générant une 404. Le _status code_ adéquat doit être fourni à la réponse.

- Page non trouvée #1
    - Si le paramètre GET de page n'est pas fourni ou qu'il est vide, _la page à appeler est la page 404_.
    - Par ex. `/index.php?page=`
    
- Page non trouvée #2
    - Si la page demandée ne peut être appelée on _renvoie une erreur HTTP 404_ (avec le bon _status code_).

- Créer une méthode qui affiche cette page.

#### Affichage de données

> :hand: En général les données sont stockées indépendamment du code qui les manipule. Nous aurons des fonctions d'accès aux données qui nous permettent de la manipuler pour pouvoir les afficher par exemple. Un type de données rendu bénéficie d'un _Content-Type_ adapté (HTML, JSON, etc.).

- Dans le template de chaque page, afficher les données fournies (voir fichier `data.php`).
    - Vous pouvez créer une méthode `getData($page)` qui retourne les données de la page en question.
    - Si besoin, trouver le moyen de transmettre des données arbitraires à la vue (un jeu de données plutôt que chaque donnée indépendemment).
    - Sur la page contact, générer le HTML des utilisateurs depuis le contrôleur ou depuis la vue selon votre implémentation.
- Créer une page _API_ qui devra retourner les données `users` sous forme de JSON.
    - URL = `/index.php?page=api`
    - Une méthode `displayJson()` peut être créée pour renvoyer le contenu JSON avec les entêtes HTTP correspondantes (lesquelles ?).

### Bonus

On n'a pas encore fait de modèle dans notre MVC ! Comme quoi c'est pas nécessaire. On pourrait créer un modèle pour les utilisateurs pour manipuler des objets au lieu de manipuler un tableau associatif.
