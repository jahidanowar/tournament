<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/admin/vendor/bs-date-picker/css/bootstrap-datetimepicker.min.css">

<h1 class="h3 mb-2 text-gray-800">Add Tournament</h1>
<p class="mb-4"></p>

<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Fill the Form
        <span class="pull-right">
            <a href="<?php echo site_url('admin/tournament'); ?>" class="badge badge-danger">Manage Tournament <i class="fas fa-tasks"></i></a>
        </span>
        </h6>
    </div>
    <div class="card-body">

    <!-- show error message -->
    <?php if($this->session->flashdata('success')): ?>
        <div class="alert alert-success my-2"><?php echo $this->session->flashdata('success'); ?>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        </div>
    <?php endif; ?>

    <?php if($this->session->flashdata('error')): ?>
        <div class="alert alert-danger my-2"><?php echo $this->session->flashdata('error'); ?>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        </div>
    <?php endif; ?>

        <?php echo form_open('admin/tournament/validate', array('id'=>'tournament-form')); ?>
        <h4>General</h4>
        <hr>
        
        <div class="row">
            <div class="col">
                <div class="form-group">
                    <label for="title">Title</label>
                    <input type="text" name="title" id="title" class="form-control <?= form_error('title')? 'is-invalid':''?>" value="<?= set_value('title'); ?>">
                    <?php if(form_error('title')):?>
                        <span class="invalid-feedback" role="alert">
                            <strong><?= form_error('title')  ?></strong>
                        </span>
                    <?php endif; ?>
                </div>
            </div>
            <div class="col">
                <div class="form-group">
                    <label for="expiry">Expiry Date</label>
                    <input type="text" name="expiry" id="expiry" class="form-control datepicker <?= form_error('expiry')? 'is-invalid':''?>" value="<?= set_value('expiry'); ?>">
                    <?php if(form_error('expiry')):?>
                        <span class="invalid-feedback" role="alert">
                            <strong><?= form_error('expiry')  ?></strong>
                        </span>
                    <?php endif; ?>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col">
                <div class="form-group">
                    <label for="venue">Venue</label>
                    <input type="text" class="form-control <?= form_error('expiry')? 'is-invalid':''?>" value="<?= set_value('venue') ?>" name="venue" id="venue">
                    <?php if(form_error('venue')):?>
                        <span class="invalid-feedback" role="alert">
                            <strong><?= form_error('venue')  ?></strong>
                        </span>
                    <?php endif; ?>
                </div>
            </div>
            <div class="col">
                <div class="form-group">
                    <label for="event_time">Event Time</label>
                    <input type="text" class="form-control <?= form_error('event_time')? 'is-invalid':''?>" value="<?= set_value('event_time') ?>" name="event_time" id="eventTime">

                    <?php if(form_error('event_time')):?>
                        <span class="invalid-feedback" role="alert">
                            <strong><?= form_error('event_time')  ?></strong>
                        </span>
                    <?php endif; ?>

                </div>
            </div>
            <div class="col">
                <div class="form-group">
                    <label for="maximum_entries">Maximum Entries</label>
                    <input type="text" class="form-control <?= form_error('maximum_entries')? 'is-invalid':''?>" value="<?= set_value('maximum_entries') ?>" name="maximum_entries" id="maximumEntries">

                    <?php if(form_error('maximum_entries')):?>
                        <span class="invalid-feedback" role="alert">
                            <strong><?= form_error('maximum_entries')  ?></strong>
                        </span>
                    <?php endif; ?>
                </div>
            </div>
            <div class="col">
                <div class="form-group">
                    <label for="winning_prize">Winning Prize</label>
                    <select name="winning_prize" id="winningPrize" class="form-control">
                        <?php foreach($winning_prize as $row){ ?>
                        <option value="<?= $row['id']?>">
                            1st Prize = <?= $row['1st_prize']?>, 2nd Prize = <?= $row['2nd_prize']?>, 3rd Prize = <?= $row['3rd_prize']?>
                        </option>
                        <?php }?>
                    </select>

                    <?php if(form_error('winning_prize')):?>
                        <span class="invalid-feedback" role="alert">
                            <strong><?= form_error('winning_prize')  ?></strong>
                        </span>
                    <?php endif; ?>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col">
                <div class="form-group">
                    <label for="type">Tournament Type</label>
                    <select name="type" id="type" class="form-control <?= form_error('type')? 'is-invalid':''?>">
                        <option value="individual">Individual</option>
                        <option value="squad">Squad</option>
                    </select>

                    <?php if(form_error('type')):?>
                        <span class="invalid-feedback" role="alert">
                            <strong><?= form_error('type')  ?></strong>
                        </span>
                    <?php endif; ?>

                </div>
            </div>
            <div class="col">
                <div class="form-group">
                    <label for="entryFees">Entry Fees</label>
                    <input type="text" name="entry_fees" id="entryFees" class="form-control  <?= form_error('entry_fees')? 'is-invalid':''?>" value="<?= set_value('entry_fees'); ?>">

                    <?php if(form_error('entry_fees')):?>
                        <span class="invalid-feedback" role="alert">
                            <strong><?= form_error('entry_fees')  ?></strong>
                        </span>
                    <?php endif; ?>

                </div>
            </div>
        </div>
        

        <div class="form-group">
            <label for="title">Description</label>
            <textarea name="description" id="description" class="form-control <?= form_error('description')? 'is-invalid':''?>"><?= set_value('description'); ?></textarea>

            <?php if(form_error('description')):?>
                <span class="invalid-feedback" role="alert">
                    <strong><?= form_error('description')  ?></strong>
                </span>
            <?php endif; ?>

        </div>

        <button type="submit" class="btn btn-primary">Create Tournament</button>
        <button type="reset" class="btn btn-danger">Reset</button>
        <?php echo form_close(); ?>
    </div>
</div>

<script>
$('#type').val('<?php echo set_value('type'); ?>');
$('#winningPrize').val('<?php echo set_value('winning_prize'); ?>');
</script>