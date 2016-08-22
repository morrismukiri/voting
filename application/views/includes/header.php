<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="">
        <meta name="author" content="">
        <title>Voting system</title>
        
        <?php  if(isset($css_files)):foreach ($css_files as $file): ?>
            <link type="text/css" rel="stylesheet" href="<?php echo $file; ?>" />
        <?php endforeach; endif; ?>
        <link type="text/css" rel="stylesheet" href="<?php echo base_url() . 'styles/bootstrap-fileupload.min.css'; ?>" />
        <link type="text/css" rel="stylesheet" href="<?php echo base_url() . 'styles/bootstrap.theme.min.css'; ?>" />
        <script type="text/javascript" src="<?php echo base_url() . 'scripts/bootstrap-fileupload.min.js'; ?>"></script>
        <?php if(isset($js_files)): foreach ($js_files as $file): ?>
            <script src="<?php echo $file; ?>"></script>
        <?php endforeach; endif; ?>
              <link type="text/css" rel="stylesheet" href="<?php echo base_url(); ?>styles/main.css" />
    </head>
    <body >

        <?php $this->load->view('includes/topbar'); ?>
        <?php $this->load->view('includes/upload');
        ?>

        <div style='height:20px;'></div>  
        <div class="container">
            <div class="page-header">
                <?php         echo  isset($module)?"<h3>Manage $module</h3>":"<h1>Voting System<h3>"; ?>
          
        </div>
            <?php if ($this->flexi_auth->status_messages()) { ?>
                <div class = "alert alert-success alert-block">
                    <a class = "close" data-dismiss = "alert" href = "#"> x </a>
                    <?php
                    echo $this->flexi_auth->status_messages();
                    ?>		
                </div>
            <?php }
            ?>
            <?php if ($this->flexi_auth->error_messages()) { ?>
                <div class = "alert alert-error alert-block">
                    <a class = "close" data-dismiss = "alert" href = "#"> x </a>
                    <?php
                    echo $this->flexi_auth->error_messages();
                    ?>		
                </div>
            <?php }
            ?>
           