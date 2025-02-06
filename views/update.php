<?php
// Include database connection
include '../database/database.php';

// Get the recipe ID from the URL
$id = $_GET['id'];

// Fetch the recipe from the database
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
<script>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Update Recipe</title>
  <link href="../statics/css/bootstrap.min.css" rel="stylesheet">
  <script src="../statics/js/bootstrap.js"></script>
  <script src="../statics/js/bootstrap.bundle.js"></script>
</head>
<body>
  <div class="container mt-5">
    <h2>Update Movie</h2>
    <form action="update.php?id=<?= $row['id']; ?>" method="POST">
      <div class="mb-3">
        <label for="title" class="form-label">Movie Title</label>
        <input type="text" class="form-control" id="title" name="title" value="<?= $row['title']; ?>" required>
      </div>
      <div class="mb-3">
        <label for="genre" class="form-label">Genre</label>
        <textarea class="form-control" id="genre" name="genre" rows="4" required><?= $row['genre']; ?></textarea>
      </div>
      <div class="mb-3">
        <label for="rating" class="form-label">Rating</label>
        <textarea class="form-control" id="rating" name="rating" rows="4" required><?= $row['rating']; ?></textarea>
      </div>
      <div class="mb-3">
        <label for="year" class="form-label">Year</label>
        <textarea class="form-control" id="year" name="year" rows="4" required><?= $row['year']; ?></textarea>
      </div>
      <button type="submit" class="btn btn-success">Update Movie</button>
    </form>
  </div>
</body>
</html>
