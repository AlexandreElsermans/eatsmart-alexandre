<?php

class ArticleModel {
    private $pdo;

    public function __construct(){
        try {
            $this->pdo = new PDO("mysql:host=localhost;dbname=eatsmart_bdd_alexandre;charset=utf8", "root", "");
            $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            die("Erreur de connexion à la base de données : " . $e->getMessage());
        }
    }
    
    public function getDBAllArticles()
    {
        $stmt = $this->pdo->query("SELECT * FROM article");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getDBArticleById ($idArticle) {
        $stmt = $this->pdo->prepare("SELECT * FROM article WHERE id_article = :idArticle");
        $stmt->bindValue(":idArticle", $idArticle, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getDBCommandeByArticle($idArticle) {
        $requete = "SELECT assoc_article_commande.id_commande, commande.date_commande, article.nom 
        FROM `assoc_article_commande`
        JOIN commande ON commande.id_commande = assoc_article_commande.id_commande
        JOIN article ON article.id_article = assoc_article_commande.id_article
        WHERE assoc_article_commande.id_article = :idArt";
        $stmt = $this->pdo->prepare($requete);
        $stmt->bindValue(":idArt", $idArticle, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}

//$article1 = new ArticleModel();
//print_r($article1->getDBAllArticles());

?>