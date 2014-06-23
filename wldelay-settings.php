<?php
class WPDelay_Settings {
    /**
     * Default delay value is 1 second
     */
    const _DEFAULT_DELAY_IN_SECONDS = 1;
    
    /**
     * Holds the values to be used in the fields callbacks
     */
    private $options;
    
    /**
     * Start up
     */
    public function __construct()
    {
        add_action( 'admin_menu', array( $this, 'add_plugin_page' ) );
        add_action( 'admin_init', array( $this, 'page_init' ) );
    }

    /**
     * Add options page
     */
    public function add_plugin_page()
    {
        // This page will be under "Settings"
        add_options_page(
            'WP Login Delay Settings',              // page title
            'WP Login Delay',                       // menu title
            'manage_options',                       // capability
            'wp-login-delay-admin',                 // menu slug
            array( $this, 'create_admin_page' )     // callback function
        );
    }

    /**
     * Options page callback
     */
    public function create_admin_page()
    {
        // Set class property
        $this->options = get_option( 'wldelay_options' );
        ?>
        <div class="wrap">
            <?php screen_icon(); ?>
            <h2>WP Login Delay Settings</h2>           
            <form method="post" action="options.php">
            <?php
                // This prints out all hidden setting fields
                settings_fields( 'wldelay_option_group' );   
                do_settings_sections( 'wp-login-delay-admin' );
                submit_button();
            ?>
            </form>
        </div>
        <?php
    }

    /**
     * Register and add settings
     */
    public function page_init()
    {        
        register_setting(
            'wldelay_option_group',     // Option group
            'wldelay_options',          // Option name
            array( $this, 'sanitize' )  // Sanitize
        );

        add_settings_section(
            'wldelay_setting_section_id', // ID
            'General settings', // Title
            array( $this, 'print_section_info' ), // Callback
            'wp-login-delay-admin' // Page
        );
        
        add_settings_field(
            'wldelay_delay',                        // id
            'Delay in seconds',                     // title
            array( $this, 'delay_callback' ),       // callback function
            'wp-login-delay-admin',                 // page
            'wldelay_setting_section_id'            // section
        );

    }

    /**
     * Sanitize each setting field as needed
     *
     * @param array $input Contains all settings fields as array keys
     */
    public function sanitize( $input )
    {
        $new_input = array();
        if( isset( $input['wldelay_delay'] ) )
            $new_input['wldelay_delay'] = absint( $input['wldelay_delay'] );

        return $new_input;
    }

    /** 
     * Print the Section text
     */
    public function print_section_info()
    {
        print 'Enter your settings below:';
    }

    /** 
     * Get the settings option array and print one of its values
     */
    public function delay_callback()
    {
        printf(
            '<input type="text" id="wldelay_delay" name="wldelay_options[wldelay_delay]" value="%d" />',
            isset( $this->options['wldelay_delay'] ) ? esc_attr( $this->options['wldelay_delay']) : self::_DEFAULT_DELAY_IN_SECONDS
        );
    }

}
