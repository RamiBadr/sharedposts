<nav class="navbar navbar-expand-lg navbar-dark bg-dark mb-3">
  <div class="container">
    <a class="navbar-brand" href="<?= URLROOT ?>"><?= SITENAME ?></a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
      <div class="navbar-nav">
        <a class="nav-link" href="<?= URLROOT ?>">Home <span class="sr-only">(current)</span></a>
        <a class="nav-link" href="<?= URLROOT ?>/pages/about">About</a>
      </div>
      <div class="navbar-nav ml-auto">
      <?php if(isset($_SESSION['user_id'])) : ?>
        <a href="<?= URLROOT ?>/users/logout" class="nav-link">Logout</a>
      <?php else: ?>
          <a href="<?= URLROOT ?>/users/register" class="nav-link">Register</a>
          <a href="<?= URLROOT ?>/users/login" class="nav-link">Login</a>
      <?php endif ?>
      </div>
    </div>
  </div>
</nav>