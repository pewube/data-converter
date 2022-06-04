<?php if (isset($params['download']) && !file_exists($params['filePath'] . $params['download'] . '.csv')) {
    error_log(date("Y-m-d H:i:s") . ' Template modal download error: file to download does not exist' . ";\n", 3, 'src/logs/errors.log');
    header('Location: /?error=noFileToDownload');
    exit;
} ?>

<div class="modal fade" id="infoModal" tabindex="-1" aria-labelledby="infoModalLabel" aria-hidden="true">
    <?php if (isset($params['download']) || isset($params['error'])) : ?>
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">

                <div class="modal-header">
                    <?php if (isset($params['download'])) : ?>
                        <h5 class="modal-title text-success" id="infoModalLabel">Konwersja udana !</h5>
                    <?php elseif (isset($params['error'])) : ?>
                        <h5 class="modal-title text-danger" id="infoModalLabel">Wystąpił błąd !</h5>
                    <?php endif ?>
                    <button type="button" class="btn-close btn-close-modal" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <?php if (isset($params['download'])) : ?>
                        <div id="modalMessage">
                            <p>Plik jest gotowy do pobrania: <a href="<?php echo $params['filePath'] . $params['download'] . '.csv' ?>">pobierz plik</a></p>
                        </div>
                    <?php elseif (isset($params['error'])) : ?>
                        <div id="modalMessage">
                            <p><?php echo $this->errorMessages[$params['error']] ?? 'Nieznany błąd.'; ?></p>
                        </div>
                    <?php endif; ?>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary btn-close-modal" data-bs-dismiss="modal">Zamknij</button>
                </div>
            </div>
        </div>
    <?php endif; ?>
</div>
