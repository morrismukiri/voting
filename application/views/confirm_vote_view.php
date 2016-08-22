<html>
    <head>
        <meta name="title" content="Human Resource and Payroll Management for Growing Business"/>
        <meta name="description" content="Easy, cheap online Payroll and Human Resource Management System" />
        <meta name="keywords" content="Lipo,Human Resource, payroll, Management, system,from Kenya, Kenyan, in Kenya, Small,Small Business, cheap, price, basic, premium, online, easy, simple,kra, tax, returns, NHIF, NSSF, Employees,Wrorks on All Devices,Leave management, employee self service,payroll processing, Training management, Appraisals & performance, payroll processing, Recruitment Management, Centralized employee data, Attendance, Organization charting, Files Sharing, Communications & Alerts,Secure,Support,        LipoHR, Lipo HR, Lipo Human Resource, LipoHR Kenya ,Lipo Human Resource Kenya ,Human Resource Software ,Human Resource System , Kenyan Human Resource ,Software made in Kenya ,Payroll System, Kra Reports,payroll Processing Kenya, kra online, returns,returns Kenya, cheap payroll">
        <link rel="shortcut icon" href="<?php echo base_url(); ?>img/favicon.ico" type="image/x-icon">
        <link rel="icon" href="<?php echo base_url(); ?>img/favicon.ico" sizes="16x16"/>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title><?php echo isset($title) ? $title : 'Confirm Voter' ?><?php echo isset($name) ? ' : ' . $name : '' ?></title>
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
                <h3 class="h3">Confirm Voter</h3>
            </div>
            <?php echo form_open('home/vote/confirm', 'class="form-signin"') ?>
            <div class="control-group <?php if (form_error('phone') !== '') echo 'error'; ?>">
                <div class="controls">
                    <h2 class="form-signin-heading">Please Confirm your Vote</h2>
                    <?php echo $this->flexi_auth->get_messages(); ?>
                    <div class="control-group <?php if (form_error('phone') !== '') echo 'error'; ?>">
                        <div class="controls">
                            <label class="control-label" for="phone">Registered Phone Number</label>
                            <input type="text" class="input-block-level" name="phone" id="phone" value="<?php echo set_value('phone'); ?>" <?php if ($this->input->post('phone') && form_error('phone') == '') {
                        echo "readonly='readonly'";
                    } ?> placeholder="Phone No">
                            <?php if ($this->input->post('phone') && form_error('phone') == '') { ?>
                                <a href="<?php echo base_url('home/vote') ?>" class="btn btn-small btn-warning"><i class="icon-repeat"></i> Resend </a>
                    <?php } echo form_error('phone') ?>
                        </div>
                    </div>
<?php if ($this->input->post('phone') && form_error('phone') == '') {
    ?> <div class="control-group <?php if (form_error('confirmationcode') !== '') echo 'error'; ?>">
                            <div class="controls">
                                <label class="control-label" for="confirmationcode">Code received through SMS</label>
                                <input type="text" id="confirmationcode" class="input-block-level" name="confirmationcode" value="<?php echo set_value('confirmationcode'); ?>" placeholder="5 digit Confirmtion Code">
                            <?php echo form_error('confirmationcode') ?>
                            </div>
<?php } ?>
                    </div>
                         <!--<input type="text" placeholder="phone (+254...)" class="input input-large" name="phone" />-->
                    <input type="submit" class="btn btn-success" value="Confirm"/>
                </div>
            </div>

            <?php echo form_close(); ?>
<!--            <form class="form-signin" action="<?php echo base_url('user/login'); ?>" method="POST">
                <h2 class="form-signin-heading">Please sign in</h2>
<?php echo $this->flexi_auth->get_messages(); ?>
                <div class="control-group <?php if (form_error('identity') !== '') echo 'error'; ?>">
                    <div class="controls">
                        <input type="text" class="input-block-level" name="identity" value="<?php echo set_value('identity'); ?>" placeholder="Username or Email address">
<?php echo form_error('identity') ?>
                    </div>
                </div>
                <div class="control-group <?php if (form_error('password') !== '') echo 'error'; ?>">
                    <div class="controls">
                        <input type="password" class="input-block-level" name="password" placeholder="Password">
<?php echo form_error('password') ?>
                    </div>
                </div>
                <label class="checkbox">
                    <input type="checkbox" name="remember" value="1" <?php echo set_checkbox('remember', 1); ?>> Remember me
                </label>
                <input class="btn btn-block btn-primary" type="submit" value="Sign in"/> 
                <a class="btn btn-link float_right" href="<?php echo base_url('user/iforgot') ?>">I forgot</a>

            </form>-->

        </div>

        <!--                 
        #############       Signup        ##############
        -->
        <div <?php echo (isset($tab) && $tab == 'signup' ? 'class="tab-pane active in"' : 'class="tab-pane fade"'); ?> id="create">
            <form id="tab"  class="form-signin"  action="<?php echo base_url('user/signup'); ?>" method="POST">
                <div class="control-group <?php if (form_error('full_name') !== '') echo 'error'; ?>">
                    <div class="controls">
                        <label for="full_name">Full Names</label>
                        <input type="text"  value="<?php echo set_value('full_name'); ?>" class="input-block-level" name="full_name" id="full_name"/>
<?php echo form_error('full_name') ?>
                    </div>
                </div>
                <div class="control-group <?php if (form_error('username') !== '') echo 'error'; ?>">
                    <div class="controls">
                        <label for="username" >Username</label>
                        <input type="text" value="<?php echo set_value('username'); ?>" name="username" id="username" class="input-block-level"/>
<?php echo form_error('username') ?>
                    </div>
                </div>
                <div class="control-group <?php if (form_error('email') !== '') echo 'error'; ?>">
                    <div class="controls">
                        <label for="email">Email</label>
                        <input type="text" value="<?php echo set_value('email'); ?>" name="email"  id="email" class="input-block-level"/>
<?php echo form_error('email') ?>
                    </div>
                </div>
                <div class="control-group <?php if (form_error('reg_password') !== '') echo 'error'; ?>">
                    <div class="controls">
                        <label for="reg_password">Password</label>
                        <input type="password" class="input-block-level" name="reg_password" id="reg_password"/>
<?php echo form_error('reg_password') ?>
                    </div>
                </div>
                <div class="control-group <?php if (form_error('passconf') !== '') echo 'error'; ?>">
                    <div class="controls">
                        <label for="passconf">Confirm Password</label>
                        <input type="password" class="input-block-level" name="passconf" id="passconf" />
<?php echo form_error('passconf') ?>
                    </div>
                </div>
                <div class="form-actions">
                    <input class="btn btn-block btn-primary" type="submit" value="Create account"/> 
                </div>
            </form>
            <div id="scripts">
                <script type="text/javascript" src="<?php echo base_url(); ?>scripts/bootstrap.min.js"></script>
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