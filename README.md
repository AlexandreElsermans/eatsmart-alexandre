# **Projet : EatSmart**

**Etudiant :** ELSERMANS Alexandre

---

### **1. Description du projet**

Programmation d’un site web marchand proposant de la nourriture avec gestion des menus et gestion d’un affichage précisant quand la commande est prête. De plus, une option historique des commandes devrait être accessible.

<img src="./assets/img/schema.PNG">

---

### **3. Fonctionnalités principales**

#### **3.1 Frontend (eatSmartFront)**

- **Fonctionnalité 1 :**  
  Présentation d’un menu
  
- **Fonctionnalité 2 :**  
  Présentation d’un historique de commande
  
#### **3.2 Backend (eatSmartBack)**

- **Fonctionnalité 1 :**  
  Gestion du menu selon les saisons et des stocks
  
- **Fonctionnalité 2 :**  
  Précision de l’état de la préparation

---

### **4. Technologies utilisées**

- **Frontend :** HTML/CSS/JS/PHP
- **Backend :** PHP/API REST
- **Base de données :** PHPmyAdmin/API REST

---

## Documentation MCD/MLD/MPD :

<img src="./assets/img/MCD.PNG">
---
<img src="./assets/img/MLD.PNG">
---
<img src="./assets/img/MPD.PNG">

---

## Endpoints de l'API

Adresse de l'API (en local) : http://localhost/alexandre-api-eatsmart/

Voici les différents endpoints de l'API : 
- `GET /articles` → Afficher la liste des articles
- `GET /articles/{id}` → Afficher l'article avec l'id égal à {id}
- `GET /categories` → Afficher la liste des catégories
- `GET /categories/{id}` → Afficher la catégorie avec l'id égal à {id}
- `GET /commandes` → Afficher la liste des commandes
- `GET /commandes/{id}` → Afficher la commande avec l'id égal à {id}
