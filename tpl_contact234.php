<?php
/**
* Plugin Name: Contact Form : Contact234
* Plugin URI: https://www.domain.com/
* Description: Contact form in post or page using ajax form using short code.
* Version: 1.0
* Author: Auhor 
* Author URI: http://domain.com/
**/
?>
   
        <div class="contactform_wrapper">
            <div class="contact-header">
                <div class="heading">Ask Us A Question</div>
                <div class="contact-sub-tle">Our team will get back to you right away</div>
            </div>
            <div class="contact-body">
            <div id="contact_success_msg"></div>
            <form id="contact234"  >
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

            <button type="button" name="submit_contact" id="submit_contact" class="btn sub_button" >Contact Us</button>
            </div>
            </form>
        </div>       
    