<?php
////////////////////////////////////////////////////
//Récupération des catégories
////////////////////////////////////////////////////
$cat = new CategorieDB($cnx);
$tabCat = $cat->getCategorie();
$nbCat = count($tabCat);

////////////////////////////////////////////////////
//Récupération des produits
////////////////////////////////////////////////////
if (isset($_GET['choix_cat'])) {
    $choix = $_GET['choix_cat'];
}

$prod = new Vue_produitsDB($cnx);
if (isset($choix)) {
    //si on a cliqué sur une catégorie, on affiche seulement les produits de cette catégorie
   // echo '<script>alert("choix existe")</script>';
    $liste = $prod->getVue_produitsByCat($choix);
} else {
    //si pas de clic sur une catégorie, on affiche tous les produits
   // echo '<script>alert("choix n existe pas")</script>';
    $liste = $prod->getVue_produits();
}

$total_produit = count($liste);
$max_par_ligne = 4;

?>

<section>
    <div class="container">
        <div class="row">
            <div class="col-sm-3">
                <div class="left-sidebar">
                    <h2>Catégories</h2>
                    <div class="panel-group category-products" id="accordian">

                        <?php
                        for ($i = 0; $i < $nbCat; $i++) {
                            ?>
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                  
                                    <h4 class="panel-title"><a href="index.php?page=produits.php&choix_cat=<?php print $tabCat[$i]->id_cat; ?>" data-target="<?php print $tabCat[$i]->id_cat; ?>"><?php print $tabCat[$i]->nom_cat; ?></a></h4>
                                </div> 
                            </div> 
                            <?php
                        }
                        ?>
                    </div>
                </div>
            </div>



            <div class="col-sm-9 padding-right">
                <div class="features_items"><!--features_items-->
                    <h2 class="title text-center">Nos produits</h2>
                    <div class="col-sm-4" id="productsContainer">



                       
                          <table>
                            <tr>
                                <?php 
                                for($i=0;$i<$total_produit;$i++){
                                    if($i!=0 && $i % $max_par_ligne == 0){
                                        echo '</tr><tr>';
                                    }
                                ?>
                                <td>
                                    <div class="product-image-wrapper">
                                        <div class="single-products">
                                            <div class="productinfo text-center">
                                                <img src="images2<?php print $liste[$i]['image']; ?>" alt="" />
                                                <h2><?php print $liste[$i]['prix_unit']; ?> €</h2>
                                                <p><?php print $liste[$i]['nom_prod']; ?></p>
                                                <a href="#" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Ajouter au panier</a>
                                            </div>

                                        </div>
                                        <div class="choose">
                                            <ul class="nav nav-pills nav-justified">
                                                <li><a href=""><i class="fa fa-plus-square"></i>Ajouter à la liste d'envies</a></li>
                                            </ul>
                                        </div>
                                    </div>
                                </td>
                                <?php
                        }
                        ?>
                            </tr>
                        </table>  
                        
                        


                    </div>
                    
                </div><!--features_items-->
            </div>
        </div>
    </div>
</section>