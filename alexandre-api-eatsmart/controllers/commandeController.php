<?php

require_once "models/CommandeModel.php";

class CommandeController {
    private $model;

    public function __construct(){
        $this->model = new CommandeModel();
    }

    public function getAllCommandes(){
        $commandes = $this->model->getDBAllCommandes();
        echo json_encode($commandes);
    }

    public function getCommandesByID ($idCommande) {
        $ligneCommande = $this->model->getDBCommandesByID($idCommande);
        echo json_encode($ligneCommande);
    }

    public function getArtByCommande ($idCommande) {
        $artByCommande = $this->model->getDBArtByCommande($idCommande);
        echo json_encode($artByCommande);
    }

    public function createCom($data){
        $newCom = $this->model->createDBCom($data);
        http_response_code(201);
        echo json_encode($newCom);
    }
}

//$commandesController = new CommandeController();
//$commandesController->getAllCommandes();

?>