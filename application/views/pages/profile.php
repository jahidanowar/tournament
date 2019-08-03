<header class="page">
    <div class="overlay"></div>
    <img src="https://www.pubgmobile.com/en/event/teamDeathmatchMode/images/map2.jpg">
    <div class="container h-100 hero">
        <div class="d-flex h-100 text-center align-items-center">
        <div class="w-100 text-white hero--container">
            <h1 class="hero--heading page"><?= $title; ?></h1>
            <p class="mb-4 hero--description page">Play Game, Make Money like a Boss</p>
        </div>
        </div>
    </div>
</header>

<div class="container mt-5">
    <div class="row">
        <!-- Sidebar -->
        <div class="col-md-4">
            <div class="card mb-3">
                <div class="card-header"><h2>Profile</h2></div>

                <div class="card-body">
                    <div class="profile text-center">
                        <img src="https://via.placeholder.com/150" alt="image" class="profile--image mb-2">
                        <h3><?= $user_data['name']; ?></h3>
                        <span class="badge badge-pill badge-primary"><?= $user_data['username']; ?></span><br>
                        <a href="<?= base_url('auth/logout'); ?>" class="btn btn-danger mt-2">Logout</a>
                    </div>
                </div>
            </div>
        </div>
        <!-- Main Area -->
        <div class="col-md-8">
            <div class="card">
                <div class="card-header"><h2>My Tournament</h2></div>
                <div class="card-body">

                    <?php if($this->session->flashdata('error')): ?>
                        <div class="alert alert-danger">
                            <?= $this->session->flashdata('error'); ?>
                        </div>
                    <?php endif; ?>
                    <?php if($this->session->flashdata('success')): ?>
                        <div class="alert alert-success">
                            <?= $this->session->flashdata('success'); ?>
                        </div>
                    <?php endif; ?>

                    <div class="row">

                    
                    <?php foreach($entries as $row) { ?>

                    <div class="col-md-6 mb-4">
                        <div class="post-item bg-img-3 text-light p-3">
                            <h2 class="text-center"><?= $row['tournament_data']['title'] ?></h2>
                        </div>
                    </div>
                    <?php } ?>

                </div>

                </div>
            </div>
        </div>
    </div>
</div>