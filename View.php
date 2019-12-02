<?php

class View
{
    public function displayHTML($data)
    {
        echo '<!DOCTYPE html>
        <html lang="fr">
        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <meta http-equiv="X-UA-Compatible" content="ie=edge">
            <title>' . $data['title'] . '</title>
        </head>
        <body>
            ' . $data['content'] . '
        </body>
        </html>';
    }

    public function displayJSON($data)
    {
        // On précise le Content-type pour que le client (navigateur, appli ou autre) sache quoi faire de la réponse. On lui annonce qu'il s'agit de json pour qu'il traite la réponse comme un objet json et pas comme du HTML
        header('Content-type: application/json');
        return json_encode($data);
    }

    /**
     * On crée cette méthode pour générer le formulaire de contact
     * Le contrôleur doit surtout servir à manipuler les données et organiser la logique qui permet de générer la page
     * Cependant, tout ce qui concerne l'affichage devrait être réservé à la classe View pour bien séparer le M, le V et le C
     */
    public function generateContactForm($users)
    {
        $form = '<form><select name="recipient">';
        foreach ($users as $name => $email) {
            $form .= '<option value="'.$email.'">'.$name.'</option>';
        }
        $form .= '</select>';
        $form .= '<textarea name="message" id="" cols="30" rows="10"></textarea>';
        $form .= '<button type="submit">Envoyer</button>';
        $form .= '</form>';

        return $form;
    }
}