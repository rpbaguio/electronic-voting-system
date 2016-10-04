<footer>
    <div class="container-fluid">
        <div class="row">
            <p><?= DATE('Y') ?> &copy; <a href="http://pps.org.ph">Philippine Pediatric Society, Inc.</a> All Rights
                Reserved.
            </p>
        </div>
    </div>
</footer>

<!-- jQuery -->
<?php if (is_connected()): ?>
    <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
<?php else: ?>
    <script type="text/javascript" src="<?= base_url('assets/script/jquery-2.1.0.min.js') ?>"></script>
<?php endif; ?>
<!-- Include all compiled plugins (below), or include individual files as needed -->
<script type="text/javascript" src="<?= base_url('assets/tb/js/bootstrap.min.js') ?>"></script>
<script type="text/javascript" src="<?= base_url('assets/pace/js/pace.min.js') ?>"></script>
<script type="text/javascript" src="<?= base_url('assets/animate/js/wow.min.js') ?>"></script>
<script type="text/javascript" src="<?= base_url('assets/script/jquery.maskedinput.min.js'); ?>"></script>
<script type="text/javascript" src="<?= base_url('assets/dt_picker/js/jquery.datetimepicker.js'); ?>"></script>
<script type="text/javascript" src="<?= base_url('assets/icheck/js/icheck.min.js'); ?>"></script>
<script type="text/javascript" src="<?= base_url('assets/base/js/base.js') ?>"></script>

</body>
</html>