<style>
.hide_user {
    display: none;
}
</style>
<?php
global $wpdb;
$page = isset($_REQUEST['page']) ? $_REQUEST['page'] : '';
$mode = isset($_REQUEST['mode']) ? $_REQUEST['mode'] : '';

if (isset($_POST['bannerbtn'])) {
    //echo"iamhere"; exit;
    if ($mode == 'edit') {
        //echo $_POST['status']; exit;
        $data = array(
            'name' => wpautop(addslashes($_POST['name'])),
            'email' => addslashes($_POST['email']),
            'phone' => addslashes($_POST['phone']),
            'message' => $_POST['message']);

        $wpdb->update($wpdb->prefix . 'contact234', $data, array('id' => $_POST['bannerid']));
        $db_status = 'update';
    } else {
        $data = array(
            'name' => wpautop(addslashes($_POST['name'])),
            'email' => addslashes($_POST['email']),
            'phone' => addslashes($_POST['phone']),
            'message' => $_POST['message'],
            'post_date' => now());


        $wpdb->insert($wpdb->prefix . 'contact234', $data);
        $db_status = 'add';
    }
    echo '<script> window.location="admin.php?page=contacts&status=' . $db_status . '" </script>';
}

if ($mode == 'edit') {
    $result = $wpdb->get_row("select * from " . $wpdb->prefix . "contact234 where id=$_REQUEST[pid]");
}
?>

<div id="wrap">
    <div class="wrap">
        <h2> Contact Plugin <a href="<?php echo $_SERVER["PHP_SELF"] ?>?page=contacts" class="button">View All</a>
        </h2>

    </div>





    <div class="wrap">
        <table width="100%" class="wp-list-table widefat fixed striped posts" border="0">
            <tr>
                <td><label> Plugin Short Code :</label> <strong>[contact234]</strong> <br /> You can insert the plugin
                    code in page and post.</td>

            </tr>
            <tr>
                <td width="100%"><label> Form Display: (design) </label>
                    <br />
                    <div class="contactform_wrapper">
                        <div class="contact-header">
                            <div class="heading">Ask Us A Question</div>
                            <div class="contact-sub-tle">Our team will get back to you right away</div>
                        </div>
                        <div class="contact-body">
                            <div id="contact_success_msg"></div>
                            <form id="contact234">
                                <div class="inputWithIcon">
                                    <input type="text" name="name" placeholder="Full Name">
                                    <i class="fa fa-user " aria-hidden="true"></i>
                                </div>

                                <div class="inputWithIcon">
                                    <input type="text" name="email" placeholder="Email">
                                    <i class="fa fa-envelope " aria-hidden="true"></i>
                                </div>

                                <div class="inputWithIcon">
                                    <input type="text" name="phone" placeholder="Phone Number">
                                    <i class="fa fa-mobile fa-lg fa-fw" aria-hidden="true"></i>
                                </div>

                                <div class="inputWithIcon">
                                    <textarea type="text" name="message" placeholder=""> Question/Comments</textarea>
                                    <i class="fa fa-comments-o fa-lg fa-fw" aria-hidden="true"></i>
                                </div>

                                <button type="button" 
                                    class="btn sub_button">Contact Us</button>
                        </div>
                        </form>
                    </div>

                </td>
            </tr>
        </table>
    </div>


</div>