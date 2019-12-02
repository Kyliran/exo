<?php

class Controller
{
    private $data;
    private $view;

    public function __construct()
    {
        include 'data.php';
        $this->data = $data;
        $this->view = new View();
    }

    /**
     * On créer un contrôleur qui va retourner la liste des users en json
     */
    public function api()
    {
        return $this->view->displayJSON($this->data['contact']['users']);
    }

    public function contact()
    {
        // dans data.php, la page contact a un title, un content et une liste d'utilisateurs qu'on peut contacter
        // Notre objectif est de retourner un le contenu de la page contact avec un formulaire de conact complet : un select avec le choix du destinataire, un textarea avec le message et le bouton submit

        // On récupère la liste des destinataires
        // Dans data.php, on retrouve un grand tableau associatif ù chaque clé est le nom d'une page. Pour la page contact, on retrouve les clés title et content mais aussi, la clé «users» avec la liste des destinataires dedans
        $users = $this->data['contact']['users'];
        // On s'en sert pour fabriquer notre formulaire

        $form = $this->view->generateContactForm($users);
        // Avec toutes ces concaténations on a créé un formulaire en HTML
        // Il faut maintenant ajouter ce formulaire au contenu de la page
        
        // On récupère d'abord le contenu de la page : 
        $pageContent = $this->data['contact'];
        // On modifie ensuite la valeur à la clé «content» de $pageContent
        $pageContent['content'] .= $form;
        
        // return $pageContent;
        // On a créé la classe View pour y centraliser des méthodes qui permettent de générer les réponses fournies par le contrôleur
        // Ainsi, c'est dans cahque méthode du contrôleur qu'on décide quelle méthode de View on choisit pour générer la page
        return $this->view->displayHTML($pageContent);
    }

    public function error404()
    {
        http_response_code(404);
        // return $this->data['404'];
        $this->view->displayHTML($this->data['404']);
    }

    public function home()
    {
        // return $this->data['home'];
        $this->view->displayHTML($this->data['home']);
    }

    public function mentionslegales()
    {
        // return $this->data['mentionslegales'];
        $this->view->displayHTML($this->data['mentionslegales']);
    }
}