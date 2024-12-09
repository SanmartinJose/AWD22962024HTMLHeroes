<?php require_once '../scriptsphp/validate_session.php'; ?>
<?php require_once '../scriptsphp/validate_roles.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
  <title>indexAdmin</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.8.1/font/bootstrap-icons.min.css">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</head>
<body>
	<div>
  <center>
    <a class="navbar-brand" href="./indexAdmin.php">
      <img src="../img/logo1.png" width="500" height="100" alt="Inicio" class="d-inline-block align-text-top">
    </a>
  </center>
</div>
<div class="text-dark text-center">
  <nav class="navbar navbar-expand-sm bg-light border border-danger">
    <div class="container">
      <!-- Imagen al principio -->
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDarkDropdown" aria-controls="navbarNavDarkDropdown" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarNavDarkDropdown">
        <ul class="nav col-12 col-lg-auto me-lg-auto mb-2 justify-content-center mb-md-0 align-items-center">
          <li class="nav-item">
            <a href="./indexAdmin.php">
              <img src="../img/logo.png" width="45" height="45" alt="Logo" class="d-inline-block align-text-top" />
            </a>
          </li>
          <?php include_once './includes/navperfiles.php'; ?>
        </ul>
        <div class="dropdown">
          <a href="#" class="d-block link-dark text-decoration-none dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
            <?php include_once '../scriptsphp/additionalForms/usernameSession.php'; ?>
          </a>
          <ul class="dropdown-menu dropdown-menu-end">
            <li><?php include_once '../scriptsphp/additionalForms/logOutHref.php'; ?></li>
          </ul>
        </div>
      </div>
    </div>
  </nav>
</div>

</body>
</html>
