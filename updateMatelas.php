<?php
$dsn = "mysql:host=localhost;dbname=literie3000;cahrset=UTF8";
$db = new PDO($dsn, "root", "");

$sponsors = $db->query("SELECT * FROM marques")->fetchAll(PDO::FETCH_ASSOC);
$widths = $db->query("SELECT * FROM dimensions")->fetchAll(PDO::FETCH_ASSOC);

if (isset($_GET["id"])) {
    $nom = trim(strip_tags($_POST["nom"]));
    $prix = trim(strip_tags($_POST["prix"]));
    $prix_remise = trim(strip_tags($_POST["prix_remise"]));
    $picture = trim(strip_tags($_POST["picture"]));
    $marques_id = trim(strip_tags($_POST["marques_id"]));
    $dimensions_id = trim(strip_tags($_POST["dimensions_id"]));

    $errors = [];

    if (empty($nom)) {
        $errors["nom"] = "Le nom du matelas est obligatoire";
    }

    if (!filter_var($picture, FILTER_VALIDATE_URL)) {
        $errors["picture"] = "L'URL de l'image n'est pas au bon format";
    }

    if (empty($errors)) {

        $query = $db->prepare("UPDATE matelas (nom, prix, prix_remise, picture, marques_id, dimensions_id) VALUES (:nom, :prix, :prix_remise, :picture, :marques_id, :dimensions_id WHERE id = :id");
        $query->bindParam(":nom", $nom);
        $query->bindParam(":prix", $prix);
        $query->bindParam(":prix_remise", $prix_remise);
        $query->bindParam(":picture", $picture);
        $query->bindParam(":marques_id", $marques_id);
        $query->bindParam(":dimensions_id", $dimensions_id);

        $query->execute(); 
        $Matela = $query->fetch();
    }
}
include("templates/header.php");
?>
<div class="center">
    <div class="dodo">
        <a href="index.php">
            <img src="./src/3.png" alt="">
        </a>
    </div>
    <h1>Modifier le matelas</h1>
    <div class="submit">
        <form action="" method="post">
            <div class="form-group pic">
                <label for="inputName">Nom du Matelas :</label>
                <input type="text" name="nom" id="inputName" value="<?= isset($nom) ? $nom : "" ?>">
                <?php
                if (isset($errors["nom"])) {
                ?>
                    <span class="info-error"><?= $errors["nom"] ?></span>
                <?php
                }
                ?>
            </div>

            <div class="form-group">
                <label for="inputPrice">Prix du Matelas :</label>
                <input type="number" name="prix" id="inputPrice" value="<?= isset($prix) ? $prix : "" ?>">
            </div>

            <div class="form-group">
                <label for="inputReduction">Prix réduit du Matelas :</label>
                <input type="number" name="prix_remise" id="inputReduction" value="<?= isset($prix) ? $prix : "" ?>">
            </div>

            <div class="form-group pic">
                <label for="inputPicture">Photo du Matelas :</label>
                <input type="text" name="picture" id="inputPicture" value="<?= isset($picture) ? $picture : "" ?>">
                <?php
                if (isset($errors["picture"])) {
                ?>
                    <span class="info-error"><?= $errors["picture"] ?></span>
                <?php
                }
                ?>
            </div>

            <div class="form-group">
                <label for="inputMarque">Marque :</label>
                <select name="marques_id" id="select-marque">
                    <option value="">Choisissez la marque correspondante</option>
                    <?php
                    foreach ($sponsors as $sponsor) {
                    ?>
                        <option value="<?= $sponsor["id"] ?>"><?= $sponsor["nom"] ?></option>
                    <?php
                    }
                    ?>
                </select>
            </div>

            <div class="form-group">
                <label for="inputName">Dimensions du Matelas :</label>
                <select name="dimensions_id" id="select-marque">
                    <option value="">Choisissez la dimension</option>
                    <?php
                    foreach ($widths as $width) {
                    ?>
                        <option value="<?= $width["id"] ?>"><?= $width["dimension"] ?></option>
                    <?php
                    }
                    ?>
                </select>
            </div>

            <input type="submit" value="Modification du matelas" class="btn-submit">
        </form>
    </div>

</div>
<?php
include("templates/footer.php");
?>