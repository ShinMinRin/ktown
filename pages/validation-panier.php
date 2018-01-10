<?php
if (isset($_POST['valide_panier'])) {
    //////////////////////////////
    //Ajout du client
    /////////////////////////////
    $c = new ClientDB($cnx);
    $c->addClient($_POST);

    $id_client = $c->getLastClient();

    ////////////////////////////
    //Ajout de la commande
    ///////////////////////////
    $l = $_SESSION['panier'];
    $nb = compterArticle();

    $t = 0;
    for ($i = 0; $i < $nb; $i++) {
        $t += $l['prix_unit'][$i] * $l['quantite'][$i];
    }



    $cm = new CommandeDB($cnx);
    $cm->addCommande($id_client[0], $t);

    $id_cde = $cm->getLastCommande();

    //var_dump($l);

    $cm->addDetailCde($id_cde[0], $l, $nb);
}
?>



<div class="shopper-informations">
    <div class="row">
        <div class="col-sm-3"></div>

        <div class="col-sm-5 clearfix">
            <div class="bill-to">
                <p>Informations client</p>
                <div class="form-one">
                    <form action="<?php print $_SERVER['PHP_SELF']; ?>" method="post" id="form-validation">
                        <input type="text" placeholder="Nom" name="nom" required="required">
                        <input type="text" placeholder="Prénom" name="prenom" required="required">
                        <input type="date" name="naiss" placeholder="Date de naissance" required="required" />
                        <input type="text" name="rue" placeholder="Votre rue" required="required" />
                        <input type="number" name="num" placeholder="Numero" required="required" />
                        <input type="number" name="cp" placeholder="Code postal" required="required" />
                        <input type="text" name="ville" placeholder="Ville" required="required" />
                        <select name="pays">
                            <option value="0">Choississez un pays</option>
                            <option value="Belgique">Belgique</option>
                            <option value="France">France</option>
                            <option value="Luxembourg">Luxembourg</option>
                            <option value="Suisse">Suisse</option>
                        </select>
                        <input type="text" name="tel" placeholder="Téléphone" required="required"/>
                        <input type="submit" name="valide_panier" class="btn btn-primary pull-right" value="Valider">
                    </form>
                </div>
            </div>
        </div>

        <div class="col-sm-3">
            <div class="bill-to">
                <table class="table table-condensed">
                    <thead>
                        <tr class="cart_menu">
                            <td>Produit</td>
                            <td>Prix</td>
                            <td>Quantité</td>
                            <td>Total</td>
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
                                    echo '<td class="cart_description">';
                                    echo '<h4>' . $liste['nom_prod'][$i] . '</h4>';
                                    echo '</td>';

                                    echo '<td class="cart_price">';
                                    echo '<p>' . $liste['prix_unit'][$i] . '</p>';
                                    echo '</td>';

                                    echo '<td class="cart_price">';
                                    echo '<p>' . $liste['quantite'][$i] . '</p>';
                                    echo '</td>';

                                    echo '<td class="cart_total">';
                                    $total_ligne = montantLigne($liste['prix_unit'][$i], $liste['quantite'][$i]);
                                    $sousTotal += $total_ligne;
                                    echo '<p class="cart_total_price">' . $total_ligne . '</p>';
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


    </div>
</div>
