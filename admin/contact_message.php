<style>
    .hide_user{
        display:none;
    }
</style>

<?php
global $wpdb;
$page = isset($_REQUEST['page']) ? $_REQUEST['page'] : '';
$mode = isset($_REQUEST['mode']) ? $_REQUEST['mode'] : '';

$result = $wpdb->get_row("select * from " . $wpdb->prefix . "contact234 where id=$_REQUEST[pid]");
//print_r($result); exit;
?>

<div id="wrap">
    <div class="wrap">
        <h2>
           View Messsage <a href="<?php echo $_SERVER["PHP_SELF"] ?>?page=contacts" class="button" >View All</a>
        </h2>

    </div>

    <style type="text/css">
        label{
            width:200px;
            display:block;
            float:left;
            font-weight:bold;
        }
    </style>



    <div class="wrap">
        <form name="bannerfrm" class="contact234_admin" action="" method="post" enctype="multipart/form-data">

            <table width="100%" class="wp-list-table widefat fixed striped posts" border="0">           
               

                <tr>
                    <td width="10%"><label> Full Name : </label></td>
                    <td width="90%"> <?php echo $result->name;?></td>
                </tr>
                <tr>
                    <td width="10%"><label> Email : </label></td>
                    <td width="90%"> <?php echo $result->email;?></td>
                </tr>
                <tr>
                    <td width="10%"><label> Phone : </label></td>
                    <td width="90%"> <?php echo $result->phone;?></td>
                </tr>
                <tr>
                    <td width="10%"><label> Message : </label></td>
                    <td width="90%"> <?php echo $result->message;?></td>
                </tr>
            </table>


        </form>

    </div>


</div>

<script>
    jQuery(document).ready(function($) {
        $('#slug').on('keyup change', function() {
            var title = $(this).val().trim();
            title = title.toLowerCase();
            var title_new = title.replace(/[^a-z0-9\-\s]/gi, '').replace(/[\s]/g, '-');
            title_new = title_new.substring(0, 50);
            $('#slug').val(title_new);
        });

        //$('#et_content-tmce').click();

        //$('#et_content-tmce').click();
    });

</script>
