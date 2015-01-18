  <!-- Fixed navbar -->
      <div class="navbar navbar-fixed-top">
        <div class="navbar-inner">
          <div class="container">
            <button type="button" class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
            </button>
            <a class="brand" href="#">Voting System</a>
            <div class="nav-collapse collapse">
              <ul class="nav">
                    <li class="active"><a href="<?php echo base_url(); ?>">Home</a></li>
                    <li><a href="<?php echo base_url('main/candidates'); ?>">Candidates</a></li>
                    <li><a href="<?php echo base_url('main/voters'); ?>">Voters</a></li>
                    <li><a href="<?php echo base_url('main/parties'); ?>">Parties</a></li>

                </ul>
                <div class="pull-right">
                    <?php echo 'welcome ' . $this->flexi_auth->get_user_identity() . ' ' . anchor('user/logout', 'logout'); ?>
                </div>
                <form class="navbar-search pull-right">
                    <input type="text" class="search-query" placeholder="Search">
                </form>
            </div>

        </div>
    </div>
    <script type="text/javascript" charset="utf-8">

        $(document).ready(function() {
            $('.nav li.active').removeClass('active');
            $('.nav li').each(function() {
                var href = $(this).find('a').attr('href');
                if (href === window.location.href) {
                    $(this).addClass('active');
                }
            });
        });

    </script>
</div>
