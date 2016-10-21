<!-- Header / Site Info -->
<div id="header">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="row">
                    <div class="jumbotron">
                        <?php if($site_info): ?>
                            <?php foreach($site_info as $info): ?>
                                <h1><?=$info->sys_header?></h1>
                                <p><?=$info->sys_slogan?></p>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <h1>Site Header</h1>
                            <p>Site Slogan</p>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="container">
    <div class="row">
        <!-- Voting Results -->
        <div id="voting-results"></div>
    </div>
</div>

<!-- jQuery -->
<script type="text/javascript" src="<?= base_url('assets/script/jquery-2.1.4.min.js') ?>"></script>
<!-- Include all compiled plugins (below), or include individual files as needed -->
<script type="text/javascript" src="<?= base_url('assets/pace/js/pace.min.js'); ?>"></script>
<script type="text/javascript" src="<?= base_url('assets/tb/js/bootstrap.min.js'); ?>"></script>

<script type="text/javascript">
    $(function () {

        // Refresh content for update
        var interval = 30000;   //number of milliseconds between each call
        var refresh = function () {
            $.ajax({
                url: "<?=base_url('admin/voting_results_content')?>",
                cache: false,
                success: function (html) {
                    $('#voting-results').html(html);
                    setTimeout(function () {
                        refresh();
                    }, interval);
                }
            });
        };
        refresh();

        // Disable context menu
        $(this).bind("contextmenu", function (e) {
            e.preventDefault();
        });

        // Disable highlighting
        $(this).bind("selectstart", function (e) {
            e.preventDefault();
        });
    });
</script>
