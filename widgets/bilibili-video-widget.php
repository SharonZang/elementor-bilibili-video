<?php
if ( ! defined( 'ABSPATH' ) ) {
    exit; // 防止直接访问文件
}

class Elementor_Bilibili_Video_Widget extends \Elementor\Widget_Base {

    // 获取小工具名称
    public function get_name() {
        return 'bilibili_video';
    }

    // 获取小工具标题
    public function get_title() {
        return __( 'Bilibili Video', 'elementor-bilibili-video' );
    }

    // 获取小工具图标
    public function get_icon() {
        return 'eicon-youtube';
    }

    // 获取小工具分类
    public function get_categories() {
        return [ 'general' ];
    }

    // 注册小工具控件
    protected function _register_controls() {
        // 视频ID控件
        $this->start_controls_section(
            'content_section',
            [
                'label' => __( 'Content', 'elementor-bilibili-video' ),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'video_id',
            [
                'label' => __( 'Bilibili Video ID', 'elementor-bilibili-video' ),
                'type' => \Elementor\Controls_Manager::TEXT,
                'placeholder' => __( '例如：BV1xx411c7mD', 'elementor-bilibili-video' ),
            ]
        );

        $this->add_control(
            'autoplay',
            [
                'label' => __( '自动播放', 'elementor-bilibili-video' ),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'label_on' => __( '开启', 'elementor-bilibili-video' ),
                'label_off' => __( '关闭', 'elementor-bilibili-video' ),
                'return_value' => '1',
                'default' => '0',
            ]
        );

        // 视频宽度控件
        $this->add_control(
            'video_width',
            [
                'label' => __( '视频宽度', 'elementor-bilibili-video' ),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'size_units' => [ 'px', '%' ],
                'range' => [
                    'px' => [
                        'min' => 100,
                        'max' => 2000,
                        'step' => 10,
                    ],
                    '%' => [
                        'min' => 10,
                        'max' => 100,
                    ],
                ],
                'default' => [
                    'unit' => 'px',
                    'size' => 800,
                ],
                'selectors' => [
                    '{{WRAPPER}} iframe' => 'width: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        // 视频高度控件
        $this->add_control(
            'video_height',
            [
                'label' => __( '视频高度', 'elementor-bilibili-video' ),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'size_units' => [ 'px', '%' ],
                'range' => [
                    'px' => [
                        'min' => 100,
                        'max' => 2000,
                        'step' => 10,
                    ],
                    '%' => [
                        'min' => 10,
                        'max' => 100,
                    ],
                ],
                'default' => [
                    'unit' => 'px',
                    'size' => 450,
                ],
                'selectors' => [
                    '{{WRAPPER}} iframe' => 'height: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_section();

        // 样式设置
        $this->start_controls_section(
            'style_section',
            [
                'label' => __( '样式', 'elementor-bilibili-video' ),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );

        // 投影控件
        $this->add_group_control(
            \Elementor\Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'box_shadow',
                'label' => __( '投影', 'elementor-bilibili-video' ),
                'selector' => '{{WRAPPER}} iframe',
            ]
        );

        // 边框控件
        $this->add_group_control(
            \Elementor\Group_Control_Border::get_type(),
            [
                'name' => 'border',
                'label' => __( '边框', 'elementor-bilibili-video' ),
                'selector' => '{{WRAPPER}} iframe',
            ]
        );

        // 圆角控件
        $this->add_control(
            'border_radius',
            [
                'label' => __( '圆角', 'elementor-bilibili-video' ),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%' ],
                'selectors' => [
                    '{{WRAPPER}} iframe' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_section();
    }

    // 渲染小工具内容
    protected function render() {
        error_log('Bilibili Video Widget Render Method Called!'); // 调试输出
        $settings = $this->get_settings_for_display();
        $video_id = $settings['video_id'];
        $autoplay = $settings['autoplay'];

        if ( ! empty( $video_id ) ) {
            $autoplay_param = $autoplay === '1' ? '&autoplay=1' : '&autoplay=0'; // 确保关闭时传递 autoplay=0
            echo '<iframe 
                    src="https://player.bilibili.com/player.html?bvid=' . esc_attr( $video_id ) . $autoplay_param . '&page=1" 
                    scrolling="no" 
                    border="0" 
                    frameborder="no" 
                    framespacing="0" 
                    allowfullscreen="true">
                  </iframe>';
        } else {
            echo '<p>请输入Bilibili视频ID。</p>';
        }
    }
}