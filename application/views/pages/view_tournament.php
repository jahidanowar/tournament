<header class="page">
    <div class="overlay"></div>
    <img src="https://www.pubgmobile.com/en/event/teamDeathmatchMode/images/map4.jpg">
    <div class="container h-100 hero">
        <div class="d-flex h-100 text-center align-items-center">
        <div class="w-100 text-white hero--container mt-5">
            <h1 class="hero--heading page"><?= $title; ?></h1>
            <p class="mb-4 hero--description page">
                
            </p>
            <a href="#apply" class="btn btn-1">Apply Now</a>
        </div>
        </div>
    </div>
</header>

<div class="container mt-5">
    <div class="row">
        <div class="col-md-6">
            <div class="post-meta p-0 bg-img-1">
                <div class="row">
                    <div class="col">
                        <div class="prize-box">
                            <img src="<?= base_url('assets/img/prize-1.svg') ?>" alt="1st Prize" class="prize-box--img">
                            <p><?= $winning_prize['1st_prize'] ?></p>
                        </div>
                    </div>
                    <div class="col">
                        <div class="prize-box">
                            <img src="<?= base_url('assets/img/prize-2.svg') ?>" alt="2nd Prize" class="prize-box--img">
                            <p><?= $winning_prize['2nd_prize'] ?></p>
                        </div>
                    </div>
                    <div class="col">
                        <div class="prize-box">
                            <img src="<?= base_url('assets/img/prize-3.svg') ?>" alt="3rd Prize" class="prize-box--img">
                            <p><?= $winning_prize['3rd_prize'] ?></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="post-meta text-center bg-img-2">
                <h2>Venue: <?= $tournament_data['venue'] ?></h2>
                <h2>Time: <?= $tournament_data['event_time'] ?></h2>
            </div>
        </div>
    </div>
</div>

<div class="container mt-5">
    <div class="row">
        <div class="col-md-4">
            <div class="post-meta text-center bg-img-3">
                <div class="meta-box">
                    <?php if($expiry != "expired" && count($entry_data)<$tournament_data['maximum_entries']){ ?>
                        <h2 class="meta-box--number count"><?= $expiry ?></h2>
                        <p class="meta-box--content">Days Left to Apply</p>
                    <?php } else{ ?>
                    <p class="meta-box--content mt-4">Application Closed for This Tournament</p>
                    <?php } ?>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="post-meta text-center bg-img-3">
                <div class="meta-box">
                    <?php if($event_expiry !=  "expired"){ ?>
                    <h2 class="meta-box--number count"><?= $event_expiry['days']; ?></h2>
                    <p class="meta-box--content">Days Left to Tournament</p>
                    <?php } else{ ?>
                    <p class="meta-box--content mt-4">Event Completed</p>
                    <?php } ?>
                </div>
            </div>
        </div>
        <div class="col-md-4">
        <div class="post-meta text-center bg-img-3">
                <div class="meta-box">
                    <h2 class="meta-box--number count"><?= $tournament_data['maximum_entries'] - count($entry_data) ?></h2>
                    <p class="meta-box--content">Entries Left</p>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="container mt-5">
    <div class="content">
        <?= $tournament_data['description'] ?>
    </div>
</div>
<?php if($not_loggedin && isset($userdata)){ ?>
    <!-- Check The Tournament Expiry -->
    <?php if($expiry != "expired" && count($entry_data)<$tournament_data['maximum_entries']){ ?>
<div class="container-fluid mt-5 bg-img-1 p-5">
    <div class="container">
        <div class="application text-light" id="apply">
            <h2>Applay Now</h2>
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
            <?php if($tournament_data['type'] != 'squad'){ ?>
                <form action="<?= base_url('entry/make') ?>" method="POST">
                    <input type="hidden" name="user_id" value="<?= $userdata['id'] ?>">
                    <input type="hidden" name="tournament_id" value="<?= $tournament_data['id'] ?>">
                    <h4>Entry Fee  &#8377; <?= $tournament_data['entry_fee'] ?></h4>
                    <button class="btn btn-1">Apply & Proceed</button>
                </form>
            <?php }else{ ?>
                <form action="<?= base_url('entry/make') ?>" method="POST">
                    <h5>Squad Infromation</h5>
                    <hr>
                    <div class="form-group">
                        <label for="squad_member_2">Squad Leader</label>
                        <input type="text" name="squad_leader" id="squad_leader" class="form-control" value="<?= $userdata['username'] ?>" readonly>
                    </div>
                    <div class="form-group">
                        <label for="squad_leader">Squad Member #2</label>
                        <input type="text" name="squad_member_2" id="squad_member_2" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="squad_member_3">Squad Member #2</label>
                        <input type="text" name="squad_member_3" id="squad_member_3" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="squad_member_4">Squad Member #3</label>
                        <input type="text" name="squad_member_4" id="squad_member_4" class="form-control">
                    </div>
                    <input type="hidden" name="user_id" value="<?= $userdata['id'] ?>">
                    <input type="hidden" name="tournament_id" value="<?= $tournament_data['id'] ?>">
                    <h4>Entry Fee  &#8377; <?= $tournament_data['entry_fee'] ?></h4>
                    <button class="btn btn-1">Apply & Proceed</button>
                </form>
            <?php }  ?>
        </div>
    </div>
</div>
    <?php }else{ ?>

    <!-- Tournament is Cloesd -->
    <div class="container-fluid mt-5 bg-img-1 p-5 text-center">
        <div class="container">
            <div class="call-to-action" id="apply">
                <h2 class="text-light">This Tournament Is Cloesd</h2>
                <a href="<?= base_url('tournament')?>" class="btn btn-1">Check Other Tournaments</a>
            </div>
        </div>
    </div>

    <?php } ?>

<?php }else{ ?>
    
<div class="container-fluid mt-5 bg-img-1 p-5 text-center">
    <div class="container">
        <div class="call-to-action" id="apply">
            <h2 class="text-light">Register or Login to Apply</h2>
            <a href="<?= base_url('auth/login?redirect=')?><?= base_url('tournament/'.$tournament_data['slug']) ?>" class="btn btn-1">Login</a>
            <a href="<?= base_url('auth/register?redirect=')?><?= base_url('tournament/'.$tournament_data['slug']) ?>" class="btn btn-1 ml-2">Register</a>
        </div>
    </div>
</div>

<?php }?>