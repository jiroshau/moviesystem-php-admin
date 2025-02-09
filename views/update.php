<?php
include '../database/database.php';

$id = $_GET['id'];

$res = $conn->query("SELECT * FROM movies WHERE id = $id");
$row = $res->fetch_assoc();

if ($_SERVER['REQUEST_METHOD'] == "POST") {
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
        echo "Error: " . $stmt->error;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Update Movie</title>
  <link href="../statics/css/bootstrap.min.css" rel="stylesheet">
  <script src="../statics/js/bootstrap.js"></script>
  <script src="../statics/js/bootstrap.bundle.js"></script>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg==" crossorigin="anonymous" referrerpolicy="no-referrer" />

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

    .btn-success {
      background-color: #2ecc71;
      color: white;
      border-radius: 25px;
      font-weight: 600;
      padding: 10px 30px;
      font-size: 1.2rem;
    }
    .text-center {
      margin-top: 20px;
    }

    .header h2 {
      font-size: 2rem;
    }

    .form-control {
      font-size: 1rem;
      padding: 12px;
    }
    
  </style>
</head>
<body>

  <div class="container">
    <div class="header">
      <h2>Update Movie</h2>
      <p class="text-muted">Edit the details of the movie below</p>
    </div>
    <form action="update.php?id=<?= $row['id']; ?>" method="POST">
      <div class="mb-3">
        <label for="title" class="form-label">Movie Title</label>
        <input type="text" class="form-control" id="title" name="title" value="<?= $row['title']; ?>" required>
      </div>
      <div class="mb-3">
        <label for="genre" class="form-label">Genre</label>
        <input type="text" class="form-control" id="genre" name="genre" value="<?= $row['genre']; ?>" required>
      </div>
      <div class="mb-3">
        <label for="rating" class="form-label">Rating</label>
        <input type="number" class="form-control" id="rating" name="rating" min="0" max="10" step="0.1" value="<?= $row['rating']; ?>" required>
      </div>
      <div class="mb-3">
        <label for="year" class="form-label">Year</label>
        <input type="number" class="form-control" id="year" name="year" min="1900" max="<?= date('Y') ?>" value="<?= $row['year']; ?>" required>
      </div>
      <button type="submit" class="btn btn-success w-100">
        Update Movie <i class="fa-solid fa-pencil"></i>
      </button>
    </form>
  </div>

</body>
</html>
