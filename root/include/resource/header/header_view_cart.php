<?php
    echo '
        <header class="header">
            <nav class="navbar">
                <img src="img/netHOC_logo.png" alt="Impossibile visualizzare il logo aziendale">

                <ul class="navbar_links">
                    <li><a href="index.php">Home</a></li>
                    <li><a href="services.php">I nostro Servizi</a></li>
                </ul>

                <a href="logout.php"><button class="button username_btn">' . $firstname . ', logout</button></a>
            </nav>
            
            <div class="line"></div>
        </header>
    ';
?>