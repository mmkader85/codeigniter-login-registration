<!DOCTYPE html>
<html lang="en">

<head>
    <title>Chope - Test</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel='shortcut icon' type='image/x-icon' href="<?php echo base_url('assets/images/favicon.ico'); ?>" />
    <link rel="stylesheet" href="<?php echo base_url('assets/css/bootstrap.css'); ?>" />
    <link rel="stylesheet" href="<?php echo base_url('assets/css/main.css'); ?>" />
</head>

<body>
    <nav class="navbar navbar-inverse">
        <div class="container">
            <div class="navbar-header">
                <a class="navbar-brand" href="/">Chope Test</a>
            </div>
            <ul class="nav navbar-nav">
                <li class="active"><a href="/">Home</a></li>
                <?php if ($this->session->userdata('id_user')) { ?>
                <li><a href="/audit">Login / Register History</a></li>
                <?php } ?>
            </ul>

            <ul class="nav navbar-nav navbar-right">
                <?php if ($this->session->userdata('id_user')) { ?>
                    <li><a href="/start/logout"><span class="glyphicon glyphicon-log-out"></span> Logout</a></li>
                <?php } else { ?>
                    <li><a href="/register"><span class="glyphicon glyphicon-user"></span> Register</a></li>
                    <li><a href="/login"><span class="glyphicon glyphicon-log-in"></span> Login</a></li>
                <?php } ?>
            </ul>
        </div>
    </nav>
