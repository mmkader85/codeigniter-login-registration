<?php
    defined('BASEPATH') OR exit('No direct script access allowed');
    require 'layout/header.php';
?>

<div class ="container">

    <div class="row">

        <h1 class="text-center">Welcome to Chope</h1>

        <div class="col-xs-offset-1 col-xs-10 col-sm-offset-3 col-sm-6 col-md-offset-4 col-md-4 well text-center">
            <?php echo $this->session->flashdata('msg'); ?>

            <?php if ($this->session->userdata('id_user')) { ?>
                <a href="/audit"><button class="btn btn-primary">Login / Register History</button></a>
                <a href="/start/logout"><button class="btn btn-danger">Logout</button></a>
            <?php } else { ?>
                <a href="/login"><button class="btn btn-success">Login</button></a>
                <a href="/register"><button class="btn btn-success">Register</button></a>
            <?php } ?>
        </div>

    </div>

</div>

<?php
    require 'layout/footer.php';
?>