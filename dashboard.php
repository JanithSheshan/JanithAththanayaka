<?php
session_start();
if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit;
}

include 'db.php';

try {
    $stmt = $conn->query("SELECT * FROM posts ORDER BY created_at DESC");
    $posts = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    die("Error fetching posts: " . htmlspecialchars($e->getMessage()));
}

$user_type = $_SESSION['user_type'] ?? '';
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Dashboard | Janith Aththanayaka</title>

  <!-- Main & Vendor CSS -->
  <link href="assets/css/main.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css" rel="stylesheet">
  <link rel="icon" href="assets/img/favicon.png">
  <link rel="apple-touch-icon" href="assets/img/apple-touch-icon.png">

  <style>
body, .main, .section, .container, .table, .table-bordered, .bg-dark, .header, .dropdown-menu {
    background: #181818 !important;
    color: #ffffffff !important;
}
.header, .header-container, .navmenu, .dropdown-menu {
    background: #181818 !important;
}
.table thead, .table thead th {
    background: #222 !important;
    color: #FFD700 !important;
    border-color: #FFD700 !important;
}
.table tbody tr {
    background: #232323 !important;
    color: #FFD700 !important;
}
.table-bordered td, .table-bordered th {
    border-color: #FFD700 !important;
}
.btn-primary {
    background: #FFD700 !important;
    color: #181818 !important;
    border: none !important;
}
.btn-danger{
    background: #ff1717ff !important;
    color: #ffffff !important;
}
.btn-danger:hover {
    background: #fffb00ff !important;
    color: #ffffff !important;
}
.btn-primary:hover, .btn-warning:hover {
    background: #fff700 !important;
    color: #181818 !important;
}
.accent-text, .dashboard-title, .dashboard-subtitle {
    color: #FFD700 !important;
}
a, a.navicon, .navmenu a, .dropdown-menu a {
    color: #FFD700 !important;
}
a:hover, .navmenu a:hover, .dropdown-menu a:hover {
    color: #fff700 !important;
    text-decoration: underline;
}
.bg-circle {
    background: rgba(255, 215, 0, 0.1) !important;
}
.alert-info {
    background: #222 !important;
    color: #FFD700 !important;
    border-color: #FFD700 !important;
}
.social-links a {
    color: #FFD700 !important;
}
.social-links a:hover {
    color: #fff700 !important;
}
</style>
</head>

<body>

<!-- Reuse your current sidebar header -->
<header id="header" class="header dark-background d-flex flex-column justify-content-center">
  <i class="header-toggle d-xl-none bi bi-list"></i>

  <div class="header-container d-flex flex-column align-items-start">
    <nav id="navmenu" class="navmenu">
      <ul>
        <li><a href="index.html"><i class="bi bi-house navicon"></i> Home</a></li>
        <li><a href="#about"><i class="bi bi-person navicon"></i> About</a></li>
        <li><a href="#resume"><i class="bi bi-file-earmark-text navicon"></i> Resume</a></li>
        <li><a href="#portfolio"><i class="bi bi-images navicon"></i> Portfolio</a></li>
        <li><a href="#services"><i class="bi bi-hdd-stack navicon"></i> Services</a></li>
        <li class="dropdown">
          <a class="toggle-dropdown"><i class="bi bi-menu-button navicon"></i><span>More</span> <i class="bi bi-chevron-down toggle-dropdown"></i></a>
          <ul>
            <li><a href="assets/pdf/Janith Aththanayaka CV resume.pdf" download>Download CV</a></li>
            <li><a href="https://g.dev/janithaththanayaka" target="_blank">Google Developer</a></li>
            <li><a href="blog.php">Blog</a></li>
          </ul>
        </li>
        <li><a href="#contact"><i class="bi bi-envelope navicon"></i> Contact</a></li>
        <li><a href="logout.php" class="btn btn-danger ms-2">Logout</a></li>
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

  <!-- Admin Dashboard Section -->
  <section id="dashboard" class="section">

    <div class="background-elements">
      <div class="bg-circle circle-1"></div>
      <div class="bg-circle circle-2"></div>
    </div>

    <div class="container">
      <div class="row justify-content-center">

        <div class="col-lg-12" data-aos="fade-up" data-aos-delay="100">

          <div class="text-center mb-4">
            <h1 class="dashboard-title"><span class="accent-text">Admin</span> Dashboard</h1>
            <p class="dashboard-subtitle">
              Manage your content and users effectively through this interface.
            </p>
            <a href="create-post.php" class="btn btn-primary mb-3"><i class="bi bi-plus-circle me-2"></i>Create New Post</a>
          </div>

          <div class="table-responsive">
            <?php if (!empty($posts)): ?>
              <table class="table table-bordered align-middle">
                <thead class="text-center bg-dark text-white">
                  <tr>
                    <th>Title</th>
                    <th>Author</th>
                    <th>Category</th>
                    <th style="min-width: 120px;">Actions</th>
                  </tr>
                </thead>
                <tbody>
                  <?php foreach ($posts as $post): ?>
                    <tr>
                      <td data-label="Title"><?= htmlspecialchars($post['title']) ?></td>
                      <td data-label="Author"><?= htmlspecialchars($post['author']) ?></td>
                      <td data-label="Category"><?= htmlspecialchars($post['category']) ?></td>
                      <td data-label="Actions">
                        <a href="edit-post.php?post_id=<?= urlencode($post['post_id']) ?>" class="btn btn-warning btn-sm mb-1">Edit</a>
                        <a href="delete-post.php?post_id=<?= urlencode($post['post_id']) ?>" class="btn btn-danger btn-sm"
                          onclick="return confirm('Are you sure you want to delete this post?');">Delete</a>
                      </td>
                    </tr>
                  <?php endforeach; ?>
                </tbody>
              </table>
            <?php else: ?>
              <div class="alert alert-info text-center">No posts found.</div>
            <?php endif; ?>
          </div>

        </div>

      </div>
    </div>

  </section><!-- /Admin Dashboard Section -->

</main>


<!-- JS Scripts -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script src="assets/js/main.js"></script>
</body>
</html>
