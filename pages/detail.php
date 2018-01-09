<?php

if (isset($_GET['idprod'])) {
    $p = new ProduitDB($cnx);
    $produit = $p->getProduitById($_GET['idprod']);

    if (count($produit) == 1) {

        $a = new ArtisteDB($cnx);
        $artistes = $a->getArtisteByIdProd($produit[0]->id_prod);
        $nbA = count($artistes);
        //var_dump($artistes);
        $nom_art = $artistes[0]->nom_artiste;
        // print 'artiste 1 : '.$nom_art;
        if ($nbA > 1) {
            for ($i = 1; $i < $nbA; $i++) {
                $nom_art = $nom_art . ", " . $artistes[$i]->nom_artiste;
            }
        }

        echo '<table><tr class="product-information">';
        echo '<td rowspan="5"><div class="img-liste-prod" style="background-image:url(images' . $produit[0]->image . ')"></div></td>';
        echo '<td>' . $produit[0]->nom_prod . '</td>';
        echo '</tr><tr class="product-information">';
        echo '<td>' . $nom_art . '</td>';
        echo '</tr><tr class="product-information">';
        echo '<td>' . $produit[0]->prix_unit . '</td>';
        echo '</tr><tr class="product-information">';
        echo '<td>' . $produit[0]->descr_prod . '</td>';
        echo '</tr><tr class="product-information">';
        echo '<td><a href="index.php?page=panier.php&AMP;action=ajout&AMP;id=' . $produit[0]->id_prod . '" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Ajouter au panier</a></td>';
        echo '</tr></table>';
    } else
        echo 'Un problème est survenu. Veuillez nous en excuser';
}
else {
    include("./lib/php/erreur.php");
}
?>