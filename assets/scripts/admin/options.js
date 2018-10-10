/**
 * Custom validation for the URL social-network fields
 */
$( document ).on(' carbonFields.apiLoaded', function( e, api ) {
	$( document ).on( 'carbonFields.validateField', function( e, field, error ) {
		let value = api.getFieldValue( field );

		if ( field.includes( 'social_url_' ) ) {
			if ( value !== '' && ! is_valid_url( value ) ) {
				return 'Please set a valid URL to be used for this field.';
			}

			return null;
		}
	});
});

/**
 * Check if a string is a valid URL
 * 
 * @param string url
 * @credits https://stackoverflow.com/a/34695026
 */
function is_valid_url( url ) {
	var pattern = new RegExp('^(https?:\\/\\/)?' + // protocol
	'((([a-z\\d]([a-z\\d-]*[a-z\\d])*)\\.?)+[a-z]{2,}|' + // domain name
	'((\\d{1,3}\\.){3}\\d{1,3}))' + // OR ip (v4) address
	'(\\:\\d+)?(\\/[-a-z\\d%_.~+]*)*' + // port and path
	'(\\?[;&a-z\\d%_.~+=-]*)?' + // query string
	'(\\#[-a-z\\d_]*)?$','i'); // fragment locator
	
	return pattern.test( url );
}