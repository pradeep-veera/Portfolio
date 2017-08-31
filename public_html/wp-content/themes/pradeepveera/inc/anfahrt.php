<?php

// Version: 1.0

function sc_get_anfahrt( $atts ) {
	$atts = shortcode_atts( array(
		'foo' => 'no foo',
		'baz' => 'default baz'
	), $atts, 'anfahrtskarte' );

	return get_anfahrtskarte();
}
add_shortcode( 'anfahrtskarte', 'sc_get_anfahrt' );



//============================================================================================



function get_anfahrtskarte() {
	
	$latlng = huku_get_option('_anfahrt_latlng');
	$zoom = huku_get_option('_anfahrt_zoom') ? huku_get_option('_anfahrt_zoom') : 15;
	$pin_url = huku_get_option('_anfahrt_pin') ? huku_get_option('_anfahrt_pin') : false;
	$pin_size = huku_get_option('_anfahrt_pin_size');
	$pin_anchor = huku_get_option('_anfahrt_pin_anchor');
	$info_content = huku_get_option('_anfahrt_info_content') ? huku_get_option('_anfahrt_info_content') : false;
	$styles = huku_get_option('_anfahrt_styles') ? huku_get_option('_anfahrt_styles') : false;
	
	
	ob_start();
?>

<div id="google-map"></div>
<script>
	
	var map, center;
	function initMap() {
		center = new google.maps.LatLng(<?php echo $latlng; ?>); 
		map = new google.maps.Map(document.getElementById('google-map'), {
			center: center,
			zoom: <?php echo $zoom; ?>,<?php if ( $styles ): ?>
			styles: <?php echo $styles; ?><?php endif; ?>
		});
		
		<?php if ( $pin_url ): ?>
		var markerIcon = {
			url: '<?php echo $pin_url; ?>',
			size: new google.maps.Size(<?php echo $pin_size; ?>),
			origin: new google.maps.Point(0, 0),
			anchor: new google.maps.Point(<?php echo $pin_anchor; ?>)
		};
		<?php endif; ?>
		
		var marker = marker = new google.maps.Marker({
			position: center,
			map: map,
			<?php if ( $pin_url ): ?>icon: markerIcon<?php endif; ?>
		});
		
		<?php if ( $info_content ): ?>
		var infowindow = new google.maps.InfoWindow({
			content: <?php echo json_encode(wpautop($info_content)); ?>
		});
		
		marker.addListener('click', function() {
			infowindow.open(map, marker);
		});
		<?php endif; ?>
	}

</script>
<script src="https://maps.googleapis.com/maps/api/js?callback=initMap&key=AIzaSyBZsmhttYU__3fAQGxMDremkGi_ywod0OA" async defer></script>
	
<?php
	$output = ob_get_contents();
	ob_end_clean();
	
	return $output;
	
}



//============================================================================================




/**
 * CMB2 Theme Options
 * @version 0.1.0
 */
class Huku_Anfahrt_Options {
	/**
 	 * Option key, and option page slug
 	 * @var string
 	 */
	private $key = 'huku_anfahrtskarte';
	/**
 	 * Options page metabox id
 	 * @var string
 	 */
	private $metabox_id = 'huku_anfahrtskarte_metabox';
	/**
	 * Options Page title
	 * @var string
	 */
	protected $title = '';
	/**
	 * Options Page hook
	 * @var string
	 */
	protected $options_page = '';
	/**
	 * Constructor
	 * @since 0.1.0
	 */
	public function __construct() {
		// Set our title
		$this->title = 'Anfahrtskarte';
	}
	/**
	 * Initiate our hooks
	 * @since 0.1.0
	 */
	public function hooks() {
		add_action( 'admin_init', array( $this, 'init' ) );
		add_action( 'admin_menu', array( $this, 'add_options_page' ) );
		add_action( 'cmb2_init', array( $this, 'add_options_page_metabox' ) );
	}
	/**
	 * Register our setting to WP
	 * @since  0.1.0
	 */
	public function init() {
		register_setting( $this->key, $this->key );
	}
	/**
	 * Add menu options page
	 * @since 0.1.0
	 */
	public function add_options_page() {
		$this->options_page = add_menu_page( $this->title, $this->title, 'manage_options', $this->key, array( $this, 'admin_page_display' ) );
		// Include CMB CSS in the head to avoid FOUT
		add_action( "admin_print_styles-{$this->options_page}", array( 'CMB2_hookup', 'enqueue_cmb_css' ) );
	}
	/**
	 * Admin page markup. Mostly handled by CMB2
	 * @since  0.1.0
	 */
	public function admin_page_display() {
		?>
		<div class="wrap cmb2-options-page <?php echo $this->key; ?>">
			<h2><?php echo esc_html( get_admin_page_title() ); ?></h2>
			<?php cmb2_metabox_form( $this->metabox_id, $this->key ); ?>
		</div>
		<?php
	}
	/**
	 * Add the options metabox to the array of metaboxes
	 * @since  0.1.0
	 */
	function add_options_page_metabox() {
		$cmb = new_cmb2_box( array(
			'id'         => $this->metabox_id,
			'hookup'     => false,
			'cmb_styles' => false,
			'show_on'    => array(
				// These are important, don't remove
				'key'   => 'options-page',
				'value' => array( $this->key, )
			),
		) );
		
		// Set our CMB2 fields		
		
		$cmb->add_field( array(
			'name' => 'Shortcode: [anfahrtskarte]',			
			'id'   => '_title',
			'type' => 'title',
		) );
		
		$cmb->add_field( array(
			'name' => 'Straße + Nr.',			
			'id'   => '_anfahrt_strasse_nr',
			'type' => 'text',
		) );
		
		$cmb->add_field( array(
			'name' => 'PLZ + Ort',			
			'id'   => '_anfahrt_plz_ort',
			'type' => 'text',
		) );
		
		$cmb->add_field( array(
			'name' => 'Koordinaten',			
			'id'   => '_anfahrt_latlng',
			'type' => 'text',
		) );
		
		$cmb->add_field( array(
			'name' => 'Map-Pin',			
			'id'   => '_anfahrt_pin',
			'type' => 'file',
		) );
		
		$cmb->add_field( array(
			'name' => 'Pin-Size',
			'desc' => 'z.B. 50,50',
			'id'   => '_anfahrt_pin_size',
			'type' => 'text_small',
		) );
		
		$cmb->add_field( array(
			'name' => 'Pin-Anchor',
			'desc' => 'z.B. 25,50',
			'id'   => '_anfahrt_pin_anchor',
			'type' => 'text_small',
		) );
		
		$cmb->add_field( array(
			'name' => 'Zoom',
			'desc' => 'z.B. 15,16,17,18',
			'id'   => '_anfahrt_zoom',
			'type' => 'text_small',
		) );
		
		$cmb->add_field( array(
			'name'    => '',			
			'id'      => '_anfahrt_info_content',
			'type'    => 'wysiwyg',
			'options' => array( 'textarea_rows' => 10, ),
		) );
		
		$cmb->add_field( array(
			'name' => 'Styles',
			'desc' => '<a href="http://googlemaps.github.io/js-samples/styledmaps/wizard/index.html" target="_blank">http://googlemaps.github.io/js-samples/styledmaps/wizard/index.html</a><br>oder<br><a href="https://snazzymaps.com/editor" target="_blank">https://snazzymaps.com/editor</a><br>Show JSON (Copy Paste)',
			'id'   => '_anfahrt_styles',
			'type' => 'textarea_code',
		) );
		
		
		
		
	}
	/**
	 * Public getter method for retrieving protected/private variables
	 * @since  0.1.0
	 * @param  string  $field Field to retrieve
	 * @return mixed          Field value or exception is thrown
	 */
	public function __get( $field ) {
		// Allowed fields to retrieve
		if ( in_array( $field, array( 'key', 'metabox_id', 'title', 'options_page' ), true ) ) {
			return $this->{$field};
		}
		throw new Exception( 'Invalid property: ' . $field );
	}
}


function huku_anfahrt_options() {
	static $object = null;
	if ( is_null( $object ) ) {
		$object = new Huku_Anfahrt_Options();
		$object->hooks();
	}
	return $object;
}


function huku_get_option( $key = '' ) {
	return cmb2_get_option( huku_anfahrt_options()->key, $key );
}


huku_anfahrt_options();