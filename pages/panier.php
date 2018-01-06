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
                        if ($nbArticles <= 0)
                            echo '<tr><td>Votre panier est vide !</td></tr>';
                        else {
                            for ($i = 0; $i < $nbArticles; $i++) {
                                echo '<tr>';
                                echo '<td class="cart_product">';
                                echo '<a href=""><img src="images' . $liste[$i]['image'] . '" alt=""></a>'; //ajouter le lien en fonction de la page d'affichage de l'article
                                echo '</td>';

                                echo '<td class="cart_description">';
                                echo '<h4><a href="">' . $liste[$i]['nom_prod'] . '</a></h4>';
                                echo '</td>';

                                echo '<td class="cart_price">';
                                echo '<p>' . $liste[$i]['prix_unit'] . '</p>';
                                echo '</td>';

                                echo '<td class="cart_quantity">';
                                echo '<div class="cart_quantity_button">';
                                echo '<a class="cart_quantity_up" href=""> + </a>';
                                echo '<input class="cart_quantity_input" type="text" name="quantity" value="' . $liste[$i]['quantite'] . '" autocomplete="off" size="2">';
                                echo '<a class="cart_quantity_down" href=""> - </a>';
                                echo '</div></td>';

                                echo '<td class="cart_total">';
                                $total_ligne = montantLigne($liste[$i]['prix_unit'], $liste[$i]['quantite']);
                                echo '<p class="cart_total_price">' . $total_ligne . '</p>';
                                echo '</td>';

                                echo '<td class="cart_delete">';
                                echo '<a class="cart_quantity_delete" href=""><i class="fa fa-times"></i></a>';
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
                $sousTotal = montantGlobal();
                $livraison = fraisLivraison();
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