<!DOCTYPE html>
<html lang="pl">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Konwerter danych</title>
    <link rel="stylesheet" href="/assets/css/style.css">
    <link rel="stylesheet" href="/assets/css/bootstrap.min.css">
</head>

<body>
    <div id="loader" class="fixed-top d-flex justify-content-center align-items-center visible">
        <div class="spinner-border text-primary" style="width: 3rem; height: 3rem;" role="status">
            <span class="visually-hidden">Loading...</span>
        </div>
    </div>
    <header>
        <div class="container">
            <div class="row">
                <div class="col-sm-12 col-md-10 offset-md-1 col-lg-6 offset-lg-3 mb-3 text-center">
                    <h1>Konwerter danych</h1>
                    <p class="fs-1">Shoper-PrestaShop</p>
                </div>
            </div>
        </div>

    </header>
    <main>
        <?php
        require_once("./templates/pages/$page.php");
        ?>
    </main>
    <footer></footer>
    <script src="/assets/js/bootstrap.bundle.min.js"></script>
    <script src="/assets/js/converter.js"></script>
    <script src="https://www.google.com/recaptcha/api.js" async defer></script>
</body>

</html>
