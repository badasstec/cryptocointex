<?php
session_start();

// Check if the user is logged in and is a client, if not then redirect to login page
if (!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true || $_SESSION["role"] !== 'client') {
    header("location: login.php");
    exit;
}
?>

<?php
require_once "./post/config.php";

$sql = "SELECT id, title, content, media, created_at FROM posts ORDER BY created_at DESC";
$stmt = $conn->prepare($sql);
$stmt->execute();
$result = $stmt->get_result();
?>

<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  <link rel="stylesheet" href="styles.css">
  <title>Timevest</title>
</head>
<body>

<!-- Preloader -->
<div id="preloader">
  <div class="container">
    <div class="slice"></div>
    <div class="slice"></div>
    <div class="slice"></div>
    <div class="slice"></div>
    <div class="slice"></div>
    <div class="slice"></div>
  </div>
</div>

<nav class="navbar navbar-expand-lg bg-body-tertiary">
  <div class="container-fluid">
    <a class="navbar-brand" href="#">Welcome <span class="h6"><?php echo htmlspecialchars($_SESSION["username"]); ?></span></a>
    <span class="navbar-text">
      <a href="./logout.php" type="button" class="btn btn-outline-danger">Logout</a>
    </span>
  </div>
</nav>

<div id="carouselExampleDark" class="carousel carousel-dark slide">
  <div class="carousel-indicators">
    <button type="button" data-bs-target="#carouselExampleDark" data-bs-slide-to="0" class="active rounded" aria-current="true" aria-label="Slide 1"></button>
    <button type="button" data-bs-target="#carouselExampleDark" data-bs-slide-to="1" aria-label="Slide 2"></button>
    <button type="button" data-bs-target="#carouselExampleDark" data-bs-slide-to="2" aria-label="Slide 3"></button>
  </div>
  <div class="carousel-inner">
    <div class="carousel-item active" data-bs-interval="10000">
      <img src="./post/img/altumcode-PNbDkQ2DDgM-unsplash.jpg" class="d-block w-100" alt="...">
      <div class="carousel-caption d-none d-md-block">
        <h5 class="text-light">First slide label</h5>
        <p class="text-light">Some representative placeholder content for the first slide.</p>
      </div>
    </div>
    <div class="carousel-item" data-bs-interval="2000">
      <img src="./post/img/pexels-cottonbro-studio-5483070.jpg" class="d-block w-100" alt="...">
      <div class="carousel-caption d-none d-md-block">
        <h5 class="text-light">Second slide label</h5>
        <p class="text-light">Some representative placeholder content for the second slide.</p>
      </div>
    </div>
    <div class="carousel-item">
      <img src="./post/img/pexels-cottonbro-studio-6344239.jpg" class="d-block w-100" alt="...">
      <div class="carousel-caption d-none d-md-block">
        <h5 class="text-light">Third slide label</h5>
        <p class="text-light">Some representative placeholder content for the third slide.</p>
      </div>
    </div>
  </div>
  <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleDark" data-bs-slide="prev">
    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
    <span class="visually-hidden">Previous</span>
  </button>
  <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleDark" data-bs-slide="next">
    <span class="carousel-control-next-icon" aria-hidden="true"></span>
    <span class="visually-hidden">Next</span>
  </button>
</div>

<!-- Carousel ends -->

<div class="container">
  <div class="row">
    <?php
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $title = htmlspecialchars($row['title']);
            $content = htmlspecialchars($row['content']);
            $media = htmlspecialchars($row['media']);
            $fileType = strtolower(pathinfo($media, PATHINFO_EXTENSION));

            // Truncate content for preview
            $previewContent = substr($content, 0, 200);
            $isTruncated = strlen($content) > 200;

            if (in_array($fileType, ['jpg', 'jpeg', 'png', 'gif'])) {
                // Image on the right
                echo '<div class="col mb-4">';
                echo '  <div class="card h-100">';
                echo '    <div class="row g-0">';
                echo '      <div class="col-md-6">';
                echo '        <div class="card-body">';
                echo '          <h1 class="display-6">' . $title . '</h1>';
                echo '          <p class="card-text">' . $previewContent . ($isTruncated ? '<span class="more-text">...</span>' : '') . '</p>';
                echo '          <p class="card-text more-content" style="display:none;">' . $content . '</p>';
                echo '          <a href="#" class="btn btn-primary read-more">Read More</a>';
                echo '          <a href="#" class="btn btn-primary read-less" style="display:none;">Read Less</a>';
                echo '          <a href="#" class="btn btn-success">Follow our socials</a>';
                echo '          <p class="card-text"><small class="text-muted">Posted on ' . $row["created_at"] . '</small></p>';
                echo '        </div>';
                echo '      </div>';
                echo '      <div class="col-md-6">';
                echo '        <img src="' . $media . '" class="img-fluid rounded-end" alt="' . $title . '">';
                echo '      </div>';
                echo '    </div>';
                echo '  </div>';
                echo '</div>';
            } elseif (in_array($fileType, ['mp4', 'avi', 'mov', 'wmv'])) {
                // Video on the left
                echo '<div class="col mb-4">';
                echo '  <div class="card h-100">';
                echo '    <div class="row g-0">';
                echo '      <div class="col-md-6 p-2">';
                echo '        <video width="100%" controls class="img-fluid rounded-start">';
                echo '          <source src="' . $media . '" type="video/' . $fileType . '">';
                echo '        </video>';
                echo '      </div>';
                echo '      <div class="col-md-6 p-2">';
                echo '        <div class="card-body">';
                echo '          <h1 class="display-6">' . $title . '</h1>';
                echo '          <p class="card-text">' . $previewContent . ($isTruncated ? '<span class="more-text">...</span>' : '') . '</p>';
                echo '          <p class="card-text more-content" style="display:none;">' . $content . '</p>';
                echo '          <a href="#" class="btn btn-primary read-more">Read More</a>';
                echo '          <a href="#" class="btn btn-primary read-less" style="display:none;">Read Less</a>';
                echo '          <a href="#" class="btn btn-success">Follow our socials</a>';
                echo '          <p class="card-text"><small class="text-muted">Posted on ' . $row["created_at"] . '</small></p>';
                echo '        </div>';
                echo '      </div>';
                echo '    </div>';
                echo '  </div>';
                echo '</div>';
            }
        }
    } else {
        echo "<div class='alert alert-warning text-center'>No media found.</div>";
    }
    $conn->close();
    ?>
  </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
<script>
  document.addEventListener("DOMContentLoaded", function() {
    const preloader = document.getElementById('preloader');
    window.addEventListener('load', function() {
      preloader.style.display = 'none';
    });

    // Read More/Less functionality
    document.querySelectorAll('.read-more').forEach(button => {
      button.addEventListener('click', function(event) {
        event.preventDefault();
        const cardBody = this.closest('.card-body');
        cardBody.querySelector('.more-content').style.display = 'block';
        cardBody.querySelector('.read-more').style.display = 'none';
        cardBody.querySelector('.read-less').style.display = 'inline';
        cardBody.querySelector('.more-text').style.display = 'none';
      });
    });

    document.querySelectorAll('.read-less').forEach(button => {
      button.addEventListener('click', function(event) {
        event.preventDefault();
        const cardBody = this.closest('.card-body');
        cardBody.querySelector('.more-content').style.display = 'none';
        cardBody.querySelector('.read-more').style.display = 'inline';
        cardBody.querySelector('.read-less').style.display = 'none';
        cardBody.querySelector('.more-text').style.display = 'inline';
      });
    });
  });
</script>
</body>
</html>
