<?php

//Change logo
add_action( 'login_enqueue_scripts', 'my_login_logo' );
function my_login_logo() { ?>
    <style type="text/css">
        #login h1 a, .login h1 a {
            background-image: url(/wp-content/themes/breda-voor-elkaar/logo.png);
            width: 320px;
            background-size: 200px;
			height: 100px;
        }
    </style>
<?php }

?>