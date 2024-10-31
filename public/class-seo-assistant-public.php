<?php

/**
 * The public-facing functionality of the plugin.
 *
 * @link       #
 * @since      1.0.0
 *
 * @package    Seo_Assistant
 * @subpackage Seo_Assistant/public
 */

/**
 * The public-facing functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the public-facing stylesheet and JavaScript.
 *
 * @package    Seo_Assistant
 * @subpackage Seo_Assistant/public
 * @author     cs_army <cs.army021@gmail.com>
 */
class Seo_Assistant_Pubilc {

	/**
	 * The ID of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $plugin_name    The ID of this plugin.
	 */
	private $plugin_name;

	/**
	 * The version of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $version    The current version of this plugin.
	 */
	private $version;


	private $seo_assistant_setting_google_webmaster;
	private $seo_assistant_setting_google_analytical;
	private $seo_assistant_setting_google_tag_manager;
	private $seo_assistant_setting_meta_pixel;
	private $seo_assistant_setting_fb_domain_verification;

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since    1.0.0
	 * @param      string    $plugin_name       The name of the plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version = $version;

		$this->seo_assistant_setting_google_webmaster 		= get_option('seo_assistant_google_webmaster');
		$this->seo_assistant_setting_google_analytical 		= get_option('seo_assistant_google_analytical');
		$this->seo_assistant_setting_google_tag_manager 	= get_option('seo_assistant_google_tag_manager');
		$this->seo_assistant_setting_meta_pixel 			= get_option('seo_assistant_meta_pixel');
		$this->seo_assistant_setting_fb_domain_verification = get_option('seo_assistant_fb_domain_verification');

	}

	/**
	 * Register the stylesheets for the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_styles() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Seo_Assistant_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Seo_Assistant_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/seo-assistant-public.css', array(), $this->version, 'all' );

	}

	/**
	 * Register the JavaScript for the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_scripts() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Seo_Assistant_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Seo_Assistant_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/seo-assistant-public.js', array( 'jquery' ), $this->version, false );

		wp_localize_script(  
			$this->plugin_name,
			'SEO_ASSISTANT_GOOGLE_ANALYTICAL',
			array(
				'google_tag_manager' => $this->seo_assistant_setting_google_tag_manager,
				'meta_pixel' => $this->seo_assistant_setting_meta_pixel,
			)
		);
	}

	public function add_google_webmaster(){
		$google_webmaster_enable = !empty($this->seo_assistant_setting_google_webmaster['google-webmaster']) ? $this->seo_assistant_setting_google_webmaster['google-webmaster'] : false;

		$google_webmaster_code = !empty($this->seo_assistant_setting_google_webmaster['google-webmaster-code']) ? $this->seo_assistant_setting_google_webmaster['google-webmaster-code'] : false;
		
		if ($google_webmaster_enable && "yes" == $google_webmaster_enable && $google_webmaster_code ) {
			printf(
				'<!--  Added by Seo Assistant plugin -->
			<meta name="google-site-verification" content="%s" />',
				esc_attr($google_webmaster_code)
			);
		}
	}


	public function add_google_analytical(){
		$google_analytics_enable = !empty($this->seo_assistant_setting_google_analytical['google-analytics-enable']) ? $this->seo_assistant_setting_google_analytical['google-analytics-enable'] : false;

		$google_analytics_id = !empty ($this->seo_assistant_setting_google_analytical['google-analytics']) ? $this->seo_assistant_setting_google_analytical['google-analytics'] : false ;
		if( $google_analytics_enable && "yes" == $google_analytics_enable && $google_analytics_id ){
			printf(
				'%2$s<!-- Global site tag (gtag.js) - Google Analytics  Added by Seo Assistant plugin -->
				<script async src="//www.googletagmanager.com/gtag/js?id=%1$s"></script>
				<script>
				window.dataLayer = window.dataLayer || [];
				function gtag(){dataLayer.push(arguments);}
				gtag("js", new Date());
				gtag("config", "%1$s");
				</script>%2$s',
				esc_attr($google_analytics_id),
				" \r\n "
			);
		}
	}

	
	public function add_google_tag_manager(){
		$google_tag_manager_enable = !empty($this->seo_assistant_setting_google_tag_manager['google-tag-manager-enable']) ? $this->seo_assistant_setting_google_tag_manager['google-tag-manager-enable'] : false;
		
		$google_tag_manager_id = !empty($this->seo_assistant_setting_google_tag_manager['google-tag-manager']) ? $this->seo_assistant_setting_google_tag_manager['google-tag-manager'] : false;
		if ($google_tag_manager_enable && "yes" == $google_tag_manager_enable && $google_tag_manager_id ) {
			printf(
				"\r\n<!-- Google Tag Manager Added by Seo Assistant plugin -->
				<script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
				new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
				j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
				'//www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
				})(window,document,'script','dataLayer','%s');</script>
				 \r\n<!-- End Google Tag Manager  Added by Seo Assistant plugin --> \r\n",
				esc_attr($google_tag_manager_id)
			);
		}
	}
	
	public function add_meta_pixel(){
		$meta_pixel_enable = !empty($this->seo_assistant_setting_meta_pixel['meta-pixel-enable']) ? $this->seo_assistant_setting_meta_pixel['meta-pixel-enable'] : false;
		
		$meta_pixel_id = !empty($this->seo_assistant_setting_meta_pixel['meta-pixel-head']) ? $this->seo_assistant_setting_meta_pixel['meta-pixel-head'] : false;
		if ($meta_pixel_enable && "yes" == $meta_pixel_enable && $meta_pixel_id ) {
			printf(
				"\r\n <!-- Meta Pixel Code by Seo Assistant Plugin -->
					<script>
					!function(f,b,e,v,n,t,s)
					{if(f.fbq)return;n=f.fbq=function(){n.callMethod?
					n.callMethod.apply(n,arguments):n.queue.push(arguments)};
					if(!f._fbq)f._fbq=n;n.push=n;n.loaded=!0;n.version='2.0';
					n.queue=[];t=b.createElement(e);t.async=!0;
					t.src=v;s=b.getElementsByTagName(e)[0];
					s.parentNode.insertBefore(t,s)}(window, document,'script',
					'https://connect.facebook.net/en_US/fbevents.js');
					fbq('init', '%s');
					fbq('track', 'PageView');
					</script>
					<noscript><img height=\"1\" width=\"1\" style=\"display:none\"
					src=\"https://www.facebook.com/tr?id=625855048766185&ev=PageView&noscript=1\"
					/></noscript>
				<!-- End Meta Pixel Code --> \r\n",
				esc_attr($meta_pixel_id)
			);
		}
	}


	public function add_facebook_domain_verification(){
		$enable = !empty($this->seo_assistant_setting_fb_domain_verification['fb-domain-verification-enable']) ? $this->seo_assistant_setting_fb_domain_verification['fb-domain-verification-enable'] : false;

		$code = !empty($this->seo_assistant_setting_fb_domain_verification['fb-domain-verification-code']) ? $this->seo_assistant_setting_fb_domain_verification['fb-domain-verification-code'] : false;
		
		if ($enable && "yes" == $enable && $code ) {
			printf(
				'<!--  Added by Seo Assistant plugin -->
			 	<meta name="facebook-domain-verification" content="%s" />',
				esc_attr($code)
			);
		}
	}

}
