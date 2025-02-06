<?php
include 'database/database.php'; 
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Movie Rating</title>
  <link href="statics/css/bootstrap.min.css" rel="stylesheet">
  <script src="statics/js/bootstrap.js"></script>
  <link href="stylesheet" href="https://cdjns.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SCk9ABhg==" crossorigin="anonymous" referrerpolicy="no-referrer"/>
  <style>
    body {
      font-family: 'Times New Roman';
      background-color: #f8f9fa;
      color: #333;
    }

    .container {
      margin-top: 50px;
    }
    .header {
      text-align: center;
      margin-bottom: 30px;
    }
    .header h1 {
      font-size: 60px;
      font-weight: 600;
      color: #2c3e50;
    }
    .movie-card {
      background-color: white;
      border-radius: 8px;
      box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.1);
      padding: 20px;
      margin-bottom: 20px;
    }
    .movie-title {
      font-size: 35px;
      font-weight: 600;
      color: #34495e;
    }
    .no-movies-text {
      font-size: 20px;
      color: #95a5a6;
    }
  </style>
</head>
<body>

  <div class="container">
    <div class="header">
      <h1>Movie Ratings</h1>
      <p>Rate and Share Movies with Others</p>
      <a href="views/create.php" class="btn btn-custom">Add New Movie&nbsp;<i class="fa-solid fa-plus"></i></a>
    </div>

    <?php
      $res = $conn->query("SELECT * FROM movies");
    ?>

    <?php if($res->num_rows > 0): ?>
      <?php while($row = $res->fetch_assoc()): ?>
        <div class="movie-card">
          <h3 class="movie-title"><?= $row['title']; ?></h3>
          <p class="movie-details"><strong>Genre:</strong> <?= $row['genre']; ?></p>
          <p class="movie-details"><strong>Rating:</strong> <?= $row['rating']; ?> / 10</p>
          <p class="movie-details"><strong>Year:</strong> <?= $row['year']; ?></p>

          <div class="movie-action-btns">
            <a href="views/update.php?id=<?= $row['id']; ?>" class="btn btn-sm btn-info">Edit</a>
            <a href="handlers/delete_handler.php?id=<?= $row['id']; ?>" class="btn btn-sm btn-danger">Delete</a>
          </div>
        </div>
      <?php endwhile; ?>
    <?php else: ?>
      <div class="no-movies-text text-center">
        <p>🎉 No movies yet! Time to add some cool and amazing movies!</p>
      </div>
    <?php endif; ?>
  </div>

</body>
</html>
