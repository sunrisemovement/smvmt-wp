<?php
/**
 * Site Layouts - Dynamic CSS
 *
 * @package smvmt
 */

add_filter( 'smvmt_dynamic_css', 'smvmt_ext_site_layouts_dynamic_css' );

/**
 * Dynamic CSS
 *
 * @param  string $dynamic_css          Astra Dynamic CSS.
 * @param  string $dynamic_css_filtered Astra Dynamic CSS Filters.
 * @return string
 */
function smvmt_ext_site_layouts_dynamic_css( $dynamic_css, $dynamic_css_filtered = '' ) {

	/**
	 * - Variable Declaration
	 */
	$page_width            = '100%';
	$parse_css             = '';
	$header_break_point    = smvmt_header_break_point(); // Header Break Point.
	$secondary_width       = smvmt_get_option( 'site-sidebar-width' );
	$primary_width         = 100 - $secondary_width;
	$layout                = smvmt_get_option( 'site-layout', 'smvmt-full-width-layout' );
	$site_container_layout = smvmt_get_option( 'site-content-layout' );
	$single_post_max       = smvmt_get_option( 'blog-single-width' );
	$single_post_max_width = smvmt_get_option( 'blog-single-max-width' );
	$blog_width            = smvmt_get_option( 'blog-width' );
	$blog_max_width        = smvmt_get_option( 'blog-max-width' );

	$woo_shop_archive_width     = smvmt_get_option( 'shop-archive-width' );
	$woo_shop_archive_max_width = smvmt_get_option( 'shop-archive-max-width' );

	// set page width depending on site layout.
	if ( 'smvmt-box-layout' == $layout ) {
		$page_width = smvmt_get_option( 'site-layout-box-width' ) . 'px';
	} elseif ( 'smvmt-full-width-layout' == $layout ) {
		$page_width = SMVMT_THEME_CONTAINER_PADDING_TWICE + smvmt_get_option( 'site-content-width' ) . 'px';
	} elseif ( 'smvmt-padded-layout' == $layout ) {
		if ( '' != smvmt_get_option( 'site-layout-padded-width' ) ) {
			$page_width = SMVMT_THEME_CONTAINER_BOX_PADDED_PADDING_TWICE + smvmt_get_option( 'site-layout-padded-width' ) . 'px';
		}
	}

	// Fluid layout padding.
	$fluid_layout_padding = smvmt_get_option( 'site-layout-fluid-lr-padding' );

	// Box Layout - Top & Bottom Margin.
	$box_topbottom_margin = smvmt_get_option( 'site-layout-box-tb-margin' );

	// Box Layout - Background Color / Image.
	$box_bg_color = smvmt_get_option( 'site-layout-outside-bg-color' );

	// Padded Layout - Padding.
	$padded_layout_padding = smvmt_get_option( 'site-layout-padded-pad' );

	$body_font_weight = smvmt_get_option( 'body-font-weight' );

	if ( 'smvmt-box-layout' == $layout || 'smvmt-padded-layout' == $layout ) {
		$blog_max_width        += SMVMT_THEME_CONTAINER_BOX_PADDED_PADDING_TWICE;
		$single_post_max_width += SMVMT_THEME_CONTAINER_BOX_PADDED_PADDING_TWICE;
	} else {
		$blog_max_width        += SMVMT_THEME_CONTAINER_PADDING_TWICE;
		$single_post_max_width += SMVMT_THEME_CONTAINER_PADDING_TWICE;
	}

	/* Global Responsive */
	$global_responsive_media = array(
		'.smvmt-container' => array(
			'max-width' => esc_attr( $page_width ),
		),
	);

	/* Parse CSS from array()*/
	$parse_css .= smvmt_parse_css( $global_responsive_media, '769' );
	$parse_css .= smvmt_parse_css( $global_responsive_media, '993' );
	$parse_css .= smvmt_parse_css( $global_responsive_media, '1201' );

	if ( 'default' == $woo_shop_archive_width ) {

		if ( 'page-builder' !== smvmt_get_content_layout() ) {
			/* Global Responsive for default woocommerce shop archive page */
			$woo_shop_archive_responsive_media = array(
				'.smvmt-woo-shop-archive .site-content > .smvmt-container' => array(
					'max-width' => esc_attr( $page_width ),
				),
			);

			/* Parse CSS from array()*/
			$parse_css .= smvmt_parse_css( $woo_shop_archive_responsive_media, '769' );
			$parse_css .= smvmt_parse_css( $woo_shop_archive_responsive_media, '993' );
			$parse_css .= smvmt_parse_css( $woo_shop_archive_responsive_media, '1201' );
		}
	}

	/* Fluid Width Layout CSS */
	if ( 'smvmt-fluid-width-layout' == $layout ) :
		$fw_layout          = '@media (min-width:769px) {';
			$fw_layout     .= '.smvmt-container {';
				$fw_layout .= 'padding-left:' . esc_attr( $fluid_layout_padding ) . 'px;';
				$fw_layout .= 'padding-right:' . esc_attr( $fluid_layout_padding ) . 'px;';
			$fw_layout     .= '}';
		$fw_layout         .= '}';
		$parse_css         .= $fw_layout;

		if ( 'default' === $woo_shop_archive_width ) :
			$woo_shop_archive_padding_css  = '@media (min-width:921px) {';
			$woo_shop_archive_padding_css .= 'body.smvmt-woo-shop-archive .site-content > .smvmt-container{';
			$woo_shop_archive_padding_css .= 'padding-left:' . esc_attr( $fluid_layout_padding ) . 'px;';
			$woo_shop_archive_padding_css .= 'padding-right:' . esc_attr( $fluid_layout_padding ) . 'px;';
			$woo_shop_archive_padding_css .= '}';
			$woo_shop_archive_padding_css .= '}';
			$parse_css                    .= $woo_shop_archive_padding_css;
		endif;

	endif;

	/* Box Layout CSS */
	if ( 'smvmt-box-layout' == $layout ) :
		$box_layout = array(
			'#page' => array(
				'max-width'    => $page_width,
				'margin-left'  => 'auto',
				'margin-right' => 'auto',
			),
		);

		/* Parse CSS from array()*/
		$parse_css .= smvmt_parse_css( $box_layout );

		$bx_layout          = '@media (min-width:769px) {';
			$bx_layout     .= '#page{';
				$bx_layout .= 'margin-top:' . esc_attr( $box_topbottom_margin ) . 'px;';
				$bx_layout .= 'margin-bottom:' . esc_attr( $box_topbottom_margin ) . 'px;';
			$bx_layout     .= '}';
			$bx_layout     .= ' .smvmt-container{';
				$bx_layout .= 'padding-left: ' . SMVMT_THEME_CONTAINER_BOX_PADDED_PADDING . 'px;';
				$bx_layout .= 'padding-right: ' . SMVMT_THEME_CONTAINER_BOX_PADDED_PADDING . 'px;';
			$bx_layout     .= '}';
		$bx_layout         .= '}';
		$parse_css         .= $bx_layout;
	endif;

	/* Padded Layout CSS */
	if ( 'smvmt-padded-layout' == $layout ) :
		$padded_layout = array(
			'body' => array(
				'background' => $box_bg_color,
			),
		);

		/* Parse CSS from array()*/
		$parse_css .= smvmt_parse_css( $padded_layout );

		/**
		 * Padded layout Desktop Spacing
		 */
		$padded_layout_spacing = array(
			'body'                           => array(
				'padding-top'    => smvmt_responsive_spacing( $padded_layout_padding, 'top', 'desktop' ),
				'padding-right'  => smvmt_responsive_spacing( $padded_layout_padding, 'right', 'desktop' ),
				'padding-bottom' => smvmt_responsive_spacing( $padded_layout_padding, 'bottom', 'desktop' ),
				'padding-left'   => smvmt_responsive_spacing( $padded_layout_padding, 'left', 'desktop' ),
			),
			'body.smvmt-padded-layout::before' => array(
				'padding-top' => smvmt_responsive_spacing( $padded_layout_padding, 'top', 'desktop' ),
			),
			'body.smvmt-padded-layout::after'  => array(
				'padding-bottom' => smvmt_responsive_spacing( $padded_layout_padding, 'bottom', 'desktop' ),
			),
		);

		$parse_css .= smvmt_parse_css( $padded_layout_spacing );

		/**
		 * Padded layout Tablet Spacing
		 */
		$tablet_padded_layout_spacing = array(
			'body'                           => array(
				'padding-top'    => smvmt_responsive_spacing( $padded_layout_padding, 'top', 'tablet' ),
				'padding-right'  => smvmt_responsive_spacing( $padded_layout_padding, 'right', 'tablet' ),
				'padding-bottom' => smvmt_responsive_spacing( $padded_layout_padding, 'bottom', 'tablet' ),
				'padding-left'   => smvmt_responsive_spacing( $padded_layout_padding, 'left', 'tablet' ),

			),
			'body.smvmt-padded-layout::before' => array(
				'padding-top' => smvmt_responsive_spacing( $padded_layout_padding, 'top', 'tablet' ),
			),
			'body.smvmt-padded-layout::after'  => array(
				'padding-bottom' => smvmt_responsive_spacing( $padded_layout_padding, 'bottom', 'tablet' ),
			),
		);

		/**
		 * Padded layout Mobile Spacing
		 */
		$mobile_padded_layout_spacing = array(
			'body'                           => array(
				'padding-top'    => smvmt_responsive_spacing( $padded_layout_padding, 'top', 'mobile' ),
				'padding-right'  => smvmt_responsive_spacing( $padded_layout_padding, 'right', 'mobile' ),
				'padding-bottom' => smvmt_responsive_spacing( $padded_layout_padding, 'bottom', 'mobile' ),
				'padding-left'   => smvmt_responsive_spacing( $padded_layout_padding, 'left', 'mobile' ),
			),
			'body.smvmt-padded-layout::before' => array(
				'padding-top' => smvmt_responsive_spacing( $padded_layout_padding, 'top', 'mobile' ),
			),
			'body.smvmt-padded-layout::after'  => array(
				'padding-bottom' => smvmt_responsive_spacing( $padded_layout_padding, 'bottom', 'mobile' ),
			),
		);

		/**
		 * Padded layout Container Spacing
		 */
		$padded_width = smvmt_get_option( 'site-layout-padded-width' );
		if ( ! empty( $padded_width ) ) {
			$padded_layout_spacing_container = array(
				'.smvmt-container' => array(
					'padding-left'  => SMVMT_THEME_CONTAINER_BOX_PADDED_PADDING . 'px',
					'padding-right' => SMVMT_THEME_CONTAINER_BOX_PADDED_PADDING . 'px',
				),
			);
		} else {
			$padded_layout_spacing_container = array(
				'.site-content > .smvmt-container' => array(
					'padding-left'  => 0,
					'padding-right' => 0,
				),
			);
		}
		// Add Container padding only for desktop devices.
		$parse_css .= smvmt_parse_css( $padded_layout_spacing_container, '769' );

		$parse_css .= smvmt_parse_css( $padded_layout_spacing );
		$parse_css .= smvmt_parse_css( $tablet_padded_layout_spacing, '', '768' );
		$parse_css .= smvmt_parse_css( $mobile_padded_layout_spacing, '', '544' );

	endif;

	/* Blog */
	if ( 'smvmt-fluid-width-layout' == $layout ) :
		if ( 'custom' === $blog_width ) :
			$blog_css   = '@media (min-width:921px) {';
			$blog_css  .= '.blog .site-content > .smvmt-container, .archive .site-content > .smvmt-container, .search .site-content > .smvmt-container{';
			$blog_css  .= 'padding-left:' . SMVMT_THEME_CONTAINER_PADDING . 'px;';
			$blog_css  .= 'padding-right:' . SMVMT_THEME_CONTAINER_PADDING . 'px;';
			$blog_css  .= '}';
			$blog_css  .= '}';
			$parse_css .= $blog_css;
		endif;
		if ( 'custom' === $woo_shop_archive_width ) :
			$woo_shop_archive_css  = '@media (min-width:921px) {';
			$woo_shop_archive_css .= '.smvmt-woo-shop-archive .site-content > .smvmt-container{';
			$woo_shop_archive_css .= 'padding-left:' . SMVMT_THEME_CONTAINER_PADDING . 'px;';
			$woo_shop_archive_css .= 'padding-right:' . SMVMT_THEME_CONTAINER_PADDING . 'px;';
			$woo_shop_archive_css .= '}';
			$woo_shop_archive_css .= '}';
			$parse_css            .= $woo_shop_archive_css;
		endif;
	endif;

	/* Single Blog */
	if ( 'smvmt-fluid-width-layout' == $layout ) :
		if ( 'custom' === $single_post_max ) :
			$single_blog_css  = '@media (min-width:921px) {';
			$single_blog_css .= '.single .site-content > .smvmt-container{';
			$single_blog_css .= 'padding-left:' . SMVMT_THEME_CONTAINER_PADDING . 'px;';
			$single_blog_css .= 'padding-right:' . SMVMT_THEME_CONTAINER_PADDING . 'px;';
			$single_blog_css .= '}';
			$single_blog_css .= '}';
			$parse_css       .= $single_blog_css;
		endif;
	endif;

	return $dynamic_css . $parse_css;

}
