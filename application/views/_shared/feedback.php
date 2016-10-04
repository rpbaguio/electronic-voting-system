<?php if ($this->session->flashdata('success')): ?>
    <div id="feedback">
        <div class="alert alert-success">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            <i class="fa fa-check-circle fa-2x pull-left"></i>

            <p><?= $this->session->flashdata('success') ?></p>
        </div>
    </div>
<?php endif; ?>

<?php if ($this->session->flashdata('deleted')): ?>
    <div id="feedback">
        <div class="alert alert-danger">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            <i class="fa fa-minus-circle fa-2x pull-left"></i>

            <p><?= $this->session->flashdata('deleted') ?></p>
        </div>
    </div>
<?php endif; ?>
