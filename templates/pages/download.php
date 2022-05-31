<div>
    <?php if ($params['fileLink']) : ?>
        <p>Plik jest gotowy do pobrania: <a href="<?php echo $params['fileLink'] ?>"><?php echo $params['fileLink'] ?></a></p>
    <?php else : ?>
        <p>Błąd</p>
    <?php endif; ?>
</div>
<div>
    <a href="/">Wróć na stronę główną</a>
</div>
