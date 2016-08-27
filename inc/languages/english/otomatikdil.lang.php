<?php

$l['otomatikdil_plugin_name'] = "Auto Language Switcher";

$l['otomatikdil_plugin_desc'] = "This plugin change forum's language according to the user's browser language.";

$l['otomatikdil_try'] = "<hr>Test it: To understand the plugin working correctly you can use the <a href=\"https://chrome.google.com/webstore/detail/quick-language-switcher/pmjbhfmaphnpbehdanbjphdcniaelfie\" target=\"_blank\">Google Chrome extension called Quick Language Switcher</a>. Don't forget you must clear your cookies before the test.";

$l['otomatikdil_settings_url'] =  "<hr>If you upload new language pack you should update plugin settings. You can use <a href=\"{2}\">plugin auto creator</a> or you can update manually with <a href=\"{1}\">plugin settings</a> (advanced).";

$l['otomatikdil_caller_not_found'] = "<hr><strong>Warning!</strong> (<i>If plugin working correctly please ignore this warning.</i>)</br> Looks like function caller has been removed from global.php. If you changed or updated global.php (so, if Auto Language Switcher function caller has been removed) you must add caller. <a href=\"{1}\">Click here</a> for add caller. If it does not work visit <a href = \"https://github.com/halilselcuk/MyBB-Auto-Language-Switcher-Plugin/wiki\" target = \"_blank\" >Wiki</a>.";;

$l['otomatikdil_pl_missing'] = "The selected plugin could not be installed because <a href=\"https://github.com/frostschutz/MyBB-PluginLibrary\">PluginLibrary</a> is missing.";

$l['otomatikdil_pl_old'] = "The selected plugin could not be installed because <a href=\"https://github.com/frostschutz/MyBB-PluginLibrary\">PluginLibrary</a> is too old.";

$l['otomatikdil_settings'] = "Auto Language Switcher Settings";

$l['otomatikdil_settings_desc'] = "Add languages for auto switch.";

$l['otomatikdil_langs'] = "Languages:";

$l['otomatikdil_langs_desc'] = "You can add new languages using this format: <i>Language Code</i> = <i>Language Name</i>, 
								<br> <i><a href=\"http://www.w3schools.com/tags/ref_language_codes.asp\">Language Code</a></i>: It's sending by browser. Plugin only uses the first two characters. This must be only two charecters.(Plugin's auto creator is using language pack's \$langinfo['htmllang'] variable.) So it may be wrong, if you have any problem with that try to change this code.
								<br><i>Language Name</i>:This is language pack file name. You can find your language packs on MYBB_ROOT/inc/languages (Plugin auto creator using language pack file names).
								<br>Note: You can find auto creator in the plugin manager.";

$l['otomatikdil_global_edit_success'] = "global.php edited successfuly.";

$l['otomatikdil_global_edit_fail'] = "global.php editing fail. You can edit global.php yourself. Add this code: if(function_exists(otodil)) otodil();  Under this code: \$mybb->post_code = generate_post_check();";

$l['otomatikdil_update_lang_list_success'] = "Operation successful. If you have any problem try manually update.";

$l['otomatikdil_update_lang_list_fail'] = "Something went wrong.";