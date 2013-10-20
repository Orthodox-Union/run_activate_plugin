<?php
/*************************************************************
*
*  Based off of http://wordpress.stackexchange.com/a/4050/7007
*
**************************************************************/

// Auto activates plugins based on this theme
function run_activate_plugin( $plugin ) {
    $current = get_option( 'active_plugins' );
    $plugin = plugin_basename( trim( $plugin ) );
    
    if ( !in_array( $plugin, $current ) ) {
        // Make sure the plugin is loaded, so we have the activation hooks
        require_once(WP_PLUGIN_DIR.'/'.$plugin);

        $current[] = $plugin;
        sort( $current );
        do_action( 'activate_plugin', trim( $plugin ) );
        update_option( 'active_plugins', $current );
        do_action( 'activate_' . trim( $plugin ) );
        do_action( 'activated_plugin', trim( $plugin) );
    }

    return null;
}
