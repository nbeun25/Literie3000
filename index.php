<?php
// Connexion base de donnée
$dsn = "mysql:host=localhost;dbname=literie3000;cahrset=UTF8";
$db = new PDO($dsn, "root", "");

// Récupération des matelas
$query = $db->query("SELECT * FROM matelas");
// Récupération sous forme d'un tableau associatif
$matelas = $query->fetchAll(PDO::FETCH_ASSOC);
?>

<h1>Nos Matelas</h1>
<div class="matelas">
    <?php
    foreach ($matelas as $matela) {
    ?>
        <div class="matela">
            <img src="<?= $matela["picture"] ?>" alt="">
            <h2><?= $matela["nom"] ?></h2>
        </div>
    <?php
    } ?>
</div>