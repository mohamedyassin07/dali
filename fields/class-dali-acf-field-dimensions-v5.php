<?php
/**
 * Field class
 *
 * @package ACF_Dimensions
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! class_exists( 'DALI_ACF_Field_Dimensions' ) ) :

	/**
	 * Field class.
	 *
	 * @since 1.0.0
	 */
	class DALI_ACF_Field_Dimensions extends acf_field {

		/**
		 * Settings.
		 *
		 * @var array
		 *
		 * @since 1.0.0
		 */
		protected $settings;

		/**
		 * Constructor.
		 *
		 * @since 1.0.0
		 *
		 * @param array $settings Settings.
		 */
		public function __construct() {

			// Settings.
			$this->settings = array(
				'version' => '1.0.3',
				'url'     => plugin_dir_url( __FILE__ ),
				'path'    => plugin_dir_path( __FILE__ ),
			);

			// Name.
			$this->name = 'dali_dimensions';

			// Label.
			$this->label = esc_html__( 'Dali Dimensions', 'dali-dimensions' );

			// Category.
			$this->category = 'layout';

			// Defaults.
			$this->defaults = array(
				'return_format' => 'array',
			);

			// Internationalization.
			$this->l10n = array();

			// Units.
			$this->units = array(
				'px'  => 'px',
				'%'   => '%',
				'rem' => 'rem',
				'em'  => 'em',
			);

			

			// Call parent constructor.
			parent::__construct();
		}

		/**
		 * Render field settings.
		 *
		 * @since 1.0.0
		 *
		 * @param array $field Field details.
		 */
		public function render_field_settings( $field ) {
			acf_render_field_setting(
				$field,
				array(
					'label'        => esc_html__( 'Return Format', 'dali-dimensions' ),
					'instructions' => '',
					'type'         => 'radio',
					'name'         => 'return_format',
					'layout'       => 'horizontal',
					'choices'      => array(
						'string' => esc_html__( 'String', 'dali-dimensions' ),
						'array'  => esc_html__( 'Array', 'dali-dimensions' ),
					),
				)
			);
		}

		/**
		 * Render field.
		 *
		 * @since 1.0.0
		 *
		 * @param array $field Field details.
		 */
		public function render_field( $field ) {
			$devices = array(
				'desktop',
				'tablet',
				'mobile',
			);
			?>
			<div class="dali-dimensions">


				<div class="dali-dimensions__devices">

						<?php
						$device_classes = 'dali-dimensions__device--';
                        $device_classes .= ' dali-dimensions__device--active';
						
						?>

						<div class="dali-dimensions__device <?php echo esc_attr( $device_classes ); ?>">
							<?php
							// Values.
							$value_top    = isset( $field['value']['top'] ) ? $field['value']['top'] : '';
							$value_right  = isset( $field['value']['right'] ) ? $field['value']['right'] : '';
							$value_bottom = isset( $field['value']['bottom'] ) ? $field['value']['bottom'] : '';
							$value_left   = isset( $field['value']['left'] ) ? $field['value']['left'] : '';

							// Linked status.
							$is_linked = ( isset( $field['value']['linked'] ) && 1 !== absint( $field['value']['linked'] ) ) ? 0 : 1;

							if ( 1 === $is_linked ) {
								$value_right  = $value_top;
								$value_bottom = $value_top;
								$value_left   = $value_top;
							}
							?>

							<div class="dali-dimensions__inputs">
								<div class="dali-dimensions__texts">
									<div class="dali-dimensions__input">
										<input type="number"
											class="input-top"
											name="<?php echo esc_attr( $field['name'] ); ?>[top]"
											value="<?php echo esc_attr( $value_top ); ?>"
											/>
										<span class="input-label"><?php esc_html_e( 'Top', 'dali-dimensions' ); ?></span>
									</div><!-- .dali-dimensions__input -->
									<div class="dali-dimensions__input">
										<input type="number"
											class="input-right"
											name="<?php echo esc_attr( $field['name'] ); ?>[right]"
											value="<?php echo esc_attr( $value_right ); ?>"
											<?php echo $is_linked ? ' readonly ' : ''; ?>
											/>
											<span class="input-label"><?php esc_html_e( 'Right', 'dali-dimensions' ); ?></span>
									</div>
									<div class="dali-dimensions__input">
										<input type="number"
											class="input-bottom"
											name="<?php echo esc_attr( $field['name'] ); ?>[bottom]"
											value="<?php echo esc_attr( $value_bottom ); ?>"
											<?php echo $is_linked ? ' readonly ' : ''; ?>
											/>
										<span class="input-label"><?php esc_html_e( 'Bottom', 'dali-dimensions' ); ?></span>
									</div>
									<div class="dali-dimensions__input">
										<input type="number"
											class="input-left"
											name="<?php echo esc_attr( $field['name'] ); ?>[left]"
											value="<?php echo esc_attr( $value_left ); ?>"
											<?php echo $is_linked ? ' readonly ' : ''; ?>
											/>
										<span class="input-label"><?php esc_html_e( 'Left', 'dali-dimensions' ); ?></span>
									</div>
								</div><!-- .dali-dimensions__texts -->
								<div class="dali-dimensions__linker">
									<?php
									$button_classes = '';

									if ( 1 === $is_linked ) {
										$button_classes .= ' btn--active';
									}
									?>
									<button class="btn btn--linker <?php echo esc_attr( $button_classes ); ?>">
										<span class="linked dashicons dashicons-admin-links"></span>
										<span class="unlinked dashicons dashicons-editor-unlink"></span>
									</button>

									<input type="hidden" class="input-linked" name="<?php echo esc_attr( $field['name'] ); ?>[linked]" value="<?php echo esc_attr( $is_linked ); ?>" />
								</div><!-- .dali-dimensions__linker -->
							</div>
							<div class="dali-dimensions__unit">
								<?php
								$selected_desktop_unit = ( isset( $field['value']['unit'] ) ) ? $field['value']['unit'] : '';
								?>
								<select name="<?php echo esc_attr( $field['name'] ); ?>[unit]">
									<?php foreach ( $this->units as $item ) : ?>
										<option value="<?php echo esc_attr( $item ); ?>" <?php selected( $item, $selected_desktop_unit ); ?>><?php echo esc_html( $item ); ?></option>
									<?php endforeach; ?>
								</select>
							</div><!-- .dali-dimensions__unit -->
						</div>
				</div><!-- .dali-dimensions__devices -->

			</div><!-- .dali-dimensions -->
			<?php
		}

		/**
		 * Load assets.
		 *
		 * @since 1.0.0
		 */
		public function input_admin_enqueue_scripts() {
			$url = $this->settings['url'];
			$path = $this->settings['path'];

			$version = $this->settings['version'];

			wp_enqueue_script( 'dali-dimensions', DALI_PLUGIN_URL . "assets/js/input.js", array( 'acf-input' ), $version );
			wp_enqueue_style( 'dali-dimensions', DALI_PLUGIN_URL . "assets/css/input.css", array( 'acf-input' ), $version );
		}

		/**
		 * Get string format value.
		 *
		 * @since 1.0.0
		 *
		 * @param mixed $value The value which was loaded from the database.
		 * @param int   $post_id The $post_id from which the value was loaded.
		 * @param array $field The field array holding all the field options.
		 * @return mixed The modified value.
		 */
		public function format_value( $value, $post_id, $field ) {
			// Bail early if no value.
			if ( empty( $value ) ) {
				return $value;
			}

			if ( 'string' === $field['return_format'] ) {
				return $this->get_string_format_value( $value );
			}

			return $value;
		}

		/**
		 * Get string format value.
		 *
		 * @since 1.0.0
		 *
		 * @param array $value Value.
		 * @return array Array of CSS string based on device.
		 */
		public function get_string_format_value( $value ) {
			$output = array();

			$devices = array(
				'desktop',
				'tablet',
				'mobile',
			);

			foreach ( $devices as $item ) {
				$css = '';

				$top    = isset( $value[ $item ]['top'] ) ? $value[ $item ]['top'] : '';
				$right  = isset( $value[ $item ]['right'] ) ? $value[ $item ]['right'] : '';
				$bottom = isset( $value[ $item ]['bottom'] ) ? $value[ $item ]['bottom'] : '';
				$left   = isset( $value[ $item ]['left'] ) ? $value[ $item ]['left'] : '';
				$unit   = isset( $value[ $item ]['unit'] ) ? $value[ $item ]['unit'] : '';

				if ( '' !== $top || '' !== $right || '' !== $bottom || '' !== $left ) {
					$css .= sprintf( '%2$s%1$s %3$s%1$s %4$s%1$s %5$s%1$s', $unit, (float) $top, (float) $right, (float) $bottom, (float) $left );
				}

				$output[ $item ] = $css;
			}

			return $output;
		}
	}

	new DALI_ACF_Field_Dimensions( $this->settings );

endif;
