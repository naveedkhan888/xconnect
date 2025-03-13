<?php

namespace Elementor;

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly
}

class Counter_Widget extends Widget_Base
{
    public function get_name()
    {
        return 'counter_widget';
    }

    public function get_title()
    {
        return esc_html__('XP Membership', 'xhub');
    }

    public function get_icon()
    {
        return 'eicon-number-field';
    }

    public function get_categories()
    {
        return ['category_xhub'];
    }

    public function get_keywords()
    {
        return ['counter', 'number', 'steps'];
    }

    protected function register_controls()
    {
        // Content Section
        $this->start_controls_section('content_section', [
            'label' => esc_html__('Content', 'xhub'),
            'tab' => Controls_Manager::TAB_CONTENT,
        ]);

        $repeater = new Repeater();

        $repeater->add_control('counter_number', [
            'label' => esc_html__('Number', 'xhub'),
            'type' => Controls_Manager::TEXT,
            'default' => '01',
            'label_block' => true,
        ]);

        $repeater->add_control('heading', [
            'label' => esc_html__('Heading', 'xhub'),
            'type' => Controls_Manager::TEXT,
            'default' => esc_html__('Receive packages', 'xhub'),
            'label_block' => true,
        ]);

        $repeater->add_control('description', [
            'label' => esc_html__('Description', 'xhub'),
            'type' => Controls_Manager::TEXTAREA,
            'default' => esc_html__('Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam. Sed ut perspiciatis unde omnis iste natus.', 'xhub'),
            'rows' => 5,
        ]);

        $repeater->add_control('icon', [
            'label' => esc_html__('Icon', 'xhub'),
            'type' => Controls_Manager::ICONS,
            'default' => [
                'value' => 'xpicon xpicon-next-4',
                'library' => 'solid',
            ],
        ]);

        $repeater->add_control('show_divider', [
            'label' => esc_html__('Show Divider', 'xhub'),
            'type' => Controls_Manager::SWITCHER,
            'default' => 'yes',
        ]);

        $this->add_control('counters', [
            'label' => esc_html__('Counters', 'xhub'),
            'type' => Controls_Manager::REPEATER,
            'fields' => $repeater->get_controls(),
            'default' => [
                [
                    'counter_number' => '01',
                    'heading' => esc_html__('Receive packages', 'xhub'),
                    'description' => esc_html__('Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam. Sed ut perspiciatis unde omnis iste natus.', 'xhub'),
                ],
            ],
            'title_field' => '{{{ counter_number }}} - {{{ heading }}}',
        ]);

        $this->end_controls_section();

        // Style Section
        $this->start_controls_section('style_section', [
            'label' => esc_html__('Style', 'xhub'),
            'tab' => Controls_Manager::TAB_STYLE,
        ]);

        // Number Style
        $this->start_controls_tabs('number_style_tabs');

        $this->start_controls_tab(
            'number_normal_tab',
            [
                'label' => esc_html__('Normal', 'xhub'),
            ]
        );

        $this->add_control('number_color', [
            'label' => esc_html__('Number Color', 'xhub'),
            'type' => Controls_Manager::COLOR,
            'default' => '',
            'selectors' => [
                '{{WRAPPER}} .counter-number' => 'color: {{VALUE}};',
            ],
        ]);

        $this->end_controls_tab();

        $this->start_controls_tab(
            'number_hover_tab',
            [
                'label' => esc_html__('Hover', 'xhub'),
            ]
        );

        $this->add_control('number_hover_color', [
            'label' => esc_html__('Number Hover Color', 'xhub'),
            'type' => Controls_Manager::COLOR,
            'default' => '',
            'selectors' => [
                '{{WRAPPER}} .counter-item:hover .counter-number' => 'color: {{VALUE}} !important;',
            ],
        ]);

        $this->end_controls_tab();

        $this->end_controls_tabs();

        $this->add_group_control(Group_Control_Typography::get_type(), [
            'name' => 'number_typography',
            'label' => esc_html__('Number Typography', 'xhub'),
            'selector' => '{{WRAPPER}} .counter-number',
            'separator' => 'before',
        ]);

        // Heading Style
        $this->add_control('heading_color', [
            'label' => esc_html__('Heading Color', 'xhub'),
            'type' => Controls_Manager::COLOR,
            'default' => '',
            'selectors' => [
                '{{WRAPPER}} .counter-heading' => 'color: {{VALUE}};',
            ],
            'separator' => 'before',
        ]);

        $this->add_group_control(Group_Control_Typography::get_type(), [
            'name' => 'heading_typography',
            'label' => esc_html__('Heading Typography', 'xhub'),
            'selector' => '{{WRAPPER}} .counter-heading',
        ]);

        // Description Style
        $this->add_control('description_color', [
            'label' => esc_html__('Description Color', 'xhub'),
            'type' => Controls_Manager::COLOR,
            'default' => '',
            'selectors' => [
                '{{WRAPPER}} .counter-description' => 'color: {{VALUE}};',
            ],
            'separator' => 'before',
        ]);

        $this->add_group_control(Group_Control_Typography::get_type(), [
            'name' => 'description_typography',
            'label' => esc_html__('Description Typography', 'xhub'),
            'selector' => '{{WRAPPER}} .counter-description',
        ]);

        // Container Style
        $this->add_control('container_background', [
            'label' => esc_html__('Container Background', 'xhub'),
            'type' => Controls_Manager::COLOR,
            'default' => '',
            'selectors' => [
                '{{WRAPPER}} .counter-item' => 'background-color: {{VALUE}};',
            ],
            'separator' => 'before',
        ]);

        $this->add_responsive_control('container_padding', [
            'label' => esc_html__('Container Padding', 'xhub'),
            'type' => Controls_Manager::DIMENSIONS,
            'size_units' => ['px', 'em', '%'],
            'selectors' => [
                '{{WRAPPER}} .counter-item' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
            ],
        ]);

        $this->add_responsive_control('container_margin', [
            'label' => esc_html__('Container Margin', 'xhub'),
            'type' => Controls_Manager::DIMENSIONS,
            'size_units' => ['px', 'em', '%'],
            'selectors' => [
                '{{WRAPPER}} .counter-item' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
            ],
        ]);

        $this->add_group_control(Group_Control_Border::get_type(), [
            'name' => 'container_border',
            'selector' => '{{WRAPPER}} .counter-item',
        ]);

        // Element Spacing Controls
        $this->add_control(
            'element_spacing_heading',
            [
                'label' => esc_html__('Element Spacing', 'xhub'),
                'type' => Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );

        // Number Spacing
        $this->add_responsive_control(
            'number_spacing',
            [
                'label' => esc_html__('Number Spacing', 'xhub'),
                'type' => Controls_Manager::SLIDER,
                'size_units' => ['px', 'em', '%'],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 200,
                    ],
                    'em' => [
                        'min' => 0,
                        'max' => 20,
                    ],
                    '%' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                ],
                'default' => [
                    'unit' => 'px',
                    'size' => 80,
                ],
                'selectors' => [
                    '{{WRAPPER}} .counter-number' => 'margin-right: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        // Heading Spacing
        $this->add_responsive_control(
            'heading_spacing',
            [
                'label' => esc_html__('Heading Spacing', 'xhub'),
                'type' => Controls_Manager::SLIDER,
                'size_units' => ['px', 'em', '%'],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 200,
                    ],
                    'em' => [
                        'min' => 0,
                        'max' => 20,
                    ],
                    '%' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                ],
                'default' => [
                    'unit' => 'px',
                    'size' => 80,
                ],
                'selectors' => [
                    '{{WRAPPER}} .counter-heading' => 'margin-right: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        // Description Spacing
        $this->add_responsive_control(
            'description_spacing',
            [
                'label' => esc_html__('Description Spacing', 'xhub'),
                'type' => Controls_Manager::SLIDER,
                'size_units' => ['px', 'em', '%'],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 200,
                    ],
                    'em' => [
                        'min' => 0,
                        'max' => 20,
                    ],
                    '%' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                ],
                'default' => [
                    'unit' => 'px',
                    'size' => 80,
                ],
                'selectors' => [
                    '{{WRAPPER}} .counter-description' => 'margin-right: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        // Icon Spacing
        $this->add_responsive_control(
            'icon_spacing',
            [
                'label' => esc_html__('Icon Spacing', 'xhub'),
                'type' => Controls_Manager::SLIDER,
                'size_units' => ['px', 'em', '%'],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 200,
                    ],
                    'em' => [
                        'min' => 0,
                        'max' => 20,
                    ],
                    '%' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                ],
                'default' => [
                    'unit' => 'px',
                    'size' => 0,
                ],
                'selectors' => [
                    '{{WRAPPER}} .counter-icon-wrapper' => 'margin-left: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_section();



        // Icon Style Section
        $this->start_controls_section('icon_style_section', [
            'label' => esc_html__('Icon Style', 'xhub'),
            'tab' => Controls_Manager::TAB_STYLE,
        ]);

        $this->start_controls_tabs('icon_style_tabs');

        $this->start_controls_tab(
            'icon_normal_tab',
            [
                'label' => esc_html__('Normal', 'xhub'),
            ]
        );

        $this->add_control('icon_color', [
            'label' => esc_html__('Icon Color', 'xhub'),
            'type' => Controls_Manager::COLOR,
            'default' => '',
            'selectors' => [
                '{{WRAPPER}} .counter-icon' => 'color: {{VALUE}};',
            ],
        ]);

        $this->add_control('icon_border_color', [
            'label' => esc_html__('Border Color', 'xhub'),
            'type' => Controls_Manager::COLOR,
            'default' => '',
            'selectors' => [
                '{{WRAPPER}} .counter-icon-wrapper' => 'border-color: {{VALUE}};',
            ],
        ]);

        $this->end_controls_tab();

        $this->start_controls_tab(
            'icon_hover_tab',
            [
                'label' => esc_html__('Hover', 'xhub'),
            ]
        );

        $this->add_control('icon_hover_color', [
            'label' => esc_html__('Icon Hover Color', 'xhub'),
            'type' => Controls_Manager::COLOR,
            'default' => '',
            'selectors' => [
                '{{WRAPPER}} .counter-item:hover .counter-icon' => 'color: {{VALUE}};',
            ],
        ]);

        $this->add_control('icon_hover_border_color', [
            'label' => esc_html__('Border Hover Color', 'xhub'),
            'type' => Controls_Manager::COLOR,
            'default' => '',
            'selectors' => [
                '{{WRAPPER}} .counter-item:hover .counter-icon-wrapper' => 'border-color: {{VALUE}};',
            ],
        ]);

        $this->end_controls_tab();

        $this->end_controls_tabs();

        $this->add_control('icon_size', [
            'label' => esc_html__('Icon Size', 'xhub'),
            'type' => Controls_Manager::SLIDER,
            'size_units' => ['px'],
            'range' => [
                'px' => [
                    'min' => 10,
                    'max' => 100,
                ],
            ],
            'default' => [
                'unit' => 'px',
                'size' => 24,
            ],
            'selectors' => [
                '{{WRAPPER}} .counter-icon' => 'font-size: {{SIZE}}{{UNIT}};',
            ],
            'separator' => 'before',
        ]);

        $this->add_control('icon_wrapper_size', [
            'label' => esc_html__('Icon Wrapper Size', 'xhub'),
            'type' => Controls_Manager::SLIDER,
            'size_units' => ['px'],
            'range' => [
                'px' => [
                    'min' => 20,
                    'max' => 200,
                ],
            ],
            'default' => [
                'unit' => 'px',
                'size' => 58,
            ],
            'selectors' => [
                '{{WRAPPER}} .counter-icon-wrapper' => 'width: {{SIZE}}{{UNIT}}; height: {{SIZE}}{{UNIT}};',
            ],
        ]);

        $this->add_control('icon_border_width', [
            'label' => esc_html__('Border Width', 'xhub'),
            'type' => Controls_Manager::SLIDER,
            'size_units' => ['px'],
            'range' => [
                'px' => [
                    'min' => 1,
                    'max' => 10,
                ],
            ],
            'default' => [
                'unit' => 'px',
                'size' => 1,
            ],
            'selectors' => [
                '{{WRAPPER}} .counter-icon-wrapper' => 'border-width: {{SIZE}}{{UNIT}};',
            ],
        ]);

        $this->end_controls_section();

        // Divider Style Section
        $this->start_controls_section('divider_style_section', [
            'label' => esc_html__('Divider Style', 'xhub'),
            'tab' => Controls_Manager::TAB_STYLE,
        ]);

        $this->add_control('divider_color', [
            'label' => esc_html__('Divider Color', 'xhub'),
            'type' => Controls_Manager::COLOR,
            'default' => 'rgba(255, 255, 255, 0.1)',
            'selectors' => [
                '{{WRAPPER}} .counter-divider' => 'background-color: {{VALUE}};',
            ],
        ]);

        $this->add_control('divider_width', [
            'label' => esc_html__('Divider Width', 'xhub'),
            'type' => Controls_Manager::SLIDER,
            'size_units' => ['px', '%'],
            'range' => [
                'px' => [
                    'min' => 1,
                    'max' => 1000,
                ],
                '%' => [
                    'min' => 1,
                    'max' => 100,
                ],
            ],
            'default' => [
                'unit' => '%',
                'size' => 100,
            ],
            'selectors' => [
                '{{WRAPPER}} .counter-divider' => 'width: {{SIZE}}{{UNIT}};',
            ],
        ]);

        $this->add_control('divider_height', [
            'label' => esc_html__('Divider Height', 'xhub'),
            'type' => Controls_Manager::SLIDER,
            'size_units' => ['px'],
            'range' => [
                'px' => [
                    'min' => 1,
                    'max' => 10,
                ],
            ],
            'default' => [
                'unit' => 'px',
                'size' => 1,
            ],
            'selectors' => [
                '{{WRAPPER}} .counter-divider' => 'height: {{SIZE}}{{UNIT}};',
            ],
        ]);



        // Divider Margin
        $this->add_responsive_control(
            'divider_margin',
            [
                'label' => esc_html__('Divider Margin', 'xhub'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'default' => [
                    'top' => '20',
                    'right' => '0',
                    'bottom' => '0',
                    'left' => '0',
                    'unit' => 'px',
                    'isLinked' => false,
                ],
                'selectors' => [
                    '{{WRAPPER}} .counter-divider' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        

        $this->end_controls_section();
    }

    protected function render()
    {
        $settings = $this->get_settings_for_display();
?>
        <a href="#">
            <div class="counter-container">
                <?php foreach ($settings['counters'] as $index => $item) : ?>
                    <div class="counter-item elementor-repeater-item-<?php echo esc_attr($item['_id']); ?>">
                        <div class="counter-number"><?php echo esc_html($item['counter_number']); ?></div>
                        <h3 class="counter-heading"><?php echo esc_html($item['heading']); ?></h3>
                        <div class="counter-description"><?php echo esc_html($item['description']); ?></div>

                        <?php if (!empty($item['icon']['value'])) : ?>
                            <div class="counter-icon-wrapper">
                                <?php Icons_Manager::render_icon($item['icon'], ['aria-hidden' => 'true', 'class' => 'counter-icon']); ?>
                            </div>
                        <?php endif; ?>

                        <!-- Always show divider regardless of setting -->
                        <div class="counter-divider"></div>
                    </div>
                <?php endforeach; ?>
            </div>
        </a>


<?php
    }
}

Plugin::instance()->widgets_manager->register(new Counter_Widget());
