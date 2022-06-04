<!DOCTYPE html>
<html lang="pl">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Konwerter danych</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
    <link rel="stylesheet" href="/assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="/assets/css/style.css">
</head>

<body>
    <div id="loader" class="fixed-top d-flex justify-content-center align-items-center visible">
        <div class="spinner-border text-primary" style="width: 3rem; height: 3rem;" role="status">
            <span class="visually-hidden">Loading...</span>
        </div>
    </div>
    <header>
        <div class="d-flex position-relative justify-content-center my-4 ">
            <div>
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
    <footer></footer>
    <?php
    require_once("./templates/pages/modal.php");
    ?>

    <script src="/assets/js/bootstrap.bundle.min.js"></script>
    <script src="/assets/js/converter.js"></script>
    <script src="https://www.google.com/recaptcha/api.js" async defer></script>
</body>

</html>
