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

    public function getDBCategorieById ($idCat) {
        $stmt = $this->pdo->prepare("SELECT *FROM categorie WHERE id_categorie = :idCat");
        $stmt->bindValue(":idCat", $idCat, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getDBArticleByCat($idCat) {
        $requete = "SELECT article.nom FROM article 
        JOIN categorie ON categorie.id_categorie = article.id_categorie
        WHERE categorie.id_categorie = :idCat";
        $stmt = $this->pdo->prepare($requete);
        $stmt->bindValue(":idCat", $idCat, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function createDBCat($data){
        $requete = "INSERT INTO categorie(id_categorie, nom)
        VALUES (:idCat, :nomCat)
        ";
        $stmt = $this->pdo->prepare($requete);
        $stmt->bindParam(":idCat", $data->id_categorie, PDO::PARAM_INT);
        $stmt->bindParam(":nomCat", $data->nom, PDO::PARAM_STR);
        $stmt->execute();
        return $this->getDBCategorieById($data->id_categorie);
    }

    public function deleteDBCat($id){
        $requete = "DELETE FROM categorie WHERE id_categorie = :id
        ";
        $stmt = $this->pdo->prepare($requete);
        $stmt->bindValue(":id", $id, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->rowCount() > 0;
    }

    public function updateDBCat($id, $data){
        $requete = "UPDATE categorie
        SET id_categorie = :idCat, nom = :nomCat
        WHERE id_categorie = :id
        ";
        $stmt = $this->pdo->prepare($requete);
        $stmt->bindParam(":idCat", $data["id_categorie"], PDO::PARAM_INT);
        $stmt->bindParam(":nomCat", $data["nom"], PDO::PARAM_STR);
        $stmt->bindParam(":id", $id, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->rowCount() > 0;
    }
}

//$categorie1 = new CategorieModel();
//print_r($categorie1->getDBAllCategories());

?>