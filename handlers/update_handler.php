<?php

include "../database/db.php";

try {

  if ($_SERVER['REQUEST_METHOD'] == "POST") {
   
    $id = $_POST['id'];
    $title = $_POST['title'];
    $genre = $_POST['genre'];
    $rating = $_POST['rating'];
    $year = $_POST['year'];

    
    $stmt = $conn->prepare("UPDATE movies SET title = ?, genre = ?, rating = ?, year = ? WHERE id = ?");

    $stmt->bind_param("ssssi", $title, $genre, $rating, $year, $id);

    
    if ($stmt->execute()) {
      
      header("Location: ../index.php");
      exit;
    } else {
      
      echo "Operation failed: " . $stmt->error;
    }
  }

} catch (\Exception $e) {
 
  echo "Error: " . $e->getMessage();
}
?>
