<div class="container-sm">
    <form action="/?download=ready" method="post" enctype="multipart/form-data">
        <div class="row">
            <div class="col-sm-12 col-md-10 offset-md-1 col-lg-6 offset-lg-3 mb-3">
                <input class="form-control" type="file" name="shoper-csv">
            </div>
        </div>
        <div class="row">
            <div class="col-sm-12 col-md-10 offset-md-1 col-lg-6 offset-lg-3 mb-3 d-flex justify-content-center">
                <div class="g-recaptcha" data-sitekey="<?php echo $params['captchaSiteKey']; ?>"></div>
            </div>
        </div>
        <div class="row options">
            <div class="form-check">
                <input class="form-check-input mt-0" type="checkbox" name="check-photos" id="copy-photos"><label class="form-check-label" for="copy-photos">Kopiuj linki do zdjęć</label>
            </div>
            <div class="form-check">
                <input class="form-check-input mt-0" type="checkbox" name="check-description" id="copy-pictures"><label class="form-check-label" for="copy-photos">Kopiuj linki go grafik w opisach produktów</label>
            </div>
            <input type="text" name="shop-address" id="">

        </div>
        <div class="row">
            <div class="col-sm-12 col-md-10 offset-md-1 col-lg-6 offset-lg-3 mb-3 text-center">
                <input id="btnConvert" class="btn btn-primary" type="submit" name="submit" value="Wczytaj wybrany plik CSV">
            </div>
        </div>
    </form>
</div>

<div class="modal fade" id="infoModal" tabindex="-1" aria-labelledby="infoModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="infoModalLabel">Modal title</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <?php if ($params['download'] === 'ready' && $params['fileLink']) : ?>
                    <div id="modalMessage">
                        <p>Plik jest gotowy do pobrania: <a href="<?php echo $params['fileLink'] ?>">pobierz plik <?php echo $params['fileLink'] ?></a></p>
                    </div>
                <?php endif; ?>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Zamknij</button>
            </div>
        </div>
    </div>
</div>
