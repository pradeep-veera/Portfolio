<?php

function sc_get_kontaktformular( $atts ) {
	$atts = shortcode_atts( array(
		'foo' => 'no foo',
		'baz' => 'default baz'
	), $atts, 'kontakt-formular' );

	return get_kontaktformular();
}
add_shortcode( 'kontakt-formular', 'sc_get_kontaktformular' );



//============================================================================================



function get_kontaktformular() {
	
	ob_start();
?>

<form id="kontaktformular">
	<div class="left">
		<div class="field name">
			<input type="text" name="name" placeholder="#Your Name" data-req="true">
		</div>
		<div class="field telefon">
			<input type="text" name="telefon" placeholder="#Your Phone (Optional)" data-req="false">
		</div>	
	</div>
	<div class="right">	
		<div class="field email">
			<input type="text" name="email" placeholder="#Your Email" data-req="true">
		</div>
		<div class="field subject">
			<input type="text" name="subject" placeholder="#Subject" data-req="true">
		</div>	
	</div>
	<div class="field message">
		<textarea name="message" placeholder="#Your Message" data-req="true"></textarea>
	</div>	
	<div class="field submit">
		<input type="submit" value="Submit">
	</div>	
</form>

<script>
	$ = jQuery;

	var formSubmitLock = false;
	var $form = $('#kontaktformular');

	$form.submit(function(e) { 
		e.preventDefault();
		if ( formSubmitLock ) return false;
		var $form = $(this);
		
		var readyForSubmit = true;
		var fields = {};
		$form.find('input[type="text"], input[type="radio"]:checked, textarea, select').each(function() {
			var $field = $(this);		
			if ( $field.attr('name') ) {
				fields[$field.attr('name')] = $field.val();
			}
			if ( $field.is('[data-req="true"]') && !$field.val() ) {
				readyForSubmit = false;
				$field.addClass('please-fill-in');
			}
		});
		
		if ( !readyForSubmit ) {
			$form.find('input[type="submit"]').val('Please fill the marked fields').addClass('please-fill-in');
		}
		
		if ( readyForSubmit ) {
			formSubmitLock = true;
			
			$form.find('input[type="submit"]').val('Message is sent');
			
			fields['origin'] = window.location.href;		
			
			jQuery.ajax({
				url: '<?php echo admin_url( 'admin-ajax.php' ); ?>',
				data: {
					action: 'do_ajax',
					fn: 'contact_form_submit',
					fields: fields
				},
				dataType: 'JSON',
				success:function(data){				
					$form.removeClass('sent fail');
					if ( data.status == 'fail' ) {		
						$form.addClass('fail');		
					} else if ( data.status == 'success' ) { 
						$form[0].reset();
						$form.addClass('sent').find('input[type="submit"]').val('Thank you for your message');
						
						setTimeout(function() {
							$form.removeClass('sent').find('input[type="submit"]').val('Absenden');
							formSubmitLock = false;							
						}, 5000);					
					}			
				},
				error: function( jqXHR, textStatus, errorThrown ){
					alert( 'Fehler' );
					console.log( jqXHR );
					console.log( textStatus );
					console.log( errorThrown );
				} 
			}); 
			
		}
		
	});


	$form.on('focus', '.please-fill-in', function() {
		$(this).removeClass('please-fill-in');
		if ( !$form.find('.please-fill-in').not('input[type="submit"]').length ) {
			$form.find('input[type="submit"]').val('Subject').removeClass('please-fill-in');
		}
	});

</script>
	
<?php
	$output = ob_get_contents();
	ob_end_clean();
	
	return $output;
	
}


//=================================================================================================


function ajax_contact_form_submit() {
	
	$fields = $_REQUEST['fields'];	
	
	$message = array(
		'Kontakt-Formular',
		'--------------------',
		'',		
		'Name: ' . $fields['name'],
		'E-Mail: ' . $fields['email'],		
		'Telefon: ' . $fields['telefon'],		
		'Subject: ' . $fields['subject'],		
		'',
		'Nachricht:',
		'---',
		$fields['message'],
		'---',
		'',
		'Diese Anfrage kam von dieser Seite: ' . $fields['origin'],
	);
	
	$message = implode("\n", $message);	

	$options = get_option( 'huku_settings' );	
	$recipient = trim($options['recipient_email']);
	if ( ! is_email( $recipient ) ) $recipient = trim(get_option('admin_email'));
	
	$subject = 'Nachricht vom Kontaktformular';
	
	$headers = 'From: ' . $fields['name'] . ' <' . $fields['email'] . '>' . "\r\n";
	if (wp_mail($recipient, $subject, $message, $headers )) {	
		$status = "success"; 
	}
	else { $status = "fail"; }
	
	return array(
		'status' => $status,
		'debug' => $fields,
	);
	
}
