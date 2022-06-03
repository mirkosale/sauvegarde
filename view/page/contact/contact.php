<!-- Main Content-->
<main class="mb-4">
    <div class="container px-4 px-lg-5">
        <div class="row gx-4 gx-lg-5 justify-content-center">
            <div class="col-md-10 col-lg-8 col-xl-7">
                <p>Si vous avez des informations à nous faire parvenir ou des questions à nous poser, vous pouvez nous contacter en remplissant le formulaire ci-dessous et nous vous répondrons dès que possible!</p>
                <div class="my-5">
                    <!-- * * * * * * * * * * * * * * *-->
                    <!-- * * SB Forms Contact Form * *-->
                    <!-- * * * * * * * * * * * * * * *-->
                    <!-- This form is pre-integrated with SB Forms.-->
                    <!-- To make this form functional, sign up at-->
                    <!-- https://startbootstrap.com/solution/contact-forms-->
                    <!-- to get an API token!-->
                    <form id="contactForm"  action="index.php?controller=contact&action=checkContact" method="post">
                        <div class="form-floating">
                            <input class="form-control" name="name" id="name" type="text" placeholder="Entrez votre nom..." />
                            <label for="name">Nom</label>
                        </div>
                        <div class="form-floating">
                            <input class="form-control" name="email" id="email" type="email" placeholder="Entrez votre adresse email..." />
                            <label for="email">Adresse Email</label>
                        </div>
                        <div class="form-floating">
                            <input class="form-control" name="phone" id="phone" type="tel" placeholder="Entrez votre numéro de téléphone... (optionnel)" />
                            <label for="phone">Numéro de téléphone (optionnel)</label>
                        </div>
                        <div class="form-floating">
                            <textarea class="form-control" name="message" id="message" placeholder="Entrez votre message ici..." style="height: 12rem"></textarea>
                            <label for="message">Message</label>
                        </div>
                        <br />
                        <!-- Submit Button-->
                        <button class="btn btn-primary text-uppercase enabled" name="btnSubmit" id="btnSubmit" type="submit">Send</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</main>