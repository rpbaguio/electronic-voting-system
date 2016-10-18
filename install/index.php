<?php

error_reporting(0); //Setting this to E_ALL showed that that cause of not redirecting were few blank lines added in some php files.

$db_config_path = '../application/config/database.php';

// Only load the classes in case the user submitted the form
if ($_POST) {

    // Load the classes and create the new objects
    require_once 'includes/core_class.php';
    require_once 'includes/database_class.php';

    $core = new Core();
    $database = new Database();

    // Validate the post data
    if ($core->validate_post($_POST) == true) {

        // First create the database, then create tables, then write config file
        if ($database->create_database($_POST) == false) {
            $message = $core->show_message('error', 'The database could not be created, please verify your settings.');
        } elseif ($database->create_tables($_POST) == false) {
            $message = $core->show_message('error', 'The database tables could not be created, please verify your settings.');
        } elseif ($core->write_config($_POST) == false) {
            $message = $core->show_message('error', 'The database configuration file could not be written, please chmod application/config/database.php file to 777');
        }

        // If no errors, redirect to auth/login page
        if (!isset($message)) {
            $redir = ((isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] == 'on') ? 'https' : 'http');
            $redir .= '://'.$_SERVER['HTTP_HOST'];
            header('Location: '.$redir.'/auth');
        }
    } else {
        $message = $core->show_message('error', 'All fields are required');
    }
}

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>

    <title>DB Configuration</title>
    <!-- External stylesheet -->
    <link href="../assets/tb/css/bootstrap.min.css" rel="stylesheet">
    <link href="../assets/pace/css/themes/flash.min.css" rel="stylesheet">
    <link href="../assets/themes/default/css/style.min.css" rel="stylesheet" title="main">
</head>
<body>

<div id="main-wrapper">
    <div class="container-fluid">
        <div class="row">
            <div id="db-config" class="col-md-offset-4 col-md-4 col-lg-offset-4 col-lg-4 box-shadow-effect">
                <form id="install_form" method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">

                  <h3 class="text-center">Database Config</h3>
                  <hr/>

                  <?php if (is_writable($db_config_path)) {?>

                  <?php if (isset($message)): ?>
                        <div class="alert alert-danger">
                            <ul class="validation-errors">
                                <li><?= $message ?></li>
                            </ul>
                        </div>
                  <?php endif; ?>

                  <div class="well well-sm">
                      <div class="form-group">
                          <label class="control-label">Database Host<span class="important">*</span></label>
                          <input type="text" class="form-control" name="hostname" placeholder="localhost">
                      </div>
                      <div class="form-group">
                          <label class="control-label">Username<span class="important">*</span></label>
                          <input type="text" class="form-control" name="username" placeholder="">
                      </div>
                      <div class="form-group">
                          <label class="control-label">Password<span class="important">*</span></label>
                          <input type="password" class="form-control" name="password" placeholder="">
                      </div>
                      <div class="form-group">
                          <label class="control-label">Database Name<span class="important">*</span></label>
                          <input type="text" class="form-control" name="database" placeholder="">
                      </div>
                  </div>

                  <button type="submit" class="btn btn-primary btn-lg btn-block btn-rounded-corner">Submit</button>

                  <?php } else { ?>
                      <p class="alert alert-danger">Please make the application/config/database.php file writable.
                          <strong>Example</strong>:<br/><br/>
                          <code>chmod 777 application/config/database.php</code>
                      </p>
                  <?php } ?>

                </form>
            </div>
        </div>
    </div>
</div>

<!-- jQuery -->
<script type="text/javascript" src="../assets/script/jquery-2.1.4.min.js"></script>

<!-- Include all compiled plugins (below), or include individual files as needed -->
<script type="text/javascript" src="../assets/pace/js/pace.min.js"></script>

</body>
</html>
