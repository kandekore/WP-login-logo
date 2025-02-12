<?php
/**
 * Plugin Name: Custom Login Logo
 * Description: Replaces the WordPress login logo with a custom logo that can be uploaded and sized via the dashboard.
 * Version: 1.0
 * Author: D Kandekore
 * Author URI: https://darrenk.uk
 * License: GPL2
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly.
}

class CustomLoginLogo {

    public function __construct() {
        // Create a settings page in the admin
        add_action( 'admin_menu', array( $this, 'add_settings_page' ) );

        // Register settings (logo URL, width, height)
        add_action( 'admin_init', array( $this, 'register_settings' ) );

        // Enqueue scripts for media uploader
        add_action( 'admin_enqueue_scripts', array( $this, 'enqueue_media_uploader' ) );

        // Output custom logo on wp-login.php
        add_action( 'login_enqueue_scripts', array( $this, 'custom_login_logo' ) );
    }

    /**
     * Add an item under "Settings" for our plugin page.
     */
    public function add_settings_page() {
        add_options_page(
            'Custom Login Logo',
            'Custom Login Logo',
            'manage_options',
            'custom-login-logo',
            array( $this, 'render_settings_page' )
        );
    }

    /**
     * Register our settings so they can be saved.
     */
    public function register_settings() {
        register_setting( 'custom_login_logo_settings', 'custom_login_logo_url' );
        register_setting( 'custom_login_logo_settings', 'custom_login_logo_width' );
        register_setting( 'custom_login_logo_settings', 'custom_login_logo_height' );
    }

    /**
     * Enqueue the WordPress media uploader scripts/styles.
     */
    public function enqueue_media_uploader( $hook ) {
        // Only enqueue on our plugin's settings page
        if ( 'settings_page_custom-login-logo' !== $hook ) {
            return;
        }
        wp_enqueue_media();
        wp_enqueue_script( 'jquery' );
    }

    /**
     * Render the settings page where users can upload a logo and define width/height.
     */
    public function render_settings_page() {
        ?>
        <div class="wrap">
            <h1>Custom Login Logo Settings</h1>
            <form method="post" action="options.php">
                <?php
                    settings_fields( 'custom_login_logo_settings' );
                    do_settings_sections( 'custom_login_logo_settings' );
                ?>
                <table class="form-table">
                    <tr>
                        <th scope="row"><label for="custom_login_logo_url">Logo URL</label></th>
                        <td>
                            <input 
                                type="text" 
                                name="custom_login_logo_url" 
                                id="custom_login_logo_url" 
                                value="<?php echo esc_url( get_option( 'custom_login_logo_url' ) ); ?>" 
                                style="width: 300px;"
                            />
                            <button type="button" class="button" id="upload_logo_button">Upload Logo</button>
                            <p class="description">Enter or upload the URL of the logo image.</p>
                        </td>
                    </tr>
                    <tr>
                        <th scope="row"><label for="custom_login_logo_width">Logo Width (px)</label></th>
                        <td>
                            <input 
                                type="number" 
                                name="custom_login_logo_width" 
                                id="custom_login_logo_width" 
                                value="<?php echo esc_attr( get_option( 'custom_login_logo_width' ) ); ?>" 
                                style="width: 100px;"
                            />
                        </td>
                    </tr>
                    <tr>
                        <th scope="row"><label for="custom_login_logo_height">Logo Height (px)</label></th>
                        <td>
                            <input 
                                type="number" 
                                name="custom_login_logo_height" 
                                id="custom_login_logo_height" 
                                value="<?php echo esc_attr( get_option( 'custom_login_logo_height' ) ); ?>" 
                                style="width: 100px;"
                            />
                        </td>
                    </tr>
                </table>
                <?php submit_button(); ?>
            </form>
        </div>

        <script>
            jQuery(document).ready(function($){
                let mediaUploader;

                $('#upload_logo_button').on('click', function(e) {
                    e.preventDefault();

                    // If the uploader object has already been created, reopen the dialog
                    if (mediaUploader) {
                        mediaUploader.open();
                        return;
                    }

                    // Extend the wp.media object
                    mediaUploader = wp.media.frames.file_frame = wp.media({
                        title: 'Select or Upload Logo',
                        button: {
                            text: 'Use this logo'
                        },
                        multiple: false
                    });

                    // When a file is selected, grab the URL and set it as the text field's value
                    mediaUploader.on('select', function() {
                        let attachment = mediaUploader.state().get('selection').first().toJSON();
                        $('#custom_login_logo_url').val(attachment.url);
                    });

                    // Open the uploader dialog
                    mediaUploader.open();
                });
            });
        </script>
        <?php
    }

    /**
     * Output CSS on the login page to replace the WordPress logo with our custom logo.
     */
    public function custom_login_logo() {
        $logo_url    = esc_url( get_option( 'custom_login_logo_url' ) );
        $logo_width  = absint( get_option( 'custom_login_logo_width' ) );
        $logo_height = absint( get_option( 'custom_login_logo_height' ) );

        if ( $logo_url ) : ?>
            <style type="text/css">
                #login h1 a, .login h1 a {
                    background-image: url('<?php echo $logo_url; ?>');
                    background-size: contain;
                    background-repeat: no-repeat;
                    text-indent: -9999px;
                    overflow: hidden;
                    padding-bottom: 0;
                    <?php if ( $logo_width && $logo_height ) : ?>
                        width: <?php echo $logo_width; ?>px;
                        height: <?php echo $logo_height; ?>px;
                        background-size: <?php echo $logo_width; ?>px <?php echo $logo_height; ?>px;
                    <?php else : ?>
                        width: 100px;
                        height: 100px;
                        /* fallback values; adjust as needed */
                    <?php endif; ?>
                }
            </style>
        <?php
        endif;
    }
}

// Initialize our class
new CustomLoginLogo();
