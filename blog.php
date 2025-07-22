<?php include 'db.php'; ?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">
  <title>Blog | Janith Aththanayaka</title>
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

<body class="blog-page">
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

  <!-- ======= Main ======= -->
  <main id="blog" class="main section">
    <div class="container" data-aos="fade-up">
      <div class="section-title">
        <h2>Blog</h2>
        <p>Stay updated with the latest tech insights, personal projects, and tutorials by Janith Aththanayaka.</p>
      </div>

      <!-- Inline Category List with Icons and Search -->
      <div class="mb-4">
        <div class="d-flex align-items-center mb-3">
          <h5 class="mb-0 me-3">Categories</h5>
          <input type="text" class="form-control form-control-sm w-auto" id="category-search" placeholder="Search categories..." autocomplete="off" style="min-width:180px;">
        </div>
        <ul class="list-inline" id="category-list" style="overflow-x:auto; white-space:nowrap;">
          <li class="list-inline-item category-item active" data-category="all" style="cursor:pointer;">
        <span class="d-inline-flex align-items-center px-3 py-2 border rounded">
          <i class="bi bi-grid me-2"></i>All
          <span class="badge bg-secondary rounded-pill ms-2">
            <?php
          $total_sql = "SELECT COUNT(*) as total FROM posts";
          $total_stmt = $conn->query($total_sql);
          $total = $total_stmt->fetch(PDO::FETCH_ASSOC);
          echo htmlspecialchars($total['total']);
            ?>
          </span>
        </span>
          </li>
          <?php
        $iconMap = [
          'ai' => 'bi-cpu',
          'web development' => 'bi-code-slash',
          'robotics' => 'bi-robot',
          'innovation' => 'bi-lightbulb',
          'news' => 'bi-newspaper',
          // Add more mappings as needed
        ];
        $cat_sql = "SELECT category, COUNT(*) as count FROM posts GROUP BY category ORDER BY category ASC";
        $cat_stmt = $conn->query($cat_sql);
        while ($cat = $cat_stmt->fetch(PDO::FETCH_ASSOC)) {
          $categoryClass = 'category-' . preg_replace('/[^a-zA-Z0-9_-]/', '', strtolower(str_replace(' ', '-', $cat['category'])));
          $iconKey = strtolower($cat['category']);
          $icon = isset($iconMap[$iconKey]) ? $iconMap[$iconKey] : 'bi-folder2-open';
          echo '<li class="list-inline-item category-item ' . $categoryClass . '" data-category="' . htmlspecialchars($cat['category']) . '" data-category-class="' . $categoryClass . '" style="cursor:pointer;">';
          echo '<span class="d-inline-flex align-items-center px-3 py-2 border rounded">';
          echo '<i class="bi ' . $icon . ' me-2"></i>' . htmlspecialchars($cat['category']);
          echo '<span class="badge bg-primary rounded-pill ms-2">' . htmlspecialchars($cat['count']) . '</span>';
          echo '</span>';
          echo '</li>';
        }
          ?>
        </ul>
      </div>
      <script>
        // Category search filter
        document.addEventListener('DOMContentLoaded', function () {
          const searchInput = document.getElementById('category-search');
          const categoryItems = document.querySelectorAll('#category-list li');

          searchInput.addEventListener('input', function () {
        const val = this.value.toLowerCase();
        categoryItems.forEach(item => {
          if (item.textContent.toLowerCase().includes(val) || item.getAttribute('data-category') === 'all') {
            item.style.display = '';
          } else {
            item.style.display = 'none';
          }
        });
          });
        });
      </script>
      <script>
        document.addEventListener('DOMContentLoaded', function () {
          const categoryItems = document.querySelectorAll('.category-item');
          const posts = document.querySelectorAll('.blog-post');

          categoryItems.forEach(item => {
            item.addEventListener('click', function () {
              categoryItems.forEach(i => i.classList.remove('active'));
              this.classList.add('active');
              const selected = this.getAttribute('data-category');
              const selectedClass = this.getAttribute('data-category-class');
              posts.forEach(post => {
                if (selected === 'all' || post.classList.contains(selectedClass)) {
                  post.parentElement.style.display = '';
                } else {
                  post.parentElement.style.display = 'none';
                }
              });
            });
          });
        });
      </script>
      </script>

      <div class="row gy-4">
        <?php
          $sql = "SELECT * FROM posts ORDER BY created_at DESC LIMIT 15";
          $result = $conn->query($sql);
          while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
          $categoryClass = 'category-' . preg_replace('/[^a-zA-Z0-9_-]/', '', strtolower(str_replace(' ', '-', $row['category'])));
          echo '<div class="col-lg-4 col-md-6">';
          echo '  <div class="card h-100 blog-post ' . $categoryClass . ' shadow-sm">';
          echo '    <img src="' . htmlspecialchars($row['image']) . '" class="card-img-top" alt="' . htmlspecialchars($row['title']) . '">';
          echo '    <div class="card-body">';
          echo '      <h5 class="card-title"><a href="blog-details.php?post_id=' . urlencode($row['post_id']) . '">' . htmlspecialchars($row['title']) . '</a></h5>';
          echo '      <p class="card-text"><small class="text-muted">By ' . htmlspecialchars($row['author']) . ' | ' . date("M d, Y", strtotime($row['created_at'])) . '</small></p>';
          echo '      <p class="card-text">' . htmlspecialchars(mb_substr(strip_tags($row['description']), 0, 100)) . '...</p>';
          echo '      <a href="blog-details.php?post_id=' . urlencode($row['post_id']) . '" class="btn btn-primary btn-sm mt-2">Read More</a>';
          echo '    </div>';
          echo '  </div>';
          echo '</div>';
          }
          $conn = null;
        ?>
      </div>
    </div>
    <!-- Add a personal login button to blog dashboard -->
    <div class="text-end mt-4">
      <a href="login.php" class="btn btn-outline-secondary">
      <i class="bi bi-person-circle me-1"></i> Login to Dashboard
      </a>
    </div>
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

  <!-- Scroll Top -->
  <a href="#" id="scroll-top" class="scroll-top d-flex align-items-center justify-content-center">
    <i class="bi bi-arrow-up-short"></i>
  </a>

  <!-- Vendor JS -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/aos@3.0.0-beta.6/dist/aos.js"></script>
  <script src="assets/js/main.js"></script>
</body>
</html>
