<?php

class acf_field_code_area extends acf_field {
	
	
	/*
	*  __construct
	*
	*  This function will setup the field type data
	*
	*  @type	function
	*  @date	5/03/2014
	*  @since	5.0.0
	*
	*  @param	n/a
	*  @return	n/a
	*/
	
	function __construct() {
		
		/*
		*  name (string) Single word, no spaces. Underscores allowed
		*/
		
		$this->name = 'code_area';
		
		
		/*
		*  label (string) Multiple words, can include spaces, visible when selecting a field type
		*/
		
		$this->label = __('Code Area', 'acf');
		
		
		/*
		*  category (string) basic | content | choice | relational | jquery | layout | CUSTOM GROUP NAME
		*/
		
		$this->category = 'content';
		
		
		/*
		*  defaults (array) Array of default settings which are merged into the field object. These are used later in settings
		*/
		
		$this->defaults = array();
		
		
		/*
		*  l10n (array) Array of strings that are used in JavaScript. This allows JS strings to be translated in PHP and loaded via:
		*  var message = acf._e('code_area', 'error');
		*/
		
		$this->l10n = array();
		
				
		// do not delete!
    	parent::__construct();
    	
	}
	
	
	/*
	*  render_field_settings()
	*
	*  Create extra settings for your field. These are visible when editing a field
	*
	*  @type	action
	*  @since	3.6
	*  @date	23/01/13
	*
	*  @param	$field (array) the $field being edited
	*  @return	n/a
	*/
	
	function render_field_settings( $field ) {
		
		/*
		*  acf_render_field_setting
		*
		*  This function will create a setting for your field. Simply pass the $field parameter and an array of field settings.
		*  The array of settings does not require a `value` or `prefix`; These settings are found from the $field array.
		*
		*  More than one setting can be added by copy/paste the above code.
		*  Please note that you must also have a matching $defaults value for the field name (font_size)
		*/
		
		acf_render_field_setting( $field, array(
			'label'			=> __('Language','acf'),
			'instructions'	=> __('','acf-code_area'),
			'type'			=> 'radio',
			'name'			=> 'language',
			'layout' 		=> 'vertical',
			'choices'		=> array(
				'Plain' 			=> __('Plain', 'acf'),
				'css' 			=> __('CSS', 'acf'),
				'javascript' 	=> __('Javascript', 'acf'),
				'htmlmixed' 	=> __('HTML', 'acf'),
				'php' 			=> __('PHP', 'acf')
			)
		));

		acf_render_field_setting( $field, array(
			'label'			=> __('Theme','acf'),
			'instructions'	=> __("Set a theme for the editor (<a href=\"http://codemirror.net/demo/theme.html\" target=\"_blank\">Preview Here</a>) ",'acf'),
			'type'			=> 'select',
			'name'			=> 'theme',
			'choices'		=> array(
				'default'			=>	__("Default",'acf'),
				'3024-day'			=> __('3024 Day', 'acf'),
				'3024-night'		=> __('3024 Night', 'acf'),
				'ambiance'			=>	__("Ambiance",'acf'),
				'base16-dark'		=> __('Base16 Dark', 'acf'),
				'base16-light'		=> __('Base16 Light', 'acf'),
				'blackboard'		=>	__("Blackboard",'acf'),
				'cobalt'				=>	__("Cobalt",'acf'),
				'eclipse'			=>	__("Eclipse",'acf'),
				'elegant'			=>	__("Elegant",'acf'),
				'erlang-dark'		=>	__("Erlang Dark",'acf'),
				'lesser-dark'		=>	__("Lesser Dark",'acf'),
				'mbo'				=> __('Mbo', 'acf'),
				'mdn-like'			=> __('MDN Like', 'acf'),
				'midnight'			=>	__("Midnight",'acf'),
				'monokai'			=>	__("Monokai",'acf'),
				'neat'				=>	__("Neat",'acf'),
				'neo'				=> __('Neo', 'acf'),
				'night'				=>	__("Night",'acf'),
				'paraiso-dark'		=> __('Paraiso Dark', 'acf'),
				'paraiso-light'		=> __('Paraiso Light', 'acf'),
				'pastel-on-dark' 	=>	__('Pastel on Dark', 'acf'),
				'rubyblue'			=>	__("Rubyblue",'acf'),
				'solarized-dark'	=>	__("Solarized Dark",'acf'),
				'solarized-light'	=>	__("Solarized Light",'acf'),
				'the-matrix'		=>	__('The Matrix', 'acf'),
				'tomorrow-night-eighties'	=> __('Tomorrow Night Eighties', 'acf'),
				'twilight'			=>	__("Twilight",'acf'),
				'vibrant-ink'		=>	__("Vibrant Ink",'acf'),
				'xq-dark'			=>	__("XQ Dark",'acf'),
				'xq-light'			=>	__("XQ Light",'acf')
			)	
		));

	}
	
	
	
	/*
	*  render_field()
	*
	*  Create the HTML interface for your field
	*
	*  @param	$field (array) the $field being rendered
	*
	*  @type	action
	*  @since	3.6
	*  @date	23/01/13
	*
	*  @param	$field (array) the $field being edited
	*  @return	n/a
	*/
	
	function render_field( $field ) {

		$dir = plugin_dir_url( __FILE__ );
		
		$field['value'] = esc_textarea($field['value']);

		$language = '';
		switch($field["language"]){
			case 'plain':
				$language = 'Plain';
				break;
			case 'css':
				$language = 'CSS';
				break;
			case 'javascript':
				$language = 'Javascript';
				break;
			case 'htmlmixed':
				$language = 'HTML';
				break;
			case 'php':
				$language = 'PHP';
				break;
		}

		echo '<textarea id="' . $field['id'] . '" rows="4" class="' . $field['class'] . ' cm-complete-flag" name="' . $field['name'] . '" >' . $field['value'] . '</textarea>';
		echo '<p style="margin-bottom:0;"><small>You are writing '.$language.' code.</small></p>';

		/*
			The two solarized themes don't have separate css files, just one and two class names. Quick hack to set these up correctly.
		*/
		if( $field['theme'] == 'solarized-light' ) {
			$css_file = 'solarized';
			$theme_name = 'solarized light';
		} elseif ( $field['theme'] == 'solarized-dark' ) {
			$css_file = 'solarized';
			$theme_name = 'solarized dark';
		} else {
			$css_file = $field['theme'];
			$theme_name = $field['theme'];
		}

  		?>

		<link rel="stylesheet" href="<?php echo $dir; ?>css/theme/<?php echo $css_file; ?>.css">
		<script>
			jQuery(document).ready(function($){
				$('.cm-complete-flag').each(function(){
					var $this = $(this);
					var id = $this.attr("id");
					console.log( id );
					if (id.indexOf("acfcloneindex") == -1 ){
							CodeMirror.fromTextArea($this[0], {
							lineNumbers: true,
							tabmode: 'indent',
							mode: '<?= $field["language"];?>',
							theme: '<?= $field["theme"];?>'
						});
						$this.removeClass("cm-complete-flag");
					}
				});
			});
	  	</script>

		<?php
	}
	
		
	/*
	*  input_admin_enqueue_scripts()
	*
	*  This action is called in the admin_enqueue_scripts action on the edit screen where your field is created.
	*  Use this action to add CSS + JavaScript to assist your render_field() action.
	*
	*  @type	action (admin_enqueue_scripts)
	*  @since	3.6
	*  @date	23/01/13
	*
	*  @param	n/a
	*  @return	n/a
	*/

	
	
	function input_admin_enqueue_scripts() {
		
		$dir = plugin_dir_url( __FILE__ );
		
		wp_register_script( 'acf-input-code_area', "{$dir}js/input.js" );

		// register acf scripts
		wp_register_script( 'acf-input-code_area-code_mirror_js', "{$dir}js/codemirror.js", array('acf-input') );
		wp_register_script( 'acf-input-code_area-code_mirror_mode_js', "{$dir}js/mode/javascript.js", array('acf-input') );
		wp_register_script( 'acf-input-code_area-code_mirror_mode_css', "{$dir}js/mode/css.js", array('acf-input') );
		wp_register_style( 'acf-input-code_area-code_mirror_css', "{$dir}css/codemirror.css", array('acf-input') ); 
		wp_register_script( 'acf-input-code_area-code_mirror_mode_html', "{$dir}js/mode/htmlmixed.js", array('acf-input') );
		wp_register_script( 'acf-input-code_area-code_mirror_mode_xml', "{$dir}js/mode/xml.js", array('acf-input') );
		wp_register_script( 'acf-input-code_area-code_mirror_mode_php', "{$dir}js/mode/php.js", array('acf-input') );
		wp_register_script( 'acf-input-code_area-code_mirror_mode_clike', "{$dir}js/mode/clike.js", array('acf-input') );

		
		// scripts
		wp_enqueue_script(array(
			'acf-input-code_area-code_mirror_js',
			'acf-input-code_area-code_mirror_mode_js',	
			'acf-input-code_area-code_mirror_mode_css',
			'acf-input-code_area-code_mirror_mode_html',
			'acf-input-code_area-code_mirror_mode_xml',
			'acf-input-code_area-code_mirror_mode_php',
			'acf-input-code_area-code_mirror_mode_clike',
		));

		// styles
		wp_enqueue_style(array(
			'acf-input-code_area-code_mirror_css',	
		));	
		
	}
	
	
	
	
	/*
	*  input_admin_head()
	*
	*  This action is called in the admin_head action on the edit screen where your field is created.
	*  Use this action to add CSS and JavaScript to assist your render_field() action.
	*
	*  @type	action (admin_head)
	*  @since	3.6
	*  @date	23/01/13
	*
	*  @param	n/a
	*  @return	n/a
	*/

	/*
		
	function input_admin_head() {
	
		
		
	}
	
	*/
	
	
	/*
   	*  input_form_data()
   	*
   	*  This function is called once on the 'input' page between the head and footer
   	*  There are 2 situations where ACF did not load during the 'acf/input_admin_enqueue_scripts' and 
   	*  'acf/input_admin_head' actions because ACF did not know it was going to be used. These situations are
   	*  seen on comments / user edit forms on the front end. This function will always be called, and includes
   	*  $args that related to the current screen such as $args['post_id']
   	*
   	*  @type	function
   	*  @date	6/03/2014
   	*  @since	5.0.0
   	*
   	*  @param	$args (array)
   	*  @return	n/a
   	*/
   	
   	/*
   	
   	function input_form_data( $args ) {
	   	
		
	
   	}
   	
   	*/
	
	
	/*
	*  input_admin_footer()
	*
	*  This action is called in the admin_footer action on the edit screen where your field is created.
	*  Use this action to add CSS and JavaScript to assist your render_field() action.
	*
	*  @type	action (admin_footer)
	*  @since	3.6
	*  @date	23/01/13
	*
	*  @param	n/a
	*  @return	n/a
	*/

	/*
		
	function input_admin_footer() {
	
		
		
	}
	
	*/
	
	
	/*
	*  field_group_admin_enqueue_scripts()
	*
	*  This action is called in the admin_enqueue_scripts action on the edit screen where your field is edited.
	*  Use this action to add CSS + JavaScript to assist your render_field_options() action.
	*
	*  @type	action (admin_enqueue_scripts)
	*  @since	3.6
	*  @date	23/01/13
	*
	*  @param	n/a
	*  @return	n/a
	*/

	/*
	
	function field_group_admin_enqueue_scripts() {
		
	}
	
	*/

	
	/*
	*  field_group_admin_head()
	*
	*  This action is called in the admin_head action on the edit screen where your field is edited.
	*  Use this action to add CSS and JavaScript to assist your render_field_options() action.
	*
	*  @type	action (admin_head)
	*  @since	3.6
	*  @date	23/01/13
	*
	*  @param	n/a
	*  @return	n/a
	*/

	/*
	
	function field_group_admin_head() {
	
	}
	
	*/


	/*
	*  load_value()
	*
	*  This filter is applied to the $value after it is loaded from the db
	*
	*  @type	filter
	*  @since	3.6
	*  @date	23/01/13
	*
	*  @param	$value (mixed) the value found in the database
	*  @param	$post_id (mixed) the $post_id from which the value was loaded
	*  @param	$field (array) the field array holding all the field options
	*  @return	$value
	*/
	
	/*
	
	function load_value( $value, $post_id, $field ) {
		
		return $value;
		
	}
	
	*/
	
	
	/*
	*  update_value()
	*
	*  This filter is applied to the $value before it is saved in the db
	*
	*  @type	filter
	*  @since	3.6
	*  @date	23/01/13
	*
	*  @param	$value (mixed) the value found in the database
	*  @param	$post_id (mixed) the $post_id from which the value was loaded
	*  @param	$field (array) the field array holding all the field options
	*  @return	$value
	*/
	
	/*
	
	function update_value( $value, $post_id, $field ) {
		
		return $value;
		
	}
	
	*/
	
	
	/*
	*  format_value()
	*
	*  This filter is appied to the $value after it is loaded from the db and before it is returned to the template
	*
	*  @type	filter
	*  @since	3.6
	*  @date	23/01/13
	*
	*  @param	$value (mixed) the value which was loaded from the database
	*  @param	$post_id (mixed) the $post_id from which the value was loaded
	*  @param	$field (array) the field array holding all the field options
	*
	*  @return	$value (mixed) the modified value
	*/
		
	
	
	function format_value( $value, $post_id, $field ) {
		
		switch($field["language"]){
			case 'plain':
				return $value;
				break;
			case 'css':
				return '<style>'.$value.'</style>';
				break;
			case 'javascript':
				return '<script>'.$value.'</script>';
				break;
			case 'htmlmixed':
				return nl2br($value);
				break;
			case 'php':
				return eval($value);
				break;
			default:
				return $value;
		}

		return $value;

	}
	
	
	
	
	/*
	*  validate_value()
	*
	*  This filter is used to perform validation on the value prior to saving.
	*  All values are validated regardless of the field's required setting. This allows you to validate and return
	*  messages to the user if the value is not correct
	*
	*  @type	filter
	*  @date	11/02/2014
	*  @since	5.0.0
	*
	*  @param	$valid (boolean) validation status based on the value and the field's required setting
	*  @param	$value (mixed) the $_POST value
	*  @param	$field (array) the field array holding all the field options
	*  @param	$input (string) the corresponding input name for $_POST value
	*  @return	$valid
	*/
	
	/*
	
	function validate_value( $valid, $value, $field, $input ){
		
		// Basic usage
		if( $value < $field['custom_minimum_setting'] )
		{
			$valid = false;
		}
		
		
		// Advanced usage
		if( $value < $field['custom_minimum_setting'] )
		{
			$valid = __('The value is too little!','acf-code_area'),
		}
		
		
		// return
		return $valid;
		
	}
	
	*/
	
	
	/*
	*  delete_value()
	*
	*  This action is fired after a value has been deleted from the db.
	*  Please note that saving a blank value is treated as an update, not a delete
	*
	*  @type	action
	*  @date	6/03/2014
	*  @since	5.0.0
	*
	*  @param	$post_id (mixed) the $post_id from which the value was deleted
	*  @param	$key (string) the $meta_key which the value was deleted
	*  @return	n/a
	*/
	
	/*
	
	function delete_value( $post_id, $key ) {
		
		
		
	}
	
	*/
	
	
	/*
	*  load_field()
	*
	*  This filter is applied to the $field after it is loaded from the database
	*
	*  @type	filter
	*  @date	23/01/2013
	*  @since	3.6.0	
	*
	*  @param	$field (array) the field array holding all the field options
	*  @return	$field
	*/
	
	/*
	
	function load_field( $field ) {
		
		return $field;
		
	}	
	
	*/
	
	
	/*
	*  update_field()
	*
	*  This filter is applied to the $field before it is saved to the database
	*
	*  @type	filter
	*  @date	23/01/2013
	*  @since	3.6.0
	*
	*  @param	$field (array) the field array holding all the field options
	*  @return	$field
	*/
	
	/*
	
	function update_field( $field ) {
		
		return $field;
		
	}	
	
	*/
	
	
	/*
	*  delete_field()
	*
	*  This action is fired after a field is deleted from the database
	*
	*  @type	action
	*  @date	11/02/2014
	*  @since	5.0.0
	*
	*  @param	$field (array) the field array holding all the field options
	*  @return	n/a
	*/
	
	/*
	
	function delete_field( $field ) {
		
		
		
	}	
	
	*/
	
	
}


// create field
new acf_field_code_area();

?>
