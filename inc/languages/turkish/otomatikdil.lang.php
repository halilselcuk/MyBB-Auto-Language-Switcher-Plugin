<?php

$l['otomatikdil_plugin_name'] = "Otomatik Dil Değiştirici";

$l['otomatikdil_plugin_desc'] = "Bu eklenti forumun dilini kullanıcının tarayıcı diline göre değiştirir.";

$l['otomatikdil_try'] = "<hr>Deneyin: Eklentinin çalışıp çalışmadığını anlamak için <a href=\"https://chrome.google.com/webstore/detail/quick-language-switcher/pmjbhfmaphnpbehdanbjphdcniaelfie\" target=\"_blank\">Quick Language Switcher adlı Google Chrome eklentisini</a> kullanabilirsiniz. Denemeden önce çerezleri temizlemeniz gerektiğini unutmayın.";

$l['otomatikdil_settings_url'] =  "<hr>Eğer yeni dil paketi yüklediyseniz eklenti ayarlarını güncellemelisiniz. <a href=\"{2}\">Eklentinin otomatik oluşturucusunu</a> kullanabilir ya da <a href=\"{1}\">eklenti ayarlarıyla</a> elle güncelleyebilirsiniz.";

$l['otomatikdil_caller_not_found'] = "<hr><strong>Uyarı!</strong> (<i>Eğer eklenti gerektiği gibi çalışıyorsa bu uyarıyı dikkate almayınız.</i>)</br> İşlev çağırıcı silinmiş gibi görünüyor. Eğer global.php'yi değiştirdiyseniz ya da güncellediyseniz (yani ekletinin işlev çağırıcısı kaldırıldıysa) çağırıcıyı eklemelisiniz. Eklemek için <a href=\"{1}\">buraya tıklayın</a>. İşe yaramazsa <a href = \"https://github.com/halilselcuk/MyBB-Auto-Language-Switcher-Plugin/wiki\" target = \"_blank\" >Wiki'yi</a> ziyaret edin.";;

$l['otomatikdil_pl_missing'] = "Seçtiğiniz eklenti kurulamadı çünkü <a href=\"https://github.com/frostschutz/MyBB-PluginLibrary\">PluginLibrary</a> eksik.";

$l['otomatikdil_pl_old'] = "Seçtiğiniz eklenti kurulamadı çünkü <a href=\"https://github.com/frostschutz/MyBB-PluginLibrary\">PluginLibrary</a>'nin eski sürümü yüklü.";

$l['otomatikdil_settings'] = "Otomatik Dil Değiştirici Ayarları";

$l['otomatikdil_settings_desc'] = "Otomatik geçiş için dil ekleyin.";

$l['otomatikdil_langs'] = "Diller:";

$l['otomatikdil_langs_desc'] = "Bu biçimi kullanarak yeni diller ekleyebilirsiniz: <i>Dil Kodu</i> = <i>Dil Adı</i>, 
								<br> <i><a href=\"http://www.w3schools.com/tags/ref_language_codes.asp\">Dil Kodu</a></i>: Bunu tarayıcı gönderir. Eklenti sadece ilk iki karakterini kullanıyor. Bu iki karakter olmak zorundadır.(Eklentinin otomatik oluşturucusu \$langinfo['htmllang'] değişkenini kullanır.) Yani bu yanlış olabilir, eğer bir sorun varsa bu kodda değişiklik yapmayı deneyin.
								<br><i>Dil Adı</i>: Bu dil paketinin dosya adıdır. Dil paketlerini MYBB_ROOT/inc/languages dizininde bulabilirsiniz. (Eklentinin otomatik oluşturucusu dil paketinin dosya adını kullanır.).
								<br>Not: Otomatik oluşturucuyu eklenti yöneticisinde bulabilirsiniz.";

$l['otomatikdil_global_edit_success'] = "global.php başarılı olarak düzenlendi.";

$l['otomatikdil_global_edit_fail'] = "global.php düzenlenemedi. global.php'yi kendiniz düzenleyebilirsiniz. Bu kodu: if(function_exists(otodil)) otodil();  Bu kodun altına ekleyin: \$mybb->post_code = generate_post_check();";

$l['otomatikdil_update_lang_list_success'] = "İşlem başarılı. Eğer bir sorun varsa elle düzenlemeyi deneyin.";

$l['otomatikdil_update_lang_list_fail'] = "Bir şeyler yanlış gitti.";