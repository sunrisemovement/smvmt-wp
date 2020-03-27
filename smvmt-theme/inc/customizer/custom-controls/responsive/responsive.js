( function( $ ) {
	/**
	 * File responsive.js
	 *
	 * Handles the responsive
	 *
	 * @package smvmt
	 */

	wp.customize.controlConstructor['smvmt-responsive'] = wp.customize.Control.extend({

		// When we're finished loading continue processing.
		ready: function() {

			'use strict';

			var control = this,
			value;

			control.smvmtResponsiveInit();

			/**
			 * Save on change / keyup / paste
			 */
			this.container.on( 'change keyup paste', 'input.smvmt-responsive-input, select.smvmt-responsive-select', function() {

				value = jQuery( this ).val();

				// Update value on change.
				control.updateValue();
			});

			/**
			 * Refresh preview frame on blur
			 */
			this.container.on( 'blur', 'input', function() {

				value = jQuery( this ).val() || '';

				if ( value == '' ) {
					wp.customize.previewer.refresh();
				}

			});

			jQuery( '.customize-control-smvmt-responsive .input-wrapper input.' + 'desktop' + ', .customize-control .smvmt-responsive-btns > li.' + 'desktop' ).addClass( 'active' );

		},

		/**
		 * Updates the sorting list
		 */
		updateValue: function() {

			'use strict';

			var control = this,
			newValue = {};

			// Set the spacing container.
			control.responsiveContainer = control.container.find( '.smvmt-responsive-wrapper' ).first();

			control.responsiveContainer.find( 'input.smvmt-responsive-input' ).each( function() {
				var responsive_input = jQuery( this ),
				item = responsive_input.data( 'id' ),
				item_value = responsive_input.val();

				newValue[item] = item_value;

			});

			control.responsiveContainer.find( 'select.smvmt-responsive-select' ).each( function() {
				var responsive_input = jQuery( this ),
				item = responsive_input.data( 'id' ),
				item_value = responsive_input.val();

				newValue[item] = item_value;
			});

			control.setting.set( newValue );
		},

		smvmtResponsiveInit : function() {

			'use strict';
			this.container.find( '.smvmt-responsive-btns button' ).on( 'click', function( event ) {

				var device = jQuery(this).attr('data-device');
				if( 'desktop' == device ) {
					device = 'tablet';
				} else if( 'tablet' == device ) {
					device = 'mobile';
				} else {
					device = 'desktop';
				}

				jQuery( '.wp-full-overlay-footer .devices button[data-device="' + device + '"]' ).trigger( 'click' );
			});
		},
	});

	jQuery(' .wp-full-overlay-footer .devices button ').on('click', function() {

		var device = jQuery(this).attr('data-device');

		jQuery( '.customize-control-smvmt-responsive .input-wrapper input, .customize-control .smvmt-responsive-btns > li' ).removeClass( 'active' );
		jQuery( '.customize-control-smvmt-responsive .input-wrapper input.' + device + ', .customize-control .smvmt-responsive-btns > li.' + device ).addClass( 'active' );
	});
})(jQuery);
