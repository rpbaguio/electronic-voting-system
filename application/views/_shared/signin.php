<div class="container-fluid">
    <div class="row">

        <div id="signin" class="col-md-offset-4 col-md-4 col-lg-offset-4 col-lg-4 box-shadow-effect">
            <h2 class="text-center">Login</h2>
            <hr/>

            <?php echo form_open(); ?>

            <?php if ($error): ?>
                <div class="alert alert-danger">
                    <ul class="validation-errors">
                        <li><?= $error ?></li>
                    </ul>
                </div>
            <?php endif; ?>

            <?php if (validation_errors()): ?>
                <div class="alert alert-danger">
                    <ul class="validation-errors">
                        <?= validation_errors() ?>
                    </ul>
                </div>
            <?php endif; ?>

            <div class="well well-sm">
                <?php echo (form_error('access_code') || $error) ? '<div class = "form-group has-error has-feedback">' : '<div class = "form-group">'; ?>
                <label class="control-label">ACCESS CODE<span class="important">*system generated access code.</span></label>
                    <?php echo form_password(array(
                        'id' => 'access-code',
                        'class' => 'form-control',
                        'name' => 'access_code',
                        'placeholder' => 'Enter your access code here.',
                        'tabindex' => '1',
                        'maxlength' => '20',
                        'value' => set_value('access_code'))); ?>
                <?= '</div>' ?>
            </div>

            <button type="submit" id="btn-change-state" class="btn btn-primary btn-lg btn-block btn-rounded-corner" data-loading-text="loading..." tabindex="2">Log In</button>

            <?php echo form_close(); ?>
        </div>
    </div>
</div>

<!-- jQuery library -->
<script type="text/javascript" src="<?= base_url('assets/script/jquery-2.1.4.min.js') ?>"></script>

<!-- Include all compiled plugins (below), or include individual files as needed -->
<script type="text/javascript" src="<?= base_url('assets/pace/js/pace.min.js'); ?>"></script>
<script type="text/javascript" src="<?= base_url('assets/tb/js/bootstrap.min.js'); ?>"></script>
<script type="text/javascript" src="<?= base_url('assets/tb/js/bootstrap-show-password.min.js'); ?>"></script>

<script type="text/javascript">
    $(function () {
        $('#btn-change-state').on('click', function () {
            var btn = $(this);
            btn.button('loading');
            setTimeout(function () {
                btn.button('reset');
            }, 3000);
        });

        $('#access-code').password().on('show.bs.password', function(e) {});
    });
</script>
