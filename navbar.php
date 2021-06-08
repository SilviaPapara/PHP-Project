<nav class="navbar navbar-expand-lg navbar-light bg-light">
  <div class="container-fluid">
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="home.php">Home</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="interior_design.php">Interior Design</a>
        </li>
      </ul>

      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
          <li class="nav-item">
            <a class="nav-link" href="exterior_design.php">Exterior Design</a>
          </li>
        </ul>


        <form class="d-flex">
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
              Account
            </a>
            <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
              <li><a href="gallery.php" class="dropdown-item" href="#">My portfolio</a></li>
              <li><a href="settings.php" class="dropdown-item" href="#">Settings</a></li>

              <?php
 
              if (isset($_SESSION['id'])) {
                $id = $_SESSION['id'];
                $sql = "SELECT * FROM users WHERE id_ = '$id'";
                $result = mysqli_query($link, $sql);
                if ($result) {
                  while ($row = mysqli_fetch_assoc($result)) {
                    $isAddmin = $row['admin'];
                  }
                }

                if ($isAddmin) {
              ?>
                  <li>
                    <hr class="dropdown-divider" />
                  </li>
                  <a href="users_list.php" class="nav-link link-dark" href="user_list.php" class="btn-primary">Delete User Page</a>
              <?php
                }
              }
              ?>


            </ul>
          </li>
          <a href="logout.php" class="btn btn-outline-danger" type="submit">Sign Out</a>
        </form>
      </div>
    </div>
</nav>
<style>
  li,
  ul {
    list-style: none;
  }
</style>