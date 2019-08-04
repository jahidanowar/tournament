<!-- Custom styles for this page -->
<link href="<?php echo base_url(); ?>assets/admin/vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
<link href="<?php echo base_url(); ?>assets/admin/vendor/bs-date-picker/css/bootstrap-datepicker.min.css" rel="stylesheet">


<h1 class="h3 mb-2 text-gray-800"><?= $title ?> for <u><?= $tournament_data['title']?></u></h1>
<p class="mb-4"></p>

<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Manage
        <span class="pull-right">
            <a href="<?php echo site_url('admin/tournament'); ?>" class="badge badge-danger">Tournament</i></a>
            <button class="btn btn-primary text-right" data-tournamentid="<?= $tournament_data['id']?>" id="makeWinner">Generate Winners</button>
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
        <table class="table" id="dataTable">
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
            <!-- <tbody>
                <?php foreach($entries as $row){ ?>
                <tr>
                    <td><?= $row['id'] ?></td>
                    <td><a href="<?= base_url('admin/user/view/'.$row['user_id']) ?>" class="btn btn-sm btn-info">View Leader</a></td>
                    <td><?php foreach(json_decode($row['usernames']) as $username){echo "<span class='badge badge-primary'>".$username."</span> ";} ?></td>
                    <td><?= $row['transaction_id'] ?></td>
                    <td><?= $row['created_at'] ?></td>
                    <td>
                    <?php if($row['points']>0){ echo $row['points']; }else{ ?>
                        <a href="#" id="addPoint" class="btn btn-primary" data-entryid="<?= $row['id'] ?>" data-userid="<?= $row['user_id'] ?>" data-tournamentid="<?= $row['tournament_id'] ?>">Add Point</a>
                    <?php } ?></td>
                </tr>
                <?php } ?>
            </tbody> -->
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
                        <label for="rank">Point</label>
                        <input type="number" name="points" id="points" class="form-control">
                    </div>
                    <div class="form-group">
                        <button type="submit" class="btn btn-primary">Add</button>
                    </div>
                    <div id="errorMessage" class="text-danger"></div>
                </form>
            </div>
        </div>
    </div>
</div>


<script>
$(document).ready( function () {

    var manageTable = $('#dataTable').DataTable({
        "ajax": "http://localhost/pubg/admin/entry/get/?id=<?php echo $row['tournament_id']; ?>",   
    });
        $(document).on('click', '#addPoint', function(e){
        e.preventDefault();
        var entryId = $(this).data('entryid');
        var userId = $(this).data('userid');
        var tournamentId = $(this).data('tournamentid');
        $("#winnerModal").modal("show");
        $(document).on('submit', '#winnerForm',function(e){
            e.preventDefault();
            var point = $("#points").val();
            console.log(point);
            console.log(entryId);
            $.ajax({
                url:'<?= base_url('admin/entry/update') ?>',
                type: 'POST',
                data: {entry_id:entryId, point:point},
                dataType: 'JSON',
                success: function(response){
                    if(response.status == 'success'){
                        $("#winnerForm").trigger("reset");
                        $("#winnerModal").modal("hide");
                        manageTable.ajax.reload();
                        notifyFunc('Points Added','success');
                    }
                    else{
                        notifyFunc(response.message,'danger');
                    }
                    
                }
            })
        })
    });

    //Generate Winner
    $(document).on('click', '#makeWinner',function(e){
        e.preventDefault();
        var tournamentId = $(this).data('tournamentid');
        $.ajax({
            url:"<?= base_url('admin/entry/select_winner') ?>",
            method:"POST",
            data:{id:tournamentId},
            dataType:"JSON",
            success:function(resp){
                if(resp.status == 'success'){
                    manageTable.ajax.reload();
                    notifyFunc(resp.message,'success');
                }
                else{
                    notifyFunc(resp.message,'danger');
                }
            }
        })
    })
});

</script>

<!-- Page level plugins -->
<script src="<?php echo base_url(); ?>assets/admin/vendor/datatables/jquery.dataTables.min.js"></script>
<script src="<?php echo base_url(); ?>assets/admin/vendor/datatables/dataTables.bootstrap4.min.js"></script>

  <!-- Page level custom scripts -->
<script src="<?php echo base_url(); ?>assets/admin/js/demo/datatables-demo.js"></script>
<!-- Bootstrap Data picker -->
<script src="<?php echo base_url(); ?>assets/admin/vendor/bs-date-picker/js/bootstrap-datepicker.min.js"></script>

