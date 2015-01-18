<html>
    <head>
        <meta name="title" content="Human Resource and Payroll Management for Growing Business"/>
        <meta name="description" content="Easy, cheap online Payroll and Human Resource Management System" />
        <meta name="keywords" content="Lipo,Human Resource, payroll, Management, system,from Kenya, Kenyan, in Kenya, Small,Small Business, cheap, price, basic, premium, online, easy, simple,kra, tax, returns, NHIF, NSSF, Employees,Wrorks on All Devices,Leave management, employee self service,payroll processing, Training management, Appraisals & performance, payroll processing, Recruitment Management, Centralized employee data, Attendance, Organization charting, Files Sharing, Communications & Alerts,Secure,Support,        LipoHR, Lipo HR, Lipo Human Resource, LipoHR Kenya ,Lipo Human Resource Kenya ,Human Resource Software ,Human Resource System , Kenyan Human Resource ,Software made in Kenya ,Payroll System, Kra Reports,payroll Processing Kenya, kra online, returns,returns Kenya, cheap payroll">
        <link rel="shortcut icon" href="<?php echo base_url(); ?>img/favicon.ico" type="image/x-icon">
        <link rel="icon" href="<?php echo base_url(); ?>img/favicon.ico" sizes="16x16"/>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title><?php echo isset($title) ? $title : 'Vote' ?><?php echo isset($name) ? ' : ' . $name : '' ?></title>
        <link rel="stylesheet" type="text/css" href="<?php echo base_url() ?>styles/bootstrap.min.css" />
        <link rel="stylesheet" type="text/css" href="<?php echo base_url() ?>styles/bootstrap-responsive.min.css" />
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
                echo '<h2>Congratulations for voting!</h2>';
            } else {
                if (isset($candidates) && $candidates <> NULL) {
                    ?>
            <table class="table table-bordered">
                        <tr><th>Name</th><th>Party</th></tr>
                        <?php
                        foreach ($candidates as $candidate) {
                            $photosrc = base_url() . 'uploads/' . $candidate->candidate_photo;
                            $party_symbol = base_url() . 'uploads/' . $candidate->party_symbol;
                            echo "<tr><td><a href='" . base_url() . "home/cast/$candidate->candidate_id/$voter->voter_id' ><strong>$candidate->candidate_name</strong><br/><img  src='$photosrc'/></a></td><td><strong>$candidate->party_initials<strong><br/><img  src='$party_symbol'/></td></tr>";
                        }
                        ?>
                    </table>
                    <?php
                }
            }
            ?>

        </div>
    </body>
</html>