<?php
/*
Plugin Name: BP Group CSS
Plugin URI: http://buddypress.org/community/groups/buddypress-group-css/
Description: Allows a Buddypress Group administrator to customise their group with CSS.
Author: Jaco Gerber
Version: 0.8.8
License: (Groupcss: GNU General Public License 2.0 (GPL) http://www.gnu.org/licenses/gpl.html)
Site Wide Only: true
*/
if ( !defined( 'BP_GROUP_CSS' ) )
  define ( 'BP_GROUP_CSS', 'groupcss' );

function bp_group_css_init() {
	bp_group_css_wrapper();
}

if ( defined( 'BP_VERSION' ) )
	bp_group_css_wrapper();
else
	add_action( 'bp_init', 'bp_group_css_init' );

require(dirname(__FILE__) . "/bp-group-css-admin.php");

function group_css_display() {
	global $bp;
	$groupid = $bp->groups->current_group->id;
	if ($groupid) {
	$group_css = groups_get_groupmeta ( $groupid , 'group_user_css' );
		echo("<style type=\"text/css\">\n" . $group_css . "\n</style><div id=\"grouppreviewmanual\"></div><div id=\"groupusercss\"></div>");
	}
}

function add_group_custom_stylesheet() {
	global $bp;
	$group_id = $bp->groups->current_group->id;
	$group_user_css_url = groups_get_groupmeta ( $group_id , 'group_user_css_url' );
	$group_user_css_theme =   WP_PLUGIN_URL . '/buddypress-group-css/themes/' .  groups_get_groupmeta ( $group_id , 'group_user_css_theme' ) . "/style.css";
	$group_user_css_palette = split(",", groups_get_groupmeta ( $group_id , 'group_user_palette' ));
	$group_user_css_theme_use = groups_get_groupmeta ( $group_id , 'group_user_css_theme_use' );	
	$group_user_css_manual_use = groups_get_groupmeta ( $group_id , 'group_user_css_manual_use' );	

	if ( $group_user_css_theme_use != "1") {
		$group_user_css_theme = "about:blank";
	}
    		wp_register_style('groupcsstheme', $group_user_css_theme);
		wp_enqueue_style('groupcsstheme');

	if ( get_option('group-css-enablemanual') == "1" && $group_user_css_manual_use == "1") {
		wp_register_style('groupcssmanual', WP_PLUGIN_URL . "/buddypress-group-css/manualtweaker/style.php?c01=" . $group_user_css_palette[0] . "&c02=" . $group_user_css_palette[1] . "&c03=" . $group_user_css_palette[2] . "&c04=" . $group_user_css_palette[3] . "&c05=" . $group_user_css_palette[4] . "&c06=" . $group_user_css_palette[5] . "&c07=" . $group_user_css_palette[6] . "&c08=" . $group_user_css_palette[7] . "&c09=" . $group_user_css_palette[8] . "&c10=" . $group_user_css_palette[9] . "&c11=" . $group_user_css_palette[10] . "&c12=" . $group_user_css_palette[11] . "&c13=" . $group_user_css_palette[12] . "&c14=" . $group_user_css_palette[13] . "&c15=" . $group_user_css_palette[14]  );
		wp_enqueue_style('groupcssmanual');
	}
	
	if ($group_user_css_url && get_option('group-css-enablelinked') == "1")
	{
       	wp_register_style('groupcss', $group_user_css_url);
		wp_enqueue_style('groupcss');
	}

	if (groups_is_user_admin($bp->loggedin_user->id, $bp->groups->current_group->id) || is_site_admin()) {
		wp_register_style('groupcsseditstyle', WP_PLUGIN_URL . "/buddypress-group-css/css/editstyles.css"  );
		wp_enqueue_style('groupcsseditstyle');
	}	

}

function add_group_custom_scripts() {
	wp_register_style('jquerycolorpickercss', WP_PLUGIN_URL . "/buddypress-group-css/manualtweaker/js/colorpicker/css/colorpicker.css");
	wp_enqueue_style('jquerycolorpickercss');
	wp_register_script('jquerycolorpicker', WP_PLUGIN_URL . "/buddypress-group-css/manualtweaker/js/colorpicker/js/colorpicker.js");
	wp_enqueue_script('jquerycolorpicker');
	wp_register_script('jqueryui', WP_PLUGIN_URL . "/buddypress-group-css/manualtweaker/js/jquery.ui.js");
	wp_enqueue_script('jqueryui');
	wp_register_script('jquerydimensions', WP_PLUGIN_URL . "/buddypress-group-css/manualtweaker/js/jquery.dimensions.js");
	wp_enqueue_script('jquerydimensions');
	wp_register_script('jquerytooltip', WP_PLUGIN_URL . "/buddypress-group-css/manualtweaker/js/jquery.tooltip.js");
	wp_enqueue_script('jquerytooltip');
}

function bp_group_css_wrapper() {
	class BP_Group_Css extends BP_Group_Extension {
		var $visibility = 'private';

		var $enable_nav_item = false;
		var $enable_create_step = true;
		var $enable_edit_item = true;

		var $has_caps = false;

		function bp_group_css () {
			global $groups_template;

			$this->name = __( 'Group Custom CSS', 'groupcss' );
			$this->slug = BP_GROUP_CSS;

			$this->nav_item_position = 12;
			$this->create_step_position = 12;

			if ( $this->has_caps == false ) {
				$this->enable_create_step = false;
				$this->enable_edit_step = false;
			}

			if ( get_option('group-css-enablemanual') == "1" ) { 
				add_action('wp_print_styles','add_group_custom_scripts');
			}			
			add_action ('wp_print_styles', 'add_group_custom_stylesheet', 110);
			add_action('wp_footer', 'group_css_display');
		}

		function create_screen () {
			global $bp, $groups_template;
		
			if ( !bp_is_group_creation_step( $this->slug ) )
				return false;
		}

		function create_screen_save () {

			check_admin_referer( 'groups_create_save_' . $this->slug );

			$this->method = 'create';
			$this->save();
		}

		function edit_screen () {
			global $bp, $groups_template;

			if ( !bp_is_group_admin_screen( $this->slug ))
				return false;

			if (!(groups_is_user_admin($bp->loggedin_user->id, $bp->groups->current_group->id) || is_site_admin())) {
				return false;
			}	

			include("bp-group-css-edit.php");

?>

<div class="form-submit" style="margin-top: 40px; clear: both">
	<input type="submit" name="save" value="<?php _e( "Save Changes", 'bp_group_css' ); ?>" />
</div>

<?php 
		wp_nonce_field( 'groups_edit_save_' . $this->slug ); 
		}

		function edit_screen_save () {
			global $bp;

			if ( !isset( $_POST['save'] ) )
				return false;

			check_admin_referer( 'groups_edit_save_' . $this->slug );
			
			$this->method = 'edit';
			$this->save();
		}

		function save() {
			global $bp;

			if ( !$group_id )
				$group_id = $bp->groups->current_group->id;
				
			// set values
			if (isset($_POST['groupcsspresetuse'])) {
				groups_update_groupmeta ( $group_id, 'group_user_css_theme_use', "1");
			} else {
				groups_update_groupmeta ( $group_id, 'group_user_css_theme_use', "");
			}
			if (isset($_POST['groupcssmanualuse'])) {
				groups_update_groupmeta ( $group_id, 'group_user_css_manual_use', "1");
			} else {
				groups_update_groupmeta ( $group_id, 'group_user_css_manual_use', "");
			}
			$new_palette = $_POST["colour_01"] . "," . $_POST["colour_02"] . "," . $_POST["colour_03"] . "," . $_POST["colour_04"] . "," . $_POST["colour_05"] . "," . $_POST["colour_06"] . "," . $_POST["colour_07"] . "," . $_POST["colour_08"] . "," . $_POST["colour_09"] . "," . $_POST["colour_10"] . "," . $_POST["colour_11"] . "," . $_POST["colour_12"] . "," . $_POST["colour_13"] . "," . $_POST["colour_14"] . "," . $_POST["colour_15"]; 
			groups_update_groupmeta ( $group_id, 'group_user_palette', $new_palette);
			$new_css = htmlspecialchars(stripslashes($_POST['usercss'] ), ENT_NOQUOTES);
			groups_update_groupmeta ( $group_id, 'group_user_css', $new_css );
			$new_css_url = $_POST['usercssurl'] ;
			groups_update_groupmeta ( $group_id, 'group_user_css_url', $new_css_url );
			$new_css_theme = $_POST['groupcsspreset'] ;
			groups_update_groupmeta ( $group_id, 'group_user_css_theme', $new_css_theme );

			$redirect_url = bp_get_group_permalink( $bp->groups->current_group ) . 'admin/' . $this->slug;
			bp_core_redirect( $redirect_url );
		}
	}
	bp_register_group_extension( 'BP_Group_Css' );
}

?>
