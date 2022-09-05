<?php
if (!empty($_GET["id"])) {
    $dsn = "mysql:host=localhost;dbname=literie3000;cahrset=UTF8";
    $db = new PDO($dsn, "root", "");

    $query = $db->query('DELETE FROM matelas WHERE id = :id');
    $query->bindParam(":id", $_GET["id"], PDO::PARAM_INT);
    $query->execute();
    $matelas = $query->fetch();

    header("Location: index.php");
}
