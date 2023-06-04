<?php 
    require_once("session.php"); 
	require_once("included_functions.php");
	require_once("database.php");

	$mysqli = Database::dbConnect();
	$mysqli -> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

	if (($output = message()) !== null) {
		echo $output;
	}

	new_header("Artopia");
	echo "<h3>Update A TV Show</h3>";
	echo "<div class='row' style='display: flex; justify-content: center; align-items: center;'>";
	echo "<label for='left-label' class='left inline'>";

    if (isset($_POST["submit"])) {
        // Update the Arts table
        $query = "UPDATE Arts SET title = ?, description = ?, price = ? WHERE artId = ?";
        $stmt = $mysqli->prepare($query);
        $stmt->execute([$_POST["title"], $_POST["description"], $_POST["price"], $_POST["artId"]]);
    

        //To update artist information based on artId, fetch the artistId from Arts table 
        //using artId and then update corresponding row in Artist table using artistId.
        $query = "SELECT artistId FROM Arts WHERE artId = ?";
        $stmt = $mysqli->prepare($query);
        $stmt->execute([$_POST["artId"]]);
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        $artistId = $row["artistId"];
    

        $query = "UPDATE Artist SET fName = ?, lName = ? WHERE artistId = ?";
        $stmt = $mysqli->prepare($query);
        $stmt->execute([$_POST["fName"], $_POST["lName"], $artistId]);
    
        $query2 = "INSERT INTO Art_Genre (artId, genreId) VALUES (?, ?)";
        $stmt2 = $mysqli->prepare($query2);
    
        if (isset($_POST["genre"]) && $_POST["genre"] !== "") {
            $queryVerify = "SELECT * FROM Art_Genre WHERE artId = ? AND genreId = ?";
            $stmtVerify = $mysqli->prepare($queryVerify);
            $stmtVerify->execute([$_POST["artId"], $_POST["genre"]]);
            if ($stmtVerify->rowCount() == 0) {
                $stmt2->execute([$_POST["artId"], $_POST["genre"]]);
            }
        }
    
        if ($stmt && $stmt2) {
            $_SESSION["message"] = $_POST["title"] . " has been updated";
        } else {
            $_SESSION["message"] = "Error! Could not update " . $_POST["title"];
        }
    
        redirect("read.php");
    }
    

    
    else {
    
        if (isset($_GET["id"]) && $_GET["id"] !== "") {
              $editID = $_GET["id"];
              //var_dump($editID);
              $query ="SELECT Arts.artId, Art_Genre.genreId, group_concat(name) AS genre, title, fName, lName , description, price FROM Art_Genre JOIN Genre ON Art_Genre. genreId =  Genre.genreId JOIN Arts ON Art_Genre.artId = Arts.artId JOIN Artist ON Arts.artistId = Artist.artistId WHERE Arts.artId = ? ORDER BY Arts.artId";
      
              $stmt = $mysqli -> prepare($query);
              $stmt -> execute([$editID]);

            if ($stmt->errorCode() !== '00000') {
                $errorInfo = $stmt->errorInfo();
                echo 'Error retrieving TV show information: ' . $errorInfo[2];
            }    

             if ($stmt) {
                $row = $stmt->fetch(PDO::FETCH_ASSOC);
                echo "<div style='text-align:center;'>";
                echo "<h3>".$row["title"]." Information</h3>";
                echo "<form style='width: 500px; margin: 0 auto;' action='update.php' method='POST'>";
                echo "<input type='hidden' name='artId' value='".$editID."' />";
                echo "Title: <input type='text' name='title' required value = '".$row["title"]."'/><br />";
                echo "Description: <input type='text' name='description' required value = '".$row["description"]."'/><br />";
                echo "Artist First Name: <input type='text' name='fName' required value = '".$row["fName"]."'/><br />";
                echo "Artist Last Name: <input type='text' name='lName' value = '".$row["lName"]."'/><br />";
                echo "Price: $".$row["price"]."<br />";

            // Include a hidden input field with the price value
                echo "<input type='hidden' name='price' value='".$row["price"]."' />";

                echo "<p> Genres: ".$row["genre"]."</p><br />";
                echo "Genre Type: <select name='genre' required>";
                $stmt2 = $mysqli->prepare("SELECT DISTINCT genreId, name FROM Genre");
                $stmt2->execute();
                echo"<option></option>";
                while ($row = $stmt2->fetch(PDO::FETCH_ASSOC)) {
                    echo "<option value='" . $row['genreId'] . "'>" . $row['name'] . "</option>";
                }
                echo "</select></p>";
                echo "<p><input type='submit' name='submit' value='Update' class='button tiny round' /></p>";
                echo "</form>";
                echo "</div>";

                echo "<br /><p>&laquo:<a href='read.php'>Back to Main Page</a>";
                echo "</label>";
                echo "</div>";
          
            }  
            else {
                $_SESSION["message"] = "TV Show could not be found!";
                redirect("read.php");
            }
            
    }
}
new_footer("Artopia");
Database::dbDisconnect();

?>