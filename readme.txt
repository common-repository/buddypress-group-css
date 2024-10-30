=== Buddypress Group CSS ===
Contributors: rustybroomhandle
Donate link: http://buddypress.org/community/groups/buddypress-group-css/donate/
Tags: buddypress, groups, css
Requires at least: 2.9.2 (BP 1.2.x)
Tested up to: 3.0.1
Stable tag: 0.8.8

== Description ==
Allows a Buddypress group administrator to customise their group with CSS via the "Group Custom CSS" tab under the group's Admin page. Also supports preset themes.

NOTE: Even though this plugin can just be dropped in and used on your site, the css in the code is only really garaunteed to work with the default Buddypress theme, and it is assumed that you as a site builder will customise it to fit your site's needs. 

== Installation ==
Install via site dashboard, or download and unzip contents into wp-content/plugins/, then activate plugin in the dashboard. Preset themes are stored in a themes/ subdirectory of the plugin. Each theme requires a style.css file, and optionally a file named preview.png - Please refer to the included examples for format guidelines.

NOTE: There's a slight usage thing I need to fix, but for the preset pallettes to show up, you must go into the Buddypress Group CSS section in your Site Dashboard at least once and hit Save Changes so that the presets I have provided will get saved to the database.

== Frequently Asked Questions ==

= Why do I see nothing but a Save button on the Group's Admin page? =

Each of the four CSS modules (Themes, Colours, Linked CSS, Inline CSS) can be enabled or disabled from your site's Dashboard. Look for "Group CSS" under Settings. 

A group admin, in turn, can then also disable/enable each of these themselves per group.

= How do I add or edit themes? =

Group themes are stored in wp-content/plugins/buddypress-group-css/themes/ and work in a fashion similar to Wordpress themes. Each theme goes in a subdirectory of its own and must contain a file called "style.css". The header of this file must contain the name of the theme in a comment like this:
/*
Theme Name: Superduperawesometheme
*/

= How do I customise the colour tweaker for my site? =

There are two parts to this. First is the template, wp-content/plugins/buddypress-group-css/manualtweaker/template.css - a css like any other, except that the colour values are unique tags in the format #BP_COL_01 through #BP_COL_15. These tags get replaced with the 15 editable colours in the editor. 

Presets can be created for the colour editor to help users get started. These can be edited in the Dashboard, and go one per line in the format:

Theme name:000000,000000,000000,000000,000000,000000,000000,000000,000000,000000,000000,000000,000000,000000,000000

(the 000000s of course correspond to the 15 editable colours, and are substituted in the template in that order)

HINT: There's a text field just underneath the colour preset dropdown that you can't see. It contains the complete range of hex values as you edit. You can copy/paste these values in to the colour presets box to aid your colour theme designing.

= Can I use more than one module together? =

You can. All depends on how you intend to use it. You can, for example, make all your preset themes purely change the images - header, background, whatever - and then use the manual tweaker alone for colours. 

= I edit colours like a madperson, but don't see any changes on the page! =

That could either mean that a group admin has disabled a particular feature, or the CSS template is not tailored for your site's theme. The included ones should mostly work, going on the assumption that most theme designers would stick to the class names used in the BP default theme.

= lolwut? =

absolutely

== Screenshots ==
1. A site admin can choose which of the three custom CSS methods are available to group admins.
2. The preset themes are managed through a themes directory that works in a similar way to the Wordpress themes.
3. Orange, yum!
4. Style sheets cascade in the order they are presented on-screen. Preset theme inherits from site theme. External CSS inherits from preset theme and site theme. Inline CSS iherits from all of the above.
5. Customisation options now arranged into sections
6. The new colour editor
7. Ooooh, shiny!

== Changelog ==
= 0.8.9 =
- Another bugfix release
- Fixed admin menu again. Was causing some issues on some installations
- Moved admin php into separate include file

= 0.8.6 =
- Fixed some IE Javascript bugs
- Moved dashboard admin menu to be under Buddypress

= 0.8.5 =
- Added the new colour picker thing
- Cleaned up code just a little bit (loads more required)
- Grouped customisation methods into sections

= 0.8.1 =
Small security fix. Line to check valid group admin was missing.
 
= 0.8 =
- A preset themes option now added
- Admin panel to enable which options are available to group admins
- Loads of bug fixes
- Prolly a few new bugs. Time to get it ready for a version 1.0, weeee!

= 0.5 =
- Ability to link an external CSS file
- Tickbox to toggle real-time previewing of css while you type
- Tidied up the code a bit
- Made the html on the edit screen stylistically comply with the standard Buddypress edit screens a bit more

= 0.2 =
Fixed some small bugs that caused activation to fail. 
