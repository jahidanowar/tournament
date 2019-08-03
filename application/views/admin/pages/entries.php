<h1 class="h3 mb-2 text-gray-800"><?= $title ?> for <u><?= $tournament_data['title']?></u></h1>
<p class="mb-4"></p>

<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Manage
        <span class="pull-right">
            <a href="<?php echo site_url('admin/tournament'); ?>" class="badge badge-danger">Tournament <i class="fas fa-plus"></i></a>
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
                    <th>Leader</th>
                    <th>Usernames</th>
                    <th>Transaction ID</th>
                    <th>Created At</th>
                    <th>Select Winner</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach($entries as $row){ ?>
                <tr>
                    <td><?= $row['id'] ?></td>
                    <td><a href="<?= base_url('admin/user/view/'.$row['user_id']) ?>" class="btn btn-sm btn-info">View Leader</a></td>
                    <td><?php foreach(json_decode($row['usernames']) as $username){echo "<span class='badge badge-primary'>".$username."</span> ";} ?></td>
                    <td><?= $row['transaction_id'] ?></td>
                    <td><?= $row['created_at'] ?></td>
                    <td><a href="#" id="selectWinner" class="btn btn-primary" data-entryid="<?= $row['id'] ?>" data-userid="<?= $row['user_id'] ?>" data-tournamentid="<?= $row['tournament_id'] ?>">Select as Winner</a></td>
                </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>

    </div>
</div>
<div class="modal fade" role="dialog" id="winnerModal">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Entries</h5>
            </div>
            <div class="modal-body">
                <form action="" method="post" id="winnerForm">
                    <div class="form-group">
                        <label for="rank">Rank</label>
                        <select name="rank" id="rank" class="form-control">
                            <option value="">--Select--</option>
                            <option value="1">1st</option>
                            <option value="2">2nd</option>
                            <option value="3">3rd</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <button type="submit" class="btn btn-primary">Add</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    $(document).on('click', '#selectWinner', function(e){
        e.preventDefault();
        var entryId = $(this).data('entryid');
        var userId = $(this).data('userid');
        var tournamentId = $(this).data('tournamentid');

        $("#winnerModal").modal("show");
        $(document).on('submit', '#winnerForm', function(e){
            e.preventDefault();
            var rank = $("#rank").val();

            console.log(entryId);
            console.log(userId);
            console.log(tournamentId);
            console.log(rank);

            $.ajax({
                url:'<?= site_url('admin/entry/winner_check'); ?>',
                type:'POST',
                data:{entry_id:entryId,tournament_id:tournamentId,rank:rank},
                dataType:'JSON',
                success: function(resp){
                    console.log(resp);
                    // if(resp.status == true){
                    //     console.log(resp);
                    // // notifyFunc(resp.id,'success');
                    // }
                    // else{
                    // notifyFunc(resp.id,'danger');
                    // } 
                }
            })

        })
        
    })
</script>
