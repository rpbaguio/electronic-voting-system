<nav class="navbar navbar-default">
    <div class="navbar-header">
        <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar top-bar"></span>
            <span class="icon-bar middle-bar"></span>
            <span class="icon-bar bottom-bar"></span>
        </button>
        <a class="navbar-brand" href="<?= base_url() ?>">EVS<sup>&reg;</sup></a>
    </div>
    <div id="navbar" class="navbar-collapse collapse">
        <ul class="nav navbar-nav">
            <li><a href="<?= base_url('admin/dashboard') ?>">Dashboard</a></li>
            <li><a href="<?= base_url('admin/persons') ?>">Persons</a></li>
        </ul>
        <!-- @TODO Theme switcher
        <ul class="nav navbar-nav" id="theme-dropdown">
            <li class="dropdown">
                <a href="#" id="placeholder" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-close-others="false">
                    Themes<span class="caret"></span></i>
                </a>
                  <ul class="dropdown-menu">
                    <li><a href="#" class="change-theme" rel="dark"> Dark (Default)</a></li>
                    <li><a href="#" class="change-theme" rel="light"> Light</a></li>
                  </ul>
            </li>
        </ul>
        -->
        <ul class="nav navbar-nav navbar-right">
            <li class="dropdown">
                <a href="javascript:void(0)" id="placeholder" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-close-others="false">
                    <?= role(user('id')); ?><span class="caret"></span></i>
                </a>
                <ul class="dropdown-menu" role="menu">
                    <li><a href="<?= base_url('auth/signout') ?>">Sign out</a></li>
                </ul>
            </li>
        </ul>
    </div>
</nav>
