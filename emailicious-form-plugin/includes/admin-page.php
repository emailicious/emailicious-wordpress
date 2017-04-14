<?php

function wpformelicious_options_page() {
    ob_start(); ?>
    <div class="wrap">
        <h2>Formelicious Plugin!</h2>
        <p>This is our settings page content</p>
    </div>
    <?php
    echo ob_get_clean();
}

function wpformelicious_options_link() {
    add_options_page('Formelicious options', 'Formelicious', 'manage_options', 'wpformelicious-options', 'wpformelicious_options_page');
}

add_action( 'admin_menu', 'wpformelicious_options_link');

