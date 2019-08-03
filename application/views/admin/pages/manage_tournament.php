<h1 class="h3 mb-2 text-gray-800">Manage Tournament</h1>
<p class="mb-4"></p>

<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Manage
        <span class="pull-right">
            <a href="<?php echo site_url('admin/tournament/create'); ?>" class="badge badge-danger">Create Tournament <i class="fas fa-plus"></i></a>
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

    <div class="col-md-12">
        <table class="table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Type</th>
                    <th>Title</th>
                    <th>Created At</th>
                    <th>Entry Fee</th>
                    <th>Venue</th>
                    <th>Event Time</th>
                    <th>Expiry Date</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach($tournament_data as $row){ ?>
                <tr>
                    <td><?= $row['id'] ?></td>
                    <td><?= $row['type'] ?></td>
                    <td><?= $row['title'] ?></td>
                    <td><?= $row['created_at'] ?></td>
                    <td><?= $row['entry_fee'] ?></td>
                    <td><?= $row['venue'] ?></td>
                    <td><?= $row['event_time'] ?></td>
                    <td><?= $row['expiry'] ?></td>
                    <td>
                        <div class="btn-group">
                            <a href="<?= base_url('admin/tournament/edit/'.$row['id']) ?>" class="btn btn-warning">Edit</a>
                            <a href="<?= base_url('tournament/'.$row['slug']) ?>" target="_blank" class="btn btn-primary">View</a>
                            <a href="<?= base_url('admin/tournament/delete/'.$row['id']) ?>" class="btn btn-danger">Del</a>
                        </div>
                    </td>
                </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>

    </div>
</div>
