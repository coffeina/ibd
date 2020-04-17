<?php

use Ibd\Ksiazki;

$ksiazki = new Ksiazki();
$lista = $ksiazki->pobierzBestsellery();
?>

<div class="col-md-2">
    <h1>Bestsellery</h1>
    <ul>
        <?php foreach ($lista as $ks): ?>
            <a href="ksiazki.szczegoly.php?id=<?= $ks['id'] ?>" title="szczegóły">
                <li style="width: 300%">
                    <p>
                    <div style="width: 30%">
                        <?php if (!empty($ks['zdjecie'])): ?>
                            <img src="zdjecia/<?= $ks['zdjecie'] ?>" alt="<?= $ks['tytul'] ?>" class="img-thumbnail"/>
                        <?php else: ?>
                            brak zdjęcia
                        <?php endif; ?>
                    </div>
                    <i><?= $ks['tytul'] ?></i>, <?= $ks['imie_autora'] ?> <?= $ks['nazwisko_autora'] ?></p>
                </li>
            </a>
        <?php endforeach; ?>
    </ul>
</div>