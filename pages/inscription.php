<?php
if(isset($_POST['envoi_inscr'])){
    
    /////////////////////////////////////////////////
    //Ajout dans la table users
    /////////////////////////////////////////////////
     
    $u = new UsersDB($cnx);
    $u->addUsers($_POST);
    
    
    /////////////////////////////////////////////////
    //Récupération des données pour la table client
    /////////////////////////////////////////////////
    $u = new UsersDB($cnx);
    $user = $u->getLastUser();
    //var_dump($user);
    //print 'id de l user à insérer :'.$user[0];
   $c = new ClientDB($cnx);
   $c->addClient($_POST, $user[0]);
    
}
?>

<section id="form"><!--form-->
    <div class="container">
        <div class="row">
            <div class="col-sm-4 col-sm-offset-1"></div>
            <div class="col-sm-4 col-sm-offset-1">
                <div class="login-form">
                    <h2>Inscription</h2>
                    <form action="<?php print $_SERVER['PHP_SELF']; ?>" method="post" id="form_inscr">
                        <input type="text" name="pseudo" placeholder="Pseudo" required="required" />
                        <input type="password" name="mdp" placeholder="Mot de passe" required="required" />
                        <input type="email" name="email" placeholder="Email" required="required" />
                        <input type="text" name="nom" placeholder="Nom" required="required" />
                        <input type="text" name="prenom" placeholder="Prenom" required="required" />
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
                        <input type="submit" name="envoi_inscr" class="btn btn-primary pull-right" value="S'inscrire">
                    </form>
                </div>
            </div>
        </div>
    </div>
</section><!--/form-->