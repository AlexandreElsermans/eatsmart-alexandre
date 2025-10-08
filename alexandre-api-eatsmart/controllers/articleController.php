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
}

//$articleController = new ArticleController();
//$articleController->getAllArticles();

?>