<?php
namespace Elementor;
if ( ! defined( 'ABSPATH' ) ) exit;

/**
 * Widget Name: Google Review Badge
 */
class xConnect_Google_Review_Badge extends Widget_Base{

	public function get_name() {
		return 'google-review-badge';
	}

	public function get_title() {
		return __( 'XP Google Review Badge', 'xconnect' );
	}

	public function get_icon() {
		return 'eicon-star';
	}

	public function get_categories() {
		return [ 'category_xconnect' ];
	}

	public static function get_badge_styles() {
		return [
			'inline' => __( 'Inline Style', 'xconnect' ),
			'boxed'  => __( 'Boxed Style', 'xconnect' ),
		];
	}

	public static function get_subtitle_style() {
		return [
			'' 				=> __( 'Default', 'xconnect' ),
			'is_highlight' 	=> __( 'Highlight', 'xconnect' ),
			'is_line' 		=> __( 'Line', 'xconnect' ),
		];
	}

	protected function register_controls() {

		// Content Section
		$this->start_controls_section(
			'content_section',
			[
				'label' => __( 'Content', 'xconnect' ),
			]
		);

		$this->add_control(
			'badge_style',
			[
				'label' => __( 'Badge Style', 'xconnect' ),
				'type' => Controls_Manager::SELECT,
				'default' => 'inline',
				'options' => self::get_badge_styles(),
			]
		);

		$this->add_control(
			'show_heading',
			[
				'label' => __( 'Show Heading', 'xconnect' ),
				'type' => Controls_Manager::SWITCHER,
				'label_on' => __( 'Yes', 'xconnect' ),
				'label_off' => __( 'No', 'xconnect' ),
				'return_value' => 'yes',
				'default' => 'no',
			]
		);

		$this->add_control(
			'sub',
			[
				'label' => __( 'Subtitle', 'xconnect' ),
				'type' => Controls_Manager::TEXT,
				'dynamic' => [
					'active' => true,
				],
				'default' => __( 'Our Reviews', 'xconnect' ),
				'placeholder' => __( 'Enter your subtitle', 'xconnect' ),
				'label_block' => true,
				'condition' => [
					'show_heading' => 'yes',
				],
			]
		);

		$this->add_control(
			'title',
			[
				'label' => __( 'Title', 'xconnect' ),
				'type' => Controls_Manager::TEXT,
				'dynamic' => [
					'active' => true,
				],
				'default' => __( 'What Our Clients Say', 'xconnect' ),
				'placeholder' => __( 'Enter your title', 'xconnect' ),
				'label_block' => true,
				'condition' => [
					'show_heading' => 'yes',
				],
			]
		);

		$this->add_control(
			'header_size',
			[
				'label' => __( 'Title HTML Tag', 'xconnect' ),
				'type' => Controls_Manager::SELECT,
				'options' => [
					'h1' => 'H1',
					'h2' => 'H2',
					'h3' => 'H3',
					'h4' => 'H4',
					'h5' => 'H5',
					'h6' => 'H6',
					'div' => 'div',
					'span' => 'span',
					'p' => 'p',
				],
				'default' => 'h2',
				'condition' => [
					'show_heading' => 'yes',
				],
			]
		);

		$this->add_control(
			'google_logo',
			[
				'label' => __( 'Google Logo URL', 'xconnect' ),
				'type' => Controls_Manager::MEDIA,
				'default' => [
					'url' => 'https://dpsample.com/wp_themes/xconnect/wp-content/uploads/2025/12/google-logo.svg',
				],
				'separator' => 'before',
			]
		);

		$this->add_control(
			'rating',
			[
				'label' => __( 'Rating', 'xconnect' ),
				'type' => Controls_Manager::NUMBER,
				'default' => 5.0,
				'min' => 0,
				'max' => 5,
				'step' => 0.1,
			]
		);

		$this->add_control(
			'review_count',
			[
				'label' => __( 'Review Count', 'xconnect' ),
				'type' => Controls_Manager::NUMBER,
				'default' => 200,
				'condition' => [
					'badge_style' => 'boxed',
				],
			]
		);

		$this->add_control(
			'review_text',
			[
				'label' => __( 'Review Text', 'xconnect' ),
				'type' => Controls_Manager::TEXT,
				'default' => __( 'Google Reviews', 'xconnect' ),
				'condition' => [
					'badge_style' => 'inline',
				],
			]
		);

		$this->add_responsive_control(
			'align',
			[
				'label' => __( 'Alignment', 'xconnect' ),
				'type' => Controls_Manager::CHOOSE,
				'options' => [
					'left'    => [
						'title' => __( 'Left', 'xconnect' ),
						'icon' => 'eicon-text-align-left',
					],
					'center' => [
						'title' => __( 'Center', 'xconnect' ),
						'icon' => 'eicon-text-align-center',
					],
					'right' => [
						'title' => __( 'Right', 'xconnect' ),
						'icon' => 'eicon-text-align-right',
					],
				],
				'selectors' => [
					'{{WRAPPER}}' => 'text-align: {{VALUE}};',
				],
				'default' => 'left',
			]
		);

		$this->end_controls_section();

		// Heading Style Section
		$this->start_controls_section(
			'heading_style_section',
			[
				'label' => __( 'Heading', 'xconnect' ),
				'tab'   => Controls_Manager::TAB_STYLE,
				'condition' => [
					'show_heading' => 'yes',
				],
			]
		);

		$this->add_control(
			'heading_stitle',
			[
				'label' => __( 'Subtitle', 'xconnect' ),
				'type' => Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);

		$this->add_control(
			'subtitle_style',
			[
				'label' => __( 'Subtitle Style', 'xconnect' ),
				'type' => Controls_Manager::SELECT,
				'default' => '',
				'options' => self::get_subtitle_style(),
			]
		);

		$this->add_responsive_control(
			'line_width',
			[
				'label' => __( 'Width', 'xconnect' ),
				'type' => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'min' => 20,
						'max' => 100,
					],
				],
				'default' => [
					'unit' => 'px',
					'size' => 45,
				],
				'selectors' => [
					'{{WRAPPER}} .xp-heading > span.is_line:before' => 'width: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .xp-heading > span.is_line' => 'padding-left: calc({{SIZE}}{{UNIT}} + 15px);',
				],
				'condition'	=> [
					'subtitle_style' => 'is_line'
				]
			]
		);

		$this->add_control(
			'stitle_color',
			[
				'label' => __( 'Color', 'xconnect' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .xp-heading > span' => 'color: {{VALUE}}; border-color: {{VALUE}};',
					'{{WRAPPER}} .xp-heading > span.is_line:before' => 'background: {{VALUE}};',
				]
			]
		);

		$this->add_control(
			'stitle_bg',
			[
				'label' => __( 'Background Color', 'xconnect' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .xp-heading > span' => 'background: {{VALUE}};',
				],
				'condition'	=> [
					'subtitle_style' => 'is_highlight'
				]
			]
		);

		$this->add_control(
			'stitle_border',
			[
				'label' => __( 'Border Color', 'xconnect' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .xp-heading > span' => 'border-color: {{VALUE}};',
				],
				'condition'	=> [
					'subtitle_style' => 'is_highlight'
				]
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'stitle_typography',
				'selector' => '{{WRAPPER}} .xp-heading > span',
			]
		);

		$this->add_responsive_control(
			'stitle_bottom_space',
			[
				'label' => __( 'Spacing', 'xconnect' ),
				'type' => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .xp-heading > span' => 'margin-bottom: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			'heading_title',
			[
				'label' => __( 'Title', 'xconnect' ),
				'type' => Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);

		$this->add_control(
			'title_color',
			[
				'label' => __( 'Color', 'xconnect' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .xp-heading .main-head' => 'color: {{VALUE}};',
				]
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'title_typography',
				'selector' => '{{WRAPPER}} .xp-heading .main-head',
			]
		);

		$this->add_responsive_control(
			'title_bottom_space',
			[
				'label' => __( 'Spacing', 'xconnect' ),
				'type' => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'default' => [
					'unit' => 'px',
					'size' => 20,
				],
				'selectors' => [
					'{{WRAPPER}} .xp-heading' => 'margin-bottom: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_section();

		// Badge Style Section
		$this->start_controls_section(
			'badge_style_section',
			[
				'label' => __( 'Badge', 'xconnect' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_responsive_control(
			'logo_size',
			[
				'label' => __( 'Logo Size', 'xconnect' ),
				'type' => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'min' => 20,
						'max' => 100,
					],
				],
				'default' => [
					'unit' => 'px',
					'size' => 36,
				],
				'selectors' => [
					'{{WRAPPER}} .google-review-badge img' => 'width: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'badge_gap',
			[
				'label' => __( 'Gap Between Elements', 'xconnect' ),
				'type' => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 50,
					],
				],
				'default' => [
					'unit' => 'px',
					'size' => 10,
				],
				'selectors' => [
					'{{WRAPPER}} .google-review-inline' => 'gap: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .google-review-boxed' => 'gap: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			'rating_heading',
			[
				'label' => __( 'Rating Number', 'xconnect' ),
				'type' => Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);

		$this->add_control(
			'rating_color',
			[
				'label' => __( 'Color', 'xconnect' ),
				'type' => Controls_Manager::COLOR,
				'default' => '#000',
				'selectors' => [
					'{{WRAPPER}} .google-review-badge .rating' => 'color: {{VALUE}};',
				]
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'rating_typography',
				'selector' => '{{WRAPPER}} .google-review-badge .rating',
			]
		);

		$this->add_control(
			'stars_heading',
			[
				'label' => __( 'Stars', 'xconnect' ),
				'type' => Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);

		$this->add_control(
			'stars_color',
			[
				'label' => __( 'Color', 'xconnect' ),
				'type' => Controls_Manager::COLOR,
				'default' => '#fbbc04',
				'selectors' => [
					'{{WRAPPER}} .google-review-inline .stars' => 'color: {{VALUE}};',
					'{{WRAPPER}} .google-review-boxed .stars' => 'color: {{VALUE}};',
				]
			]
		);

		$this->add_responsive_control(
			'stars_size',
			[
				'label' => __( 'Size', 'xconnect' ),
				'type' => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'min' => 10,
						'max' => 40,
					],
				],
				'default' => [
					'unit' => 'px',
					'size' => 14,
				],
				'selectors' => [
					'{{WRAPPER}} .google-review-badge .stars' => 'font-size: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			'text_heading',
			[
				'label' => __( 'Review Text/Count', 'xconnect' ),
				'type' => Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);

		$this->add_control(
			'text_color',
			[
				'label' => __( 'Color', 'xconnect' ),
				'type' => Controls_Manager::COLOR,
				'default' => '#222',
				'selectors' => [
					'{{WRAPPER}} .google-review-badge .text' => 'color: {{VALUE}};',
					'{{WRAPPER}} .google-review-badge .meta' => 'color: {{VALUE}};',
				]
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'text_typography',
				'selector' => '{{WRAPPER}} .google-review-badge .text, {{WRAPPER}} .google-review-badge .meta',
			]
		);

		$this->add_control(
			'badge_background_heading',
			[
				'label' => __( 'Badge Background', 'xconnect' ),
				'type' => Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);

		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name' => 'badge_background',
				'types' => [ 'classic', 'gradient' ],
				'selector' => '{{WRAPPER}} .google-review-badge',
			]
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' => 'badge_border',
				'selector' => '{{WRAPPER}} .google-review-badge',
			]
		);

		$this->add_responsive_control(
			'badge_border_radius',
			[
				'label' => __( 'Border Radius', 'xconnect' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%' ],
				'selectors' => [
					'{{WRAPPER}} .google-review-badge' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'badge_box_shadow',
				'selector' => '{{WRAPPER}} .google-review-badge',
			]
		);

		$this->add_responsive_control(
			'badge_padding',
			[
				'label' => __( 'Padding', 'xconnect' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors' => [
					'{{WRAPPER}} .google-review-badge' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_section();
	}

	protected function render() {
		$settings = $this->get_settings_for_display();
		
		$rating = floatval( $settings['rating'] );
		$full_stars = floor( $rating );
		$half_star = ( $rating - $full_stars ) >= 0.5 ? 1 : 0;
		$empty_stars = 5 - $full_stars - $half_star;
		
		$stars_html = str_repeat( '★', $full_stars );
		if ( $half_star ) {
			$stars_html .= '★';
		}
		$stars_html .= str_repeat( '☆', $empty_stars );

		?>
		<div class="xp-google-review-wrapper">
			<?php if ( $settings['show_heading'] === 'yes' ) : ?>
				<div class="xp-heading">
					<?php if ( ! empty( $settings['sub'] ) ) : 
						$hl = $settings['subtitle_style'];
						$this->add_render_attribute( 'subtitle', 'class', $hl );
					?>
						<span <?php echo wp_kses_post( $this->get_render_attribute_string( 'subtitle' ) ); ?>>
							<?php echo esc_html( $settings['sub'] ); ?>
						</span>
					<?php endif; ?>
					
					<?php if ( ! empty( $settings['title'] ) ) : 
						$this->add_render_attribute( 'heading', 'class', 'main-head' );
						$title_html = sprintf( '<%1$s %2$s>%3$s</%1$s>', $settings['header_size'], $this->get_render_attribute_string( 'heading' ), esc_html( $settings['title'] ) );
						echo wp_kses_post( $title_html );
					endif; ?>
				</div>
			<?php endif; ?>

			<?php if ( $settings['badge_style'] === 'inline' ) : ?>
				<div class="google-review-badge google-review-inline">
					<?php if ( ! empty( $settings['google_logo']['url'] ) ) : ?>
						<img src="<?php echo esc_url( $settings['google_logo']['url'] ); ?>" alt="Google">
					<?php endif; ?>
					<div class="flexieitem">
						<div class="flex_ittmm">
							<div class="rating"><?php echo number_format( $rating, 1 ); ?></div>
							<div class="stars"><?php echo wp_kses_post( $stars_html ); ?></div>
						</div>
						<div class="text"><?php echo esc_html( $settings['review_text'] ); ?></div>
					</div>
				</div>
			<?php else : ?>
				<div class="google-review-badge google-review-boxed">
					<?php if ( ! empty( $settings['google_logo']['url'] ) ) : ?>
						<img src="<?php echo esc_url( $settings['google_logo']['url'] ); ?>" alt="Google">
					<?php endif; ?>
					<div class="rating"><?php echo number_format( $rating, 1 ); ?></div>
					<div>
						<div class="stars"><?php echo wp_kses_post( $stars_html ); ?></div>
						<div class="meta"><?php echo absint( $settings['review_count'] ); ?> reviews</div>
					</div>
				</div>
			<?php endif; ?>
		</div>

		<style>
		.xp-google-review-wrapper {
			  align-items: center;
			  display: flex;
			}
		.xp-google-review-wrapper .google-review-inline {
			display: inline-flex;
			align-items: center;
			gap: 10px;
		}
		.xp-google-review-wrapper .google-review-inline .flex_ittmm {
			display: inline-flex;
			align-items: center;
			gap: 5px;
		}
		.xp-google-review-wrapper .google-review-inline .rating {
			font-weight: 700;
			line-height: 1;
		}
		.xp-google-review-wrapper .google-review-inline .stars {
			line-height: 1;
		}
		.xp-google-review-wrapper .google-review-inline .text {
		  line-height: 1;
		  opacity: 0.85;
		}
		.xp-google-review-wrapper .google-review-inline .flexieitem {
		  display: flex;
  		  flex-flow: column;
		  gap: 4px;
		}
		.xp-google-review-wrapper .google-review-boxed {
			display: inline-flex;
			align-items: center;
		}
		.xp-google-review-wrapper .google-review-boxed .rating {
			font-weight: 700;
			line-height: 1;
			font-size: 44px;
		}
		.xp-google-review-wrapper .google-review-boxed .stars {
			margin-bottom: 4px;
			line-height: 1;
		}
		.xp-google-review-wrapper .google-review-boxed .meta {
			opacity: 0.85;
			line-height: 1;
		}
		</style>
		<?php
	}

	protected function content_template() {
		?>
		<#
		var rating = parseFloat( settings.rating );
		var fullStars = Math.floor( rating );
		var halfStar = ( rating - fullStars ) >= 0.5 ? 1 : 0;
		var emptyStars = 5 - fullStars - halfStar;
		
		var starsHtml = '★'.repeat( fullStars );
		if ( halfStar ) {
			starsHtml += '★';
		}
		starsHtml += '☆'.repeat( emptyStars );

		var hl = settings.subtitle_style;
		#>
		<div class="xp-google-review-wrapper">
			<# if ( settings.show_heading === 'yes' ) { #>
				<div class="xp-heading">
					<# if ( settings.sub ) { #>
						<span class="{{ hl }}">{{{ settings.sub }}}</span>
					<# } #>
					<# if ( settings.title ) { #>
						<{{{ settings.header_size }}} class="main-head">{{{ settings.title }}}</{{{ settings.header_size }}}>
					<# } #>
				</div>
			<# } #>

			<# if ( settings.badge_style === 'inline' ) { #>
				<div class="google-review-badge google-review-inline">
					<# if ( settings.google_logo.url ) { #>
						<img src="{{{ settings.google_logo.url }}}" alt="Google">
					<# } #>
					<div class="flexieitem">
						<div class="flex_ittmm">
							<div class="rating">{{{ rating.toFixed(1) }}}</div>
							<div class="stars">{{{ starsHtml }}}</div>
						</div>
						<div class="text">{{{ settings.review_text }}}</div>
					</div>
				</div>
			<# } else { #>
				<div class="google-review-badge google-review-boxed">
					<# if ( settings.google_logo.url ) { #>
						<img src="{{{ settings.google_logo.url }}}" alt="Google">
					<# } #>
					<div class="rating">{{{ rating.toFixed(1) }}}</div>
					<div>
						<div class="stars">{{{ starsHtml }}}</div>
						<div class="meta">{{{ settings.review_count }}} reviews</div>
					</div>
				</div>
			<# } #>
		</div>
		<?php
	}
}

Plugin::instance()->widgets_manager->register( new xConnect_Google_Review_Badge() );