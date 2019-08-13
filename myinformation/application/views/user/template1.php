 <!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="mlm">
        <link rel="shortcut icon" href="<?php echo base_url(); ?>assets/images/logo.png">
        <title>My Information|UserPanel</title>
        <!--Morris Chart CSS -->
		<script>
			var base_url="<?php echo site_url(); ?>";
		</script>
    <!-- Vendor styles -->
	<?php  $obj= new jscss_model();
			$css=$obj->get_css($page);
			$js=$obj->get_js($page);
			foreach($css as $csrow){
		?> 
			<link href="<?php echo base_url($csrow); ?>" rel="stylesheet"><?php
		}
	?>
        <script src="<?php echo base_url();?>assets/js/modernizr.min.js"></script>
    </head>
    <body >
       
             <!-- Top Bar Start -->
          
               
                
               
       
     
						<?php $this->load->view("user/".$content); ?>
					

        <script>
            var resizefunc = [];
        </script>
	<?php
    foreach($js as $csrow){
		?> 
		 <script src="<?php echo  base_url($csrow); ?>"></script>
		<?php
	}
   ?>
    </body>
    <?php if(!empty($this->session->flashdata('success'))) { ?> 
    <script>
        window.onload=function(){
            $.Notification.notify('success','top-right','<?= $this->session->flashdata("success") ?>','<?= $this->session->flashdata("message") ?>');
        }
    </script>
    <?php } if(!empty($this->session->flashdata('error'))) { ?> 
        <script>
            window.onload=function(){
                $.Notification.notify('error','top-right','<?= $this->session->flashdata("error") ?>','<?= $this->session->flashdata("message") ?>');
            }
        </script>
    <?php }?>
    
</html>