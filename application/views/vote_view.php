<?php
// header('');
// echo json_encode($candidates);
                        // die();

                  
 ?>
<html>
    <head>
         <link rel="shortcut icon" href="<?php echo base_url(); ?>img/favicon.ico" type="image/x-icon">
        <link rel="icon" href="<?php echo base_url(); ?>img/favicon.ico" sizes="16x16"/>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title><?php echo isset($title) ? $title : 'Vote' ?><?php echo isset($name) ? ' : ' . $name : '' ?></title>
        <link rel="stylesheet" type="text/css" href="<?php echo base_url() ?>styles/bootstrap.min.css" />
        <link rel="stylesheet" type="text/css" href="<?php echo base_url() ?>styles/bootstrap-responsive.min.css" />
        <link rel="stylesheet" type="text/css" href="<?php echo base_url() ?>styles/bootstrap.theme.min.css" />
        <link rel="stylesheet" type="text/css" href="<?php echo base_url() ?>styles/main.css" />
        <link href='//fonts.googleapis.com/css?family=Roboto:400,300,400italic,500,700,100' rel='stylesheet' type='text/css'>
        <link href='//fonts.googleapis.com/css?family=Roboto+Slab:400,100,300,700' rel='stylesheet' type='text/css'>
        <link href='//fonts.googleapis.com/css?family=Roboto+Condensed:100,400,700,300' rel='stylesheet' type='text/css'/>
        <!-- HTML5 shim, for IE6-8 support of HTML5 elements -->
        <!--[if lt IE 9]>
          <script src="../assets/js/html5shiv.js"></script>
        <![endif]-->
        <?php
        if (isset($styles)) {
            foreach ($styles as $style) {
                ?>
                <link rel="stylesheet" type="text/css" href="<?php echo $style; ?>" />
                <?php
            }
        }
        ?>
        <script type="text/javascript" src="//ajax.googleapis.com/ajax/libs/jquery/1.8.2/jquery.min.js" ></script>
        <script type="text/javascript">window.jQuery || document.write('<script type=text/javascript src=\'<?php echo base_url(); ?>scripts/jquery-1.8.2.min.js\'><\/script>');</script>
        <style type="text/css">
            body{            
                /*                font-family: segoe ui;
                                color: #04c;*/
            }
            h2{
                font-weight: 400;
                font-size: 23px;
            }
            td{
                width: 350px; 

            }

        </style>

    </head>
    <body>     
        <?php
        if ($this->flexi_auth->is_logged_in()) {
            $this->load->view('includes/topbar');
        } else {
            echo anchor('home', 'Home', 'class="pull-left btn btn-large btn-success"  style="margin:1% 10%"') . anchor('user/login', 'Login', 'class="pull-right btn btn-large btn-primary" style="margin:1% 10%"');
        }
        ?>

        <div  class="container ">
            <div class="page-header">
                <h3 class="h3">Cast Vote</h3>
            </div>
            <?php
            if (isset($hasvoted) && $hasvoted) {
                echo '<h2>Congratulations! You have voted for all the candidates</h2>';
            } else {
           
            ?>
            <form action="<?php echo base_url().'home/vote_submit/'.$voter->voter_id ?>" method="POST" role="form">
    
    <div class="row-fluid">
            
    <?php
      foreach ($positions as $position) {
    if(!$this->common_model->hasVoted($voter->voter_id,$position->position_id)){//check whether the voter has voted for this position
                        # code...
                   ?>
                    <legend><?php echo $position->position_name ?></legend>
                    <hr/>
                   <?php 
        foreach ($candidates as $candidate) { 
            if($candidate->position_id == $position->position_id ){
            $photosrc = base_url() . 'uploads/' . $candidate->candidate_photo;
            $party_symbol = base_url() . 'uploads/' . $candidate->party_symbol;
            $vote_url= base_url() . "home/cast/$candidate->candidate_id/$voter->voter_id";
    ?>
    
    
<div class="checkbox candidate col-md-4 span3">
    <label>
    <img src="<?php echo $photosrc ?>" alt="<?php echo $candidate->candidate_name ?>" style="width: 200px;    height: 200px;    border-radius: 50%;">
       <h3> <input type="checkbox" value="<?php echo $candidate->candidate_id ?>" name="<?php echo 'position-'.$candidate->position_id ?>[]" class="candidate-select <?php echo 'position-'.$candidate->position_id ?>">
        <?php echo $candidate->candidate_name ?></h3>
        <h5><img  src='<?php echo $party_symbol ?>' style="width:30px"/> <?php echo $candidate->party_initials ?></h5>
    </label>
</div>

<?php
}
 }
}
}
?>
</div>
    <div class="row">
        <hr/>
    
<div class="span12 ">
    

    <button type="submit" class="btn btn-success btn-large center">Submit Votes</button>
    </div>
    </div>
</form>
<?php
    }
?>
        </div>
        <script type="text/javascript">
            $('input.candidate-select').on('change', function() {

 var currentClasses= $(this).attr('class');
 var positionClass= currentClasses.replace('candidate-select','').trim(); 
  $('input.candidate-select.'+positionClass).closest('.candidate').removeClass('checked');
    $('input.candidate-select.'+positionClass).not(this).prop('checked', false);
$(this).closest('.candidate').addClass('checked'); 
});
            setTimeout(function(){
window.location='<?php echo base_url() ?>home';
console.log('redirected')
},180000);
        </script>

    </body>
</html>