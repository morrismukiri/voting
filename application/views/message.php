<html>
    <head>
        <meta name="title" content="Human Resource and Payroll Management for Growing Business"/>
        <meta name="description" content="Easy, cheap online Payroll and Human Resource Management System" />
        <meta name="keywords" content="Lipo,Human Resource, payroll, Management, system,from Kenya, Kenyan, in Kenya, Small,Small Business, cheap, price, basic, premium, online, easy, simple,kra, tax, returns, NHIF, NSSF, Employees,Wrorks on All Devices,Leave management, employee self service,payroll processing, Training management, Appraisals & performance, payroll processing, Recruitment Management, Centralized employee data, Attendance, Organization charting, Files Sharing, Communications & Alerts,Secure,Support,        LipoHR, Lipo HR, Lipo Human Resource, LipoHR Kenya ,Lipo Human Resource Kenya ,Human Resource Software ,Human Resource System , Kenyan Human Resource ,Software made in Kenya ,Payroll System, Kra Reports,payroll Processing Kenya, kra online, returns,returns Kenya, cheap payroll">
        <link rel="shortcut icon" href="<?php echo base_url(); ?>img/favicon.ico" type="image/x-icon">
        <link rel="icon" href="<?php echo base_url(); ?>img/favicon.ico" sizes="16x16"/>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title><?php echo isset($title) ? $title : 'Send SMS' ?><?php echo isset($name) ? ' : ' . $name : '' ?></title>
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
        <?php $this->load->view('includes/topbar'); ?>
        <?php $this->load->view('includes/upload');
        ?>
        <div  class="container ">
            <h3 class="h3">Send Message</h3>
            <?php echo form_open('main/send'); ?>


            <div class="control-group <?php if (form_error('full_name') !== '') echo 'error'; ?>">
                <div class="controls">
                    <div class="row">
                        <div class="span3 well"> 
                            <h3>Groups</h3>
                            <select class="input-xlarge span3" name="groups" id="groups">
                                <option selected="selected" value='-1'>All</option>
                                <?php
                                if (isset($groups) && $groups <> NULL) {
                                    foreach ($groups as $group) {
                                        echo " <option name='opt_$group->id' id='opt_$group->id' value='$group->id'>$group->Name</option>";
                                    }
                                }
                                ?>  


                            </select>

                            <h3>Contacts</h3>
                            <div style="height: 50%; overflow: scroll">
                                <label for ='contact_all'   class=" checkbox-inline label label-info "><input type='checkbox' class="checkbox" name='contacts[]' id='contact_all'/> All</label> <br/>
                                <!--<select class="multiselect input-xlarge span3" name="groups" id="groups" multiple="multiple">-->
                                <!--<option selected="selected" value="all" name="all">All</option>-->                                   
                                <div id='contact_list'>
                                    <?php
                                    if (isset($contacts) && $contacts <> NULL) {
                                        foreach ($contacts as $contact) {
                                            echo"<label for ='contact_$contact->id'  class=' label'><input type='checkbox' name='contacts[]' id='contact_$contact->id' value='$contact->phone' class='contact'/> $contact->name</label> <br/>";
//                                            echo " <option name='opt_$contact->id' id='opt_$contact->id' value='$contact->id'>$contact->name</option>";
                                        }
                                    }
                                    ?>  
                                </div>

                            </div>
                            <!--</select>-->
                        </div>
                        <!--</div>-->
                        <!--<div class="row">-->
                        <div class="span5 well">
                            <label for="recipients" class="pull-left" >Recipients</label>
                            <a class="btn btn-small btn-info pull-right"  href="#upload" role="button" data-toggle="modal" style="margin-bottom: 10px;">Upload</a>    
                            <textarea id="recipients" name="recipients" rows="8" class="input-xlarge span5 " ></textarea>
                            <h6 class="pull-right"><span id='recipentCount'>0</span> Recipients selected</h6>
                        </div>
                        <div class="span5 well">
                            <label for="msg" >Message</label>
                            <textarea id="msg" name="msg" maxlength="160" rows="6" class="input-xlarge span5 " ></textarea>
                            <h6 class="pull-right" id="remaing_counter">160 characters remaining</h6>
                        </div>
                        <div class=" span5 form-button-box">
                            <input class="btn btn-large btn-success pull-right" type="submit" value="Send"/>
                        </div>
                    </div>

                </div>
                <!--</div>-->


                </form>
            </div>

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