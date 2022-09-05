<?php
// Connexion base de donnée
$dsn = "mysql:host=localhost;dbname=literie3000;cahrset=UTF8";
$db = new PDO($dsn, "root", "");

// Récupération des matelas
$query = $db->query("SELECT * FROM matelas");
// Récupération sous forme d'un tableau associatif
$matelas = $query->fetchAll(PDO::FETCH_ASSOC);

include("templates/header.php");
?>


<div class="page">
    <div class="table-l">
        <img src="./src/1.png" alt="">
        <h1>Le catalogue</h1>
    </div>
    <div class="table-r">
        <h1>Nos Matelas</h1>
        <div class="lines">
            <div class="informations">
                <h3>Photo</h3>
                <h3>Marque</h3>
                <h3>Nom</h3>
                <h3>Prix</h3>
            </div>
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
    </div>
</div>

<?php
// Inclure le template footer
include("templates/footer.php");
?>