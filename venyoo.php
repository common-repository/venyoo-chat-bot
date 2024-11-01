<?php
/**
 * Plugin Name: Venyoo Chat Bot
 * Description: With Venyoo free livechat you can chat with visitors on your website to increase conversion and sales
 * Author: Venyoo
 * Version: 1.0.0
 */

// Add multilingual support
load_plugin_textdomain( 'venyoo', false, basename( dirname( __FILE__ ) ) . '/languages' );

// Add settings page and register settings with WordPress
add_action('admin_menu', 'venyoo_setup');

function venyoo_setup()
{
  add_submenu_page(
      'options-general.php',
      __( 'Venyoo Chat Bot Plugin', 'venyoo'),
      __( 'Venyoo Chat Bot', 'venyoo'),
      'manage_options',
      'options-venyoo',
      'venyoo_settings'
  );

  register_setting(
      'venyoo',
      'venyoo-code'
  );
}

function venyoo_settings()
{
  echo "<h2>" . __( 'Venyoo Chat Bot Setup', 'venyoo' ) . "</h2>";
  if (get_option('venyoo-code'))
  {
    echo "<p>" . __('Seems like everything is OK', 'venyoo') . '! <br> ' . __('Check your', 'venyoo') .' <a href="' . home_url() . '">' . __('website', 'venyoo') . '</a> ' . __('to see if the live chat widget is present', 'venyoo') . '<br>' . __('Log in to your', 'venyoo') . ' <a href="https://account.venyoo.ru/?utm_s=WP" target="_blank">' . __('Venyoo dashboard', 'venyoo') . '</a> ' . __('to chat with your website visitors and manage preferences', 'venyoo') . '.<br>';
  } else {
    echo "<p>" . __( 'Signup for a free Venyoo account at', 'venyoo' ) . ' <a href="https://account.venyoo.ru/?utm_s=WP" target="_blank">account.venyoo.ru</a>,<br> ' . __('then copy and paste Widget code from Setup & Customize section into the form below', 'venyoo') . ':' . "</p>";
  }

  echo "<form action=\"options.php\" method=\"POST\">";

    settings_fields( 'venyoo' );
    do_settings_sections( 'venyoo' );

    echo "<textarea cols=\"90\" rows=\"16\" name=\"venyoo-code\">" . esc_attr( get_option('venyoo-code') ) . "</textarea>";

    submit_button();

  echo "</form>";
}

add_action('wp_footer', 'add_venyoo_code');

function add_venyoo_code()
{
  echo get_option( 'venyoo-code' );
}
