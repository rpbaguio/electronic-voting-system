<!-- Navbar -->
<div id="navbar-wrapper">
  <div class="navbar-affix" data-spy="affix">
      <div class="container-fluid">
          <div class="row">
                <?= $this->load->view('admin/navbar', '', true) ?>
          </div>
      </div>
  </div>
</div>

<!-- Dashboard -->
<div id="dashboard">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <h2><?= $page_title ?></h2>
                <hr/>
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <div class="btn-group-wrapper pull-right">
                            <div class="btn-group">
                                <a class="btn btn-default" data-toggle="modal" href="#add-person"><i class="material-icons md-18">person_add</i></a>
                            </div>
                        </div>
                        List of Persons
                    </div>
                    <div class="panel-body">
                        <table id="datatables" class="table table-bordered table-striped table-hover" cellspacing="0" width="100%">
                            <thead>
                            <tr>
                                <th>First Name</th>
                                <th>Last Name</th>
                                <th>Gender</th>
                                <th>Is Candidate?</th>
                                <th>Is Validated?</th>
                                <th>Is Voted?</th>
                                <th></th>
                                <th></th>
                            </tr>
                            </thead>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal (Update Person Info) -->
<div class="modal fade" id="update-person-info" data-backdrop="static" tabindex="-1" role="dialog"
     aria-labelledby="myModalLabel">
    <div class="modal-dialog modal-md" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <h4 class="modal-title" id="myModalLabel">Update Person</h4>
            </div>
            <?php echo form_open('admin/update_person_info', array('class' => 'update-person-info-form')) ?>
            <div class="modal-body">
                <input type="hidden" name="id" value="">

                <div id="ajax-preloader"></div>

                <div id="ajax-response-update"></div>

                <div class="row">
                  <div class="col-md-6">
                        <div class="row">
                            <div class="col-md-12">
                                <div id="first-name" class="form-group">
                                    <label class="control-label">First Name<span class="important">*</span></label>
                                    <input type="text" class="form-control" name="first_name" value="<?= set_value('first_name') ?>" placeholder="">
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div id="last-name" class="form-group">
                                    <label class="control-label">Last Name<span class="important">*</span></label>
                                    <input type="text" class="form-control" name="last_name" value="<?= set_value('last_name') ?>" placeholder="">
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div id="birth-date" class="form-group">
                                    <label class="control-label">Birth Date<span class="optional">YYYY-MM-DD</span></label>
                                    <input type="text" class="form-control datetime-picker date-masking" name="birth_date" value="<?= set_value('birth_date') ?>" placeholder="">
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div id="date-registered" class="form-group">
                                    <label class="control-label">Date Registered</label>
                                    <p class="help-block"></p>
                                </div>
                            </div>
                        </div>
                  </div>
                  <div class="col-md-6">
                        <div class="row">
                            <div class="col-md-12">
                                  <div id="access-code" class="form-group">
                                      <label class="control-label">Access Code<span class="important">*</span></label>
                                      <input type="text" class="form-control" name="access_code" value="" placeholder="">
                                  </div>
                            </div>
                            <div class="col-md-12">
                                  <div id="qrcode" class="text-center"></div>
                            </div>
                        </div>
                  </div>
                </div>

            </div>
            <div class="modal-footer">
                <div>
                    <button type="submit" class="btn btn-lg btn-primary btn-rounded-corner">Submit</button>
                    <button type="button" class="btn btn-lg btn-default btn-rounded-corner" data-dismiss="modal">Back</button>
                </div>
            </div>
            <?php echo form_close(); ?>
        </div>
    </div>
</div>

<!-- Modal (Add Person) -->
<div class="modal fade" id="add-person" data-backdrop="static" tabindex="-1" role="dialog"
     aria-labelledby="myModalLabel">
    <div class="modal-dialog modal-sm" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <h4 class="modal-title" id="myModalLabel">Add Person</h4>
            </div>
            <?php echo form_open('admin/add_person', array('class' => 'add-person-form')) ?>
            <div class="modal-body">

                <div id="ajax-preloader"></div>

                <div id="ajax-response-add"></div>

                <div class="row">
                    <div class="col-md-12">
                        <div id="first-name" class="form-group">
                            <label class="control-label">First Name<span class="important">*</span></label>
                            <input type="text" class="form-control" name="first_name" placeholder="">
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div id="last-name" class="form-group">
                            <label class="control-label">Last Name<span class="important">*</span></label>
                            <input type="text" class="form-control" name="last_name" placeholder="">
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div id="birth-date" class="form-group">
                            <label class="control-label">Birth Date<span class="optional">YYYY-MM-DD</span></label>
                            <input type="text" class="form-control datetime-picker date-masking" name="birth_date" placeholder="">
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div id="gender" class="form-group">
                            <label class="control-label">Gender<span class="important">*</span></label>
                            <select class="form-control" name="gender">
                                <!-- <option values="" selected>&mdash; Select &mdash;</option> -->
                                <option values="Male">Male</option>
                                <option values="Female">Female</option>
                            </select>
                        </div>
                    </div>
                </div>

            </div>
            <div class="modal-footer">
                <div>
                    <button type="submit" class="btn btn-lg btn-primary btn-rounded-corner">Submit</button>
                    <button type="button" class="btn btn-lg btn-default btn-rounded-corner" data-dismiss="modal">Back</button>
                </div>
            </div>
            <?php echo form_close(); ?>
        </div>
    </div>
</div>

<!-- jQuery -->
<script type="text/javascript" src="<?= base_url('assets/script/jquery-2.1.4.min.js') ?>"></script>

<!-- Include all compiled plugins (below), or include individual files as needed -->
<script type="text/javascript" src="<?= base_url('assets/pace/js/pace.min.js'); ?>"></script>
<script type="text/javascript" src="<?= base_url('assets/datatables/js/jquery.dataTables.min.js'); ?>"></script>
<script type="text/javascript" src="<?= base_url('assets/datatables/js/dataTables.tableTools.js'); ?>"></script>
<script type="text/javascript" src="<?= base_url('assets/datatables/js/dataTables.bootstrap.js'); ?>"></script>
<script type="text/javascript" src="<?= base_url('assets/tb/js/bootstrap.min.js'); ?>"></script>
<script type="text/javascript" src="<?= base_url('assets/script/moment.min.js'); ?>"></script>
<script type="text/javascript" src="<?= base_url('assets/dt_picker/js/jquery.datetimepicker.js'); ?>"></script>
<script type="text/javascript" src="<?= base_url('assets/script/jquery.maskedinput.min.js'); ?>"></script>

<script type="text/javascript">
    $(function () {

        // Active link
        var active_list = function() {
            var str = location.href.toLowerCase();
            $(".navbar-nav li a").each(function () {
                if (str.indexOf(this.href.toLowerCase()) > -1) {
                    $(".navbar-nav li.active").removeClass("active");
                    $(this).parent().addClass("active");
                }
            });
            $(".navbar-nav li.active").parents().each(function () {
                if ($(this).is("li")) {
                    $(this).addClass("active");
                }
            });
        }

        // POST: Server side processing
        var data_tables = function() {
            var table = $('#datatables').dataTable({
                "processing": true,
                "serverSide": true,
                "ajax": {
                    "url": "<?=base_url('admin/person_data')?>",
                    "type": "POST"
                },
                "columns": [
                    {data: "first_name"},
                    {data: "last_name"},
                    {
                        searchable: false,
                        data: "gender"
                    },
                    {
                        searchable: false,
                        data: "is_candidate",
                        mRender: function (data) {
                            return ((data == 1) ? '<span class="label label-success">yes</span>' : '<span class="label label-danger">no</span>');
                        }
                    },
                    {
                        searchable: false,
                        data: "is_validated",
                        mRender: function (data) {
                            return ((data == 1) ? '<span class="label label-success">yes</span>' : '<span class="label label-danger">no</span>');
                        }
                    },
                    {
                        searchable: false,
                        data: "is_voted",
                        mRender: function (data) {
                            return ((data == 1) ? '<span class="label label-success">yes</span>' : '<span class="label label-danger">no</span>');
                        }
                    },
                    {
                        searchable: false,
                        data: "person_id",
                        mRender: function (data) {
                            return '<a data-toggle="modal" data-param="' + data + '" href="#update-person-info"><i class="material-icons md-18">mode_edit</i></a>';
                        }
                    },
                    {
                        searchable: false,
                        data: "person_id",
                        mRender: function (data) {
                            return '<a data-toggle="modal" data-param="' + data + '" href="#"><i class="material-icons md-18">remove_circle_outline</i></a>';
                        }
                    }
                ],
                "lengthMenu": [[10, 25, 50, 75, 100, -1], [10, 25, 50, 75, 100, "All"]],
                "order": [[1, "asc"]],
                "columnDefs": [
                    {"orderable": false, "targets": [6, 7]}
                ]
            });
            var tableTools = new $.fn.dataTable.TableTools(table, {
                "buttons": [
                    "copy",
                    "xls",
                    "pdf"
                ]
            });
            $(tableTools.fnContainer()).appendTo('div.panel-heading div.btn-group');
        }

        // GET: View Person info
        var view_person_info = function() {

            // Reset form
            var reset = function() {
                $('#update-person-info').find('form')[0].reset();
                $('#update-person-info .form-group').removeClass('has-error');
            }

            $('#update-person-info').on('show.bs.modal', function (e) {

                // Reset form
                reset();

                var url = '<?php echo base_url('admin/person_info'); ?>';
                var target = $(e.relatedTarget);
                var id = target.data('param');
                var param = '/' + id;

                // Data only
                var data = $(this).serialize();

                $.ajax({
                    url: url + param,
                    type: 'GET',
                    dataType: 'json',
                    data: data,
                    cache: false,
                    processData: false,
                    beforeSend: function () {
                        $('#update-person-info #ajax-preloader').html('<p>loading...</p>').show();
                    },
                    success: function (data) {

                        var res = data;

                        if (res) {
                            // Hide preloader.
                            $('#update-person-info #ajax-preloader').html('<p>loading...</p>').hide('fast');

                            // Populate form
                            $('#update-person-info input:hidden').val(res.id);
                            $('#update-person-info #first-name input').val(res.first_name);
                            $('#update-person-info #last-name input').val(res.last_name);
                            $('#update-person-info #birth-date input').val(res.birth_date);
                            $('#update-person-info #access-code input').val(res.access_code);
                            var dt = moment(res.dt_registered).format('llll'); // Format datetime with momentjs
                            $('#update-person-info #date-registered p').html(dt);
                            $('#update-person-info #qrcode').html('<img src="' + res.qrcode +'" />');
                        }

                        // For debugging
                        console.log(res);
                    },
                    error: function (jqXHR, textStatus, errorThrown) {
                        // For debugging
                        console.log('The following error occurred: ' + textStatus, errorThrown);
                    }
                });

            });
        }

        // POST: Update Person info
        var update_person_info = function() {
            $('form.update-person-info-form').on('submit', function (e) {

                var url = '<?php echo base_url('admin/update_person_info'); ?>';
                var id = $('input:hidden').val();
                var param = '/' + id;

                // Data only
                var data = $(this).serialize();

                $.ajax({
                    url: url + param,
                    type: 'POST',
                    dataType: 'json',
                    data: data,
                    cache: false,
                    processData: false,
                    beforeSend: function () {
                        $('#update-person-info #ajax-preloader').html('<p>loading...</p>').show();
                    },
                    success: function (data) {

                        var res = data;

                        if (res.status == true) {

                            // Hide preloader.
                            $('#update-person-info #ajax-preloader').html('<p>loading...</p>').hide('fast');

                            // Success msg response
                            $('#update-person-info #ajax-response-update').html(res.msg);

                            // Clear the form.
                            $('#update-person-info .form-group').removeClass('has-error');

                            // Reload datatables
                            $('#datatables').DataTable().ajax.reload(null, false); // user paging is not reset on reload

                        } else {
                            // Hide preloader.
                            $('#update-person-info #ajax-preloader').html('<p>loading...</p>').hide('fast');

                            // Error msg response
                            $('#update-person-info #ajax-response-update').html(res.msg);

                            ($('#update-person-info #first-name input').val().length <= 0) ? $('#update-person-info #first-name').addClass('has-error') : $('#update-person-info #first-name').removeClass('has-error');
                            ($('#update-person-info #last-name input').val().length <= 0) ? $('#update-person-info #last-name').addClass('has-error') : $('#update-person-info #last-name').removeClass('has-error');
                            ($('#update-person-info #birth-date input').val().length <= 0) ? $('#update-person-info #birth-date').addClass('has-error') : $('#update-person-info #birth-date').removeClass('has-error');
                            ($('#update-person-info #access-code input').val().length <= 0) ? $('#update-person-info #access-code').addClass('has-error') : $('#update-person-info #access-code').removeClass('has-error');
                        }
                    },
                    error: function (jqXHR, textStatus, errorThrown) {
                        // For debugging
                        console.log('The following error occurred: ' + textStatus, errorThrown);
                    }
                });

                e.preventDefault();
            });
        }

        // POST: Add Person
        var add_person = function() {

            // Reset form
            var reset = function() {
                $('#add-person').find('form')[0].reset();
                $('#add-person .form-group').removeClass('has-error');
            }

            $('form.add-person-form').on('submit', function (e) {

                // Serialize data
                var data = $(this).serialize();

                $.ajax({
                    url: '<?php echo base_url('admin/add_person'); ?>',
                    type: 'POST',
                    dataType: 'json',
                    data: data,
                    cache: false,
                    processData: false,
                    beforeSend: function () {
                        $('#add-person #ajax-preloader').html('<p>loading...</p>').show();
                    },
                    success: function (data) {

                        var res = data;

                        if (res.status === true) {

                            // Hide preloader
                            $('#add-person #ajax-preloader').html('<p>loading...</p>').hide('fast');

                            // Success msg response
                            $('#add-person #ajax-response-add').html(res.msg).show();

                            // Set timeout before hiding the success message response.
                            setTimeout(function () {
                                $('#add-person #ajax-response-add').hide('fast');
                            }, 3600);

                            // Reset form
                            reset();

                            // Reload datatables
                            $('#datatables').DataTable().ajax.reload(null, false); // user paging is not reset on reload
                        } else {
                            // Hide preloader.
                            $('#add-person #ajax-preloader').html('<p>loading...</p>').hide('fast');

                            // Error message response.
                            $('#add-person #ajax-response-add').html(res.msg).show();

                            ($('#add-person #first-name > input').val().length <= 0) ? $('#add-person #first-name').addClass('has-error') : $('#add-person #first-name').removeClass('has-error');
                            ($('#add-person #last-name > input').val().length <= 0) ? $('#add-person #last-name').addClass('has-error') : $('#add-person #last-name').removeClass('has-error');
                            ($('#add-person #gender > input').val().length <= 0) ? $('#add-person #gender').addClass('has-error') : $('#add-person #gender').removeClass('has-error');
                        }
                    },
                    error: function (jqXHR, textStatus, errorThrown) {
                        // For debugging
                        console.log('The following error occurred: ' + textStatus, errorThrown);
                    }
                });

                e.preventDefault();
            });
        }

        // Navbar Affix
        var navbar_affix = function() {
            $('.navbar-affix').affix({
                offset: {
                    top: 50
                }
            });
        }

        // Masking
        var input_masking = function() {
            $(".date-masking").mask("9999-99-99", {placeholder: "YYYY-MM-DD"});
        }

        // Date and Time Picker
        var datetime_picker = function() {
            $('.datetime-picker').datetimepicker({
                    timepicker: false,
                    format: 'Y-m-d'
                }
            );
        }

        active_list();
        data_tables();
        view_person_info();
        update_person_info();
        add_person();
        navbar_affix();
        input_masking();
        datetime_picker();
    });
</script>
