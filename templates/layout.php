<!DOCTYPE html>
<html lang="pl">

<head>
    <meta charset="UTF-8">
    <meta name="description" content="Konwerter danych Shoper-PrestaShop. Przygotuj plik CSV z danymi produktów do wczytania do PrestaShop." />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Konwerter danych</title>
    <link rel="shortcut icon" href="/assets/img/favicon.ico" type="image/x-icon" />
    <link rel="stylesheet" href="/assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="/assets/css/style.min.css">
</head>

<body>
    <div id="loader" class="fixed-top d-flex justify-content-center align-items-center visible">
        <div class="spinner-border text-primary" style="width: 3rem; height: 3rem;" role="status">
            <span class="visually-hidden">Loading...</span>
        </div>
    </div>
    <header class="container-sm">
        <div class="d-flex position-relative justify-content-center pb-4 my-4 border-bottom">
            <div class="text-center">
                <h1>Konwerter danych</h1>
                <h2>Shoper <span class="fs-1 text-primary">&#8669;</span> PrestaShop</h2>
                <a href="/" class="stretched-link"></a>
            </div>
        </div>
    </header>
    <main>
        <?php
        require_once("./templates/pages/$page.php");
        ?>
    </main>

    <footer class="container-sm d-flex flex-wrap justify-content-center py-4 mt-5 border-top">
        <p class="text-center text-muted mb-1 mx-2">© <?php echo date("Y") ?> pewube.eu</p>
        <address class="text-center text-muted mb-1 mx-2"><a class="link-secondary" href="mailto:kontakt@pewube.eu">kontakt@pewube.eu</a></address>
    </footer>
    <?php
    require_once("./templates/pages/modal.php");
    ?>

    <script src="/assets/js/bootstrap.bundle.min.js"></script>
    <script src="/assets/js/converter.min.js"></script>
    <script src="https://www.google.com/recaptcha/api.js" async defer></script>
</body>

</html>
