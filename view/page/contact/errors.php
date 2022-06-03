<main class="mb-4">
    <div class="container px-4 px-lg-5">
        <div class="row gx-4 gx-lg-5 justify-content-center">
            <div class="col-md-10 col-lg-8 col-xl-7">
                <h2>Vous avez une (ou plusieurs) erreur(s)</h2>
                <ul>

                    <?php
                    #Affiche toutes les erreurs lors de la validation de la page de contact
                    foreach ($errors as $error) {
                        echo '<li>' . $error . '</li>';
                    }
                    ?>
                </ul>
                <button class="btn btn-primary text-uppercase enabled"><a href="javascript:window.history.back();" style="color:white;">Retour en arrière</a></button>
                <br />
            </div>
        </div>
    </div>
</main>