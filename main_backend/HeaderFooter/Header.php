<!-- en-tête de la page -->
<div class="head_bar">

<div class="logo">
    <img src="Images/dendo-propre.png"></img>
</div>

<div class="menu">

    <nav class="navbar navbar-expand-lg navbar-light  ">

        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon text-body "></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
            <div class="navbar-nav">
                <a class="nav-link active" href="./Panier/basket.php">
                    Panier
                    <!--Image-->
                    <svg width="1em" height="1em" viewBox="0 0 14 16" class="bi bi-cart4" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd" d="M0 2.5A.5.5 0 0 1 .5 2H2a.5.5 0 0 1 .485.379L2.89 4H14.5a.5.5 0 0 1 .485.621l-1.5 6A.5.5 0 0 1 13 11H4a.5.5 0 0 1-.485-.379L1.61 3H.5a.5.5 0 0 1-.5-.5zM3.14 5l.5 2H5V5H3.14zM6 5v2h2V5H6zm3 0v2h2V5H9zm3 0v2h1.36l.5-2H12zm1.11 3H12v2h.61l.5-2zM11 8H9v2h2V8zM8 8H6v2h2V8zM5 8H3.89l.5 2H5V8zm0 5a1 1 0 1 0 0 2 1 1 0 0 0 0-2zm-2 1a2 2 0 1 1 4 0 2 2 0 0 1-4 0zm9-1a1 1 0 1 0 0 2 1 1 0 0 0 0-2zm-2 1a2 2 0 1 1 4 0 2 2 0 0 1-4 0z" />
                    </svg>
                </a>
                <?php
                    if(!isset($_SESSION['userEmail'])) {
                        ?>
                        <a >
                            <button onclick="document.getElementById('id01').style.display='block'" class="w3-button ">Connexion
                            <svg width="1em" height="1em" viewBox="0 0 14 14" class="bi bi-person" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd" d="M10 5a2 2 0 1 1-4 0 2 2 0 0 1 4 0zM8 8a3 3 0 1 0 0-6 3 3 0 0 0 0 6zm6 5c0 1-1 1-1 1H3s-1 0-1-1 1-4 6-4 6 3 6 4zm-1-.004c-.001-.246-.154-.986-.832-1.664C11.516 10.68 10.289 10 8 10c-2.29 0-3.516.68-4.168 1.332-.678.678-.83 1.418-.832 1.664h10z" />
                            </svg>
                            </button>
                        </a>

                        <div id="id01" class="w3-modal">
                            <div class="w3-modal-content">
                                <div class="w3-container">
                                <span onclick="document.getElementById('id01').style.display='none'" class="w3-button w3-display-topright">&times;</span>
                                <div class="container" id="container">
                            
                                    <form action="./main_backend/connectionValidation.php" method="POST">
                                        <h1>Connexion</h1>
                                        
                        
                                        <label><b>Mail:</b></label>
                                        <input type="email" placeholder="Entrer votre email" name="mail_address" required>
                        
                                        <label><b>Mot de passe</b></label>
                                        <input type="password" placeholder="Entrer votre mot de passe" name="password" required>
                                        <p>Je n'ai pas encore de compte, je m'inscris : <a href="./Inscription/registration.html"> Page d'inscription </a> </p>
                                        <p>J'ai oublié mon mot de passe <a href="./main_backend/forgot_password/forgot_password.php"> Mot de passe oublié </a> </p>
                                        
                                        <input type="submit" id='submit' value='Connexion'>
                                        
                                    </form>
                                </div>
                                </div>
                            </div>
                        </div>

                        <a class="nav-link active" href="./Inscription/registration.html">
                            Inscription
                            <!--Image-->
                            <svg width="1em" height="1em" viewBox="0 0 14 14" class="bi bi-person" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd" d="M10 5a2 2 0 1 1-4 0 2 2 0 0 1 4 0zM8 8a3 3 0 1 0 0-6 3 3 0 0 0 0 6zm6 5c0 1-1 1-1 1H3s-1 0-1-1 1-4 6-4 6 3 6 4zm-1-.004c-.001-.246-.154-.986-.832-1.664C11.516 10.68 10.289 10 8 10c-2.29 0-3.516.68-4.168 1.332-.678.678-.83 1.418-.832 1.664h10z" />
                            </svg>
                        </a>

                        <?php
                    } else {
                        ?>
                        <a class="nav-link active" href="./Favoris/favoris.php">
                            Favoris
                            <!--Image-->
                            <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-star" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd" d="M2.866 14.85c-.078.444.36.791.746.593l4.39-2.256 4.389 2.256c.386.198.824-.149.746-.592l-.83-4.73 3.523-3.356c.329-.314.158-.888-.283-.95l-4.898-.696L8.465.792a.513.513 0 0 0-.927 0L5.354 5.12l-4.898.696c-.441.062-.612.636-.283.95l3.523 3.356-.83 4.73zm4.905-2.767l-3.686 1.894.694-3.957a.565.565 0 0 0-.163-.505L1.71 6.745l4.052-.576a.525.525 0 0 0 .393-.288l1.847-3.658 1.846 3.658a.525.525 0 0 0 .393.288l4.052.575-2.906 2.77a.564.564 0 0 0-.163.506l.694 3.957-3.686-1.894a.503.503 0 0 0-.461 0z" />
                            </svg>
                        </a>
                        <a class="nav-link active" href="./Profil/profil.php">
                            Profil
                            <!--Image-->
                            <svg width="1em" height="1em" viewBox="0 0 14 14" class="bi bi-person" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd" d="M10 5a2 2 0 1 1-4 0 2 2 0 0 1 4 0zM8 8a3 3 0 1 0 0-6 3 3 0 0 0 0 6zm6 5c0 1-1 1-1 1H3s-1 0-1-1 1-4 6-4 6 3 6 4zm-1-.004c-.001-.246-.154-.986-.832-1.664C11.516 10.68 10.289 10 8 10c-2.29 0-3.516.68-4.168 1.332-.678.678-.83 1.418-.832 1.664h10z" />
                            </svg>
                        </a>
                        <a class="nav-link active" href="./main_backend/logout.php">
                            Déconnexion
                            <!--Image-->
                            <svg width="1em" height="1em" viewBox="0 0 14 14" class="bi bi-person" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd" d="M10 5a2 2 0 1 1-4 0 2 2 0 0 1 4 0zM8 8a3 3 0 1 0 0-6 3 3 0 0 0 0 6zm6 5c0 1-1 1-1 1H3s-1 0-1-1 1-4 6-4 6 3 6 4zm-1-.004c-.001-.246-.154-.986-.832-1.664C11.516 10.68 10.289 10 8 10c-2.29 0-3.516.68-4.168 1.332-.678.678-.83 1.418-.832 1.664h10z" />
                            </svg>
                        </a>
                        <?php
                    }
                ?>
                
            </div>
        </div>
    </nav>
</div>
</div>