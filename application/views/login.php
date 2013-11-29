<html>
    <head>
        <meta name="title" content="Human Resource and Payroll Management for Growing Business"/>
        <meta name="description" content="Easy, cheap online Payroll and Human Resource Management System" />
        <meta name="keywords" content="Lipo,Human Resource, payroll, Management, system,from Kenya, Kenyan, in Kenya, Small,Small Business, cheap, price, basic, premium, online, easy, simple,kra, tax, returns, NHIF, NSSF, Employees,Wrorks on All Devices,Leave management, employee self service,payroll processing, Training management, Appraisals & performance, payroll processing, Recruitment Management, Centralized employee data, Attendance, Organization charting, Files Sharing, Communications & Alerts,Secure,Support,        LipoHR, Lipo HR, Lipo Human Resource, LipoHR Kenya ,Lipo Human Resource Kenya ,Human Resource Software ,Human Resource System , Kenyan Human Resource ,Software made in Kenya ,Payroll System, Kra Reports,payroll Processing Kenya, kra online, returns,returns Kenya, cheap payroll">
        <link rel="shortcut icon" href="<?php echo base_url(); ?>img/favicon.ico" type="image/x-icon">
        <link rel="icon" href="<?php echo base_url(); ?>img/favicon.ico" sizes="16x16"/>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title><?php echo isset($title) ? $title : 'Welcome' ?><?php echo isset($name) ? ' : ' . $name : '' ?></title>
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
    <body class="container">
        <div class="" id="loginModal">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">x</button>
                <h3>Have an Account?</h3> 

            </div>
        </div>
        <div class="modal-content">
            <ul class="nav nav-tabs">
                <li <?php echo (!isset($tab) || (isset($tab) && $tab !== 'signup') ? 'class="active"' : ''); ?>><a href="#login" data-toggle="tab">Login</a></li>
                <li <?php echo (isset($tab) && $tab == 'signup' ? 'class="active"' : ''); ?>><a href="#create" data-toggle="tab">Create Account</a></li>
            </ul>
            <div id="myTabContent" class="tab-content">
                <div  <?php echo (!isset($tab) || (isset($tab) && $tab !== 'signup') ? 'class="tab-pane active in"' : 'class="tab-pane fade"'); ?> id="login">
                    <form class="form-signin" action="<?php echo base_url('user/login'); ?>" method="POST">
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

                    </form>

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
                </div>
            </div>

        </div>
        <div id="scripts">
            <script type="text/javascript" src="<?php echo base_url() ?>scripts/bootstrap.min.js"></script>

        </div>
    </body>
</html>