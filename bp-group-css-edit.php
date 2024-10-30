<script type="text/javascript">
jQuery(document).ready(function() {
	jQuery(".groupcsspreset").click(function() {
		reloadThemeCss();
	});

	addFoldEvents();
});

function reloadThemeCss() {
	if (jQuery('#groupcsspresetuse').is(':checked')) {
		cs = jQuery('input[name=groupcsspreset]:checked').val() ;
		jQuery("#groupcsstheme-css").attr("href","<?php echo(WP_PLUGIN_URL . "/buddypress-group-css/themes/" ); ?>" + cs + "/style.css");
	} else {
		jQuery("#groupcsstheme-css").attr("href","about:blank");
	}
}

function addFoldEvents() {
	jQuery('.themeconfigs h4').click(function() {
	
		if (jQuery(this).next().next().next().css("display") == "block") 
		{
			jQuery(this).find("span.hiderplusminus").html("[ + ] ");
			jQuery(this).next().next().next().hide();
			jQuery(this).next().next().hide();
		} else {
			jQuery(this).find("span.hiderplusminus").html("[ - ] ");
			jQuery(this).next().next().next().show();
			jQuery(this).next().next().show();
		}
	});
	
	jQuery('div.themeconfigs h4').mouseover(function() {
		jQuery(this).css("color","#000000", "background-color", "#bbbbbb");
	});
	jQuery('div.themeconfigs h4').mouseout(function() {
		jQuery(this).css("color","#444444", "background-color", "#eeeeee");
	});
}

function reloadManualCss() {
	if (jQuery('#groupcssmanualuse').is(':checked')) {
		var col01 = jQuery("#colour_01").val();
		var col02 = jQuery("#colour_02").val();
		var col03 = jQuery("#colour_03").val();
		var col04 = jQuery("#colour_04").val();
		var col05 = jQuery("#colour_05").val();
		var col06 = jQuery("#colour_06").val();
		var col07 = jQuery("#colour_07").val();
		var col08 = jQuery("#colour_08").val();
		var col09 = jQuery("#colour_09").val();
		var col10 = jQuery("#colour_10").val();
		var col11 = jQuery("#colour_11").val();
		var col12 = jQuery("#colour_12").val();
		var col13 = jQuery("#colour_13").val();
		var col14 = jQuery("#colour_14").val();
		var col15 = jQuery("#colour_15").val();
		jQuery("#fordevs").val(col01+","+col02+","+col03+","+col04+","+col05+","+col06+","+col07+","+col08+","+col09+","+col10+","+col11+","+col12+","+col13+","+col14+","+col15);
		jQuery('#grouppreviewmanual').load("<?php echo(WP_PLUGIN_URL . "/buddypress-group-css/manualtweaker/style.php?" ); ?>c01="+col01+"&c02="+col02+"&c03="+col03+"&c04="+col04+"&c05="+col05+"&c06="+col06+"&c07="+col07+"&c08="+col08+"&c09="+col09+"&c10="+col10+"&c11="+col11+"&c12="+col12+"&c13="+col13+"&c14="+col14+"&c15="+col15);
	} else {
		jQuery('#groupcssmanual-css').attr('href','about:blank');
		jQuery('#grouppreviewmanual').html('');
	}
}

function initColourPickers() {
	jQuery('.colourpicker').each(function() {
		var bbthiscolour = jQuery(this).val();
		var $this = jQuery(this);
		jQuery(this).css("background",'#'+bbthiscolour);
		jQuery(this).css("color",'#'+bbthiscolour);
		jQuery(this).css("width","20px");
		jQuery(this).css("height","20px");
		jQuery(this).ColorPicker({
			color: '#'+jQuery(this).val(),
			onChange: function (hsb, hex, rgb) {
			$this.css('background', '#' + hex);
			$this.css('color', '#' + hex);
			$this.val(hex);
			},
			onHide: function () {
				reloadManualCss();
			}
		});
	});
}

function destroyColourPickers() {
jQuery('.colourpicker').each(function() {
	jQuery(this).ColorPicker('destroy');
});
}

jQuery(document).ready(function() {

jQuery('#groupcssmanualuse').click(function() {
	reloadManualCss();
});

jQuery('#groupcsspresetuse').click(function() {
	reloadThemeCss();
});

jQuery('.colourpalette li').tooltip({ 
    track: true, 
    delay: 0, 
    showURL: false, 
    bodyHandler: function() { 
        return jQuery(this).attr("tooltiptitle"); 
    },
    fade: 50 
});

	initColourPickers();
	jQuery('#presetcolours').change(function() {
		newColours = jQuery(this).val().split(",");
		jQuery("#colour_01").val(newColours[0]);
		jQuery("#colour_02").val(newColours[1]);
		jQuery("#colour_03").val(newColours[2]);
		jQuery("#colour_04").val(newColours[3]);
		jQuery("#colour_05").val(newColours[4]);
		jQuery("#colour_06").val(newColours[5]);
		jQuery("#colour_07").val(newColours[6]);
		jQuery("#colour_08").val(newColours[7]);
		jQuery("#colour_09").val(newColours[8]);
		jQuery("#colour_10").val(newColours[9]);
		jQuery("#colour_11").val(newColours[10]);
		jQuery("#colour_12").val(newColours[11]);
		jQuery("#colour_13").val(newColours[12]);
		jQuery("#colour_14").val(newColours[13]);
		jQuery("#colour_15").val(newColours[14]);
		destroyColourPickers();
		initColourPickers();
		reloadManualCss();
	});
});

function previewCss() {
	if (jQuery('#updatelive:checked').val() != null) {
 		jQuery("#groupusercss").html("<style type='text/css'>" + jQuery("#usercss").val() + "</style>");
	}
}
</script>
<?php
	$group_id = $bp->groups->current_group->id;
	$group_user_css = groups_get_groupmeta ( $group_id , 'group_user_css' );
	$group_user_css_url = groups_get_groupmeta ( $group_id , 'group_user_css_url' );
	$group_user_css_theme = groups_get_groupmeta ( $group_id , 'group_user_css_theme' );
	$palette_val = groups_get_groupmeta ( $group_id , 'group_user_palette' );
	if ($palette_val == "none" || $palette_val == "") {
		$palette_val = ",,,,,,,,,,,,,,,";
	}
	$group_user_css_palette = split(",", $palette_val);
	$group_user_css_theme_use = groups_get_groupmeta ( $group_id , 'group_user_css_theme_use' );
	$group_user_css_manual_use = groups_get_groupmeta ( $group_id , 'group_user_css_manual_use' );
?>

<h4>Sample page content</h4>
<p>This is an example of what content will look like with your chosen colours.</p>
<ul class="item-list" id="member-list">
	<li>
		<a href="#">
			<img width="50" height="50" class="avatar user-1-avatar" alt="Avatar Image" src="http://www.gravatar.com/avatar/7e9c3847bcc565337697307b2f6a588f?d=wavatar&amp;s=50">	</a>
		<h5><a href="#">Sample user</a></h5>
		<span class="activity">joined 4 weeks ago</span>
			<div class="action">
				<div id="friendship-button-1" class="generic-button friendship-button not_friends"><a class="add" rel="add" id="friend-1" title="Add Friend" href="#">Add Friend</a></div>
		</div>
	</li>
	<li>
		<a href="#">
			<img width="50" height="50" class="avatar user-1-avatar" alt="Avatar Image" src="http://www.gravatar.com/avatar/7e9c3847bcc565337697307b2f6a588f?d=wavatar&amp;s=50">	</a>
		<h5><a href="#">Another user</a></h5>
		<span class="activity">joined 2 weeks ago</span>
			<div class="action">
				<div id="friendship-button-1" class="generic-button friendship-button not_friends"><a class="add" rel="add" id="friend-1" title="Add Friend" href="#">Add Friend</a></div>
		</div>
	</li>
</ul>

<p>&nbsp;</p>

<div class="themeconfigs">

<?php if ( get_option('group-css-enablethemes') == "1" ) { ?>
<h4 class="hider clearfix"><span class="hiderplusminus">[ + ] </span><?php _e( "Themes", 'bp_group_css' ); ?></h4>
<div class="clearfix intro">
<?php _e( "You can choose from one of these pre-designed themes. Click for instant previews.", 'bp_group_css' ); ?>
</div>
<div class="intro2">
<label><input type="checkbox" autocomplete="off" name="groupcsspresetuse" id="groupcsspresetuse" value="1"
	<?php if ($group_user_css_theme_use == "1" ) { echo("checked='checked'"); }  ?>  /> <?php _e( "Use theme", 'bp_group_css' ); ?></label>
</div>

<div class="configcontent clearfix">

<ul class="swatches clearfix">
<?php
if ($handle = opendir(WP_PLUGIN_DIR . '/buddypress-group-css/themes/')) {
while (false !== ($file = readdir($handle))) {
if (strlen($file) > 2) {

$theme_file = WP_PLUGIN_DIR . '/buddypress-group-css/themes/' . $file . "/style.css";
$preview_file = WP_PLUGIN_DIR . '/buddypress-group-css/themes/' . $file . "/preview.png";
$theme_data = get_theme_data($theme_file);

$name = $theme_data['Name'];
?>
	<li><h6><input type="radio" name="groupcsspreset" class="groupcsspreset" value="<?php echo($file);?>"
		<?php if ($group_user_css_theme == $file) { echo("checked='checked'"); }  ?> /> <?php echo($name); ?></h6>
		<?php if (file_exists($preview_file)) { ?>
	<img src="<?php echo(WP_PLUGIN_URL); ?>/buddypress-group-css/themes/<?php echo($file); ?>/preview.png" align="bottom" /><?php } ?></li>
<?php
}
}
    closedir($handle);
}
?>
</ul>
</div>
<?php
} ?>

<?php if ( get_option('group-css-enablemanual') == "1" ) { ?>

<h4 class="hider clearfix"><span class="hiderplusminus">[ + ] </span><?php _e( "Colour Palette", 'bp_group_css' ); ?></h4>
<div class="clearfix intro">
<?php _e( "Here you can tweak individual colours, or select from a preset and then tweak it further.", 'bp_group_css' ); ?>
</div>
<div class="clearfix intro2">
<label><input type="checkbox" autocomplete="off" name="groupcssmanualuse" id="groupcssmanualuse" value="1"
	<?php if ($group_user_css_manual_use == "1" ) { echo("checked='checked'"); }  ?>  /> <?php _e( "Use custom colors", 'bp_group_css' ); ?></label>
</div>

<div class="configcontent clearfix">

<div id="colourselector clearfix">

<div class="colourgroup">
<h5>Basic</h5>
<ul class="colourpalette">
<li tooltiptitle="Body background colour"><input type="text" class="colourpicker" id="colour_01" name="colour_01" value="<?php echo($group_user_css_palette[0]); ?>" /></li>
<li tooltiptitle="Content background"><input type="text" class="colourpicker" id="colour_03" name="colour_03" value="<?php echo($group_user_css_palette[2]); ?>" /></li>
<li tooltiptitle="Generic text colour"><input type="text" class="colourpicker" id="colour_02" name="colour_02" value="<?php echo($group_user_css_palette[1]); ?>" /></li>
<li tooltiptitle="Link colours"><input type="text" class="colourpicker" id="colour_10" name="colour_10" value="<?php echo($group_user_css_palette[9]); ?>" /></li>
</ul>
</div>

<div class="colourgroup">
<h5>Navigation</h5>
<ul class="colourpalette">
<li tooltiptitle="Group tabs background"><input type="text" class="colourpicker" id="colour_07" name="colour_07" value="<?php echo($group_user_css_palette[6]); ?>" /></li>
<li tooltiptitle="Subnav background colour"><input type="text" class="colourpicker" id="colour_08" name="colour_08" value="<?php echo($group_user_css_palette[7]); ?>" /></li>
<li tooltiptitle="Selected tab background colour"><input type="text" class="colourpicker" id="colour_09" name="colour_09" value="<?php echo($group_user_css_palette[8]); ?>" /></li>
</ul>
</div>

<div class="colourgroup">
<h5>Sidebar</h5>
<ul class="colourpalette">
<li tooltiptitle="Sidebar background"><input type="text" class="colourpicker" id="colour_04" name="colour_04" value="<?php echo($group_user_css_palette[3]); ?>" /></li>
<li tooltiptitle="Widget title background"><input type="text" class="colourpicker" id="colour_05" name="colour_05" value="<?php echo($group_user_css_palette[4]); ?>" /></li>
<li tooltiptitle="Widget title text"><input type="text" class="colourpicker" id="colour_14" name="colour_14" value="<?php echo($group_user_css_palette[13]); ?>" /></li>
<li tooltiptitle="Widget links background"><input type="text" class="colourpicker" id="colour_06" name="colour_06" value="<?php echo($group_user_css_palette[5]); ?>" /></li>
</ul>
</div>

<div class="colourgroup">
<h5>Activity</h5>
<ul class="colourpalette">
<li tooltiptitle="Activity and messages background"><input type="text" class="colourpicker" id="colour_11" name="colour_11" value="<?php echo($group_user_css_palette[10]); ?>" /></li>
<li tooltiptitle="Activity and messages shadow"><input type="text" class="colourpicker" id="colour_12" name="colour_12" value="<?php echo($group_user_css_palette[11]); ?>" /></li>
<li tooltiptitle="Activity and messages text"><input type="text" class="colourpicker" id="colour_13" name="colour_13" value="<?php echo($group_user_css_palette[12]); ?>" /></li>
</ul>
</div>

<div class="colourgroup">
<h5>Other</h5>
<ul class="colourpalette">
<li tooltiptitle="Lines"><input type="text" class="colourpicker" id="colour_15" name="colour_15" value="<?php echo($group_user_css_palette[14]); ?>" /></li>
</ul>
</div>

<div class="colourgroup last">
<h5>Load Presets</h5>
<select id="presetcolours" style="padding: 0px">
<option value="none">-</option>
<?php 
$colourranges = get_option('group-css-colourranges');
$colourranges_lines = split("\n", $colourranges);
for ($i=0; $i < count($colourranges_lines); $i++) {
$colourrangesplit = split(":",$colourranges_lines[$i]);
$colourrangename = $colourrangesplit[0];
$colourrangevalue = $colourrangesplit[1];
echo('<option value="' . $colourrangevalue . '">' . $colourrangename . '</option>');
}
?>
</select>

<br/><input type="text" id="fordevs">
</div>

</div>


</div>
<?php } ?>

<?php if ( get_option('group-css-enablelinked') == "1" || get_option('group-css-enableinline') == "1") { ?>
<h4 class="hider clearfix"><span class="hiderplusminus">[ + ] </span><?php _e( "Advanced", 'bp_group_css' ); ?></h4>
<div class="clearfix intro">
<?php _e( "For users who can use CSS. No need to use &lt;style&gt; tags.", 'bp_group_css' ); ?>
</div>
<div class="clearfix intro2"></div>
<div class="configcontent clearfix">
<?php if ( get_option('group-css-enablelinked') == "1" ) { ?>
<label for="usercssurl"><?php _e( "External Custom CSS URL", 'bp_group_css' ); ?></label>
<input type="text" id="usercssurl" name="usercssurl" value="<?php echo($group_user_css_url); ?>" />
<?php } ?>

<?php if ( get_option('group-css-enableinline') == "1" ) { ?>
<label for="usercss"><?php _e( "Inline Custom CSS", 'bp_group_css' ); ?></label>
<textarea name="usercss" id="usercss" onkeyup="if (typeof(previewTimer)!='undefined') { clearTimeout(previewTimer) }; previewTimer= setTimeout('previewCss()',1500);"><?php echo( htmlspecialchars(stripslashes($group_user_css), ENT_NOQUOTES) ); ?></textarea>
<label><input type="checkbox" checked="checked" id="updatelive" value="do it!"/> <?php _e( "Preview as you type", 'bp_group_css' ); ?></label>
<?php } ?>
</div>
<?php } ?>

</div>