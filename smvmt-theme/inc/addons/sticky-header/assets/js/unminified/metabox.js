/**
 * Sticky Header Metabox
 *
 * @package smvmt
 * @since 1.0.0
 */

(function( $ ) {

	function toggle_sticky_header_options( value ) {
		if ( 'enabled' == value ) {
			$( '#stick-header-meta-options' ).slideDown();
			toggle_sticky_header_opacity();
		} else {
			$( '#stick-header-meta-options' ).slideUp();
			$( '.sticky-header-bg-opc-wrap' ).slideUp();
		}
	}

	$( '#stick-header-meta' ).each(function(index, el) {
		var value = $( el ).val();
		toggle_sticky_header_options( value );
		$( el ).change(function(event) {
			value = $( el ).val();
			toggle_sticky_header_options( value );
		});
	});

	$( '#stick-header-meta-options input' ).click(function() {
		toggle_sticky_header_opacity();
	});

	function toggle_sticky_header_opacity() {
		var checkedValues = $( '#stick-header-meta-options input[type=checkbox]:checked' ).map(function () {
	        return this.value;
	    }).get();
	    if (checkedValues == '') {
	    	$( '.sticky-header-bg-opc-wrap' ).slideUp();
	    } else {
	    	$( '.sticky-header-bg-opc-wrap' ).slideDown();
	    }
	}

	/**
	 * Below Header meta option
	 */
	toggle_sticky_suppl_options();
	$( '#smvmt-below-header-display').click(function(){
		toggle_sticky_suppl_options();
		toggle_stick_wrapper();
	})

	function toggle_sticky_suppl_options(){
		if ( $( '#smvmt-below-header-display' ).is(':checked')) {
			$( '.sticky-below-header-meta-wrapper' ).slideUp();
		}
		else{
			$( '.sticky-below-header-meta-wrapper' ).slideDown();
		}
	}

	/**
	 * Above Header meta option
	 */
	toggle_sticky_above_header_options();
	$( '#smvmt-above-header-display').click(function(){
		toggle_sticky_above_header_options();
		toggle_stick_wrapper();
	})

	function toggle_sticky_above_header_options(){
		if ( $( '#smvmt-above-header-display' ).is(':checked')) {
			$( '.sticky-above-header-meta-wrapper' ).slideUp();
		}
		else{
			$( '.sticky-above-header-meta-wrapper' ).slideDown();
		}
	}

	/**
	 * Above Header meta option
	 */
	toggle_sticky_primary_header_options();
	$( '#smvmt-main-header-display').click(function(){
		toggle_sticky_primary_header_options();
		toggle_stick_wrapper();
	})

	function toggle_sticky_primary_header_options(){
		if ( $( '#smvmt-main-header-display' ).is(':checked')) {
			$( '.stick-main-header-meta-wrapper' ).slideUp();
		}
		else{
			$( '.stick-main-header-meta-wrapper' ).slideDown();
		}
	}
	/**
	 * Header meta option disabled
	 */
	toggle_stick_wrapper();

	function toggle_stick_wrapper(){
		//Main Header & Above Header & Below Header
		 if( $('#smvmt-main-header-display').length && $('#smvmt-above-header-display').length && $('#smvmt-below-header-display').length)
		{
		     if ( $( '#smvmt-main-header-display' ).is(':checked') &&
				$( '#smvmt-above-header-display' ).is(':checked') &&
				$( '#smvmt-below-header-display' ).is(':checked'))
			{
				$( '.stick-header-wrapper' ).slideUp();
			}
			else{
				$( '.stick-header-wrapper' ).slideDown();
			}
		}
		//Main Header & Above Header
		else if( $('#smvmt-main-header-display').length && $('#smvmt-above-header-display').length)
			{
		     	if ( $( '#smvmt-main-header-display' ).is(':checked') &&
					$( '#smvmt-above-header-display' ).is(':checked'))
				{
					$( '.stick-header-wrapper' ).slideUp();
				}
				else{
					$( '.stick-header-wrapper' ).slideDown();
				}
		}
		//Main Header & Below Header
		else if( $('#smvmt-main-header-display').length && $('#smvmt-below-header-display').length)
		{
		     if ( $( '#smvmt-main-header-display' ).is(':checked') &&
				$( '#smvmt-below-header-display' ).is(':checked'))
			{
				$( '.stick-header-wrapper' ).slideUp();
			}
			else{
				$( '.stick-header-wrapper' ).slideDown();
			}
		}
		//Main Header
		else{
			if ( $( '#smvmt-main-header-display' ).is(':checked') )
			{
				$( '.stick-header-wrapper' ).slideUp();
			}
			else{
				$( '.stick-header-wrapper' ).slideDown();
			}
		}
	}

})( jQuery );
