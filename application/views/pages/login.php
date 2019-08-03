<header class="auth">
    <div class="overlay"></div>
    <img src="https://www.pubgmobile.com/en/event/teamDeathmatchMode/images/map3.jpg">
    <div class="container h-100 hero">
        <div class="d-flex h-100 align-items-center">
        <div class="w-100 text-white hero--container">
            <div class="warper">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-md-8">
                        <div class="card">
                            <div class="card-header text-center"><h2><?= $title; ?></h2></div>
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

                                <form method="POST" action="<?= base_url('/auth/login/validate')?>">
                                        <input type="hidden" name="redirect" value="<?= $redirect; ?>">
                                        <div class="form-group">
                                            <label for="username" class="text-left">Username</label>
                                            <input id="text" type="text" class="form-control <?= form_error('username')? 'is-invalid':''?>" name="username" value="<?= set_value('username') ?>" required autocomplete="username">

                                            <?php if(form_error('username')):?>
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong><?= form_error('username')  ?></strong>
                                                    </span>
                                                <?php endif; ?>
                                        </div>
                                        
                                        <div class="form-group">
                                            <label for="password" class="text-left">Password</label>
                                            <input id="password" type="password" class="form-control <?= form_error('password')? 'is-invalid':''?>" name="password" required autocomplete="new-password" value="<?= set_value('password') ?>">
                                            <?php if(form_error('password')):?>
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong><?= form_error('password')  ?></strong>
                                                    </span>
                                                <?php endif; ?>
                                        </div>

                                    <div class="form-group">
                                        <button type="submit" class="btn btn-1">
                                            Login
                                        </button>
                                    </div>

                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                </div>
            </div>
        </div>
        </div>
    </div>
</header>