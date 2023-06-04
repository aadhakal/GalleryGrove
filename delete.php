<?php
require_once("session.php");
require_once("included_functions.php");
require_once("database.php");

new_header("Artopia 2023 (Aashish & Amisha)");
$mysqli = Database::dbConnect();
$mysqli->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

if (($output = message()) !== null) {
    echo $output;
}

if (isset($_GET["id"]) && $_GET["id"] !== "") {
    $query = "DELETE FROM Art_Genre WHERE artId = ?";
    $stmt = $mysqli->prepare($query);
    $stmt->execute([$_GET['id']]);

    if ($stmt) {
        $_SESSION["message"] = "Artwork was successfully deleted.";
    } else {
        $_SESSION["message"] = "Artwork could not be deleted.";
    }

    redirect("read.php");
} else {
    $_SESSION["message"] = "Artwork could not be found!";
    redirect("read.php");
}

new_footer("Artopia");
Database::dbDisconnect($mysqli);

?>