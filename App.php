<?php

class App
{
    public function dispatchRoute($page)
    {
        $controller = new Controller();
        // On appelle la méthode dont le nom est précisé dans la variable $page
        // On peut appeler la méthode de cette façon : 
        // $data = $controller->$page();
        // Le contrôleur va retourner un tableau associatif qu'on récupère dans $data

        // On pourraut aussi utiliser une fonction de PHP qui serait juster à appeler une fonction proprement avec un nom qui est dans une variable
        // call_user_func([$controller, $page]);

        // On envoie $data à displayHTML qui est la méthode de App qui affiche la page selon le contenu de $data
        // $data est donc toujours un tableau associatif avec une clé 'title' et une clé 'content'
        // $this->displayHTML($data);

        echo $controller->$page();
    }

    // On supprime cette méthode parce qu'on crée une classe View qui fera ce travail
    // public function displayHTML($data)
    // {
    //     echo '<!DOCTYPE html>
    //     <html lang="fr">
    //     <head>
    //         <meta charset="UTF-8">
    //         <meta name="viewport" content="width=device-width, initial-scale=1.0">
    //         <meta http-equiv="X-UA-Compatible" content="ie=edge">
    //         <title>' . $data['title'] . '</title>
    //     </head>
    //     <body>
    //         ' . $data['content'] . '
    //     </body>
    //     </html>';
    // }

    public function getRoute()
    {
        // On teste si l'URL nous précise une page à afficher
        if (isset($_GET['page'])) {
            // Si c'est le cas, on retourne le nom de page, mais seulement si elle existe
            if (method_exists('Controller', $_GET['page'])) {
                return $_GET['page'];
            } else {
                // Si la page demandée n'existe pas, on retourne une 404
                return 'error404';
            }
        } else {
            // Sinon, sans ?page=xxxx dans l'url, on retourne la page «home»
            return 'home';
        }
    }
}