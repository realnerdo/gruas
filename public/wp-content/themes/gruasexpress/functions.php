<?php

function gruas_theme_setup(){
    add_theme_support('menus');
    register_nav_menu('primary', 'Primary Header Navigation');
}
add_action('init', 'gruas_theme_setup');

function gruas_script_enqueue() {
    wp_enqueue_style('customstyle', get_template_directory_uri() . '/style.css', [], '1.0.0', 'all');
    wp_enqueue_script('customjs', get_template_directory_uri() . '/js/dist/scripts.js', [], '1.0.0', true);
}
add_action('wp_enqueue_scripts', 'gruas_script_enqueue');

function my_acf_init() {
	acf_update_setting('google_api_key', 'AIzaSyAvrj9JjNDYOyiYqt62MCDx6F7gLfAXLuQ');
}
add_action('acf/init', 'my_acf_init');
