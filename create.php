<?php
    require_once("session.php"); 
    require_once("included_functions.php");
    require_once("database.php");

    $mysqli = Database::dbConnect();
    $mysqli -> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	new_header("Artopia 2023"); 

    if (($output = message()) !== null) {
        echo $output;
    }
	echo "<h3 style='text-align:center;'>Enter Art Information</h3>";
    echo "<div class='row' style='display: flex; justify-content: center; align-items: center;'>";
    echo "<label for='left-label' class='left inline'>";
	

    if (isset($_POST["submit"])) {
        if( (isset($_POST["genre"]) && $_POST["genre"] !== "") && (isset($_POST["title"]) && $_POST["title"] !== "") &&(isset($_POST["artist_first_name"]) && $_POST["artist_first_name"] !== "") &&(isset($_POST["artist_last_name"]) && $_POST["artist_last_name"] !== "") &&(isset($_POST["description"]) && $_POST["description"] !== "") && (isset($_POST["price"]) && $_POST["price"] !== "")) {

            // Insert artist's name into the Artist table
            $query = "INSERT INTO Artist (fName, lName) VALUES (?, ?)";
            $stmt = $mysqli->prepare($query);
            $stmt->execute([$_POST["artist_first_name"], $_POST["artist_last_name"]]);

            // Get the artistId of the last inserted artist
            $artistId = $mysqli->lastInsertId();

            // Insert the art piece into the Arts table
            $query = "INSERT INTO Arts (title, artistId, description, price) VALUES (?, ?, ?, ?)";
            $stmt = $mysqli->prepare($query);
            $stmt->execute([$_POST['title'], $artistId, $_POST['description'], $_POST['price']]);

            // Get the artId of the last inserted art piece
            $artId = $mysqli->lastInsertId();

            // Insert the art piece and genre into the Art_Genre table
            $query = "INSERT INTO Art_Genre (artId, genreId) VALUES (?, ?)";
            $stmt = $mysqli->prepare($query);
            $stmt->execute([$artId, $_POST["genre"]]);

            if ($stmt) {
                $_SESSION["message"] = $_POST['title']." has been added";
                redirect("read.php");
            } else {
                $_SESSION["message"] = "Error adding ".$_POST['title'];
                redirect("create.php");
            }
        }
        else {
            $_SESSION["message"] = "Unable to add art piece. Fill in all information!";
            redirect("create.php");
        }
    } else {
        echo "<div style='text-align:center;'>"; 
        echo "<form  style='width: 500px; margin: 0 auto; action='create.php' method='POST'>"; 
        echo "Title: <input type='text' name='title' required /><br />";
        echo "Description: <input type='text' name='description' required/><br />";
        echo "Artist First Name: <input type='text' name='artist_first_name' required /><br />";
        echo "Artist Last Name: <input type='text' name='artist_last_name' /><br />";
        echo "Price: <input type='number' name='price' required/><br />";
		echo "Genre Type: <select name='genre' required>";
        $stmt2 = $mysqli->prepare("SELECT DISTINCT genreId, name FROM Genre");
        $stmt2->execute();
        while ($row = $stmt2->fetch(PDO::FETCH_ASSOC)) {
            echo "<option value='" . $row['genreId'] . "'>" . $row['name'] . "</option>";
        }
        echo "</select></p>";
        echo "<p><input type='submit' name='submit' value='Add' class='button tiny round' /></p>";
        echo "</form>";
        echo "</div>"; 
    }
echo "<br /><p>&laquo:<a href='read.php'>Back to Main Page</a>";
new_footer("Artopia");
Database::dbDisconnect();
?>


