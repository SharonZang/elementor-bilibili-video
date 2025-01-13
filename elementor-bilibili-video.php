<?php
/*
Plugin Name: Elementor Bilibili Video
Plugin URI: https://nutswp.com/
Description: 为Elementor添加一个Bilibili视频元素，支持控制自动播放和视频尺寸。
Version: 1.0
Author: NUTSWP
Author URI: https://nutswp.com/
License: GPL2
*/


if ( ! defined( 'ABSPATH' ) ) {
    exit; // 防止直接访问文件
}

error_log('Plugin Loaded!'); // 插件加载调试信息

add_action( 'plugins_loaded', function() {
    // 检查Elementor是否已加载
    if ( ! did_action( 'elementor/loaded' ) ) {
        error_log('Elementor Not Loaded!'); // 调试输出
        return;
    }

    // 检查小工具文件是否存在
    if ( file_exists( __DIR__ . '/widgets/bilibili-video-widget.php' ) ) {
        error_log('Bilibili Video Widget File Exists!'); // 调试输出
    } else {
        error_log('Bilibili Video Widget File Not Found!'); // 调试输出
        return;
    }

    // 注册自定义Elementor元素
    function register_elementor_bilibili_video_widget( $widgets_manager ) {
        require_once( __DIR__ . '/widgets/bilibili-video-widget.php' ); // 加载自定义元素类

        if ( class_exists( 'Elementor_Bilibili_Video_Widget' ) ) {
            error_log('Bilibili Video Widget Class Loaded!'); // 调试输出
            $widgets_manager->register( new \Elementor_Bilibili_Video_Widget() ); // 注册元素
            error_log('Bilibili Video Widget Registered!'); // 调试输出
        } else {
            error_log('Bilibili Video Widget Class Not Loaded!'); // 调试输出
        }
    }
    add_action( 'elementor/widgets/register', 'register_elementor_bilibili_video_widget' );

    // 检查Elementor钩子是否触发
    function check_elementor_hook() {
        error_log('Elementor Widgets Register Hook Triggered!'); // 调试输出
    }
    add_action( 'elementor/widgets/register', 'check_elementor_hook' );
});

// 插件激活调试信息
register_activation_hook( __FILE__, function() {
    error_log('Bilibili Video Plugin Activated!');
});