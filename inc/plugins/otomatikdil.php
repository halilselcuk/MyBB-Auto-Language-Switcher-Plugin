<?php
/*
Halil Selçuk
http://halil.selçuk.gen.tr
*/
if(!defined("IN_MYBB")) 
{
	die();
}
if(!defined("PLUGINLIBRARY"))
{
    define("PLUGINLIBRARY", MYBB_ROOT."inc/plugins/pluginlibrary.php");
}

$plugins->add_hook("admin_config_plugins_begin", "otomatikdil_yenile");

function otomatikdil_info()
{
	global $mybb, $db;
	$aciklama = "Auto language switcher according to the user's browser language.";
	$sorgu = $db->query("SELECT * FROM ".TABLE_PREFIX."settinggroups WHERE name='otomatikdil'");
	$ayarg = $db->fetch_array($sorgu);
	if($ayarg != null)
	{
		$ayar = "?module=config-settings&action=change&gid=".$ayarg["gid"];
		$yenile = "?module=config-plugins&islem=yenile&my_post_key=".$mybb->post_code;
		$aciklama .= "<hr>If you upload new language pack you should update plugin settings. You can update manually with <a href=\"$ayar\">plugin settings</a> or you can use <a href=\"$yenile\">plugin auto creator</a>.";
	}
	return array
	(
		"name" => "Auto Language Switcher",
		"author" => "Halil Selçuk",
		"website" => "http://halil.selçuk.gen.tr",
		"description" => $aciklama,
		"version" => "1.0",
		"authorsite" => "http://halil.selçuk.gen.tr",
		"compatibility" => "*"
	);
	
}

function otomatikdil_is_installed()
{
    global $settings;
    if(isset($settings['otomatikdil_diller'])) return true;
}

function otomatikdil_install()
{
    if(!file_exists(PLUGINLIBRARY))
    {
        flash_message("The selected plugin could not be installed because <a href=\"http://mods.mybb.com/view/pluginlibrary\">PluginLibrary</a> is missing.", "error");
        admin_redirect("index.php?module=config-plugins");
    }
	
    global $PL;
    $PL or require_once PLUGINLIBRARY;
	
    if($PL->version < 11)
    {
        flash_message("The selected plugin could not be installed because <a href=\"http://mods.mybb.com/view/pluginlibrary\">PluginLibrary</a> is too old.", "error");
        admin_redirect("index.php?module=config-plugins");
    }
	
	$PL->settings(
	"otomatikdil",
	"Auto Language Switcher Settings",
	"Add languages for auto switch.",
	array
		(
			"diller" => 
							array
							(
								"title" => "Languages:",
								"description" => "You can add new languages using this format: <i>Language Code</i> = <i>Language Name</i>, 
								<br> <i><a href=\"http://www.w3schools.com/tags/ref_language_codes.asp\">Language Code</a></i>: It's sending by browser. Plugin only uses the first two characters. This must be only two charecters.(Plugin auto creator using language pack \$langinfo['htmllang'] variable. So it may wrong, if you have problem try change this code.).
								<br><i>Language Name</i>: I think think it's language pack file name. You can see your language packs on MYBB_ROOT/inc/languages (Plugin auto creator using language pack file names).
								<br>Note: You can find auto creator in the plugin manager.
								",
								"optionscode" => "textarea",
								"value" => dilleriolustur()
							)
								
		)
	);
	
}

function otomatikdil_uninstall()
{
	global $PL;
	$PL or require_once PLUGINLIBRARY;
    $PL->settings_delete("otomatikdil");
	
}

function otomatikdil_activate()
{
	global $PL;
	$PL or require_once PLUGINLIBRARY;
	$result = $PL->edit_core
	(
	"otomatikdil", 
	"global.php",
	array
	(
		'search' => 
		array("// Set and load the language"),
		'replace' => "if(function_exists(otodil)) otodil();"
	),
	true
	);
	
}

function otomatikdil_deactivate()
{
	global $PL;
	$PL or require_once MYBB_ROOT."inc/plugins/pluginlibrary.php";
	$result = $PL->edit_core
	(
	"otomatikdil", 
	"global.php",
	array
	(
	),
	true
	);
	
	
}

function otomatikdil_yenile()
{
	global $db, $mybb;
	
    if($mybb->input['my_post_key'] != $mybb->post_code)
    {
        return;
    }
	
	if($mybb->input['islem'] == 'yenile')
	{
		$dizi = array
		(
			'value' => dilleriolustur()
		);
		if($db->update_query("settings", $dizi, "name='otomatikdil_diller'")) flash_message("Operation successful. If you have problems try manually update.", "success");
		else flash_message("Something went wrong.", "error"); 
		admin_redirect("index.php?module=config-plugins");
		rebuild_settings();
	}
}
	
function otodil()
{
	global $mybb, $lang;
	if($mybb->user['usergroup'] == 1)
	{
		$dilad = diladi(strtolower(substr($_SERVER['HTTP_ACCEPT_LANGUAGE'], 0, 2)));
		if(!isset($mybb->cookies['mybblang']))
		{
			my_setcookie('mybblang',  $dilad);
		}
	}
}
	
function diladi($dilkodu)
{
	global $settings;
	$ayar = $settings['otomatikdil_diller'];
	$a1 = explode (",", $ayar);
	$diller;
	foreach($a1 as $a)
	{
		$a2 = explode("=", $a);
		if(isset($a2[0])) $diller[trim($a2[0])] = trim($a2[1]);
	}
	if(isset($diller[$dilkodu])) return $diller[$dilkodu];
	else return "english";
}

function dilleriolustur()
{
	$dizin = MYBB_ROOT . "inc/languages/";
	$ret = "";
	foreach(scandir($dizin) as $a)
	{
		if(!is_dir($dizin.$a) && $a != "index.html")
		{
			require $dizin.$a;
			$ret .= substr($langinfo['htmllang'], 0, 2)." = ".str_replace(".php", "", $a) . ",\r";
		}
	}
	return $ret;
}
?>