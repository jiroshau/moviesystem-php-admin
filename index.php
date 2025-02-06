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
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SCk9ABhg==" crossorigin="anonymous" referrerpolicy="no-referrer"/>
  <style>
    body {
      font-family: 'Poppins', sans-serif;
      background: linear-gradient(135deg,rgb(125, 168, 248),rgb(211, 203, 208));
      margin: 0;
      padding: 0;
      color: #444;
    }

    .container {
      max-width: 1200px;
      margin: 50px auto;
      padding: 0 20px;
    }

    .header {
      text-align: center;
      margin-bottom: 40px;
      color:rgb(245, 246, 246);
    }

    .header h1 {
      font-size: 4rem;
      font-weight: 700;
      letter-spacing: -1px;
    }

    .header p {
      font-size: 1.2rem;
      font-weight: 300;
      color:rgb(245, 246, 246);
    }

    .movie-card {
      background-color: #fff;
      border-radius: 12px;
      box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
      overflow: hidden;
      transition: transform 0.3s ease;
      margin-bottom: 25px;
    }

    .movie-card:hover {
      transform: translateX(-10px);
    }

    .movie-card .movie-title {
      font-size: 2.5rem;
      font-weight: 600;
      color: #2980b9;
    }

    .movie-details {
      font-size: 1.1rem;
      margin: 8px 0;
      color: #34495e;
    }

    .movie-action-btns {
      margin-top: 15px;
    }

    .movie-action-btns .btn {
      background-color:rgb(52, 52, 52);
      color: white;
      border-radius: 25px;
      font-weight: 500;
      padding: 8px 18px;
      margin-right: 10px;
    }

    .btn-custom {
      background-color:rgb(58, 67, 87);
      color: white;
      font-weight: 600;
      padding: 10px 25px;
      font-size: 1.1rem;
    }
  </style>
</head>
<body>

  <div class="container">
    <div class="header">
      <h1>Movie Ratings</h1>
      <p>Rate Your Favorite Movies & Share with the World</p>
      <a href="views/create.php" class="btn btn-custom"><i class="fa-solid fa-plus"></i> Add New Movie</a>
    </div>

    <?php
      $res = $conn->query("SELECT * FROM movies");
    ?>

    <?php if($res->num_rows > 0): ?>
      <?php while($row = $res->fetch_assoc()): ?>
        <div class="movie-card">
          <div class="card-body">
            <h3 class="movie-title"><?= $row['title']; ?></h3>
            <p class="movie-details"><strong>Genre:</strong> <?= $row['genre']; ?></p>
            <p class="movie-details"><strong>Rating:</strong> <?= $row['rating']; ?> / 10</p>
            <p class="movie-details"><strong>Year:</strong> <?= $row['year']; ?></p>

            <div class="movie-action-btns">
              <a href="views/update.php?id=<?= $row['id']; ?>" class="btn btn-sm">Edit</a>
              <a href="handlers/delete_handler.php?id=<?= $row['id']; ?>" class="btn btn-sm">Delete</a>
            </div>
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
