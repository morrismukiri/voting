<html>
    <head>
        <meta name="title" content="Human Resource and Payroll Management for Growing Business"/>
        <meta name="description" content="Easy, cheap online Payroll and Human Resource Management System" />
        <meta name="keywords" content="Lipo,Human Resource, payroll, Management, system,from Kenya, Kenyan, in Kenya, Small,Small Business, cheap, price, basic, premium, online, easy, simple,kra, tax, returns, NHIF, NSSF, Employees,Wrorks on All Devices,Leave management, employee self service,payroll processing, Training management, Appraisals & performance, payroll processing, Recruitment Management, Centralized employee data, Attendance, Organization charting, Files Sharing, Communications & Alerts,Secure,Support,        LipoHR, Lipo HR, Lipo Human Resource, LipoHR Kenya ,Lipo Human Resource Kenya ,Human Resource Software ,Human Resource System , Kenyan Human Resource ,Software made in Kenya ,Payroll System, Kra Reports,payroll Processing Kenya, kra online, returns,returns Kenya, cheap payroll">
        <link rel="shortcut icon" href="<?php echo base_url(); ?>img/favicon.ico" type="image/x-icon">
        <link rel="icon" href="<?php echo base_url(); ?>img/favicon.ico" sizes="16x16"/>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title><?php echo isset($title) ? $title : 'Votes Analysis' ?><?php echo isset($name) ? ' : ' . $name : '' ?></title>
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
                <h3 class="h3">Votes Analysis</h3>
            </div>
            <div class="nav">
                <a class="btn btn-info btn-large" href="<?php echo base_url('home/vote') ?>"><i class="icon-ok-circle icon-white glyphicon"></i> Vote</a>
            </div>
            <div id="donut"></div>
            <script src="<?php echo base_url().'assets/morris.js/morris.min.js' ?>"></script>
            <script src="<?php echo base_url().'assets/morris.js/raphael-2.1.0.min.js' ?>"></script>
            <script type="text/javascript">
                Morris.Donut({
                    element: 'donut',
                    data: [
                         <?php
                    if (isset($votes)) {
                        foreach ($votes as $vote) {
                             echo "{label: '$vote->candidate_name', value:$vote->votes_count},"; 
                        }
                    }
                    ?>
//                        {label: "Download Sales", value: 12},
//                        {label: "In-Store Sales", value: 30},
//                        {label: "Mail-Order Sales", value: 20}
                    ]
                    
                });

            </script>
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>Candidate</th><th>Votes</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    if (isset($votes)) {
                        foreach ($votes as $vote) {
                            ?>
                            <tr>
                                <?php echo "<td>$vote->candidate_name</td><td>$vote->votes_count</td>"; ?>
                            </tr>
                            <?php
                        }
                    }
                    ?>
                </tbody>
            </table>

            <div id = "scripts">
                <script type = "text/javascript" src = "<?php echo base_url(); ?>scripts/bootstrap.min.js"></script>
                <script  type="text/javascript" >
                    $(document).ready(function(a) {
                        remaining = 160;
                        $('#msg').on('input', function() {
                            var x = $('#msg').val();
                            // counter = $('#msg').val().replace(/(\r\n|\n|\r)/, "").length;
                            var newLines = x.match(/(\r\n|\n|\r)/g);
                            var addition = 0;
                            if (newLines != null) {
                                addition = newLines.length;
                            }
                            var remaining = 160 - (x.length + addition);
                            $('#remaing_counter').html(remaining + ' characters remaining');
                        });
                        $('#contact_all').on('change', function() {
                            $('.contact').each(function() {
                                $(this).prop('checked', $('#contact_all').prop('checked'));

                                pushpoprecipients($(this).val(), $('#contact_all').prop('checked'));
                            });
                        });
                        $('#groups').on('change', function() {
                            $.ajax({
                                url: "<?php echo base_url() ?>main/get_contacts_in_group_ajax/" + $(this).val(),
                                context: document.body
                            }).done(function(data) {
                                $('#contact_list').html(data);
                            });
                        });
                        $('#contact_list').on('change', '.contact', function(a) {

                            pushpoprecipients($(this).val());
                        });

                        function pushpoprecipients() {
                            $('#recipients').val($('.contact:checked').map(function() {
                                return this.value;
                            }).get().join(','));
                            $('#recipentCount').html($('#recipients').val().split(',').length)
                        }

                    });
                </script>
            </div>
    </body>
</html>