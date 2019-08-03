<div class="warper">
    <header>
        <div class="overlay"></div>
        <video playsinline="playsinline" autoplay="autoplay" muted="muted" loop="loop">
            <source src="<?= base_url('assets/video/bg-video.mp4'); ?>" type="video/mp4">
        </video>
        <div class="container h-100 hero">
            <div class="d-flex h-100 text-center align-items-center">
            <div class="w-100 text-white hero--container">
                <h1 class="hero--heading">Gamenia</h1>
                <p class="mb-4 hero--description">Play Game, Make Money like a Boss</p>
                <?php if(!$not_loggedin): ?>
                <a href="<?= base_url('auth/login'); ?>" class="btn btn-1">Login</a>
                <a href="<?= base_url('auth/register'); ?>" class="btn btn-1">Register</a>
                <?php endif; ?>
            </div>
            </div>
        </div>
    </header>

    <div class="container">
        <section class="section-info text-center mt-5">
            <h2>How It Works ?</h2>
            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Exercitationem suscipit quam at sint necessitatibus dicta cupiditate vero sunt saepe hic porro voluptatum voluptatibus distinctio amet, ratione ab natus laudantium odit.</p>
        </section>
    </div>

</div>