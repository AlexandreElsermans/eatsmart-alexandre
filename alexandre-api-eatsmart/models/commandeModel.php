<?php

class CommandeModel {
    private $pdo;

    public function __construct(){
        try {
            $this->pdo = new PDO("mysql:host=localhost;dbname=eatsmart_bdd_alexandre;charset=utf8", "root", "");
            $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            die("Erreur de connexion à la base de données : " . $e->getMessage());
        }
    }
    
    public function getDBAllCommandes()
    {
        $stmt = $this->pdo->query("SELECT * FROM commande");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getDBCommandesByID ($idCommande) {
        $stmt = $this->pdo->prepare("SELECT * FROM commande WHERE id_commande = :idCommande");
        $stmt->bindValue(":idCommande", $idCommande, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getDBArtByCommande ($idCommande) {
        $requete = "SELECT article.nom, article.prix, article.description 
        FROM `assoc_article_commande` JOIN article 
        ON article.id_article=assoc_article_commande.id_article
        WHERE id_commande = :idCommande";
        $stmt = $this->pdo->prepare($requete);
        $stmt->bindValue(":idCommande", $idCommande, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function createDBCom($data){
        $req1 = "INSERT INTO commande (id_commande, date_commande, prix_total, etat)
        VALUES (:idC, :dateC, :pxC, :etatC)
        ";
        $req2 = "INSERT INTO assoc_article_commande (id_article, id_commande, quantite_article)
        VALUES (:idA, :idCom, :quantA)
        ";

        $stmt1 = $this->pdo->prepare($req1);
        $stmt2 = $this->pdo->prepare($req2);

        $stmt1->bindParam(":idC", $data->id_commande, PDO::PARAM_INT);
        $stmt1->bindParam(":dateC", $data->date_commande, PDO::PARAM_STR);
        $stmt1->bindParam(":pxC", $data->prix_total, PDO::PARAM_INT);
        $stmt1->bindParam(":etatC", $data->etat, PDO::PARAM_STR);
        $stmt1->execute();

        foreach($data->articles as $articles){
            $stmt2->bindParam(":idA", $articles->id_article, PDO::PARAM_INT);
            $stmt2->bindParam(":idCom", $data->id_commande, PDO::PARAM_INT);
            $stmt2->bindParam(":quantA", $articles->quantite, PDO::PARAM_INT);
            $stmt2->execute();
        }

        return $this->getDBCommandesByID($data->id_commande);
    }
}

//$commande1 = new CommandeModel();
//print_r($commande1->getDBAllCommandes());

?>