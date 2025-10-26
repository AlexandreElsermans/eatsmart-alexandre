<?php

require_once "models/articleModel.php";

class ArticleController {
    private $model;

    public function __construct(){
        $this->model = new ArticleModel();
    }

    public function getAllArticles () {
        $articles = $this->model->getDBAllArticles();
        echo json_encode($articles);
    }

    public function getArticleByID ($idArticle) {
        $ligneArticle = $this->model->getDBArticleById($idArticle);
        echo json_encode($ligneArticle);
    }

    public function getCommandeByArticle($idArticle) {
        $commandeArticle = $this->model->getDBCommandeByArticle($idArticle);
        echo json_encode($commandeArticle);
    }

    public function createArt($data){
        $ligneArt = $this->model->createDBArt($data);
        http_response_code(201);
        echo json_encode($ligneArt);
    }

    public function deleteArt($id){
        $success = $this->model->deleteDBArt($id);
        if($success){
            http_response_code(204);
        } else {
            http_response_code(404);
            echo json_encode(["message" => "Article introuvable"]);
        }
    }

    public function updateArticle($id, $data){
        $success = $this->model->updateDBArticle($id, $data);
        if($success){
            http_response_code(204);
        } else {
            http_response_code(404);
            echo json_encode(["message" => "Article non trouvé ou non modifié"]);
        }
    }
}

//$articleController = new ArticleController();
//$articleController->getAllArticles();

?>