<div class="container-sm pb-5">
    <div class="text-center">
        <a class="link-primary" href="/?action=help" target="_blank" rel="noopener noreferrer">
            <svg class="info-icons" xmlns="http://www.w3.org/2000/svg" height="36px" viewBox="0 0 24 24" width="36px">
                <path d="M0 0h24v24H0z" fill="none" />
                <path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm1 15h-2v-6h2v6zm0-8h-2V7h2v2z" />
            </svg>
        </a>
    </div>
    <form class="col-sm-10 offset-sm-1 col-md-8 offset-md-2 col-lg-6 offset-lg-3" action="" method="post" enctype="multipart/form-data">
        <div class="mt-4 mb-5">
            <input class="form-control has-validation" type="file" name="shoper-csv" required>
        </div>
        <div class="card">
            <div class="card-body">
                <h6 class="card-title mb-4">Opcje konwersji</h5>
                    <div class="input-group align-items-start flex-nowrap py-2">
                        <div class="form-check form-switch">
                            <input class="form-check-input option-chbox" type="checkbox" name="copy-photos" id="copy-photos" role="switch" <?php echo $this->copyPhotos; ?>>
                            <label class="form-check-label" for="copy-photos">Kopiuj linki do zdjęć</label>
                        </div>
                        <a tabindex="0" class="d-block ms-2" data-bs-toggle="popover" data-bs-trigger="focus" data-bs-placement="top" data-bs-content="Po wczytaniu danych PrestaShop zaimportuje zdjęcia, zapisze je w miejscu swojej instalacji i dostosuje zgodnie z wprowadzonymi ustawieniami. Pliki ze zdjęciami znajdować się będą na serwerze, gdzie zainstalowany jest PrestaShop."><?php echo $this->helpIcon; ?></a>
                    </div>
                    <div class="input-group align-items-start flex-nowrap py-2">
                        <div class="form-check form-switch">
                            <input class="form-check-input option-chbox" type="checkbox" name="copy-pictures" id="copy-pictures" role="switch" <?php echo $this->copyPictures; ?> data-bs-toggle="collapse" data-bs-target="#shop-address" aria-expanded="false" aria-controls="shop-address">
                            <label class="form-check-label" for="copy-pictures">Kopiuj linki do grafik w opisach produktów</label>
                        </div>
                        <a tabindex="0" class="d-block ms-2" data-bs-toggle="popover" data-bs-trigger="focus" data-bs-placement="top" data-bs-content="Po wczytaniu danych PrestaShop skopiuje linki do grafik i umieści je w opisach produktów. Należy pamiętać o tym, że chociaż PrestaShop będzie wyświetlał grafiki w opisach produktów to pliki graficzne fizycznie znajdować się będą nadal na serwerze Shopera, z którego kopiowane są dane. W przypadku usunięcia ich z Shopera grafiki przestaną być widoczne również w PrestaShop. Aby pliki z grafikami znalazły się na serwerze, gdzie zainstalowany jest PrestaShop należy je tam skopiować i wprowadzić odpowiednie linki do opisów produktów."><?php echo $this->helpIcon; ?></a>
                    </div>
                    <div class="input-group input-group-sm collapse" id="shop-address">
                        <input type="text" name="shop-address" class="form-control mt-1 mb-3" placeholder="adres sklepu np. https://moj-sklep.pl" aria-label="Shop address">
                    </div>
                    <div class="input-group align-items-start flex-nowrap py-2">
                        <div class="form-check form-switch">
                            <input class="form-check-input option-chbox" type="checkbox" name="copy-styles" id="copy-styles" role="switch" <?php echo $this->copyStyles; ?>>
                            <label class="form-check-label" for="copy-styles">Kopiuj style</label>
                        </div>
                        <a tabindex="0" class="d-block ms-2" data-bs-toggle="popover" data-bs-trigger="focus" data-bs-placement="top" data-bs-content="Po zaznaczeniu tej opcji opisy zostaną skopiowane do PrestaShop razem z ustawieniami styli  liniowych w html, takimi jak kolory, wielkości i kroje czcionek, pogrubienia, kursywy. Należy pamiętać o tym, że skopiowane zostaną jedynie style liniowe znajdujące się w opisach produktów w Shoperze."><?php echo $this->helpIcon; ?></a>
                    </div>
                    <div class="input-group align-items-start flex-nowrap py-2">
                        <div class="form-check form-switch">
                            <input class="form-check-input option-chbox" type="checkbox" name="copy-bold" id="copy-bold" role="switch" <?php echo $this->copyBold; ?>>
                            <label class="form-check-label" for="copy-bold">Kopiuj tylko pogrubienia</label>
                        </div>
                        <a tabindex="0" class="d-block ms-2" data-bs-toggle="popover" data-bs-trigger="focus" data-bs-placement="top" data-bs-content="Po zaznaczeniu tej opcji opisy zostaną skopiowane do PrestaShop razem z ustawieniami styli  liniowych w html, które dotyczą pogrubienia czcionek tj. skopiowane zostaną tagi <strong> i <b>. Należy pamiętać o tym, że skopiowane zostaną jedynie style liniowe znajdujące się w opisach produktów w Shoperze."><?php echo $this->helpIcon; ?></a>
                    </div>
                    <div class="input-group align-items-start flex-nowrap py-2">
                        <div class="form-check form-switch">
                            <input class="form-check-input option-chbox" type="checkbox" name="deactivate-product" id="deactivate-product" role="switch" <?php echo $this->deactivateProduct; ?>>
                            <label class="form-check-label" for="deactivate-product">Ustaw produkty jako nieaktywne</label>
                        </div>
                        <a tabindex="0" class="d-block ms-2" data-bs-toggle="popover" data-bs-trigger="focus" data-bs-placement="top" data-bs-content="Włączenie tej opcji spowoduje, że wszystkie konwertowane produkty zostaną ustawione jako nieaktywne. Oznacza to, że po wczytaniu do PrestaShop nie będą one wyświetlane dopóki nie zostaną aktywowane. Jeżeli opcja ta pozostanie wyłączona aktywność produktów nie zostanie zmieniona w stosunku do ustawień w sklepie Shoper."><?php echo $this->helpIcon; ?></a>
                    </div>
            </div>
        </div>

        <div class="mt-5 mb-3 d-flex justify-content-center">
            <div class="g-recaptcha" data-sitekey="<?php echo $params['captchaSiteKey']; ?>"></div>
        </div>
        <div class="my-3 text-center">
            <input id="btnConvert" class="btn btn-primary" type="submit" name="submit" value="Konwertuj dane">
        </div>
    </form>
</div>
