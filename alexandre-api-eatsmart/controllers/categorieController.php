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
}

//$categorieController = new CategorieController();
//$categorieController->getAllCategories();

?>