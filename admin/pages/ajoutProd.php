<?php
$cat = new CategorieDB($cnx);
$c = $cat->getCategorie();
//var_dump($c);

$art = new ArtisteDB($cnx);
$a = $art->getArtiste();


if (isset($_POST['envoi_ajout'])) {

    /////////////////////////////////////////////////
    //Vérification que les champs sont bien remplis
    /////////////////////////////////////////////////

    extract($_POST, EXTR_OVERWRITE);
    $e = false;
    $erreur = '';
    if (empty($nom_prod) || empty($prix_unit) || $categorie == 0 || $artiste == 0) {
        $erreur += "Veuillez remplir tous les champs";
        $e = true;
    }

    if ($_FILES['mon_image']['error'] > 0) {
        $e = true;
        $erreur += "<br/>Erreur lors du transfert de l'image";
    }


    $extensions_valides = array('jpg', 'jpeg', 'gif', 'png');
//1. strrchr renvoie l'extension avec le point (« . »).
//2. substr(chaine,1) ignore le premier caractère de chaine.
//3. strtolower met l'extension en minuscules.
    $extension_upload = strtolower(substr(strrchr($_FILES['mon_image']['name'], '.'), 1));
    if (!in_array($extension_upload, $extensions_valides)){
        $erreur += "<br/>L'extension de l'image n'est pas autorisée";
        $e = true;
    }


    if (!$e) {

        /////////////////////////////////////////////////
        //On place l'image dans le dossier correspondant
        /////////////////////////////////////////////////
        $destination = "../images/";
        
      switch ($categorie){
            case 1 : $destination .= "cd/";
                break;
            case 2 : $destination .= "dvd/";
                break;
            case 3 : $destination .= "vetement/";
                break;
            case 4 : $destination .= "bijoux/";
                break;
            case 5 : $destination .= "poster/";
                break;
            case 6 : $destination .= "papeterie/";
                break;
            case 7 : $destination .= "sac/";
                break;
            case 8 : $destination .= "lightstick/";
                break;
            default :
                break;
            
        }
        
        $destination .= $_FILES['mon_image']['name'];
        //print $destination;
        //print $_FILES['mon_image']['tmp_name'];
        $resultat = move_uploaded_file($_FILES['mon_image']['tmp_name'], $destination);
        //if($resultat) echo "transfert réussi";
        $img = substr($destination, 9);
        
        
        
        //////////////////////////////
        //Ajout dans la table produit
        //////////////////////////////
        $p = new ProduitDB($cnx);
        $p->addProduit($_POST, $img);
        
        
        //////////////////////////////////
        //Lien entre produit et artiste
        /////////////////////////////////
        $id_prod = $p->getLastProduit();
        $p->linkProdToArt($id_prod[0], $artiste);
        
        echo '<script>alert("Produit ajouté !")</script>';
        
        
    }
}
?>


<section id="ajout-prod"><!--form-->
    <div class="container">
        <div class="row">
            <div class="col-sm-4 col-sm-offset-1">
                <?php
                if (isset($erreur)) {
                    print $erreur;
                }
                ?>
            </div>
            <div class="col-sm-4 col-sm-offset-1">
                <div class="login-form">
                    <h2>Ajouter un produit</h2>
                    <form action="<?php print $_SERVER['PHP_SELF']; ?>" method="post"  enctype="multipart/form-data">
                        <input type="text" name="nom_prod" placeholder="Nom du produit" />
                        
                        <select name="artiste">
                            <option value="0">Artiste</option>
                            <?php
                            for ($i = 0; $i < count($a); $i++) {
                                echo '<option value="' . $a[$i]->id_artiste . '">' . $a[$i]->nom_artiste . '</option>';
                            }
                            ?>
                        </select>
                        &nbsp;&nbsp;
                        <textarea rows="3" cols="30" name="descr" placeholder="Description"></textarea>&nbsp;&nbsp;&nbsp;&nbsp;
                        <input type="number" step="0.01" name="prix_unit" placeholder="Prix unitaire" />

                        <select name="categorie">
                            <option value="0">Catégorie</option>
                            <?php
                            for ($i = 0; $i < count($c); $i++) {
                                echo '<option value="' . $c[$i]->id_cat . '">' . $c[$i]->nom_cat . '</option>';
                            }
                            ?>
                        </select>
                        &nbsp;&nbsp;
                        <label for="mon_image">Image (max. 1 Mo) :</label><br />
                        <input type="hidden" name="maxsize" value="1048576" />
                        <input type="file" name="mon_image" id="mon_image" />

                        <input type="submit" name="envoi_ajout" class="btn btn-primary pull-right" value="Ajouter">
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>