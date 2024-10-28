<?php
/**
 * Plugin Name: Contact Form 7 - Email to Flamingo (Add-on)
 * Description: Disables email sending in Contact Form 7 and sends all CF7 submissions directly to Flamingo. Requires both Contact Form 7 and Flamingo plugins.
 * Version: 0.2
 * Author: drhdev
 * Plugin URI: https://github.com/drhdev/cf7-email-to-flamingo
 * License: GPL2
 * License URI: https://www.gnu.org/licenses/gpl-2.0.html
 * Text Domain: cf7-email-to-flamingo
 * Domain Path: /languages
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly to avoid unauthorized access
}

/**
 * Check for required plugins and display admin notice if missing
 */
function cf7_email_to_flamingo_check_dependencies() {
    if ( ! class_exists( 'WPCF7_ContactForm' ) || ! class_exists( 'Flamingo_Inbound_Message' ) ) {
        add_action( 'admin_notices', 'cf7_email_to_flamingo_admin_notice_missing_dependencies' );
    }
}
add_action( 'admin_init', 'cf7_email_to_flamingo_check_dependencies' );

/**
 * Admin notice for missing dependencies
 */
function cf7_email_to_flamingo_admin_notice_missing_dependencies() {
    ?>
    <div class="notice notice-error">
        <p><?php esc_html_e( 'Contact Form 7 - Email to Flamingo requires both Contact Form 7 and Flamingo to be installed and activated. Please install and activate both plugins.', 'cf7-email-to-flamingo' ); ?></p>
    </div>
    <?php
}

if ( ! class_exists( 'CF7_Email_To_Flamingo' ) ) {

    /**
     * Main plugin class
     */
    class CF7_Email_To_Flamingo {

        /**
         * Constructor
         */
        public function __construct() {
            // Initialize plugin
            add_action( 'admin_menu', array( $this, 'cf7_email_to_flamingo_add_admin_menu' ) );
            add_action( 'admin_init', array( $this, 'cf7_email_to_flamingo_settings_init' ) );
            add_filter( 'wpcf7_skip_mail', array( $this, 'cf7_email_to_flamingo_skip_mail' ), 10, 2 );
        }

        /**
         * Add plugin options page to the Contact Form 7 menu in the admin sidebar
         */
        public function cf7_email_to_flamingo_add_admin_menu() {
            add_submenu_page(
                'wpcf7', // Parent slug for Contact Form 7
                __( 'Email to Flamingo', 'cf7-email-to-flamingo' ),
                __( 'Email to Flamingo', 'cf7-email-to-flamingo' ),
                'wpcf7_edit_contact_forms', // CF7's capability
                'cf7-email-to-flamingo',
                array( $this, 'cf7_email_to_flamingo_options_page' )
            );
        }

        /**
         * Initialize plugin settings
         */
        public function cf7_email_to_flamingo_settings_init() {
            register_setting(
                'cf7_email_to_flamingo',
                'cf7_email_to_flamingo_settings',
                array( $this, 'cf7_email_to_flamingo_sanitize_settings' )
            );

            add_settings_section(
                'cf7_email_to_flamingo_section',
                __( 'Configuration Options', 'cf7-email-to-flamingo' ),
                null,
                'cf7_email_to_flamingo'
            );

            add_settings_field(
                'cf7_email_to_flamingo_enable',
                __( 'Disable email sending', 'cf7-email-to-flamingo' ),
                array( $this, 'cf7_email_to_flamingo_enable_field_render' ),
                'cf7_email_to_flamingo',
                'cf7_email_to_flamingo_section'
            );
        }

        /**
         * Sanitize plugin settings
         *
         * @param array $input The input array.
         * @return array Sanitized input.
         */
        public function cf7_email_to_flamingo_sanitize_settings( $input ) {
            $new_input = array();

            if ( isset( $input['cf7_email_to_flamingo_enable'] ) ) {
                $new_input['cf7_email_to_flamingo_enable'] = absint( $input['cf7_email_to_flamingo_enable'] );
            }

            return $new_input;
        }

        /**
         * Render the checkbox field for enabling/disabling email sending
         */
        public function cf7_email_to_flamingo_enable_field_render() {
            $options = get_option( 'cf7_email_to_flamingo_settings', array() );
            $enabled = isset( $options['cf7_email_to_flamingo_enable'] ) ? $options['cf7_email_to_flamingo_enable'] : 0;
            ?>
            <label for="cf7_email_to_flamingo_enable">
                <input type="checkbox" name="cf7_email_to_flamingo_settings[cf7_email_to_flamingo_enable]" id="cf7_email_to_flamingo_enable" value="1" <?php checked( $enabled, 1 ); ?>>
                <?php esc_html_e( 'Disable email sending and send submissions to Flamingo only.', 'cf7-email-to-flamingo' ); ?>
            </label>
            <p class="description"><?php esc_html_e( 'When enabled, Contact Form 7 will not send emails but will store submissions in Flamingo.', 'cf7-email-to-flamingo' ); ?></p>
            <?php
        }

        /**
         * Conditionally skip email sending in Contact Form 7 based on plugin setting
         *
         * @param bool              $skip_mail    Whether to skip mail.
         * @param WPCF7_ContactForm $contact_form The current contact form.
         * @return bool
         */
        public function cf7_email_to_flamingo_skip_mail( $skip_mail, $contact_form ) {
            $options = get_option( 'cf7_email_to_flamingo_settings', array() );
            $enabled = isset( $options['cf7_email_to_flamingo_enable'] ) ? $options['cf7_email_to_flamingo_enable'] : 0;

            if ( $enabled ) {
                return true; // Disable email sending
            }

            return $skip_mail; // Respect previous filters
        }

        /**
         * Render the options page
         */
        public function cf7_email_to_flamingo_options_page() {
            ?>
            <div class="wrap">
                <h1><?php esc_html_e( 'Email to Flamingo Settings', 'cf7-email-to-flamingo' ); ?></h1>
                <form method="post" action="options.php">
                    <?php
                    settings_fields( 'cf7_email_to_flamingo' );
                    do_settings_sections( 'cf7_email_to_flamingo' );
                    submit_button();
                    ?>
                </form>
                <p><?php esc_html_e( 'Note: Enabling this option will prevent all emails from being sent through Contact Form 7. Submissions will be stored in the Flamingo database only.', 'cf7-email-to-flamingo' ); ?></p>
                <p>
                    <a href="https://contactform7.com/" target="_blank"><?php esc_html_e( 'Learn more about Contact Form 7', 'cf7-email-to-flamingo' ); ?></a> |
                    <a href="https://wordpress.org/plugins/flamingo/" target="_blank"><?php esc_html_e( 'Learn more about Flamingo', 'cf7-email-to-flamingo' ); ?></a>
                </p>
            </div>
            <?php
        }
    }

    new CF7_Email_To_Flamingo();
}
