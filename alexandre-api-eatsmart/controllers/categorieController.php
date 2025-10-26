<?php

require_once "models/CategorieModel.php";

class CategorieController {
    private $model;

    public function __construct(){
        $this->model = new CategorieModel();
    }

    public function getAllCategories(){
        $categories = $this->model->getDBAllCategories();
        echo json_encode($categories);
    }

    public function getCategorieById ($idCat) {
        $ligneCat = $this->model->getDBCategorieById($idCat);
        echo json_encode($ligneCat);
    }

    public function getArticleByCat ($idCat) {
        $articleByCat = $this->model->getDBArticleByCat($idCat);
        echo json_encode($articleByCat);
    }

    public function createCat($data){
        $newCat = $this->model->createDBCat($data);
        http_response_code(201);
        echo json_encode($newCat);
    }

    public function deleteCat($id){
        $success = $this->model->deleteDBCat($id);
        if ($success) {
            http_response_code(204);
        } else {
            http_response_code(404);
            echo json_encode(["message" => "categorie introuvable"]);
        }
    }

    public function updateCat($id, $data){
        $success = $this->model->updateDBCat($id, $data);
        if ($success){
            http_response_code(204);
        } else {
            http_response_code(404);
            echo json_encode(["message" => "categorie introuvable ou non modifiée"]);
        }
    }
}

//$categorieController = new CategorieController();
//$categorieController->getAllCategories();

?>