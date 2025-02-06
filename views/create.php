<?php
include '../database/database.php';

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
        echo "Error: " . $stmt->error;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Add Movie</title>
  <link href="../statics/css/bootstrap.min.css" rel="stylesheet">
  <script src="../statics/js/bootstrap.js"></script>
</head>
<body>
  <div class="container mt-5">
    <h2>Add New Movie</h2>
    <form action="create.php" method="POST">
      <div class="mb-3">
        <label for="title" class="form-label">Movie Name</label>
        <input type="text" class="form-control" id="title" name="title" required>
      </div>
      <div class="mb-3">
        <label for="genre" class="form-label">Genre</label>
        <textarea class="form-control" id="genre" name="genre" rows="4" required></textarea>
      </div>
      <div class="mb-3">
        <label for="rating" class="form-label">Rating</label>
        <textarea class="form-control" id="rating" name="rating" rows="4" required></textarea>
      </div>
      <div class="mb-3">
        <label for="year" class="form-label">Year</label>
        <textarea class="form-control" id="year" name="year" rows="4" required></textarea>
      </div>
      <button type="submit" class="btn btn-success">Add Movie</button>
    </form>
  </div>
</body>
</html>
