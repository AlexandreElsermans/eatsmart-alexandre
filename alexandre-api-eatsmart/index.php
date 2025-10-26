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
    $method = $_SERVER['REQUEST_METHOD'];

    // On teste le premier segment pour déterminer la ressource demandée
    switch($url[0]) {
        case "articles" :
            switch($method){
                case "GET":
                    // Si un second segment est présent (ex: un ID), on l’utilise
                    if (isset($url[1])) {
                        if (!(isset($url[2]))) {
                            // Exemple : /articles/3 → affiche les infos de l'article 3
                            $articleController->getArticleByID($url[1]);
                        } elseif (isset($url[2]) && $url[2] == "commandes") {
                            $articleController->getCommandeByArticle($url[1]);
                        }
                    } else {
                        // Sinon, on affiche tous les articles
                        $articleController->getAllArticles();
                    }
                    break;

                case "POST":
                    $data = json_decode(file_get_contents("php://input"));
                    $articleController->createArt($data);
                    break;

                case "DELETE":
                    if(isset($url[1])){
                        $articleController->deleteArt($url[1]);
                    } else {
                       http_response_code(400);
                        echo json_encode(["message" => "id_article manquant dans l'URL"]);
                    }
                    break;

                case "PUT":
                    if (isset($url[1])) {
                        $data = json_decode(file_get_contents("php://input"), true);
                        $articleController->updateArticle($url[1], $data);
                    } else {
                        http_response_code(400);
                        echo json_encode(["message" => "id_article manquant dans l'URL"]);
                    }
                    break;
            }
            break;

        case "categories" :
            switch($method){
                case "GET":
                    if (isset($url[1])) {
                        if (!(isset($url[2]))) {
                            $categorieController->getCategorieById($url[1]);
                        } elseif (isset($url[2]) && $url[2] == "articles"){
                            $categorieController->getArticleByCat($url[1]);
                        }
                    } else {
                        $categorieController->getAllCategories();
                    }
                    break;

                case "POST":
                    $data = json_decode(file_get_contents("php://input"));
                    $categorieController->createCat($data);
                    break;
            }
            break;

        case "commandes" :
            if (isset($url[1])) {
                if (!(isset($url[2]))){
                    $commandeController->getCommandesByID($url[1]);
                } elseif (isset($url[2]) && $url[2] == "articles"){
                    $commandeController->getArtByCommande($url[1]);
                }
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