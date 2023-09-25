<?php
    require_once("session.php");
    require_once("included_functions.php");
    require_once("database.php");

    new_header("GalleryGrove 2023");
    $mysqli = Database::dbConnect();
    $mysqli->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    if (($output = message()) !== null) {
        echo $output;
    }

    $query = "SELECT g.name AS genre_name, COUNT(a.artId) AS num_artworks, AVG(a.price) AS average_price FROM Art_Genre ag JOIN Genre g ON ag.genreId = g.genreId JOIN Arts a ON ag.artId = a.artId GROUP BY g.name ORDER BY g.name;";

    $stmt = $mysqli->prepare($query);
    $stmt->execute();

    if ($stmt) {
        echo "<div class='row'>";
        echo "<center>";
        echo "<h2>Average Art Price by Genre</h2>";
        echo "<table>";
        echo "<thead>";
        echo "<tr><th>Genre Name</th><th>Quantity</th><th>Average Price</th></tr>";
        echo "</thead>";
        echo "<tbody>";
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $name = $row['genre_name'];
            $artworks = $row['num_artworks'];
            $avg = $row['average_price'];
        
            echo "<tr>";
           // echo "<td><a href='delete.php?id=".urlencode($row['artistId'])."' onclick='return confirm(\"Are you sure want to delete?\");' style='color:red;'>X</a></td>";
            echo "<td>{$name}</td>";
            echo "<td>{$artworks}</td>";
             echo "<td>$" . number_format($avg, 2) ."</td>";
            //echo "<td><a href='edit.php?id=".urlencode($row['artistId'])."'>Edit</a></td>";
            echo "</tr>";
        }
        echo "</tbody>";
        echo "</table>";
        echo "</center>";
        echo "</div>";

    } else {
        echo "Error: " . $mysqli->error;
    }

    // query 2
    $query2 = "SELECT CONCAT(Seller.lname, ' ', Seller.fname) AS seller, Transactions.date, SUM(Transactions.amount) AS total_amount
    FROM Transactions
    JOIN Seller ON Transactions.userId = Seller.sellerId
    GROUP BY Transactions.userId, Transactions.date
    ORDER BY Transactions.date, Seller.fname ASC;";


    $stmt2 = $mysqli->prepare($query2);
    $stmt2->execute();

    if ($stmt2) {
        echo "<div class='row'>";
        echo "<center>";
        echo "<h2>Recent Sellers (By Date)</h2>";
        echo "<table>";
        echo "<thead>";
        echo "<tr><th>Seller</th><th>Date</th><th>Amount</th></tr>";
        echo "</thead>";
        echo "<tbody>";
        while ($row = $stmt2->fetch(PDO::FETCH_ASSOC)) {
            $seller = $row['seller'];
            $date = $row['date'];
            $amount = $row['total_amount'];
            
            echo "<tr>";
            // echo "<td><a href='delete.php?id=".urlencode($row['artistId'])."' onclick='return confirm(\"Are you sure want to delete?\");' style='color:red;'>X</a></td>";
            echo "<td>{$seller}</td>";
            echo "<td>{$date}</td>";
            echo "<td>$" . number_format($amount, 2) . "</td>";
            // echo "<td><a href='edit.php?id=".urlencode($row['artistId'])."'>Edit</a></td>";
            echo "</tr>";
        }
        echo "</tbody>";
        echo "</table>";
        echo "</center>";
        echo "</div>";

    } else {
        echo "Error: " . $mysqli->error;
    }

    // query 3
    $query3 = "SELECT a.title, CONCAT(ar.fName, ' ' ,ar.lName) as artist
    FROM Arts a
    JOIN Artist ar ON a.artistId = ar.artistId
    WHERE a.price > 200
    AND a.artistId IN (
        SELECT artistId
        FROM Artist
        WHERE lName IN ('van Gogh', 'Picasso')
    );";

    $stmt3 = $mysqli->prepare($query3);
    $stmt3->execute();

    if ($stmt3) {
        echo "<div class='row'>";
        echo "<center>";
        echo "<h2>Art pieces over $200 by Van Gogh and Picasso</h2>";
        echo "<table>";
        echo "<thead>";
        echo "<tr><th>Title</th><th>Artist</th></tr>";
        echo "</thead>";
        echo "<tbody>";
        while ($row = $stmt3->fetch(PDO::FETCH_ASSOC)) {
            $title = $row['title'];
            $artist = $row['artist'];
            
            echo "<tr>";
            echo "<td>{$title}</td>";
            echo "<td>{$artist}</td>";
            echo "</tr>";
        }
        echo "</tbody>";
        echo "</table>";
        echo "</center>";
        echo "</div>";

    } else {
        echo "Error: " . $mysqli->error;
    }

    // query 4
    $query4 = "SELECT 
    CONCAT(Artist.fName, ' ', Artist.lName) AS Artist_Name,
    GROUP_CONCAT(CONCAT(Seller.fName, ' ', Seller.lName) ORDER BY Seller.lName ASC SEPARATOR ', ') AS users
    FROM Payment
    JOIN Arts ON Payment.artId = Arts.artId
    JOIN Artist ON Arts.artistId = Artist.artistId
    JOIN Seller ON Payment.userId = Seller.sellerId
    GROUP BY Artist.artistId, Artist_Name
    ORDER BY Artist.lName ASC;";

    $stmt4 = $mysqli->prepare($query4);
    $stmt4->execute();

    if ($stmt4) {
        echo "<div class='row'>";
        echo "<center>";
		echo "<h2>Curios which artist has more users?</h2>";
        echo "<table>";
        echo "<thead>";
        echo "<tr><th>Artist_Name</th><th>users</th></tr>";
        echo "</thead>";
        echo "<tbody>";
        while ($row = $stmt4->fetch(PDO::FETCH_ASSOC)) {
            $artist = $row['Artist_Name'];
            $users = $row['users'];
            
            echo "<tr>";
            echo "<td>{$artist}</td>";
            echo "<td>{$users}</td>";
            echo "</tr>";
        }
        echo "</tbody>";
        echo "</table>";
		echo "<br /><p>&laquo:<a href='read.php'>Back to Main Page</a>";
        echo "</center>";
        echo "</div>";

    } else {
        echo "Error: " . $mysqli->error;
    }
	
	
    new_footer("GalleryGrove");
    Database::dbDisconnect($mysqli);
?>
