<?php

function creationPanier(){
    if(!isset($_SESSION['panier'])){
        $_SESSION['panier']=array();
        $_SESSION['panier']['id_prod']=array();
        $_SESSION['panier']['nom_prod']=array();
        $_SESSION['panier']['image']=array();
        $_SESSION['panier']['prix_unit']=array();
        $_SESSION['panier']['quantite']=array();
        $_SESSION['panier']['verrou'] = false;
    }
    return true;
}


function ajouterArticle($id_prod,$nom_prod,$image,$prix_unit,$quantite){
    //Si le panier existe
    if(creationPanier() && !isVerrouille()){
        //Si le produit existe déjà, on ajoute seulement la quantité
        $positionProduit = array_search($id_prod, $_SESSION['panier']['id_prod']);
        
        if($positionProduit !== false){
            $_SESSION['panier']['quantite'][$positionProduit] += $quantite;
        }
        else{
            //Sinon on ajoute le produit
            array_push($_SESSION['panier']['id_prod'], $id_prod);
            array_push($_SESSION['panier']['nom_prod'], $nom_prod);
            array_push($_SESSION['panier']['image'], $image);
            array_push($_SESSION['panier']['prix_unit'], $prix_unit);
            array_push($_SESSION['panier']['quantite'], $quantite);
        }
        
    }
    else
        echo '<script>alert("Un problème est survenu, veuillez nous en excuser")</script>';
    
}


function supprimerArticle($id_prod){
    //si le panier existe
    if(creationPanier() && !isVerrouille())
    {
        //Nous allons passer par un panier temporaire
        $tmp=array();
       $tmp['id_prod']=array();
       $tmp['nom_prod']=array();
       $tmp['image']=array();
       $tmp['prix_unit']=array();
       $tmp['quantite']=array();
       $tmp['verrou'] =  $_SESSION['panier']['verrou'];
       
       for($i=0; $i < count($_SESSION['panier']['id_prod']); $i++){
           if($_SESSION['panier']['id_prod'][$i] !== $id_prod){
               array_push($tmp['id_prod'], $_SESSION['panier']['id_prod'][$i]);
               array_push($tmp['nom_prod'], $_SESSION['panier']['nom_prod'][$i]);
               array_push($tmp['image'], $_SESSION['panier']['image'][$i]);
               array_push($tmp['prix_unit'], $_SESSION['panier']['prix_unit'][$i]);
               array_push($tmp['quantite'], $_SESSION['panier']['quantite'][$i]);
           }
       }
       //On remplace le panier en session par notre panier temporaire à jour
       $_SESSION['panier'] = $tmp;
       //on efface notre panier temporaire
       unset($tmp);
    }
    else
        echo '<script>alert("Un problème est survenu, veuillez nous en excuser")</script>';
    
}


function modifierQteArticle($id_prod, $quantite){
    //si le panier existe
    if(creationPanier() && !isVerrouille()){
        //si la quantité est positive, on modifie sinon on supprime l'article
        if($quantite > 0){
            //recherche du produit dans le panier
            $positionProduit = array_search($id_prod, $_SESSION['panier']['id_prod']);
            
            if($positionProduit !== false){
                $_SESSION['panier']['quantite'][$positionProduit] = $quantite;
            }
        }
        else
            supprimerArticle ($id_prod);
    }
    else
        echo '<script>alert("Un problème est survenu, veuillez nous en excuser")</script>';
}

function montantLigne($prix,$qte){
    $t = $prix * $qte;
    return $t;
}


function montantGlobal(){
    $total = 0;
    
    for($i = 0; $i < count($_SESSION['panier']['id_prod']); $i++){
        $total += $_SESSION['panier']['quantite'][$i] * $_SESSION['panier']['prix_unit'];
    }
    return $total;
}


function fraisLivraison(){
    
    if(montantGlobal()>35)
        $frais = 0;
    else
        $frais = 5;
    return $frais;    
}

function isVerrouille(){
    if(isset($_SESSION['panier']) && $_SESSION['panier']['verrou'])
        return true;
    else
        return false;
}


function compterArticle(){
    if(isset($_SESSION['panier']))
        return count($_SESSION['panier']['id_prod']);
    else
        return 0;
}


function supprimePanier(){
    unset($_SESSION['panier']);
}