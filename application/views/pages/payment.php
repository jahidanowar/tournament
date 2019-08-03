<header class="page">
    <div class="overlay"></div>
    <img src="https://www.pubgmobile.com/en/event/teamDeathmatchMode/images/map4.jpg">
    <div class="container h-100 hero">
        <div class="d-flex h-100 text-center align-items-center">
        <div class="w-100 text-white hero--container mt-5">
            <h1 class="hero--heading page"><?= $title; ?></h1>
        </div>
        </div>
    </div>
</header>

<div class="container mt-5">
    <h1 class="text-center">Please do not refresh this page...</h1>
    <form action="https://securegw-stage.paytm.in/order/process" name="f1">
        <?php 
            foreach($payment_data['param_list'] as $k => $v){
                echo '<input type="hidden" name="' . $k .'" value="' . $v . '">';
            }
        ?>
        <input type="hidden" name="CHECKSUMHASH" value="<?php echo $payment_data['checksum'] ?>">
        <script type="text/javascript">
			document.f1.submit();
		</script>
    </form>
    
</div>