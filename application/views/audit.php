<?php
    defined('BASEPATH') OR exit('No direct script access allowed');
    require 'layout/header.php';
?>

<div class ="container">

    <div class="row">

        <h1 class="text-center">Login / Register History</h1>

        <div class="col-xs-offset-1 col-xs-10 col-sm-offset-1 col-sm-10 well">
            <?php echo $this->session->flashdata('msg'); ?>

            <?php if (!count($audits)) { ?>
                <h3 class="text-danger text-center">No login/register history found</h3>
            <?php } else { ?>
                <div class="table-responsive">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>Date</th>
                                <th>Event</th>
                                <th>IP Address</th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php foreach ($audits as $audit) { ?>
                            <tr>
                                <td><?php echo $audit->created_time; ?></td>
                                <td><?php echo $audit->type; ?></td>
                                <td><?php echo $audit->ip_address; ?></td>
                            </tr>
                        <?php } ?>
                        </tbody>
                    </table>
                </div>

                <div class="text-center">
                    <?php echo $paginationLinks; ?>
                </div>
            <?php } ?>
        </div>

    </div>

</div>

<?php
    require 'layout/footer.php';
?>