<?php

// jesli nie podano parametru id, przekieruj do listy książek
if (empty($_GET['id'])) {
    header("Location: ksiazki.lista.php");
    exit();
}

$id = (int)$_GET['id'];

include 'header.php';

use Ibd\Ksiazki;

$ksiazki = new Ksiazki();
$dane = $ksiazki->pobierz($id)
?>

    <h2><?= $dane['tytul'] ?></h2>

    <p>
        <a href="ksiazki.lista.php"><i class="fas fa-chevron-left"></i> Powrót</a>
    </p>

    <?php if (!empty($dane['zdjecie'])): ?>
        <img style="width: 30%" src="zdjecia/<?= $dane['zdjecie'] ?>" alt="<?= $dane['tytul'] ?>" class="img-thumbnail"/></br>
    <?php else: ?>
        brak zdjecia</br>
    <?php endif; ?>
    </br>
    <p> ISBN : <?= $dane['isbn'] ?></p>
    <p> Liczba stron : <?= $dane['liczba_stron'] ?></p>
    <p> Cena : <strong><?= $dane['cena'] ?>zł</strong></p>
    <p> Opis : <?= $dane['opis'] ?></p>

<?php include 'footer.php'; ?>