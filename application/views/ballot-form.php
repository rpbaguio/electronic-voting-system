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

<!-- Ballot form -->
<div id="ballot-form">
    <div class="container">
      <div class="row">
          <div class="col-md-offset-1 col-md-10">
              <div class="row">
                  <div class="panel panel-default">
                      <!-- Default panel contents -->
                      <div class="panel-heading">
                          <h4>Official Ballot Form<br/>
                              <small>To make your selection, select the button to the left of the option.</small>
                          </h4>
                      </div>

                      <div class="panel-body">
                          <?php echo form_open('ballot_form'); ?>
                          <div class="col-md-12">
                              <?php if (position()): ?>
                                  <div class="row">
                                      <?php foreach (position() as $pos): ?>
                                          <!-- Position -->
                                          <div class="col-md-12">
                                              <h3><?= $pos->name ?>
                                                  <small>&mdash; Vote for <?= convert_number_to_words($pos->max_selection) ?> (<?= $pos->max_selection ?>)</small>
                                              </h3>
                                              <hr/>
                                          </div>

                                          <!-- Candidate -->
                                          <div class="col-md-12">
                                              <?php if (candidate($pos->id)): ?>
                                                  <div class="row">
                                                      <?php foreach (candidate($pos->id) as $row): ?>
                                                          <div class="col-md-6">
                                                              <div class="checkbox <?= $pos->id.'_'.$pos->max_selection ?>">
                                                                  <input id="<?= $pos->id.'_'.$pos->max_selection ?>" data-type="max" type="hidden" value="<?= $pos->max_selection ?>">
                                                                  <input type="checkbox" id="candidate(<?= $row->person_id ?>)" name="candidate_id[]" value="<?= $row->person_id ?>"<?= set_checkbox('candidate_id', $row->person_id) ?> />
                                                                  <label for="candidate(<?= $row->person_id ?>)">
                                                                      <img class="avatar img-circle img-responsive pull-right" src="<?= base_url('assets/img').'/'.$row->avatar ?>">
                                                                      <span class="fullname"><?= $row->prefix.nbs().$row->first_name.nbs().$row->last_name ?></span><br/>
                                                                      <small class="group"><?= $row->group_name ?></small>
                                                                  </label>
                                                              </div>
                                                          </div>
                                                      <?php endforeach; ?>
                                                  </div>
                                              <?php else: ?>
                                                  <div class="alert alert-danger">No records found.</div>
                                              <?php endif; ?>
                                          </div>
                                      <?php endforeach; ?>
                                  </div>
                              <?php else: ?>
                                  <p class="alert alert-danger">No records found.</p>
                              <?php endif; ?>

                          </div>
                          <!-- Submit Button -->
                          <div class="col-md-12">
                              <a class="center-block btn btn-primary btn-lg btn-rounded-corner btn-enable-disable" disabled data-toggle="modal">Continue</a>
                          </div>
                          <?php echo form_close(); ?>
                      </div>
                  </div>
              </div>
          </div>
      </div>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="confirmation" data-backdrop="static" tabindex="-1" role="dialog"
     aria-labelledby="myModalLabel">
    <div class="modal-dialog modal-md" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <h4 class="modal-title" id="myModalLabel">Confirmation</h4>
            </div>
            <?php echo form_open() ?>
            <div class="modal-body">
                <h4>Confirm your selections</h4>
                <hr/>
                <ul>
                    <li>If correct, click Submit Ballot to cast your votes.</li>
                    <li>To alter your selections, click Return to Ballot.</li>
                </ul>
            </div>
            <div class="modal-footer">
                <div>
                    <button type="button" id="confirm" class="btn btn-lg btn-primary btn-rounded-corner">Submit Ballot</button>
                    <button type="button" class="btn btn-lg btn-default btn-rounded-corner" data-dismiss="modal">Return to Ballot</button>
                </div>
            </div>
            <?php echo form_close(); ?>
        </div>
    </div>
</div>

<!-- jQuery library -->
<script type="text/javascript" src="<?= base_url('assets/script/jquery-2.1.4.min.js') ?>"></script>
<!-- Include all compiled plugins (below), or include individual files as needed -->
<script type="text/javascript" src="<?= base_url('assets/pace/js/pace.min.js'); ?>"></script>
<script type="text/javascript" src="<?= base_url('assets/tb/js/bootstrap.min.js'); ?>"></script>

<script type="text/javascript">
    $(function () {

        // Limit number of checkbox selected
        var checkbox_limit = function() {
            var data = [];
            $('input[data-type="max"]').each(function () {
                data.push({
                    id: $(this).attr("id"),
                    value: $(this).attr("value")
                });
            });
            $.each(data, function () {
                var pos = this.id;
                var max = this.value;
                var checkboxes = $('.' + pos + ' ' + 'input:checkbox');
                checkboxes.change(function () {
                    var current = checkboxes.filter(':checked').length;
                    checkboxes.filter(':not(:checked)').prop('disabled', current >= max);
                });
            });
        }

        // Enable / Disable button
        var btn_toggle = function() {
            $('input:checkbox').on('click', function () {
                if ($(this).is(':checked')) {
                    $('.btn-enable-disable').removeAttr('disabled').attr('href', '#confirmation');
                }
                else {
                    $('.btn-enable-disable').attr('disabled', true).removeAttr('href');
                }
            })
        }

        // Confirmation dialog
        var dialog = function() {
            $('#confirmation').on('show.bs.modal', function(e) {
                var form = $(e.relatedTarget).closest('form');
                $(this).find('.modal-footer #confirm').data('form', form);
            });

            $('#confirmation').find('.modal-footer #confirm').on('click', function() {
                $(this).data('form').submit();
            });
        }

        // Disable context menu (right click menu)
        $(this).bind("contextmenu", function (e) {
            e.preventDefault();
        });

        // Disable highlighting
        $(this).bind("selectstart", function (e) {
            e.preventDefault();
        });

        checkbox_limit();
        btn_toggle();
        dialog();
    });
</script>
