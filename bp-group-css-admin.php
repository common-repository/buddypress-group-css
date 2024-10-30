<?php

function group_css_add_admin_menu() {
	add_submenu_page( 'bp-general-settings', __( 'Group CSS Settings', 'bp_group_css' ), __( 'Group CSS Settings', 'bp_group_css' ), 'manage_options', __FILE__, 'group_css_plugin_options' );
}
add_action('admin_menu', 'group_css_add_admin_menu', 15);
	
function group_css_plugin_options() {
if (!current_user_can('manage_options'))  {
    wp_die( __('You do not have sufficient permissions to access this page.') );
  }
	$updated = false;

	if( $_POST['action'] == 'update' ) {
		$group_css_enablethemes_post = $_POST[ 'group-css-enablethemes' ];
		$group_css_enablelinked_post = $_POST[ 'group-css-enablelinked' ];
		$group_css_enableinline_post = $_POST[ 'group-css-enableinline' ];
		$group_css_enablemanual_post = $_POST[ 'group-css-enablemanual' ];
		$group_css_colourranges = $_POST[ 'group-css-colourranges' ];
		
		update_option( 'group-css-enablethemes', $group_css_enablethemes_post );
		update_option( 'group-css-enablelinked', $group_css_enablelinked_post );
		update_option( 'group-css-enableinline', $group_css_enableinline_post );
		update_option( 'group-css-enablemanual', $group_css_enablemanual_post );
		update_option( 'group-css-colourranges', $group_css_colourranges );
		
		$updated = true;
	}

	$group_css_enablethemes = get_option('group-css-enablethemes');
	$group_css_enablelinked = get_option('group-css-enablelinked');
	$group_css_enableinline = get_option('group-css-enableinline');
	$group_css_enablemanual = get_option('group-css-enablemanual');
	$group_css_colourranges = get_option('group-css-colourranges');

	// Must find more elegant way of handling these. Might make a site for it. 
	if ($group_css_colourranges == "") {
		$group_css_colourranges = "Earthy:443322,1f1812,665544,776655,887766,6b5e51,42372d,453a30,665544,ebb838,5c2445,aa6845,fdcd4b,000000,3d3b38
Grapes and cheese:150033,e0ab5c,5c2445,aa6845,fdcd4b,000000,150033,150033,5c2445,cf9043,e6b975,a37423,000000,000000,000000
Needs Grecian Formula:ffffff,383838,dddddd,cccccc,bbbbbb,aaaaaa,bdbdbd,c7c7c7,dddddd,5c5c5c,a8a8a8,707070,333333,222222,8c8c8c
Mossy:223322,9ed99e,445544,4a594a,667766,485248,223322,283628,445544,99b8a5,997e3a,7a6020,e7ff33,000000,2a2e2a
Under da sea:386c6f,1e3b3d,608371,cccccc,bbbbbb,aaaaaa,608371,4f6b5d,608371,dde461,acbb6c,7b854b,2f330e,222222,8c8c8c
Gloory:1b1b26,d2ffab,26394c,cccccc,bbbbbb,aaaaaa,28637f,28637f,26394c,a3ff57,acbb6c,7b854b,2f330e,222222,8c8c8c
More Insurance:0b261a,d2ffab,33401c,cccccc,bbbbbb,aaaaaa,28637f,8c322d,33401c,ff5031,ff5031,8c322d,8c322d,222222,000000
Mount Doom:262323,ff8052,3d2828,cccccc,bbbbbb,aaaaaa,28637f,7a392d,3d2828,ff4a08,7a392d,262323,d99a64,222222,262323
Wounded:a66062,5a3f49,ffd8ae,cccccc,bbbbbb,aaaaaa,28637f,da9a87,ffd8ae,5a3f49,da9a87,a66062,704143,222222,5a3f49
Orange:f28705,100900,b28645,cccccc,bbbbbb,aaaaaa,bdbdbd,f28705,b28645,734001,bd8f4f,704e1e,573d18,222222,614723";
update_option( 'group-css-colourranges', $group_css_colourranges );
	}
?>
<div class="wrap" style="position: relative">
<h2><?php _e("Group CSS", 'bp_group_css') ?></h2>

<form method="post" action="<?php echo $_SERVER['REQUEST_URI']?>">
<?php wp_nonce_field('update-options'); ?>

<h4><?php _e( "Allow a group administrator to:", 'bp_group_css' ); ?></h4>
<p><input type="checkbox" name="group-css-enablethemes" value="1" <?php if ($group_css_enablethemes == "1") { echo( 'checked="checked"'); } ?> /> <?php _e( "Use the preset themes", 'bp_group_css' ); ?></p>
<p><input type="checkbox" name="group-css-enablemanual" value="1" <?php if ($group_css_enablemanual == "1") { echo( 'checked="checked"'); } ?> /> <?php _e( "Use the manual style editor", 'bp_group_css' ); ?></p>
<p><?php _e( "Preset colour ranges for manual editor", 'bp_group_css' ); ?>:<br/> <textarea name="group-css-colourranges" style="width: 500px; height: 200px;" wrap="off"><?php echo($group_css_colourranges); ?></textarea></p>
<p><input type="checkbox" name="group-css-enablelinked" value="1" <?php if ($group_css_enablelinked == "1") { echo( 'checked="checked"'); } ?> /> <?php _e( "Link to an external CSS file", 'bp_group_css' ); ?></p>
<p><input type="checkbox" name="group-css-enableinline" value="1" <?php if ($group_css_enableinline == "1") { echo( 'checked="checked"'); } ?> /> <?php _e( "Add inline CSS", 'bp_group_css' ); ?></p>
 
<input type="hidden" name="action" value="update" />
<input type="hidden" name="page_options" value="<?php echo $opt_name ?>" />

<p class="submit">
<input type="submit" class="button-primary" value="<?php _e('Save Changes') ?>" />
</p>

</form>
</div>
<?php
}
?>