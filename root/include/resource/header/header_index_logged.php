<?php
    echo '
        <header class="header">
            <nav class="navbar">
                <img src="img/netHOC_logo.png" alt="Impossibile visualizzare il logo aziendale">
            
                <ul class="navbar_links">
                    <li><a href="/index.php">Home</a></li>
                    <li><a href="#Chi_siamo">Chi siamo</a></li>
                    <li><a href="#Cosa_facciamo">Cosa facciamo</a></li>
                    <li><a href="#Dove_siamo">Dove siamo</a></li>
                    <li><a href="#I_nostri_servizi">I nostro Servizi</a></li>
                    <li><a href="#Contatti">Contatti</a></li>
                </ul>

                <div class="btn_containar">
                    <a href="logout.php"><button class="button welcome">' . $firstname . ', logout</button></a>
                    <a href="view_cart.php"><button class="button cart"><i class="fa fa-shopping-cart"></i> Carrello</button></a> 
                </div>
            </nav>
            
            <div class="line"></div>
        </header>
    ';
?>