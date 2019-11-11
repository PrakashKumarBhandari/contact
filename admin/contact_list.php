<?php error_reporting(0); ?>
<link href="<?php bloginfo('template_url'); ?>/pkb-options/css/style.css" rel="stylesheet" type="text/css" />
<div id="wrap">
    <?php
    global $wpdb;
    $page = isset($_REQUEST['page']) ? $_REQUEST['page'] : '';
    $mode = isset($_REQUEST['mode']) ? $_REQUEST['mode'] : '';

    /*  -------Filter opton ----- */
    $extra = "";
    $page_truncate = '';

    if (isset($_REQUEST['s']) && $_REQUEST['s'] != '') {
        $extra .= " and (name like'%" . $_REQUEST['s'] . "%')";
        $extra .= " or (email like'%" . $_REQUEST['s'] . "%')";
        $page_truncate .= '&s=' . $_REQUEST['s'];
    }

    $limit = 15;
    $adjacents = 2;
    $targetpage = get_bloginfo('url') . '/wp-admin/admin.php?page=contacts' . $page_truncate;
    $condition = "";
    $total_records = count_records($extra);

    $total_pages = $total_records / $limit;


    $pageid = $_GET['pageid'];
    if ($pageid)
        $start = ($pageid - 1) * $limit;    //first item to display on this page
    else
        $start = 0;


    /* ---------  Custom Function start here ------------ */

    function count_records($extra) {
        global $wpdb;
        $sql = "select * from " . $wpdb->prefix . "contact234 WHERE 1 = 1 ";
        if ($extra != '')
            $sql .= $extra;

        $sql .= " order by id DESC";
        $res = $wpdb->get_results($sql, OBJECT);
        return count($res);
    }

    if ($mode == 'delete') {
        $wpdb->query("delete from " . $wpdb->prefix . "contact234 where id=$_REQUEST[pid]");
        echo '<script> window.location="admin.php?page=contacts&status=delete" </script>';
    }


    $sql = "select * from " . $wpdb->prefix . "contact234 WHERE 1= 1 ";
    if ($extra != '') {
        $sql .= $extra;
    }
    $sql .= "order by id ASC limit $start, $limit";

    $result = $wpdb->get_results($sql);
    ?>


    <div class="wrap">
        <h2>Contact Messages 
        <!-- <a href="<?php echo $_SERVER["PHP_SELF"] ?>?page=contacts-add&mode=add" class="button" >Add New</a>  -->
        </h2>
    </div>


    <div class="wrap">
        <span id="wp_paginate" > 
            <div class="pagination-holder">
                <form method="get" action="">
                    <p class="search-box" style="padding:10px">
                        <span style="float:left; width:100px;">  Search : </span>
                        <input type="hidden" name="page" value="contacts">
                        <input type="search" name="s" placeholder="Name or email" value="<?php echo isset($_REQUEST['s']) ? $_REQUEST['s'] : ''; ?>">              
                        <input type="submit" value="Search" class="button" id="search-submit">
                    </p>
                </form>
            </div> 
        </span> 


    </div>

    <?php if (isset($_REQUEST['status'])) : ?>
    <?php if (isset($_REQUEST['status']) && $_REQUEST['status'] == 'delete') {
        ?>
        <div class="notice notice-success is-dismissible">
        <p>Contact message successfully deleted</p>
        </div>
        <?php
    } ?>


    </div>
    <?php
    endif;
    ?>

    <table width="100%" class="widefat fixed comments"  style="padding-bottom:20px;">
        <thead>
            <tr>
                <th width="5%">S.N.</th>
                <th width="25%">Full Name</th>
                <th width="25%">Email</th>                
                <!-- <th width="10%">Phone Number</th>
                <th width="50">Message</th> -->
                <th width="20%">Date</th>
                <th width="10%">Action</th>
            </tr>
        </thead>

        <tbody>

            <?php if ($result) { ?>

                <?php
                $count = $start + 1;
                $class = '';
                foreach ($result as $entry) {

                    if ($count % 2 == 1)
                        $class = 'class="alternate "';
                    else
                        $class = '';
                    ?>

                    <tr <?php echo $class; ?>>
                        <td><?php echo (($pages->current_page - 1) * $pages->items_per_page) + $count; ?></td>
                        <td><a href="<?php echo $_SERVER["PHP_SELF"] ?>?page=contacts-message&pid=<?php echo $entry->id; ?>&mode=view"><?php echo stripslashes($entry->name); ?></a></td> 
                        <td><?php echo stripslashes($entry->email); ?></td>                       
                        <td><?php echo stripslashes($entry->post_date); ?></td> 
                        <td>
                        <a href="<?php echo $_SERVER["PHP_SELF"] ?>?page=contacts-message&pid=<?php echo $entry->id; ?>&mode=view">
                        <?php if ($entry->status == '1') {
                            ?><i class="fa fa-eye"></i>
                        <?php
                        } else { ?><i class="fa fa-eye-slash"></i>                        
                        <?php
                        } ?> View
                        </a>
                          / <a href="<?php echo $_SERVER["PHP_SELF"] ?>?page=contacts&pid=<?php echo $entry->id; ?>&mode=delete" onclick="return confirm('Are you sure to delete?');">Delete</a>
            
                        </td> 

                        
                    </tr> 
        <?php
        $count++;
    }
    ?>

<?php } else { ?>
                <tr>
                    <td colspan="5">No record found.</td>
                </tr>
<?php } ?>
        </tbody>

        <tfoot>
            <tr>
                <th width="5%">S.N.</th>
                <th width="25%">Full Name</th>
                <th width="25%">Email</th>      
                <th width="20%">Date</th>
                <th width="10%">Action</th>
            </tr>
        </tfoot>

    </table>

</div>