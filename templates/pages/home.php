<div class="container-sm">
    <div class="text-center">
        <a class="link-primary fs-1" href="/?action=help" target="_blank" rel="noopener noreferrer">
            <span class="material-symbols-outlined fs-1">info</span>
        </a>
    </div>
    <form class="col-sm-12 col-md-10 offset-md-1 col-lg-6 offset-lg-3" action="" method="post" enctype="multipart/form-data">
        <div class="mt-4 mb-5">
            <input class="form-control has-validation" type="file" name="shoper-csv" required>
        </div>
        <div class="input-group py-2">
            <div class="form-check form-switch">
                <input class="form-check-input option-chbox" type="checkbox" name="copy-photos" id="copy-photos" role="switch" <?php echo $this->copyPhotos; ?>>
                <label class="form-check-label" for="copy-photos">Kopiuj linki do zdjęć</label>
            </div>
            <a class="d-block ms-3" data-bs-toggle="popover" data-bs-placement="top" data-bs-content="Po wczytaniu danych PrestaShop zaimportuje zdjęcia, zapisze je w miejscu swojej instalacji i dostosuje zgodnie z wprowadzonymi ustawieniami. Pliki ze zdjęciami znajdować się będą na serwerze, gdzie zainstalowany jest PrestaShop."><span class="material-symbols-outlined text-primary">help</span></a>
        </div>
        <div class="input-group py-2">
            <div class="form-check form-switch">
                <input class="form-check-input option-chbox" type="checkbox" name="copy-pictures" id="copy-pictures" role="switch" <?php echo $this->copyPictures; ?> data-bs-toggle="collapse" data-bs-target="#shop-address" aria-expanded="false" aria-controls="shop-address">
                <label class="form-check-label" for="copy-pictures">Kopiuj linki do grafik w opisach produktów</label>
            </div>
            <a class="d-block ms-3" data-bs-toggle="popover" data-bs-placement="top" data-bs-content="Po wczytaniu danych PrestaShop skopiuje linki do grafik i umieści je w opisach produktów. Należy pamiętać o tym, że chociaż PrestaShop będzie wyświetlał grafiki w opisach produktów to pliki graficzne fizycznie znajdować się będą nadal na serwerze Shopera, z którego kopiowane są dane. W przypadku usunięcia ich z Shopera grafiki przestaną być widoczne również w PrestaShop. Aby pliki z grafikami znalazły się na serwerze, gdzie zainstalowany jest PrestaShop należy je tam skopiować i wprowadzić odpowiednie linki do opisów produktów."><span class="material-symbols-outlined text-primary">help</span></a>
        </div>
        <div class="input-group input-group-sm collapse" id="shop-address">
            <input type="text" name="shop-address" class="form-control mt-1 mb-3" placeholder="adres sklepu np. https://moj-sklep.pl" aria-label="Shop address">
        </div>
        <div class="input-group py-2">
            <div class="form-check form-switch">
                <input class="form-check-input option-chbox" type="checkbox" name="copy-styles" id="copy-styles" role="switch" <?php echo $this->copyStyles; ?>>
                <label class="form-check-label" for="copy-styles">Kopiuj style</label>
            </div>
            <a class="d-block ms-3" data-bs-toggle="popover" data-bs-placement="top" data-bs-content="Po zaznaczeniu tej opcji opisy zostaną skopiowane do PrestaShop razem z ustawieniami styli  liniowych w html, takimi jak kolory, wielkości i kroje czcionek, pogrubienia, kursywy. Należy pamiętać o tym, że skopiowane zostaną jedynie style liniowe znajdujące się w opisach produktów w Shoperze."><span class="material-symbols-outlined text-primary">help</span></a>
        </div>
        <div class="input-group py-2">
            <div class="form-check form-switch">
                <input class="form-check-input option-chbox" type="checkbox" name="copy-bold" id="copy-bold" role="switch" <?php echo $this->copyBold; ?>>
                <label class="form-check-label" for="copy-bold">Kopiuj pogrubienia</label>
            </div>
            <a class="d-block ms-3" data-bs-toggle="popover" data-bs-placement="top" data-bs-content="Po zaznaczeniu tej opcji opisy zostaną skopiowane do PrestaShop razem z ustawieniami styli  liniowych w html, które dotyczą pogrubienia czcionek tj. skopiowane zostaną tagi <strong> i <b>. Należy pamiętać o tym, że skopiowane zostaną jedynie style liniowe znajdujące się w opisach produktów w Shoperze."><span class="material-symbols-outlined text-primary">help</span></a>
        </div>
        <div class="mt-5 mb-3 d-flex justify-content-center">
            <div class="g-recaptcha" data-sitekey="<?php echo $params['captchaSiteKey']; ?>"></div>
        </div>
        <div class="my-3 text-center">
            <input id="btnConvert" class="btn btn-primary" type="submit" name="submit" value="Konwertuj dane">
        </div>
    </form>
</div>
