

jQuery("#contact234").on("click", "#submit_contact", function () {
    //window.location = fsp_params.dashboard_url;
    //var guest_id = getCookie('guest_id');   
    
    jQuery.ajax({
        type: "POST",
        dataType: "json",
        url: 'http://localhost/contact/wp-admin/admin-ajax.php',
        data: {
            'action': 'insert_contact_message',
            'data': jQuery('#contact234').serialize()
        },

        success: function (data) {
            alert(data);
            if (data.status == 'success') {
             //alert("success");
             jQuery('#contact_success_msg').html('shshd adsiad sdioas do sdiosad');
             jQuery('#contact_success_msg').fadeIn(400).delay(1000).fadeOut(600);             

            } else {
                return false;
            }
            return false;
        }
    });
});