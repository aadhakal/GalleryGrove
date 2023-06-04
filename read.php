<?php
    require_once("session.php");
    require_once("included_functions.php");
    require_once("database.php");

    new_header("Artopia 2023");

    $mysqli = Database::dbConnect();
    $mysqli->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    if (($output = message()) !== null) {
        echo $output;
    }

    $query = "SELECT a.artId, a.title, CONCAT(ar.fName, ' ', ar.lName) AS artist, a.description, a.price, 
    GROUP_CONCAT(DISTINCT g.name ORDER BY g.name SEPARATOR ',') AS genre
    FROM Art_Genre ag
    JOIN Genre g ON ag.genreId = g.genreId
    JOIN Arts a ON ag.artId = a.artId
    JOIN Artist ar ON a.artistId = ar.artistId
    GROUP BY a.artId, a.title, artist, a.description, a.price
    ORDER BY a.artId ASC;";

    $stmt = $mysqli->prepare($query);
    $stmt->execute();

    if ($stmt) {
        echo "<div class='row'>";
        echo "<center>";
        echo "<h2>Artopia</h2>";
        echo "<table>";
        echo "<thead>";
        echo "<tr><th></th><th>Artist</th><th>Genre</th><th>Title</th><th>Description</th><th>Price</th></tr>";
        echo "</thead>";
        echo "<tbody>";
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $artist = $row['artist'];
            $title = $row['title'];
            $description = $row['description'];
            $price = $row['price'];
            $genre = $row['genre'];

            echo "<tr>";
            echo "<td><a href='delete.php?id=".urlencode($row['artId'])."' onclick='return confirm(\"Are you sure want to delete?\");' style='color:red;'>X</a></td>";
            echo "<td>{$artist}</td>";
            echo "<td>{$genre}</td>";
            echo "<td>{$title}</td>";
            echo "<td>{$description}</td>";
            echo "<td>{$price}</td>";
            echo "<td><a href='update.php?id=".urlencode($row['artId'])."'>Edit</a></td>";
            echo "</tr>";
        }
        echo "</tbody>";
        echo "</table>";
        echo "<p><a href='create.php'>Add a new art piece</a></p>";
        echo "<a href='read1.php'>Other queries</a>";
        echo "</center>";
        echo "</div>";
    } else {
        echo "Error: " . $mysqli->error;
    }

    new_footer("Artopia ");
    Database::dbDisconnect($mysqli);
?>