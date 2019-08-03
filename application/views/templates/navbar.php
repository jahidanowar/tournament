<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container">
        <a class="navbar-brand" href="<?= base_url('/') ?>">Gamenia</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav ml-auto">

            <li class="nav-item <?= $page == 'home'? 'active' : '' ?> ">
                <a class="nav-link" href="<?= base_url('') ?>">Home <span class="sr-only">(current)</span></a>
            </li>
            <li class="nav-item <?= $page == 'tournaments'? 'active' : '' ?>">
                <a class="nav-link" href="<?= base_url('tournament') ?>">Tournaments</a>
            </li>
            <li class="nav-item <?= $page == 'about'? 'active' : '' ?>">
                <a class="nav-link" href="<?= base_url('about') ?>">About</a>
            </li>
            <li class="nav-item <?= $page == 'contact'? 'active' : '' ?>">
                <a class="nav-link" href="<?= base_url('contact') ?>">Contact</a>
            </li>
            <?php if(!$not_loggedin): ?>
            <li class="nav-item <?= $page == 'register'? 'active' : '' ?>">
                <a class="nav-link" href="<?= base_url('auth/register') ?>">Register</a>
            </li>
            <li class="nav-item <?= $page == 'login'? 'active' : '' ?>">
                <a class="nav-link" href="<?= base_url('auth/login?redirect=') ?><?=(isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? 
                "https" : "http") . "://" . $_SERVER['HTTP_HOST'] .  
                $_SERVER['REQUEST_URI']?>">Login</a>
            </li>
            <?php endif; ?>
            <?php if($not_loggedin): ?>
            <li class="nav-item">
                <a class="nav-link" href="<?= base_url('user/profile') ?>">My Account</a>
            </li>
            <?php endif; ?>

        </ul>
        </div>
    </div>
</nav>