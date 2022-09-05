<?php
// Connexion base de donnée
$dsn = "mysql:host=localhost;dbname=literie3000;cahrset=UTF8";
$db = new PDO($dsn, "root", "");

// Récupération des matelas
$query = $db->query("SELECT matelas.picture as 'picture', matelas.nom as 'nom', matelas.prix as 'prix', matelas.prix_remise as 'reduction', dimensions.dimension as 'dimensions', marques.nom as 'marque' from marques RIGHT JOIN matelas
on marques.id = matelas.marques_id 
right join dimensions
on matelas.dimensions_id = dimensions.id 
group by matelas.nom");
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
        <div class="nav">
            <h1>Nos Matelas</h1>
            <div class="btn">
                <a href="./addMatelas.php">Ajouter</a>
            </div>
        </div>
        <div class="lines">
            <div class="informations">
                <h3>Photo</h3>
                <h3>Marque</h3>
                <h3>Nom</h3>
                <h3>Prix</h3>
                <h3> </h3>
            </div>
            <?php
            foreach ($matelas as $matela) {
            ?>
                <div class="matela">
                    <img src="<?= $matela["picture"] ?>" alt="">
                    <h2><?= $matela["marque"] ?></h2>
                    <div class="name">
                        <h2><?= $matela["nom"] ?></h2>
                        <h2><?= $matela["dimensions"] ?></h2>
                    </div>
                    <div class="prix">
                        <h1><?= $matela["prix"] ?> €</h1>
                        <h2 id="destock"><?= $matela["reduction"] ?></h2>
                    </div>
                    <div class="boutton">
                        <input type="submit" value="Supprimer" class="btn-sup">
                        <a href="./updateMatelas.php">
                            <input type="submit" value="Modifier" class="btn-mod">
                        </a>
                    </div>
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