<?php
$dsn = "mysql:host=localhost;dbname=literie3000;cahrset=UTF8";
$db = new PDO($dsn, "root", "");

$sponsors = $db->query("SELECT * FROM marques")->fetchAll(PDO::FETCH_ASSOC);
$widths = $db->query("SELECT * FROM dimensions")->fetchAll(PDO::FETCH_ASSOC);

if (!empty($_POST)) {
    $nom = trim(strip_tags($_POST["nom"]));
    $prix = trim(strip_tags($_POST["prix"]));
    $reduction = trim(strip_tags($_POST["reduction"]));
    $picture = trim(strip_tags($_POST["picture"]));
    $dimensions = trim(strip_tags($_POST["dimensions"]));
    $marque = trim(strip_tags($_POST["marque"]));

    $errors = [];

    if (empty($nom)) {
        $errors["nom"] = "Le nom du matelas est obligatoire";
    }

    if (!filter_var($picture, FILTER_VALIDATE_URL)) {
        $errors["picture"] = "L'URL de l'image n'est pas au bon format";
    }

    if (empty($errors)) {

        $query = $db->prepare("INSERT INTO matelas (nom, prix, prix_remise, picture, dimensions_id, marques_id) VALUES (:nom, :prix, :reduction, :picture, :dimensions, :marque");

        $query->bindParam(":nom", $nom);
        $query->bindParam(":prix", $prix);
        $query->bindParam(":reduction", $reduction);
        $query->bindParam(":picture", $picture);
        $query->bindParam(":dimensions", $dimensions);
        $query->bindParam(":marque", $marque);

        if ($query->execute()) {
            // Redirection vers la page récapitulative
            header("Location: index.php");
        }
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
    <h1>Ajouter un matelas</h1>
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
                <label for="inputMarque">Marque :</label>
                <select name="marque" id="select-marque">
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
                <select name="dimensions" id="select-marque">
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

            <div class="form-group">
                <label for="inputPrice">Prix du Matelas :</label>
                <input type="number" name="prix" id="inputPrice" value="<?= isset($prix) ? $prix : "" ?>">
            </div>

            <div class="form-group">
                <label for="inputReduction">Prix réduit du Matelas :</label>
                <input type="number" name="reduction" id="inputReduction" value="<?= isset($prix) ? $prix : "" ?>">
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

            <input type="submit" value="Ajout du matelas" class="btn-submit">
        </form>
    </div>

</div>
<?php
include("templates/footer.php");
?>