<?php

if ( is_admin() ){ // admin actions
	add_action( 'admin_menu', 'add_menu_huku_settings_page' );
	add_action( 'admin_init', 'register_huku_settings_page' );
}



function register_huku_settings_page() {

	register_setting( 'huku-settings', 'huku_settings' );
	
	add_settings_section(
		'huku_pluginPage_section', 
		__( 'Einstellungen', 'huku' ), 
		'huku_settings_section_callback', 
		'huku-settings'
	);

	add_settings_field( 
		'enable_google_analytics_tracking', 
		__( 'Google-Analytics aktivieren', 'huku' ), 
		'huku_enable_google_analytics_tracking_render', 
		'huku-settings', 
		'huku_pluginPage_section' 
	);

	add_settings_field( 
		'gaProperty', 
		__( 'Google-Analytics-ID', 'huku' ), 
		'huku_gaProperty_render', 
		'huku-settings', 
		'huku_pluginPage_section' 
	);
	
	add_settings_field( 
		'recipient_email', 
		__( 'Empfänger-Emailadresse', 'huku' ), 
		'huku_recipient_email_render', 
		'huku-settings', 
		'huku_pluginPage_section' 
	);
	
}

function huku_settings_section_callback(  ) { 

	echo __( '...', 'huku' );

}


function huku_enable_google_analytics_tracking_render(  ) { 

	$options = get_option( 'huku_settings' );
	$options['enable_google_analytics_tracking'] = isset($options['enable_google_analytics_tracking']) ? $options['enable_google_analytics_tracking'] : 0;
	?>
	<input type='checkbox' name='huku_settings[enable_google_analytics_tracking]' <?php checked( $options['enable_google_analytics_tracking'], 1 ); ?> value='1'>
	<?php

}


function huku_gaProperty_render(  ) { 

	$options = get_option( 'huku_settings' );
	$options['gaProperty'] = isset($options['gaProperty']) ? $options['gaProperty'] : '';
	?>
	<input type='text' name='huku_settings[gaProperty]' value='<?php echo $options['gaProperty']; ?>'>
	<?php

}


function huku_recipient_email_render(  ) { 

	$options = get_option( 'huku_settings' );
	$options['recipient_email'] = isset($options['recipient_email']) ? $options['recipient_email'] : '';
	?>
	<input type='text' name='huku_settings[recipient_email]' value='<?php echo $options['recipient_email']; ?>'>
	<?php

}


function add_menu_huku_settings_page() {
	add_menu_page( 'Einstellungen', 'huku Settings', 'manage_options', 'huku_settings', 'display_huku_settings', 'dashicons-admin-generic', 110 );
}



function display_huku_settings() {
	
	?>
	<div class="wrap">
		<h2>huku-Settings</h2>
		<form method="post" action="options.php"> 
		<?php settings_fields('huku-settings');?>
		<?php do_settings_sections('huku-settings');?>
		<?php submit_button(); ?>
		</form>
	</div>
	<?php
}