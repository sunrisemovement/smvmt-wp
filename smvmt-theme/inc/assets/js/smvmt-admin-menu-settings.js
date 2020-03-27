/**
 * Install Starter Templates
 *
 *
 * @since 1.2.4
 */

(function($){

	smvmtThemeAdmin = {

		init: function()
		{
			this._bind();
		},


		/**
		 * Binds events for the smvmt Theme.
		 *
		 * @since 1.0.0
		 * @access private
		 * @method _bind
		 */
		_bind: function()
		{
			$( document ).on('smvmt-after-plugin-active', smvmtThemeAdmin._disableActivcationNotice );
			$( document ).on('click' , '.smvmt-install-recommended-plugin', smvmtThemeAdmin._installNow );
			$( document ).on('click' , '.smvmt-activate-recommended-plugin', smvmtThemeAdmin._activatePlugin);
			$( document ).on('click' , '.smvmt-deactivate-recommended-plugin', smvmtThemeAdmin._deactivatePlugin);
			$( document ).on('wp-plugin-install-success' , smvmtThemeAdmin._activatePlugin);
			$( document ).on('wp-plugin-install-error'   , smvmtThemeAdmin._installError);
			$( document ).on('wp-plugin-installing'      , smvmtThemeAdmin._pluginInstalling);
		},

		/**
		 * Plugin Installation Error.
		 */
		_installError: function( event, response ) {

			var $card = jQuery( '.smvmt-install-recommended-plugin' );

			$card
				.removeClass( 'button-primary' )
				.addClass( 'disabled' )
				.html( wp.updates.l10n.installFailedShort );
		},

		/**
		 * Installing Plugin
		 */
		_pluginInstalling: function(event, args) {
			event.preventDefault();

			var slug = args.slug;

			var $card = jQuery( '.smvmt-install-recommended-plugin' );
			var activatingText = smvmt.recommendedPluiginActivatingText;


			$card.each(function( index, element ) {
				element = jQuery( element );
				if ( element.data('slug') === slug ) {
					element.addClass('updating-message');
					element.html( activatingText );
				}
			});

		},

		/**
		 * Activate Success
		 */
		_activatePlugin: function( event, response ) {

			event.preventDefault();

			var $message = jQuery(event.target);
			var $init = $message.data('init');
			var activatedSlug;

			if (typeof $init === 'undefined') {
				var $message = jQuery('.smvmt-install-recommended-plugin[data-slug=' + response.slug + ']');
				activatedSlug = response.slug;
			} else {
				activatedSlug = $init;
			}

			// Transform the 'Install' button into an 'Activate' button.
			var $init = $message.data('init');
			var activatingText = smvmt.recommendedPluiginActivatingText;
			var settingsLink = $message.data('settings-link');
			var settingsLinkText = smvmt.recommendedPluiginSettingsText;
			var deactivateText = smvmt.recommendedPluiginDeactivateText;
			var smvmtSitesLink = smvmt.smvmtSitesLink;

			$message.removeClass( 'install-now installed button-disabled updated-message' )
				.addClass('updating-message')
				.html( activatingText );

			// WordPress adds "Activate" button after waiting for 1000ms. So we will run our activation after that.
			setTimeout( function() {

				$.ajax({
					url: smvmt.ajaxUrl,
					type: 'POST',
					data: {
						'action'            : 'smvmt-sites-plugin-activate',
						'init'              : $init,
					},
				})
				.done(function (result) {

					if( result.success ) {
						var output  = '<a href="#" class="smvmt-deactivate-recommended-plugin" data-init="'+ $init +'" data-settings-link="'+ settingsLink +'" data-settings-link-text="'+ deactivateText +'" aria-label="'+ deactivateText +'">'+ deactivateText +'</a>';
							output += ( typeof settingsLink === 'string' && settingsLink != 'undefined' ) ? '<a href="' + settingsLink +'" aria-label="'+ settingsLinkText +'">' + settingsLinkText +' </a>' : '';
							output += ( typeof settingsLink === undefined && settingsLink != undefined ) ? '<a href="' + settingsLink +'" aria-label="'+ settingsLinkText +'">' + settingsLinkText +' </a>' : '';

						$message.removeClass( 'smvmt-activate-recommended-plugin smvmt-install-recommended-plugin button button-primary install-now activate-now updating-message' );

						$message.parent('.smvmt-addon-link-wrapper').parent('.smvmt-recommended-plugin').addClass('active');
						$message.parents('.smvmt-addon-link-wrapper').html( output );

						var starterSitesRedirectionUrl = smvmtSitesLink + result.data.starter_template_slug;
						jQuery(document).trigger( 'smvmt-after-plugin-active', [starterSitesRedirectionUrl, activatedSlug] );

					} else {

						$message.removeClass( 'updating-message' );
					}

				});

			}, 1200 );

		},

		/**
		 * Activate Success
		 */
		_deactivatePlugin: function( event, response ) {

			event.preventDefault();

			var $message = jQuery(event.target);

			var $init = $message.data('init');

			if (typeof $init === 'undefined') {
				var $message = jQuery('.smvmt-install-recommended-plugin[data-slug=' + response.slug + ']');
			}

			// Transform the 'Install' button into an 'Activate' button.
			var $init = $message.data('init');
			var deactivatingText = $message.data('deactivating-text') || smvmt.recommendedPluiginDeactivatingText;
			var settingsLink = $message.data('settings-link');
			var settingsLinkText = smvmt.recommendedPluiginSettingsText;
			var activateText = smvmt.recommendedPluiginActivateText;

			$message.removeClass( 'install-now installed button-disabled updated-message' )
				.addClass('updating-message')
				.html( deactivatingText );

			// WordPress adds "Activate" button after waiting for 1000ms. So we will run our activation after that.
			setTimeout( function() {

				$.ajax({
					url: smvmt.ajaxUrl,
					type: 'POST',
					data: {
						'action'            : 'smvmt-sites-plugin-deactivate',
						'init'              : $init,
					},
				})
				.done(function (result) {

					if( result.success ) {
						var output = '<a href="#" class="smvmt-activate-recommended-plugin" data-init="'+ $init +'" data-settings-link="'+ settingsLink +'" data-settings-link-text="'+ activateText +'" aria-label="'+ activateText +'">'+ activateText +'</a>';
						$message.removeClass( 'smvmt-activate-recommended-plugin smvmt-install-recommended-plugin button button-primary install-now activate-now updating-message' );

						$message.parent('.smvmt-addon-link-wrapper').parent('.smvmt-recommended-plugin').removeClass('active');

						$message.parents('.smvmt-addon-link-wrapper').html( output );

					} else {

						$message.removeClass( 'updating-message' );

					}

				});

			}, 1200 );

		},

		/**
		 * Install Now
		 */
		_installNow: function(event)
		{
			event.preventDefault();

			var $button 	= jQuery( event.target ),
				$document   = jQuery(document);

			if ( $button.hasClass( 'updating-message' ) || $button.hasClass( 'button-disabled' ) ) {
				return;
			}

			if ( wp.updates.shouldRequestFilesystemCredentials && ! wp.updates.ajaxLocked ) {
				wp.updates.requestFilesystemCredentials( event );

				$document.on( 'credential-modal-cancel', function() {
					var $message = $( '.smvmt-install-recommended-plugin.updating-message' );

					$message
						.addClass('smvmt-activate-recommended-plugin')
						.removeClass( 'updating-message smvmt-install-recommended-plugin' )
						.text( wp.updates.l10n.installNow );

					wp.a11y.speak( wp.updates.l10n.updateCancel, 'polite' );
				} );
			}

			wp.updates.installPlugin( {
				slug:    $button.data( 'slug' )
			});
		},

		/**
		 * After plugin active redirect and deactivate activation notice
		 */
		_disableActivcationNotice: function( event, smvmtSitesLink, activatedSlug )
		{
			event.preventDefault();

			if ( activatedSlug.indexOf( 'smvmt-sites' ) >= 0 || activatedSlug.indexOf( 'smvmt-pro-sites' ) >= 0 ) {
				if ( 'undefined' != typeof smvmtNotices ) {
			    	smvmtNotices._ajax( 'smvmt-sites-on-active', '' );
				}
				window.location.href = smvmtSitesLink + '&smvmt-disable-activation-notice';
			}
		},
	};

	/**
	 * Initialize smvmtThemeAdmin
	 */
	$(function(){
		smvmtThemeAdmin.init();
	});

})(jQuery);
