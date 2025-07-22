<?php
session_start();
include 'db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $password = md5($_POST['password']); // MD5 not recommended for production

    $stmt = $conn->prepare("SELECT * FROM users WHERE username = ? AND password = ?");
    $stmt->execute([$username, $password]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($user) {
        $_SESSION['username'] = $user['username'];
        $_SESSION['user_type'] = $user['user_type'];
        header("Location: dashboard.php");
        exit;
    } else {
        $error = "Invalid username or password.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Admin Login - Janith Aththanayaka</title>

  <!-- Bootstrap & Main CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="assets/css/main.css" rel="stylesheet">
  <link rel="icon" href="assets/img/favicon.png">
  <link rel="apple-touch-icon" href="assets/img/apple-touch-icon.png">

<style>
    body {
        background-color: #181a1b;
        color: #e0e0e0;
        padding-top: 120px;
    }

    .login-box {
        background: #23272b;
        border-radius: 12px;
        padding: 30px;
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.6);
    }

    .logo h1 {
        font-size: 24px;
        font-weight: 600;
        color: #fef902;
        text-shadow: 1px 1px 2px #000;
    }

    .btn-custom {
        background-color: #fef902;
        color: #181a1b;
        font-weight: 600;
        transition: 0.3s ease;
        border: none;
    }

    .btn-custom:hover {
        background-color: #e6e600;
        color: #181a1b;
    }

    .form-control {
        background-color: #23272b;
        color: #e0e0e0;
        border: 1px solid #444;
    }

    .form-control:focus {
        border-color: #fef902;
        box-shadow: 0 0 0 0.2rem rgba(254, 249, 2, 0.15);
        background-color: #23272b;
        color: #fff;
    }

    .alert-danger {
        background-color: #3a2323;
        color: #ffb3b3;
        border-color: #a94442;
    }

    @media (max-width: 768px) {
        .login-box {
            padding: 20px;
        }
    }
</style>
</head>

<body>

  <!-- Header -->
  <header class="header fixed-top bg-warning shadow-sm">
    <div class="container d-flex align-items-center justify-content-between py-2">
      <a href="index.html" class="logo text-decoration-none">
        <h1 class="sitename m-0 text-dark">Janith Aththanayaka</h1>
      </a>
    </div>
  </header>

  <!-- Login Section -->
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-md-6 col-lg-4">
        <div class="login-box mt-4">
          <h3 class="text-center mb-4">Admin Login</h3>

          <?php if (isset($error)) : ?>
            <div class="alert alert-danger"><?= $error ?></div>
          <?php endif; ?>

          <form method="POST">
            <div class="mb-3">
              <label for="username" class="form-label">Username</label>
              <input type="text" id="username" name="username" class="form-control" required>
            </div>
            <div class="mb-3">
              <label for="password" class="form-label">Password</label>
              <input type="password" id="password" name="password" class="form-control" required>
            </div>
            <button type="submit" name="login" class="btn btn-custom w-100">Login</button>
          </form>
        </div>
      </div>
    </div>
  </div>

  <!-- Bootstrap JS -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
