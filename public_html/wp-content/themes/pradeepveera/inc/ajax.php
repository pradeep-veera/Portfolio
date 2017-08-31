<?php

// Ajax
add_action('wp_ajax_nopriv_do_ajax', 'our_ajax_function');
add_action('wp_ajax_do_ajax', 'our_ajax_function');

function our_ajax_function() {
	
	$response = call_user_func('ajax_' . $_REQUEST['fn']);
	
		
	if( is_array($response) ){
		$response['fn'] = $_REQUEST['fn'];
		$response['request'] = $_REQUEST;
		$response = json_encode( $response );
		print_r($response);
	}
	else {		
		$response = array(
			'fn' => $_REQUEST['fn'],
			'response' => $response,
			'request' => $_REQUEST
		);
		$response = json_encode( $response );
		print_r($response);
	}
	exit;

}

//=====================================================================


