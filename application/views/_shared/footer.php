<footer>
  <div class="container-fluid">
      <div class="row">
          <div class="col-md-12">
              <p class="pull-left text-muted">Copyright &copy; <?=date('Y')?> &mdash; <?=$page_header?><sup>&reg;</sup> <strong>v0.0.1</strong>. All rights reserved.</p>
              <p class="pull-right text-muted">Page rendered in <strong>{elapsed_time}</strong> seconds. <?php echo  (ENVIRONMENT === 'development') ? 'CodeIgniter Version <strong>'.CI_VERSION.'</strong>' : '' ?></p>
          </div>
      </div>
    </div>
</footer>
