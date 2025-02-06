<?php

include "../database/database.php";

try {

  if ($_SERVER['REQUEST_METHOD'] == "POST") {
    
    $title = $_POST['title'];
    $genre = $_POST['genre'];
    $rating = $_POST['rating'];
    $year = $_POST['year'];

    
    $stmt = $conn->prepare("INSERT INTO movies (title, genre, rating, year) VALUES (?, ?, ?, ?)");

    
    $stmt->bind_param("ssss", $title, $genre, $rating, $year);


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
