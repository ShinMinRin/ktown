<?php
/////////////////////////////////////
//GESTION DU FORMULAIRE DE CONTACT
/////////////////////////////////////

if($_SERVER['REQUEST_METHOD']=='POST'){
    //on récupère les données du formulaire
    $nom_exp = $_POST['nom'];
    $email_exp = $_POST['email'];
    $message = $_POST['message'];
    $sujet = '[K-town] '.$_POST['sujet'];
    
    //variables concernant l'email à envoyer
    $destinataire = 'ktown.infos@gmail.com';
    $contenu = '<html><head><title>'.$sujet.'</title></head><body>';
    $contenu .= '<p>Bonjour, vous avez reçu un message sur votre site web K-town.</p>';
    $contenu .= '<p><strong>Nom : </strong>'.$nom_exp.'</p>';
    $contenu .= '<p><strong>Email : </strong>'.$email_exp.'</p>';
    $contenu .= '<p><strong>Message : </strong></p><p>'.$message.'</p>';
    $contenu .= '</body></html>';
    
    $headers = 'MIME-Version: 1.0'."\r\n";
    $headers .= 'Content-type: text/html; charset=iso-8859-1'."\r\n";
    
    mail($destinataire, $sujet, $contenu, $headers);
    echo '<script>alert("Message envoyé")</script>';
    
    
    
}


?>

<div id="contact-page" class="container">
    <div class="bg">
        <div class="row">    		
            <div class="col-sm-12">    			   			
                <h2 class="title text-center">Contactez <strong>nous</strong></h2>    			    				    				
            </div>			 		
        </div>    	
        <div class="row">  	
            <div class="col-sm-8">
                <div class="contact-form">
                    <h2 class="title text-center">Par Email</h2>
                    <div class="status alert alert-success" style="display: none"></div>
                    <form id="main-contact-form" class="contact-form row" name="contact-form" method="post">
                        <div class="form-group col-md-6">
                            <input type="text" name="nom" class="form-control" required="required" placeholder="Nom">
                        </div>
                        <div class="form-group col-md-6">
                            <input type="email" name="email" class="form-control" required="required" placeholder="Email">
                        </div>
                        <div class="form-group col-md-12">
                            <input type="text" name="sujet" class="form-control" required="required" placeholder="Sujet">
                        </div>
                        <div class="form-group col-md-12">
                            <textarea name="message" id="message" required="required" class="form-control" rows="8" placeholder="Ecrivez votre message ici"></textarea>
                        </div>                        
                        <div class="form-group col-md-12">
                            <input type="submit" name="submit" class="btn btn-primary pull-right" value="Envoyer">
                        </div>
                    </form>
                </div>
            </div>
            
            <div class="col-sm-4">
                <div class="contact-info">
                    <h2 class="title text-center">Informations de contact</h2>
                    <address>
                        <p>K-Town</p>
                        <p>152 Avenue Sainte-Catherine</p>
                        <p>1000 Bruxelles</p>
                        <p>Tel : +32 2 520 14 12</p>
                        <p>Fax : +32 2 520 12 34</p>
                    </address>
                    <div class="social-networks">
                        <h2 class="title text-center">Réseaux sociaux</h2>
                        <ul>
                            <li>
                                <a href="#"><i class="fa fa-facebook"></i></a>
                            </li>
                            <li>
                                <a href="#"><i class="fa fa-twitter"></i></a>
                            </li>
                            <li>
                                <a href="#"><i class="fa fa-google-plus"></i></a>
                            </li>
                            <li>
                                <a href="#"><i class="fa fa-youtube"></i></a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>    			
        </div>  
    </div>	
</div>