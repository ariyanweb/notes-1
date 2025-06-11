<?php

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
if (isset($_SESSION['user'])) {
    header('location: panel.php');
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Register</title>
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="assets/js/bootstrap.bundle.min.js"></script>
    <style>
    body {
    font-family: Arial, sans-serif;
    transition: background-color 1s ease !important;
}</style>
</head>

<body>
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card shadow">
                    <div class="card-header text-center">
                        <h4>Register</h4>
                    </div>
                    <div class="card-body">
                        <form action="handle.php" method="POST">
                            <div class="mb-3">
                                <label for="name" class="form-label">Full Name</label>
                                <input type="text" name="name" class="form-control" id="name">
                            </div>
                            <div class="mb-3">
                                <label for="registerEmail" class="form-label">Email</label>
                                <input type="email" name="email" class="form-control" id="registerEmail" required>
                            </div>
                            <div class="mb-3">
                                <label for="registerPassword" class="form-label">Password</label>
                                <input type="password" name="password" class="form-control" id="registerPassword" required>
                            </div>
                            <div class="mb-3">
                                <label for="confirmPassword" class="form-label">Confirm Password</label>
                                <input type="password" name="confrimpass" class="form-control" id="confirmPassword" required>
                            </div>
                            <input type="hidden" name="type" value="register">
                            <button type="submit" name="submit" class="btn btn-primary w-100">Register</button>
                        </form>
                    </div>
                    <?php if (isset($error)): ?>
                        <div class="alert alert-danger mx-3" role="alert">
                            <?php echo $error; ?>
                        </div>
                    <?php endif; ?>
                    <?php if (isset($success)):  ?>
                        <div class="alert alert-success mx-3" role="alert">
                            <?php echo $success; ?>
                        </div>
                    <?php endif; ?>
                    <div class="card-footer text-center">
                        <small>Already have an account? <a href="login.php">Login here</a></small>
                    </div>
                </div>
            </div>
        </div>
    </div>


<script>
function getRandomColor() {
  const letters = '0123456789ABCDEF';
  let color = '#';
  for (let i = 0; i < 6; i++) {
    color += letters[Math.floor(Math.random() * 16)];
  }
  return color;
}
document.body.style.backgroundColor = getRandomColor();
</script>
</body>
</html>
