<?php
$erreur = false;

$action = (isset($_POST['action'])? $_POST['action']:  (isset($_GET['action'])? $_GET['action']:null )) ;

if($action !== null)
{
   if(!in_array($action,array('ajout', 'suppression', 'modifier')))
   $erreur=true;

   //récuperation des variables en POST ou GET
   $id = (isset($_POST['id'])? $_POST['id']:  (isset($_GET['id'])? $_GET['id']:null )) ;
   $q = (isset($_POST['q'])? $_POST['q']:  (isset($_GET['q'])? $_GET['q']:null )) ;
   //$n = (isset($_POST['n'])? $_POST['n']:  (isset($_GET['n'])? $_GET['n']:null )) ;
   //$img = (isset($_POST['img'])? $_POST['img']:  (isset($_GET['img'])? $_GET['img']:null )) ;
   //$p = (isset($_POST['p'])? $_POST['p']:  (isset($_GET['p'])? $_GET['p']:null )) ;

   //Suppression des espaces verticaux
   $id = preg_replace('#\v#', '',$id);


   //On traite $q qui peut etre un entier simple ou un tableau d'entier
    
   if (is_array($q)){
      $QteArticle = array();
      $i=0;
      foreach ($q as $contenu){
         $QteArticle[$i++] = intval($contenu);
      }
   }
   else
   $q = intval($q);
   
   
   $p = new ProduitDB($cnx);
   $prod = $p->getProduitById($id);
   $n = $prod[0]->nom_prod;
   $img = $prod[0]->image;
   $p = $prod[0]->prix_unit;
   
    
}

if (!$erreur){
   switch($action){
      Case "ajout":
         ajouterArticle($id,$n,$img,$p);
         break;

      Case "suppression":
         supprimerArticle($id);
         break;

      Case "modifier" :
         for ($i = 0 ; $i < count($QteArticle) ; $i++)
         {
            modifierQteArticle($_SESSION['panier']['id_prod'][$i],round($QteArticle[$i]));
         }
         break;

      Default:
         break;
   }
}

?>




<section id="cart_items">
    <div class="container">
        <div class="breadcrumbs">
            <ol class="breadcrumb">
                <li><a href="index.php?page=accueil.php">Accueil</a></li>
                <li class="active">Panier</li>
            </ol>
        </div>
        <div class="table-responsive cart_info">
            <table class="table table-condensed">
                <thead>
                    <tr class="cart_menu">
                        <td class="image">Produit</td>
                        <td class="description"></td>
                        <td class="prix">Prix</td>
                        <td class="quantite">Quantité</td>
                        <td class="total">Total</td>
                        <td></td>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    if (creationPanier()) {
                        $liste = $_SESSION['panier'];
                        $nbArticles = compterArticle();
                        //var_dump($liste);
                        if ($nbArticles <= 0)
                            echo '<tr><td>Votre panier est vide !</td></tr>';
                        else {
                            $sousTotal = 0;                            
                          for ($i = 0; $i < $nbArticles; $i++) {
                                
                              
                              //print_r($liste);
                                echo '<tr>';
                                echo '<td class="cart_product">';
                                echo '<a href="index.php?page=detail.php&amp;idprod='. $liste['id_prod'][$i] .'"><div class="img-liste-prod" style="background-image:url(images'.$liste['image'][$i].')"></div></a>';
                                echo '</td>';

                                echo '<td class="cart_description">';
                                echo '<h4><a href="index.php?page=detail.php&amp;idprod='. $liste['id_prod'][$i] .'">' . $liste['nom_prod'][$i] . '</a></h4>';
                                echo '</td>';

                                echo '<td class="cart_price">';
                                echo '<p>' . $liste['prix_unit'][$i] . '</p>';
                                echo '</td>';

                                echo '<td class="cart_quantity">';
                                echo '<div class="cart_quantity_button">';
                                echo '<input class="cart_quantity_input" type="text" name="quantity" value="' . $liste['quantite'][$i] . '" autocomplete="off" size="2">';
                                echo '</div></td>';

                                echo '<td class="cart_total">';
                                $total_ligne = montantLigne($liste['prix_unit'][$i], $liste['quantite'][$i]);
                                $sousTotal += $total_ligne;
                                echo '<p class="cart_total_price">' . $total_ligne . '</p>';
                                echo '</td>';

                                echo '<td class="cart_delete">';
                                echo '<a class="cart_quantity_delete" href="index.php?page=panier.php&AMP;action=suppression&AMP;id='.$liste['id_prod'][$i].'"><i class="fa fa-times"></i></a>';
                                echo '</td>';
                                echo '</tr>';
                            }
                        }
                    }
                    ?>

                </tbody>
            </table>
        </div>
    </div>
</section> <!--/#cart_items-->

<section id="do_action">
    <div class="container">
        
        <div class="row">
            <div class="col-sm-6">
               
            </div>
            
            <?php
                $livraison = fraisLivraison($sousTotal);
                $total = $sousTotal + $livraison;
            
                echo '<div class="col-sm-6">';
                echo '<div class="total_area">';
                echo '<ul>';
                echo '<li>Sous-total <span>'.$sousTotal.' €</span></li>';
                echo '<li>Livraison <span>';
                if($livraison == 0)
                    echo 'Offerte';
                else
                    echo $livraison.' €';
                
                echo '</span></li>';
                echo '<li>Total <span>'.$total.' €</span></li>';
                echo '</ul>';
                echo '<a class="btn btn-default update" href="">Mettre à jour</a>';
                echo '<a class="btn btn-default check_out" href="">Valider le panier</a>';
                echo '</div>';
                echo '</div>';
            ?>
           
                
                    
                    
                
            
        </div>
    </div>
</section>