<?php

/**
 * Provide an admin area view for the plugin
 *
 * This file is used to markup the admin-facing aspects of the plugin.
 *
 * @link       https://github.com/Pasquill
 * @since      1.0.0
 *
 * @package    Content_External_Links_Wp_Plugin
 * @subpackage Content_External_Links_Wp_Plugin/admin/partials
 */
?>

<form method="post" action="options.php">

    <?php
    $options = get_option( $this->plugin_name );
    $nofollow = ( isset( $options['nofollow'] ) ) ? true : false;
    $blank = ( isset( $options['blank'] ) ) ? true : false;
    settings_fields( $this->plugin_name );
    do_settings_sections( $this->plugin_name );
    ?>

    <h2><?php echo esc_html( get_admin_page_title() ); ?></h2>

    <fieldset>
        <legend class="screen-reader-text"><span><?php _e( 'Add rel="nofollow" attribute', $this->plugin_name ); ?></span></legend>
        <label for="<?php echo $this->plugin_name; ?>-nofollow">
            <span><?php esc_attr_e( 'Add rel="nofollow" attribute', $this->plugin_name ); ?></span>
        </label>
        <input type="checkbox"
                id="<?php echo $this->plugin_name; ?>-nofollow"
                name="<?php echo $this->plugin_name; ?>[nofollow]"
                <?php if( !!$nofollow ) { echo 'checked'; } ?>
        >
    </fieldset>

    <fieldset>
        <legend class="screen-reader-text"><span><?php _e( 'Add target="_blank" attribute', $this->plugin_name ); ?></span></legend>
        <label for="<?php echo $this->plugin_name; ?>-blank">
            <span><?php esc_attr_e( 'Add target="_blank" attribute', $this->plugin_name ); ?></span>
        </label>
        <input type="checkbox"
                id="<?php echo $this->plugin_name; ?>-blank"
                name="<?php echo $this->plugin_name; ?>[blank]"
                <?php if( !!$blank ) { echo 'checked'; } ?>
        >
    </fieldset>

    <?php submit_button( __( 'Save all changes', $this->plugin_name), 'primary','submit', TRUE ); ?>

</form>
