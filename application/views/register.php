<?php
    defined('BASEPATH') OR exit('No direct script access allowed');
    require 'layout/header.php';
?>

<div class ="container">

    <div class="row">

        <h2 class="text-center">Register</h2>

        <div class="col-xs-offset-1 col-xs-10 col-sm-offset-4 col-sm-4 well">
            <?php echo $this->session->flashdata('msg'); ?>

            <?php if ($this->session->userdata('id_user')) { ?>

                <p class="text-center">You already logged in as "<?php echo $this->session->userdata('name'); ?>"</p>

                <p class="text-center"><a href="/start/logout"><button class="btn btn-danger">Logout</button></a></p>

            <?php } else { ?>

                <?php
                    $attributes = array("name" => "register");
                    echo form_open("/register", $attributes);
                ?>
                    <div class="form-group">
                        <input class="form-control" name="name" placeholder="Name" type="text" value="<?php echo set_value('name'); ?>" />
                        <span class="text-danger"><?php echo form_error('name'); ?></span>
                    </div>

                    <div class="form-group">
                        <input class="form-control" name="email" placeholder="Email" type="text" value="<?php echo set_value('email'); ?>" />
                        <span class="text-danger"><?php echo form_error('email'); ?></span>
                    </div>

                    <div class="form-group">
                        <input class="form-control" name="contact_no" placeholder="Contact No" type="text" value="<?php echo set_value('contact_no'); ?>" />
                        <span class="text-danger"><?php echo form_error('contact_no'); ?></span>
                    </div>

                    <div class="form-group">
                        <input class="form-control" name="password" placeholder="Password" type="password" />
                        <span class="text-danger"><?php echo form_error('password'); ?></span>
                    </div>

                    <div class="form-group">
                        <input class="form-control" name="cpassword" placeholder="Confirm Password" type="password" />
                        <span class="text-danger"><?php echo form_error('cpassword'); ?></span>
                    </div>

                    <div class="form-group">
                        <button name="submit" type="submit" class="btn btn-success">Register</button>
                        <button name="clear" type="reset" class="btn btn-danger">Clear</button>
                    </div>
                <?php echo form_close(); ?>

            <?php } ?>
        </div>

    </div>

</div>

<?php require 'layout/footer.php'; ?>