<header class="page">
    <div class="overlay"></div>
    <img src="https://www.pubgmobile.com/en/event/teamDeathmatchMode/images/map5.jpg">
    <div class="container h-100 hero">
        <div class="d-flex h-100 text-center align-items-center">
        <div class="w-100 text-white hero--container mt-5">
            <h1 class="hero--heading page"><?= $title; ?></h1>
            <p class="mb-4 hero--description page">Play Game, Make Money like a Boss</p>
        </div>
        </div>
    </div>
</header>

<div class="container mt-5">
    <div class="row">

        <?php foreach($tournaments as $row) { ?>

        <div class="col-md-6 mb-4">
            <a href="<?= base_url('tournament/'.$row['slug'])?>">
                <div class="post-item bg-img-3 text-light p-3">
                    <h2 class="text-center"><?= $row['title'] ?></h2>
                    <div class="row text-center post-item-meta">
                        <div class="col-sm-5">
                            <img src="<?= base_url('assets/img/placeholder.svg') ?>" alt="Venue" class="post-item-meta--img">
                            <p><?= $row['venue'] ?></p>
                        
                        </div>
                        <div class="col-sm-3">
                            <img src="<?= base_url('assets/img/rupee.svg') ?>" alt="Entry Fee" class="post-item-meta--img">
                            <p>&#8377;<?= $row['entry_fee'] ?></p>
                        </div>
                        <div class="col-sm-3">
                            <img src="<?= base_url('assets/img/first-prize-trophy.svg') ?>" alt="Winning Prize" class="post-item-meta--img">
                            <p>&#8377;<?= $row['winning_prize']['1st_prize'] ?></p>
                        </div>
                    </div>
                </div>
            </a>
        </div>
        <?php } ?>

    </div>
</div>
