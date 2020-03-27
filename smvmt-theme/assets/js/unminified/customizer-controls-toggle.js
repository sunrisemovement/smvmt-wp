/**
 * Customizer controls toggles
 *
 * @package smvmt
 */

( function( $ ) {

	/* Internal shorthand */
	var api = wp.customize;

	/**
	 * Trigger hooks
	 */
	ASTControlTrigger = {

	    /**
	     * Trigger a hook.
	     *
	     * @since 1.0.0
	     * @method triggerHook
	     * @param {String} hook The hook to trigger.
	     * @param {Array} args An array of args to pass to the hook.
		 */
	    triggerHook: function( hook, args )
	    {
	    	$( 'body' ).trigger( 'smvmt-control-trigger.' + hook, args );
	    },

	    /**
	     * Add a hook.
	     *
	     * @since 1.0.0
	     * @method addHook
	     * @param {String} hook The hook to add.
	     * @param {Function} callback A function to call when the hook is triggered.
	     */
	    addHook: function( hook, callback )
	    {
	    	$( 'body' ).on( 'smvmt-control-trigger.' + hook, callback );
	    },

	    /**
	     * Remove a hook.
	     *
	     * @since 1.0.0
	     * @method removeHook
	     * @param {String} hook The hook to remove.
	     * @param {Function} callback The callback function to remove.
	     */
	    removeHook: function( hook, callback )
	    {
		    $( 'body' ).off( 'smvmt-control-trigger.' + hook, callback );
	    },
	};

	/**
	 * Helper class that contains data for showing and hiding controls.
	 *
	 * @since 1.0.0
	 * @class ASTCustomizerToggles
	 */
	ASTCustomizerToggles = {

		'smvmt-settings[display-site-title]' : [],

		'smvmt-settings[display-site-tagline]' : [],

		'smvmt-settings[smvmt-header-retina-logo]' :[],

		'custom_logo' : [],

		/**
		 * Section - Header
		 *
		 * @link  ?autofocus[section]=section-header
		 */

		/**
		 * Layout 2
		 */
		// Layout 2 > Right Section > Text / HTML
		// Layout 2 > Right Section > Search Type
		// Layout 2 > Right Section > Search Type > Search Box Type.
		'smvmt-settings[header-main-rt-section]' : [],


		'smvmt-settings[hide-custom-menu-mobile]' :[],


		/**
		 * Blog
		 */
		'smvmt-settings[blog-width]' :[],

		'smvmt-settings[blog-post-structure]' :[],

		/**
		 * Blog Single
		 */
		 'smvmt-settings[blog-single-post-structure]' : [],

		'smvmt-settings[blog-single-width]' : [],

		'smvmt-settings[blog-single-meta]' :[],


		/**
		 * Small Footer
		 */
		'smvmt-settings[footer-sml-layout]' : [],

		'smvmt-settings[footer-sml-section-1]' :[],

		'smvmt-settings[footer-sml-section-2]' :[],

		'smvmt-settings[footer-sml-divider]' :[],

		'smvmt-settings[header-main-sep]' :[],

		'smvmt-settings[disable-primary-nav]' :[],

		/**
		 * Footer Widgets
		 */
		'smvmt-settings[footer-adv]' :[],

		'smvmt-settings[shop-archive-width]' :[],

		'smvmt-settings[mobile-header-logo]' :[],

		'smvmt-settings[different-mobile-logo]' :[],

	};

} )( jQuery );
