
</div>
<!-- End of Main Content -->

 
  <!-- Footer -->
<footer class="sticky-footer bg-white">
  <div class="container my-auto">
    <div class="copyright text-center my-auto">
      <span>Copyright &copy; FoxPMS 2019</span>
    </div>
  </div>
</footer>
<!-- End of Footer -->

</div>
<!-- End of Content Wrapper -->

</div>
<!-- End of Page Wrapper -->

<!-- Scroll to Top Button-->
<a class="scroll-to-top rounded" href="#page-top">
<i class="fas fa-angle-up"></i>
</a>
  
  </div>
  <!-- Bootstrap core JavaScript-->
  
  <script src="<?php echo base_url(); ?>assets/admin/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

  <!-- Core plugin JavaScript-->
  <script src="<?php echo base_url(); ?>assets/admin/vendor/jquery-easing/jquery.easing.min.js"></script>

  <!-- Custom scripts for all pages-->
  <script src="<?php echo base_url(); ?>assets/admin/js/sb-admin-2.min.js"></script>
  <script src="<?php echo base_url(); ?>assets/admin/vendor/bs-date-picker/js/bootstrap-datetimepicker.min.js"></script>



<!-- Custom -->
<script type="text/javascript">

$('.datepicker').datetimepicker({
    format: 'yyyy-mm-dd',
    weekStart: 1,
    autoclose: true,
    todayHighlight: true,
    startView: 2,
		minView: 2,
		forceParse: 0
});

$('#eventTime').datetimepicker({
    format: 'yyyy-mm-dd hh:ii',
    autoclose: true,
    todayHighlight: true,
})

//Notification Function
function notifyFunc(message,type){
  $.notify({
    // options
    message: message 
    },{
    // settings
    type: type,
    z_index: 1100
  }); 
}

</script>  

</body>

</html>