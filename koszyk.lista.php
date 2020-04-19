<?php
require_once 'vendor/autoload.php';
session_start();

use Ibd\Koszyk;
use Ibd\Ksiazki;

$koszyk = new Koszyk();

if (isset($_POST['zmien'])) {
    $koszyk->zmienLiczbeSztuk($_POST['ilosci']);
    header("Location: koszyk.lista.php");
}

$listaKsiazek = $koszyk->pobierzWszystkie();
$cenaWszystkich = 0;
foreach ($listaKsiazek as $wynik) {
    $cenaWszystkich += $wynik['liczba_sztuk'] * $wynik['cena'];
}

include 'header.php';
?>

    <h2>Koszyk</h2>

    <form method="post" action="">
        <table class="table table-striped table-condensed">
            <thead>
            <tr>
                <th>&nbsp;</th>
                <th>Tytuł</th>
                <th>Autor</th>
                <th>Kategoria</th>
                <th>Cena PLN</th>
                <th>Liczba sztuk</th>
                <th>Cena razem</th>
                <th>&nbsp;</th>
            </tr>
            </thead>

            <?php if (count($listaKsiazek) > 0): ?>
                <tbody>
                <?php foreach ($listaKsiazek as $ks): ?>
                    <tr>
                        <td style="width: 100px">
                            <?php if (!empty($ks['zdjecie'])): ?>
                                <img src="zdjecia/<?= $ks['zdjecie'] ?>" alt="<?= $ks['tytul'] ?>"
                                     class="img-thumbnail"/>
                            <?php else: ?>
                                brak zdjęcia
                            <?php endif; ?>
                        </td>
                        <td><?= $ks['tytul'] ?></td>
                        <td><?= $ks['imie_autora'] ?></td>
                        <td><?= $ks['nazwisko_autora'] ?></td>
                        <td><?= $ks['nazwa_kategorii'] ?></td>
                        <td><?= $ks['cena'] ?></td>
                        <td>
                            <div style="width: 50px">
                                <input type="text" name="ilosci[<?= $ks['id_koszyka'] ?>]"
                                       value="<?= $ks['liczba_sztuk'] ?>" class="form-control"/>
                            </div>
                        </td>
                        <td><?= $ks['cena'] * $ks['liczba_sztuk'] ?></td>
                        <td style="white-space: nowrap">
                            <a href="koszyk.usun.php" title="usuń z koszyka" data-id="<?= $ks['id_koszyka'] ?>"
                               class="aUsunZKoszyka">
                                <i class="fas fa-trash"></i>
                            </a>
                            <a href="ksiazki.szczegoly.php?id=<?= $ks['id'] ?>" title="szczegóły">
                                <i class="fas fa-folder-open"></i>
                            </a>
                        </td>
                    </tr>
                <?php endforeach; ?>
                </tbody>
                <tr>
                    <td colspan="8" style="text-align: center">Cena wszystkich książek :
                        <b><?php echo $cenaWszystkich ?> zł</b></td>
                </tr>
                <tfoot>
                <tr>
                    <td colspan="5">&nbsp;</td>
                    <td colspan="3"><input type="submit" class="btn btn-primary btn-sm" name="zmien"
                                           value="Zmień liczbę sztuk"/></td>
                </tr>
                </tfoot>
            <?php else: ?>
                <tr>
                    <td colspan="8" style="text-align: center">Brak produktów w koszyku.</td>
                </tr>
            <?php endif; ?>
        </table>
    </form>

<?php include 'footer.php'; ?>