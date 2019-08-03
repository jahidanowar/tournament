<h1 class="h3 mb-2 text-gray-800"><?= $title ?></h1>
<p class="mb-4"></p>

<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Manage
        <span class="pull-right">
            <a href="<?php echo site_url('admin/user/create'); ?>" class="badge badge-danger">Create User <i class="fas fa-plus"></i></a>
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
                    <th>Name</th>
                    <th>Username</th>
                    <th>Created At</th>
                    <th>Email</th>
                    <th>Phone</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach($user_data as $row){ ?>
                <tr>
                    <td><?= $row['id'] ?></td>
                    <td><?= $row['name'] ?></td>
                    <td><?= $row['username'] ?></td>
                    <td><?= $row['created_at'] ?></td>
                    <td><?= $row['email'] ?></td>
                    <td><?= $row['phone'] ?></td>
                    <td>
                        <div class="btn-group">
                            <a href="<?= base_url('admin/user/edit/'.$row['id']) ?>" class="btn btn-warning">Edit</a>
                            <a href="<?= base_url('admin/user/delete/'.$row['id']) ?>" class="btn btn-danger">Del</a>
                        </div>
                    </td>
                </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>

    </div>
</div>
