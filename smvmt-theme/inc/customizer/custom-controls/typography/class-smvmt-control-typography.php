<?php
/**
 * Customizer Control: typography.
 *
 * @package     smvmt
 * @author      smvmt
 * @copyright   Copyright (c) 2020, smvmt
 * @link        https://smvmt.org/
 * @since       1.0.0
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Typography control.
 */
final class SMVMT_Control_Typography extends WP_Customize_Control {

	/**
	 * Used to connect controls to each other.
	 *
	 * @since 1.0.0
	 * @var bool $connect
	 */
	public $connect = false;

	/**
	 * Option name.
	 *
	 * @since 1.0.0
	 * @var string $name
	 */
	public $name = '';

	/**
	 * Option label.
	 *
	 * @since 1.0.0
	 * @var string $label
	 */
	public $label = '';

	/**
	 * Option description.
	 *
	 * @since 1.0.0
	 * @var string $description
	 */
	public $description = '';

	/**
	 * Control type.
	 *
	 * @since 1.0.0
	 * @var string $type
	 */
	public $type = 'smvmt-font';

	/**
	 * Used to connect variant controls to each other.
	 *
	 * @since 1.5.2
	 * @var bool $variant
	 */
	public $variant = false;

	/**
	 * Used to set the mode for code controls.
	 *
	 * @since 1.0.0
	 * @var bool $mode
	 */
	public $mode = 'html';

	/**
	 * Used to set the default font options.
	 *
	 * @since 1.0.8
	 * @var string $smvmt_inherit
	 */
	public $smvmt_inherit = '';

	/**
	 * All font weights
	 *
	 * @since 1.0.8
	 * @var string $smvmt_inherit
	 */
	public $smvmt_all_font_weight = array();

	/**
	 * If true, the preview button for a control will be rendered.
	 *
	 * @since 1.0.0
	 * @var bool $preview_button
	 */
	public $preview_button = false;

	/**
	 * Set the default font options.
	 *
	 * @since 1.0.8
	 * @param WP_Customize_Manager $manager Customizer bootstrap instance.
	 * @param string               $id      Control ID.
	 * @param array                $args    Default parent's arguments.
	 */
	public function __construct( $manager, $id, $args = array() ) {
		$this->smvmt_inherit         = __( 'Inherit', 'smvmt' );
		$this->smvmt_all_font_weight = array(
			'100'       => __( 'Thin 100', 'smvmt' ),
			'100italic' => __( '100 Italic', 'smvmt' ),
			'200'       => __( 'Extra-Light 200', 'smvmt' ),
			'200italic' => __( '200 Italic', 'smvmt' ),
			'300'       => __( 'Light 300', 'smvmt' ),
			'300italic' => __( '300 Italic', 'smvmt' ),
			'400'       => __( 'Normal 400', 'smvmt' ),
			'italic'    => __( '400 Italic', 'smvmt' ),
			'500'       => __( 'Medium 500', 'smvmt' ),
			'500italic' => __( '500 Italic', 'smvmt' ),
			'600'       => __( 'Semi-Bold 600', 'smvmt' ),
			'600italic' => __( '600 Italic', 'smvmt' ),
			'700'       => __( 'Bold 700', 'smvmt' ),
			'700italic' => __( '700 Italic', 'smvmt' ),
			'800'       => __( 'Extra-Bold 800', 'smvmt' ),
			'800italic' => __( '800 Italic', 'smvmt' ),
			'900'       => __( 'Ultra-Bold 900', 'smvmt' ),
			'900italic' => __( '900 Italic', 'smvmt' ),
		);
		parent::__construct( $manager, $id, $args );
	}

	/**
	 * Renders the content for a control based on the type
	 * of control specified when this class is initialized.
	 *
	 * @since 1.0.0
	 * @access protected
	 * @return void
	 */
	protected function render_content() {

		switch ( $this->type ) {

			case 'smvmt-font-family':
				$this->render_font( $this->smvmt_inherit );
				break;

			case 'smvmt-font-variant':
				$this->render_font_variant( $this->smvmt_inherit );
				break;

			case 'smvmt-font-weight':
				$this->render_font_weight( $this->smvmt_inherit );
				break;
		}
	}

	/**
	 * Enqueue control related scripts/styles.
	 *
	 * @access public
	 */
	public function enqueue() {

		$js_uri  = SMVMT_THEME_URI . 'inc/customizer/custom-controls/typography/';
		$css_uri = SMVMT_THEME_URI . 'inc/customizer/custom-controls/typography/';
		$js_uri  = SMVMT_THEME_URI . 'inc/customizer/custom-controls/typography/';
		wp_enqueue_style( 'smvmt-select-woo-style', $css_uri . 'selectWoo.css', null, SMVMT_THEME_VERSION );
		wp_enqueue_script( 'smvmt-select-woo-script', $js_uri . 'selectWoo.js', array( 'jquery' ), SMVMT_THEME_VERSION, true );

		wp_enqueue_script( 'smvmt-typography', $js_uri . 'typography.js', array( 'jquery', 'customize-base' ), SMVMT_THEME_VERSION, true );
		$SMVMT_typo_localize = $this->smvmt_all_font_weight;

		wp_localize_script( 'smvmt-typography', 'smvmtTypo', $SMVMT_typo_localize );
	}
	/**
	 * Renders the title and description for a control.
	 *
	 * @since 1.0.0
	 * @access protected
	 * @return void
	 */
	protected function render_content_title() {
		if ( ! empty( $this->label ) ) {
			echo '<span class="customize-control-title">' . esc_html( $this->label ) . '</span>';
		}
		if ( ! empty( $this->description ) ) {
			echo '<span class="description customize-control-description">' . esc_html( $this->description ) . '</span>';
		}
	}

	/**
	 * Renders the connect attribute for a connected control.
	 *
	 * @since 1.0.0
	 * @access protected
	 * @return void
	 */
	protected function render_connect_attribute() {
		if ( $this->connect ) {
			echo ' data-connected-control="' . esc_attr( $this->connect ) . '"';
			echo ' data-inherit="' . esc_attr( $this->smvmt_inherit ) . '"';
		}
		if ( $this->variant ) {
			echo ' data-connected-variant="' . esc_attr( $this->variant ) . '"';
			echo ' data-inherit="' . esc_attr( $this->smvmt_inherit ) . '"';
		}

		echo ' data-value="' . esc_attr( $this->value() ) . '"';
		echo ' data-name="' . esc_attr( $this->name ) . '"';
	}

	/**
	 * Renders a font control.
	 *
	 * @since 1.0.16 Added the action 'SMVMT_customizer_font_list' to support custom fonts.
	 * @since 1.0.0
	 * @param  string $default Inherit/Default.
	 * @access protected
	 * @return void
	 */
	protected function render_font( $default ) {
		echo '<label>';
		$this->render_content_title();
		echo '</label>';
		echo '<select ';
		$this->link();
		$this->render_connect_attribute();
		echo '>';

		echo '</select>';
	}

	/**
	 * Renders a font weight control.
	 *
	 * @since 1.0.0
	 * @param  string $default Inherit/Default.
	 * @access protected
	 * @return void
	 */
	protected function render_font_weight( $default ) {
		echo '<label>';
		$this->render_content_title();
		echo '</label>';
		echo '<select ';
		$this->link();
		$this->render_connect_attribute();
		echo '>';
		if ( 'normal' == $this->value() ) {
			echo '<option value="normal" ' . selected( 'normal', $this->value(), false ) . '>' . esc_attr( $default ) . '</option>';
		} else {
			echo '<option value="inherit" ' . selected( 'inherit', $this->value(), false ) . '>' . esc_attr( $default ) . '</option>';
		}
		$selected       = '';
		$selected_value = $this->value();
		$all_fonts      = $this->smvmt_all_font_weight;

		foreach ( $all_fonts as $key => $value ) {
			if ( $key == $selected_value ) {
				$selected = ' selected = "selected" ';
			} else {
				$selected = '';
			}
			// Exclude all italic values.
			if ( strpos( $key, 'italic' ) === false ) {
				echo '<option value="' . esc_attr( $key ) . '"' . esc_attr( $selected ) . '>' . esc_attr( $value ) . '</option>';
			}
		}
		echo '</select>';
	}

	/**
	 * Renders a font variant control.
	 *
	 * @since 1.5.2
	 * @param  string $default Inherit/Default.
	 * @access protected
	 * @return void
	 */
	protected function render_font_variant( $default ) {
		echo '<label>';
		$this->render_content_title();
		echo '</label>';
		echo '<select ';
		$this->link();
		$this->render_connect_attribute();
		echo ' multiple >';
		$values = explode( ',', $this->value() );
		foreach ( $values as $key => $value ) {
			echo '<option value="' . esc_attr( $value ) . '" selected="selected" >' . esc_html( $value ) . '</option>';
		}
		echo '<input class="smvmt-font-variant-hidden-value" type="hidden" value="' . esc_attr( $this->value() ) . '">';
		echo '</select>';
		echo '<span class="smvmt-control-tooltip dashicons dashicons-editor-help smvmt-variant-description" title="Only selected Font Variants will be loaded from Google Fonts."></span>';
	}

	/**
	 * Refresh the parameters passed to the JavaScript via JSON.
	 *
	 * @see WP_Customize_Control::to_json()
	 */
	public function to_json() {
		parent::to_json();

		$this->json['label']       = esc_html( $this->label );
		$this->json['description'] = $this->description;
		$this->json['name']        = $this->name;
		$this->json['value']       = $this->value();
	}

	/**
	 * An Underscore (JS) template for this control's content (but not its container).
	 *
	 * Class variables for this control class are available in the `data` JS object;
	 * export custom variables by overriding {@see WP_Customize_Control::to_json()}.
	 *
	 * @see WP_Customize_Control::print_template()
	 *
	 * @access protected
	 */
	protected function content_template() {

		?>

		<label>
		<# if ( data.label ) { #>
			<span class="customize-control-title">{{{data.label}}}</span>
		<# } #>

		</label>
		<select data-inherit="<?php echo esc_attr( $this->smvmt_inherit ); ?>" <?php $this->link(); ?> class={{ data.font_type }} data-name={{ data.name }}
		data-value="{{data.value}}"

		<# if ( data.connect ) { #>
			data-connected-control={{ data.connect }}
		<# } #>
		<# if ( data.variant ) { #>
			data-connected-variant="{{data.variant}}";
		<# } #>

		>
		</select>

		<?php
	}
}
