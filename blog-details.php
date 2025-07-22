<?php
include 'db.php';

if (isset($_GET['post_id'])) {
    $post_id = $_GET['post_id'];
    $stmt = $conn->prepare("SELECT * FROM posts WHERE post_id = :post_id");
    $stmt->execute(['post_id' => $post_id]);
    $post = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$post) {
        echo "Post not found!";
        exit;
    }
} else {
    echo "No post specified!";
    exit;
}

$title = $post['title'];
$description = $post['description'];
$author = $post['author'];
$created_at = $post['created_at'];
$image = $post['image'];
$category = $post['category'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">
  <title>Blog - Details | Janith Aththanayaka</title>
  <meta name="description" content="Stay updated with latest blog posts, updates, and news from Janith Aththanayaka's tech and innovation journey.">
  <meta name="keywords" content="Janith Aththanayaka, Blog, News, Web Development, AI, Robotics, Innovation, Sri Lanka">
  <meta name="author" content="Janith Aththanayaka">
  <link href="assets/img/favicon.png" rel="icon">
  <link href="assets/img/apple-touch-icon.png" rel="apple-touch-icon">
  <link href="https://fonts.googleapis.com/css2?family=Ubuntu:wght@400;700&family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/aos@3.0.0-beta.6/dist/aos.css" rel="stylesheet">
  <link href="assets/css/main.css" rel="stylesheet">
</head>

<body>
<!-- ======= Header ======= -->
  <header id="header" class="header dark-background d-flex flex-column justify-content-center">
    <i class="header-toggle d-xl-none bi bi-list"></i>
    <div class="header-container d-flex flex-column align-items-start">
      <nav id="navmenu" class="navmenu">
        <ul>
          <li><a href="index.html#hero"><i class="bi bi-house navicon"></i> Home</a></li>
          <li><a href="index.html#about"><i class="bi bi-person navicon"></i> About</a></li>
          <li><a href="index.html#resume"><i class="bi bi-file-earmark-text navicon"></i> Resume</a></li>
          <li><a href="index.html#portfolio"><i class="bi bi-images navicon"></i> Portfolio</a></li>
          <li><a href="index.html#services"><i class="bi bi-hdd-stack navicon"></i> Services</a></li>
          <li class="dropdown">
            <a href="#"><i class="bi bi-menu-button navicon"></i> <span>More</span> <i class="bi bi-chevron-down toggle-dropdown"></i></a>
            <ul>
              <li><a href="assets/pdf/Janith Aththanayaka CV resume.pdf" download>Download CV</a></li>
              <li><a href="https://g.dev/janithaththanayaka" target="_blank">Google Developer</a></li>
              <li><a href="blog.php" class="active">Blog</a></li>
            </ul>
          </li>
          <li><a href="index.html#contact"><i class="bi bi-envelope navicon"></i> Contact</a></li>
        </ul>
      </nav>
      <div class="social-links text-center mt-3">
        <a href="https://twitter.com" target="_blank" class="twitter"><i class="bi bi-twitter"></i></a>
        <a href="https://facebook.com" target="_blank" class="facebook"><i class="bi bi-facebook"></i></a>
        <a href="https://instagram.com" target="_blank" class="instagram"><i class="bi bi-instagram"></i></a>
        <a href="https://g.dev/janithaththanayaka" target="_blank" class="google-plus"><i class="bi bi-google"></i></a>
        <a href="https://www.linkedin.com/in/janithaththanayaka" target="_blank" class="linkedin"><i class="bi bi-linkedin"></i></a>
      </div>
    </div>
  </header>

<main class="main">

  <section class="page-title py-5 position-relative">
    <a href="blog.php" class="btn btn-outline-light mb-3 position-absolute top-0 start-0 m-3" style="z-index: 10;">
      <i class="bi bi-arrow-left"></i> Back
    </a>
    <div class="container text-center">
      <h1 class="text-white"><?= htmlspecialchars($title) ?></h1>
      <p class="text-light">Published on <?= date("F d, Y", strtotime($created_at)) ?> by <?= htmlspecialchars($author) ?></p>
      <nav class="breadcrumbs mt-3 d-flex justify-content-center">
        <ol class="breadcrumb mb-0">
          <li class="breadcrumb-item"><a href="index.html">Home</a></li>
          <li class="breadcrumb-item"><a href="blog.php">Blog</a></li>
          <li class="breadcrumb-item active">Blog Details</li>
        </ol>
      </nav>
    </div>
  </section>

  <section id="blog-details" class="blog-details section py-5">
    <div class="container">
      <div class="row justify-content-center">
        <div class="col-lg-10">

          <div class="post-img mb-4">
            <img src="<?= htmlspecialchars($image) ?>" class="img-fluid w-100 rounded shadow" alt="Blog Image">
          </div>

          <div class="mb-3">
            <span class="badge bg-success"><?= htmlspecialchars($category) ?></span>
          </div>

          <h2 class="mb-4"><?= htmlspecialchars($title) ?></h2>

          <div class="meta-top text-muted mb-4">
            <i class="bi bi-person me-2"></i><?= htmlspecialchars($author) ?>
            <span class="mx-2">|</span>
            <i class="bi bi-clock me-2"></i><?= date("F d, Y", strtotime($created_at)) ?>
          </div>

          <div class="content mb-5">
            <p><?= nl2br(htmlspecialchars($description)) ?></p>
          </div>

          <div class="tags mt-4">
            <h6 class="mb-2">Tags:</h6>
            <ul class="list-inline">
              <li class="list-inline-item"><span class="badge bg-secondary">Creative</span></li>
              <li class="list-inline-item"><span class="badge bg-secondary">Tips</span></li>
              <li class="list-inline-item"><span class="badge bg-secondary">Marketing</span></li>
            </ul>
          </div>

        </div>
      </div>
    </div>
  </section>

</main>

<!-- ======= Footer ======= -->
  <footer id="footer" class="footer position-relative">
    <div class="container">
      <div class="copyright text-center ">
        <p>© <span>Copyright</span> <strong class="px-1 sitename">Janithfolio</strong> <span>All Rights Reserved</span></p>
      </div>
      <div class="credits">
        Designed by <a href="https://janithaththanayaka.com/">me</a>
      </div>
    </div>
  </footer>

<!-- Scripts -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/aos@3.0.0-beta.6/dist/aos.js"></script>
<script src="assets/js/main.js"></script>
</body>
</html>
