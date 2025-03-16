<?php
/*
Halil Selçuk
*/
if(!defined("IN_MYBB")) 
{
	die();
}
if(!defined("PLUGINLIBRARY"))
{
    define("PLUGINLIBRARY", MYBB_ROOT."inc/plugins/pluginlibrary.php");
}

$plugins->add_hook("admin_config_plugins_begin", "otomatikdil_eklentiler");

function otomatikdil_info()
{
	global $mybb, $db, $lang, $cp_language;
	if(!file_exists(MYBB_ROOT . "inc/languages/" . $cp_language . "/otomatikdil.lang.php")) $lang->set_language("english", "admin");
	$lang->load("otomatikdil", true);
	$lang->set_language($cp_language, "admin");
	$aciklama = $lang->otomatikdil_plugin_desc;
	$sorgu = $db->query("SELECT * FROM ".TABLE_PREFIX."settinggroups WHERE name='otomatikdil'");
	$ayarg = $db->fetch_array($sorgu);
	
	if($ayarg != null)
	{
		$ayar = "?module=config-settings&action=change&gid=".$ayarg["gid"];
		$yenile = "?module=config-plugins&islem=yenile&my_post_key=".$mybb->post_code;
		$globalphp_duzenle = "?module=config-plugins&islem=globalphp_duzenle&my_post_key=".$mybb->post_code;
		$aciklama .= $lang->otomatikdil_try;
		$aciklama .= $lang->sprintf($lang->otomatikdil_settings_url, $ayar, $yenile);
		$dosya = MYBB_ROOT."/global.php";
		if(file_exists($dosya))
		{
			$globalphpac = fopen($dosya, 'r');
			$globalphp = fread($globalphpac, filesize($dosya));
			fclose($globalphpac);
			if(strpos($globalphp, "otodil();") === false || strpos($globalphp, "function_exists(otodil)") !== false)
			$aciklama .= $lang->sprintf($lang->otomatikdil_caller_not_found, $globalphp_duzenle);
		}
	}
	
	return array
	(
		"name" => $lang->otomatikdil_plugin_name,
		"author" => "Halil Selçuk",
		"website" => "https://halilselcuk.blogspot.com/2016/08/mybb-auto-language-switcher.html",
		"description" => $aciklama,
		"version" => "1.2.2",
		"authorsite" => "https://halilselcuk.com",
		"compatibility" => "*",
		"codename"		=> "otomatikdil"
	);
	
}

function otomatikdil_is_installed()
{
    global $settings;
    if(isset($settings['otomatikdil_diller'])) return true;
}

function otomatikdil_install()
{
	global $lang, $cp_language;
	if(!file_exists(MYBB_ROOT . "inc/languages/" . $cp_language . "/otomatikdil.lang.php")) $lang->set_language("english", "admin");
	$lang->load("otomatikdil", true);
	$lang->set_language($cp_language, "admin");
    if(!file_exists(PLUGINLIBRARY))
    {
        flash_message($lang->otomatikdil_pl_missing, "error");
        admin_redirect("index.php?module=config-plugins");
    }
	
    global $PL;
    $PL or require_once PLUGINLIBRARY;
	
    if($PL->version < 11)
    {
        flash_message($lang->otomatikdil_pl_old, "error");
        admin_redirect("index.php?module=config-plugins");
    }
	
	$PL->settings(
	"otomatikdil",
	$lang->otomatikdil_settings,
	$lang->otomatikdil_settings_desc,
	array
		(
			"diller" => 
							array
							(
								"title" => $lang->otomatikdil_langs,
								"description" => $lang->otomatikdil_langs_desc,
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
	globalphp_duzenle(false);
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

function otomatikdil_eklentiler()
{
	global $mybb;
	$islem = $mybb->input['islem'] ?? null;
	if($islem == 'yenile')
	{
		dilleri_yenile();
	}
	else if($islem == "globalphp_duzenle")
	{
		globalphp_duzenle(true);
	}
	
	
}

function globalphp_duzenle($yonlendir)
{
	global $PL, $lang, $cp_language;
	
	if(!file_exists(MYBB_ROOT . "inc/languages/" . $cp_language . "/otomatikdil.lang.php")) $lang->set_language("english", "admin");
	$lang->load("otomatikdil", true);
	$lang->set_language($cp_language, "admin");
	
	$PL or require_once PLUGINLIBRARY;
	
	$result = $PL->edit_core
	(
	"otomatikdil", 
	"global.php",
	array
	(
		'search' => 
		array("// Set and load the language"),
		'replace' => "if(function_exists('otodil')) otodil();"
	),
	true
	);
	if($result) flash_message($lang->otomatikdil_global_edit_success, "success");
	else flash_message($lang->otomatikdil_global_edit_fail, "error");
	if($yonlendir) admin_redirect("index.php?module=config-plugins");
}

function dilleri_yenile()
{
	global $db, $lang, $cp_language;
	if(!file_exists(MYBB_ROOT . "inc/languages/" . $cp_language . "/otomatikdil.lang.php")) $lang->set_language("english", "admin");
	$lang->load("otomatikdil", true);
	$lang->set_language($cp_language, "admin");
	$dizi = array
	(
		'value' => dilleriolustur()
	);
	if($db->update_query("settings", $dizi, "name='otomatikdil_diller'"))
	{
	rebuild_settings();
	flash_message($lang->otomatikdil_update_lang_list_success, "success");
	}
	else flash_message($lang->otomatikdil_update_lang_list_fail, "error"); 
	admin_redirect("index.php?module=config-plugins");
	rebuild_settings();
	
}
	
function otodil()
{
	global $mybb;
	if($mybb->user['usergroup'] == 1)
	{
		if(!isset($mybb->cookies['mybblang']))
		{
			$dilad = diladi(strtolower(substr($_SERVER['HTTP_ACCEPT_LANGUAGE'], 0, 2)));
			my_setcookie('mybblang',  $dilad);
		}
	}
}
	
function diladi($dilkodu)
{
	global $settings;
	$ayar = strtolower($settings['otomatikdil_diller']);
	$a1 = explode (",", $ayar);
	$diller;
	foreach($a1 as $a)
	{
		$a2 = explode("=", $a);
		if (isset($a2[0]) && isset($a2[1])) 
		{
			$diller[trim($a2[0])] = trim($a2[1]);
		}
	}
	if(isset($diller[$dilkodu])) return $diller[$dilkodu];
	else return $settings['bblanguage'];
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
			if(isset($langinfo['htmllang']))
			{
			$ret .= substr($langinfo['htmllang'], 0, 2)." = ".str_replace(".php", "", $a) . ",\r";
			unset($langinfo['htmllang']);
			}
		}
	}
	return $ret;
}
?>