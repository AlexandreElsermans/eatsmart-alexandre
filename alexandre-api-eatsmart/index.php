<?php

require_once "C:\wamp64\www/eatsmart-alexandre\alexandre-api-eatsmart\controllers\articleController.php";
require_once "C:\wamp64\www/eatsmart-alexandre\alexandre-api-eatsmart\controllers\categorieController.php";
require_once "C:\wamp64\www/eatsmart-alexandre\alexandre-api-eatsmart\controllers\commandeController.php";

$articleController = new ArticleController();
$categorieController = new CategorieController();
$commandeController = new CommandeController();

// Vérifie si le paramètre "page" est vide ou non présent dans l'URL
if (empty($_GET["page"])) {
    // Si le paramètre est vide, on affiche un message d'erreur
    echo "La page n'existe pas";
} else {
    // Sinon, on récupère la valeur du paramètre "page"
    // Par exemple, si l’URL est : index.php?page=articles/3
    // Alors $_GET["page"] vaut "articles/3"
    
    // On découpe cette chaîne en segments, en séparant sur le caractère "/"
    // Cela donne un tableau, ex : ["articles", "3"]
    $url = explode("/", $_GET['page']);

    // On teste le premier segment pour déterminer la ressource demandée
    switch($url[0]) {
        case "articles" : 
            // Si un second segment est présent (ex: un ID), on l’utilise
            if (isset($url[1])) {
                // Exemple : /articles/3 → affiche les infos de l'article 3
                $articleController->getArticleByID($url[1]);
            } else {
                // Sinon, on affiche tous les articles
                $articleController->getAllArticles();
            }
            break;

        case "categories" :
            if (isset($url[1])) {
                $categorieController->getCategorieById($url[1]);
            } else {
                $categorieController->getAllCategories();
            }
            break;

        case "commandes" :
            if (isset($url[1])) {
                $commandeController->getCommandesByID($url[1]);
            } else {
                $commandeController->getAllCommandes();
            }
            break;

        // Si la ressource n'existe pas, on renvoie un message d’erreur
        default :
            echo "La page n'existe pas";
    }
}

?>