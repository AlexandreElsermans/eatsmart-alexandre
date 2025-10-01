<?php

class CategorieModel {
    private $pdo;

    public function __construct(){
        try {
            $this->pdo = new PDO("mysql:host=localhost;dbname=eatsmart_bdd_alexandre;charset=utf8", "root", "");
            $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            die("Erreur de connexion à la base de données : " . $e->getMessage());
        }
    }
    
    public function getDBAllCategories()
    {
        $stmt = $this->pdo->query("SELECT * FROM categorie");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}

//$categorie1 = new CategorieModel();
//print_r($categorie1->getDBAllCategories());

?>