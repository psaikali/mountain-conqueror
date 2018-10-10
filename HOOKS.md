# Available hooks

A few actions and filters are available in the Mountain Conqueror theme to let plugin and child-theme developers interact with the this theme logic. They are listed and described in this document.

## Actions

#### inp_mc_before_site_content
Add content before the site content container opening tag (which contains the sidebar and the main content section).

#### inp_mc_after_site_content
Add content after the site content container closing tag (which contains the sidebar and the main content section). Same as `inp_mc_before_footer`.

#### inp_mc_before_masthead
Add content before the sidebar opening tag.

#### inp_mc_after_masthead
Add content after the sidebar closing tag.

#### inp_mc_start_masthead
Add content just after the sidebar opening tag (inside).

#### inp_mc_end_masthead
Add content just before the sidebar closing tag (inside).

#### inp_mc_start_content
Add content just after the main body content container opening tag (inside).

#### inp_mc_end_content
Add content just before the main body content container closing tag (inside).

#### inp_mc_before_footer
Add content before the footer opening tag. Same as `inp_mc_before_site_content`.

#### inp_mc_after_footer
Add content after the footer closing tag.

#### inp_mc_start_footer
Add content just after the footer container opening tag (inside).

#### inp_mc_end_footer
Add content just before the footer container closing tag (inside).

---

## Filters
#### inp_mc_composer_path( string )
Obsolete (trigger too late). See `COMPOSER_AUTOLOADER_PATH` constant below.

#### inp_mc_enable_injection_event_data_in_post( boolean )
Lets you disable the current way of injecting the `Event` data inside the `$post` variable.
_Return a boolean._

#### inp_mc_post_is_a_valid_event( boolean $valid, WP_Post $post )
Lets you decide if a WP_Post is a valid event and if event properties should be access/displayed.
Hook to a property bigger than 10 to bypass the theme current "true-ish" hook.
_Return a boolean to judge if a post is a valid event._

#### inp_mc_event_data_source( Event, WP_Post )
Lets you overwrite the way template has access to Event data/metadata. Use wisely in conjunction with `inp_mc_enable_injection_event_data_in_post` to change the way theme has access to Event data.
_Return a Event object._

#### inp_mc_theme_options_tabs( array( 'tab_slug' => 'tab_title' ) )
Lets you modify the Theme Options tabs. Uses CarbonFields library.
_Return an associative array of tabs._

#### inp_mc_theme_options_fields_tab_{$tab_slug}( array )
Lets you modify/add fields in a Theme Options tab. Uses CarbonFields library.
_Return an array of CarbonFields fields objects._

#### inp_mc_should_use_first_content_image_as_thumbnail( boolean )
Lets you disable the logic that will use, if available, the first image found in $post_content as a featured image.
_Return a boolean to enable/disable this logic._

#### inp_mc_web_font_url( string )
Lets you change the webfonts URL for custom fonts.
_Return a string URL._

#### inp_mc_icon_font_url( string )
Lets you change the webfonts URL for icon fonts.
_Return a string URL._

---

## Constants
#### COMPOSER_AUTOLOADER_PATH
Define this constant to disable the theme composer autoloader.
Required if you are using composer for your whole WordPress installation, where your /vendor directory has a custom location.