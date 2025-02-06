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
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">
  <style>
    body {
      font-family: 'Poppins', sans-serif;
      background: linear-gradient(135deg,rgb(125, 168, 248),rgb(211, 203, 208));
      color: #444;
    }

    .container {
      max-width: 800px;
      margin-top: 80px;
      background-color: #fff;
      border-radius: 12px;
      padding: 40px;
    }

    .header {
      text-align: center;
      margin-bottom: 30px;
    }

    .header h2 {
      font-size: 2.5rem;
      font-weight: 600;
      color: #2d3436;
    }

    .form-control {
      font-size: 1.1rem;
      padding: 15px;
      border-radius: 8px;
      margin-bottom: 15px;
    }

    .btn-success {
      background-color: #2ecc71;
      color: white;
      border-radius: 25px;
      font-weight: 600;
      padding: 10px 30px;
      font-size: 1.2rem;
    }

    .btn-custom {
      background-color: #3498db;
      color: white;
      font-weight: 500;
      border-radius: 25px;
      padding: 10px 30px;
      text-decoration: none;
    }

    .btn-custom:hover {
      background-color: #2980b9;
    }

    .text-center {
      margin-top: 20px;
    }
    .header h2 {
        font-size: 2rem;
    }
  </style>
</head>
<body>

  <div class="container">
    <div class="header">
      <h2>Add New Movie</h2>
      <p class="text-muted">Fill out the form to add a new movie</p>
    </div>
    <form action="create.php" method="POST">
      <div class="mb-3">
        <label for="title" class="form-label">Movie Name</label>
        <input type="text" class="form-control" id="title" name="title" required>
      </div>
      <div class="mb-3">
        <label for="genre" class="form-label">Genre</label>
        <input type="text" class="form-control" id="genre" name="genre" required>
      </div>
      <div class="mb-3">
        <label for="rating" class="form-label">Rating</label>
        <input type="number" class="form-control" id="rating" name="rating" min="0" max="10" step="0.1" required>
      </div>
      <div class="mb-3">
        <label for="year" class="form-label">Year</label>
        <input type="number" class="form-control" id="year" name="year" min="1900" max="<?= date('Y') ?>" required>
      </div>
      <button type="submit" class="btn btn-success w-100">Add Movie</button>
    </form>
  </div>

</body>
</html>
