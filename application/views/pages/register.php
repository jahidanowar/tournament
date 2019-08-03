<header class="auth">
    <div class="overlay"></div>
    <img src="https://www.pubgmobile.com/en/event/teamDeathmatchMode/images/map2.jpg">
    <div class="container h-100 hero">
        <div class="d-flex h-100 text-center align-items-center">
        <div class="w-100 text-white hero--container">
            <div class="warper">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-md-8">
                        <div class="card">
                            <div class="card-header"><h2>Register</h2></div>
                            <div class="card-body">
                                <form method="POST" action="<?= base_url('/auth/register/validate')?>">
                                    <div class="form-group row">
                                        <label for="name" class="col-md-4 col-form-label text-md-right">Name</label>
                                        <div class="col-md-6">
                                            <input id="name" type="text" class="form-control <?= form_error('name')? 'is-invalid':''?>" name="name" value="<?= set_value('name') ?>" required>
                                                <?php if(form_error('name')):?>
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong><?= form_error('name')  ?></strong>
                                                    </span>
                                                <?php endif; ?>
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label for="email" class="col-md-4 col-form-label text-md-right">E-Mail Address</label>
                                        <div class="col-md-6">
                                            <input id="email" type="email" class="form-control <?= form_error('email')? 'is-invalid':''?>" name="email" value="<?= set_value('email') ?>" required autocomplete="email">
                                            
                                            <?php if(form_error('email')):?>
                                                <span class="invalid-feedback" role="alert">
                                                    <strong><?= form_error('email')  ?></strong>
                                                </span>
                                            <?php endif; ?>

                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label for="phone" class="col-md-4 col-form-label text-md-right">Phone Number</label>

                                        <div class="col-md-6">
                                            <input id="text" type="text" class="form-control <?= form_error('phone')? 'is-invalid':''?>" name="phone" value="<?= set_value('phone') ?>" required autocomplete="phone">

                                            <?php if(form_error('phone')):?>
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong><?= form_error('phone')  ?></strong>
                                                    </span>
                                                <?php endif; ?>
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label for="username" class="col-md-4 col-form-label text-md-right">PUBG Username</label>

                                        <div class="col-md-6">
                                            <input id="text" type="text" class="form-control <?= form_error('username')? 'is-invalid':''?>" name="username" value="<?= set_value('username') ?>" required autocomplete="username">

                                            <?php if(form_error('username')):?>
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong><?= form_error('username')  ?></strong>
                                                    </span>
                                                <?php endif; ?>
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label for="password" class="col-md-4 col-form-label text-md-right ">Password</label>

                                        <div class="col-md-6">
                                            <input id="password" type="password" class="form-control <?= form_error('password')? 'is-invalid':''?>" name="password" required autocomplete="new-password" value="<?= set_value('password') ?>">
                                            <?php if(form_error('password')):?>
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong><?= form_error('password')  ?></strong>
                                                    </span>
                                                <?php endif; ?>
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label for="password-confirm" class="col-md-4 col-form-label text-md-right">Confirm Password</label>

                                        <div class="col-md-6">
                                            <input id="password-confirm" type="password" class="form-control <?= form_error('password_confirmation')? 'is-invalid':''?>" name="password_confirmation" required autocomplete="new-password">

                                            <?php if(form_error('password_confirmation')):?>
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong><?= form_error('password_confirmation')  ?></strong>
                                                    </span>
                                                <?php endif; ?>
                                        </div>
                                    </div>

                                    <div class="form-group row mb-0">
                                        <div class="col-md-6 offset-md-4">
                                            <button type="submit" class="btn btn-1">
                                                Register
                                            </button>
                                        </div>
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