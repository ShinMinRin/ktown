<script language="javascript">
function Go(idprod)
{
    window.location.href="index.php?page=detail.php&idprod=" + idprod;
}
</script>


<section id="slider">
    <div class="container">
        <div class="row">
            <div class="col-sm-12">
                <div id="slider-carousel" class="carousel slide" data-ride="carousel">
                    <ol class="carousel-indicators">
                        <li data-target="#slider-carousel" data-slide-to="0" class="active"></li>
                        <li data-target="#slider-carousel" data-slide-to="1"></li>
                        <li data-target="#slider-carousel" data-slide-to="2"></li>
                    </ol>

                    <div class="carousel-inner">
                        <div class="item active">
                            <div class="col-sm-6">
                                <h1><span>Love</span> Yourself</h1>
                                <h2>Le nouvel album des BTS</h2>
                                <p>Après leur sacre avec WINGS et Never Walk Alone entame un nouveau cycle avec la série LOVE YOURSELF et son premier volet 'Her'. Inclus 2 titres cachés dont un produit par Rap Monster.</p>
                                <button type="button" class="btn btn-default get" onclick="Go(35)">Plus d'info</button>
                            </div>
                            <div class="col-sm-6">
                                <img src="images/home/bts-ly-L-vers.png" class="girl img-responsive" alt="BTS - Love Yourself" />
                            </div>
                        </div>
                        <div class="item">
                            <div class="col-sm-6">
                                <h1><span>This</span> Christmas</h1>
                                <h2>Passez de merveilleuses fêtes avec Taeyeon !</h2>

                                <button type="button" class="btn btn-default get" onclick="Go(37)">Plus d'info</button>
                            </div>
                            <div class="col-sm-6">
                                <img src="images/home/taeyeon-this-christmas.png" class="girl img-responsive" alt="Taeyeon - This Christmas" />
                            </div>
                        </div>

                        <div class="item">
                            <div class="col-sm-6">
                                <h1><span>YOU &</span> ME</h1>
                                <h2>KARD</h2>
                                <p>Après des débuts tonitruants et l'incroyable succès de 'Hola Hola', la sensation KARD est de retour avec leur second mini album You & Me.</p>
                                <button type="button" class="btn btn-default get" onclick="Go(36)">Plus d'info</button>
                            </div>
                            <div class="col-sm-6">
                                <img src="images/home/kard-you-me.png" class="girl img-responsive" alt="KARD - YOU & ME" />
                            </div>
                        </div>

                    </div>

                    <a href="#slider-carousel" class="left control-carousel hidden-xs" data-slide="prev">
                        <i class="fa fa-angle-left"></i>
                    </a>
                    <a href="#slider-carousel" class="right control-carousel hidden-xs" data-slide="next">
                        <i class="fa fa-angle-right"></i>
                    </a>
                </div>

            </div>
        </div>
    </div>
</section>