<?php

// Autologin:
//   Note: During development, when auth is not implemented yet ,
//       pages are displayed on url like:
//       http://localhost/?page=login
//       http://localhost/?page=allboards

// Change visible page based on $_PORT variable content.

$page = $_GET["page"];

// Debugging
$debug = false;
if ($debug) {
  // Error reporting: ALL
  ini_set('error_reporting', E_ALL);
}

include_once('settings.php');

/*
 Translations start:
 1) Check browser language
 2) If translation exists, load translation from JSON file
 */
if (!empty( $_SERVER[ 'HTTP_ACCEPT_LANGUAGE' ] ) ) {
   $langs = explode( ',', $_SERVER['HTTP_ACCEPT_LANGUAGE'] );
   if (!empty($langs[ 0 ])) {
     $lang = $langs[ 0 ];
     // If browser language is ascii:
     if (mb_detect_encoding($lang, 'ASCII', true)) {
       // If length of browser language code if 5, like fi-FI
       if (strlen($lang) == 5) {
         // Format language to first 2 lowercase, then - , then 2 last uppercase, like fi-FI
         $lang = strtolower(substr($lang, 0, 2)) . "-" . strtoupper(substr($lang, 3, 2));
         // Short name of language
         $langshort = substr($lang, 0, 2);
         // If it's same language in another country, keep those language names same
         switch ($lang) {
           case "ar-EG":
           case "zh-CN":
           case "zh-HK":
           case "zh-TW":
           case "en-GB":
           case "de-CH":
           case "pt-BR":
           case "es-AR":
           case "es-LA":
           case "es-CL":
           case "es-MX":
           case "es-PY":
           case "es-PE":
             break;
           default:
             // Otherwise, it's same as short langage name.
             $lang = $langshort;
         }
       } else if (strlen($lang) == 2) {
         $lang = strtolower($lang);
         switch ($lang) {
           case "ar":
           case "hy":
           case "eu":
           case "br":
           case "bg":
           case "ca":
           case "hr":
           case "cs":
           case "da":
           case "nl":
           case "en":
           case "eo":
           case "fi":
           case "fr":
           case "gl":
           case "ka":
           case "de":
           case "el":
           case "he":
           case "hu":
           case "hi":
           case "ig":
           case "id":
           case "it":
           case "ja":
           case "km":
           case "ko":
           case "lv":
           case "mk":
           case "mn":
           case "nb":
           case "oc":
           case "fa":
           case "pa":
           case "pl":
           case "pt":
           case "ro":
           case "ru":
           case "sr":
           case "sk":
           case "sl":
           case "es":
           case "sv":
           case "sw":
           case "ta":
           case "th":
           case "tr":
           case "uk":
           case "vi":
             break;
           default:
             $lang="en";
         }
       } else {
         // In case of language name not 2 or 5 characters, only es-LA has non-ASCII language name
         $lang = "es-LA";
       }
     } else {
       // Only es-LA has non-ASCII language name
       $lang = "es-LA";
     }
   } else {
     $lang = 'en';
   }
} else {
  $lang = 'en';
}

$langjson = file_get_contents('i18n/' . $lang . '.i18n.json');

$translate = json_decode($langjson, true);

/*
  Translations end.
*/


if ($debug) {
  $indicesServer = array('PHP_SELF',
    'argv',
    'argc',
    'GATEWAY_INTERFACE',
    'SERVER_ADDR',
    'SERVER_NAME',
    'SERVER_SOFTWARE',
    'SERVER_PROTOCOL',
    'REQUEST_METHOD',
    'REQUEST_TIME',
    'REQUEST_TIME_FLOAT',
    'QUERY_STRING',
    'DOCUMENT_ROOT',
    'HTTP_ACCEPT',
    'HTTP_ACCEPT_CHARSET',
    'HTTP_ACCEPT_ENCODING',
    'HTTP_ACCEPT_LANGUAGE',
    'HTTP_CONNECTION',
    'HTTP_HOST',
    'HTTP_REFERER',
    'HTTP_USER_AGENT',
    'HTTPS',
    'REMOTE_ADDR',
    'REMOTE_HOST',
    'REMOTE_PORT',
    'REMOTE_USER',
    'REDIRECT_REMOTE_USER',
    'SCRIPT_FILENAME',
    'SERVER_ADMIN',
    'SERVER_PORT',
    'SERVER_SIGNATURE',
    'PATH_TRANSLATED',
    'SCRIPT_NAME',
    'REQUEST_URI',
    'PHP_AUTH_DIGEST',
    'PHP_AUTH_USER',
    'PHP_AUTH_PW',
    'AUTH_TYPE',
    'PATH_INFO',
    'ORIG_PATH_INFO') ;

  echo '<table cellpadding="10">' ;
  foreach ($indicesServer as $arg) {
    if (isset($_SERVER[$arg])) {
        echo '<tr><td>'.$arg.'</td><td>' . $_SERVER[$arg] . '</td></tr>' ;
    }
    else {
        echo '<tr><td>'.$arg.'</td><td>-</td></tr>' ;
    }
  }
  echo '</table>' ;

}

/*
  Debug End
*/

/*
  HTML head and start or body
*/

?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html lang="en">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <title>
        <?php echo htmlentities($productName); ?>
    </title>
    <meta name="viewport" content="maximum-scale=1.0,width=device-width,initial-scale=1.0,user-scalable=0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link rel="stylesheet" type="text/css" href="css/style.css">
    <link rel="shortcut icon" type="image/x-icon" href="<?php echo urlencode($shortcutIcon); ?>">
    <link rel="apple-touch-icon" sizes="180x180" href="<?php echo urlencode($appleTouchIcon180x180); ?>">
    <link rel="icon" type="image/png" sizes="32x32" href="<?php echo urlencode($favicon32x32); ?>">
    <link rel="icon" type="image/png" sizes="16x16" href="<?php echo urlencode($favicon16x16); ?>">
    <link rel="manifest" href="<?php echo urlencode($manifest); ?>">
    <link rel="mask-icon" href="<?php echo urlencode($maskIcon); ?>" color="#<?php echo strip_tags($maskIconColor); ?>">
    <meta name="apple-mobile-web-app-title" content="<?php echo htmlentities($productName); ?>">
    <meta name="application-name" content="<?php echo htmlentities($productName); ?>">
    <meta name="msapplication-TileColor" content="#<?php echo strip_tags($msapplicationTileColor); ?>">
    <meta name="theme-color" content="#<?php echo strip_tags($themeColor); ?>">
</head>

<body style="font-family: <?php echo strip_tags($font); ?>; background-color: #<?php echo strip_tags($bgColor); ?>">

<?php

/*
  Index page: List of pages Wekan has
*/

if ($page == "") {

?>
  <center>
  <h1></h1>
<?php

    // Login logo image URL
    if (!empty($loginLogoImageUrl)) {
      echo '<img src="' . urlencode($loginLogoImageUrl) . '" alt="' . 
      htmlentities($productName) .
      '" width="' . strip_tags($loginLogoImageWidth) .
      '" height="' . strip_tags($loginLogoImageHeight) . '">';
    }

?>

<section class="auth-layout"><h1 class="at-form-landing-logo"><img src="img/wekan-logo.png" alt="Wekan"></h1>
  <section class="auth-dialog">
    <div class="at-form">        
        <h3>
          <a class="button-link" href="?page=login">Login</a><br /><br />
          <a class="button-link" href="?page=loginamiga">Login Amiga</a><br /><br />
          <a class="button-link" href="?page=allboards">All Boards</a><br /><br />
        </h3>
    </div>          
  </section>
</section>

  </center> 

<?php

/*
  Login page
*/

} else if ($page == "loginamiga") {

?>

    <center>
        <h1></h1>

<?php

if ($hideLogo != true) {

    // Login logo link URL start
    if (!empty($loginLogoLinkUrl)) {
      echo '<a href="' . urlencode($loginLogoLinkUrl) . '">';
    }

    // Login logo image URL
    if (!empty($loginLogoImageUrl)) {
      echo '<img src="' . urlencode($loginLogoImageUrl) . '" alt="' . 
      htmlentities($productName) .
      '" width="' . strip_tags($loginLogoImageWidth) .
      '" height="' . strip_tags($loginLogoImageHeight) . '">';
    }

    // Login logo link URL end
    if (!empty($loginLogoLinkUrl)) {
      echo "</a>";
    }

}

?>
        <br /><br />

        <table border="0" margin="0" padding="0">
            <tr>
                <td align="left">
                    <h3>
                        <?php echo htmlentities($translate["log-in"]); ?>
                    </h3>
                    <form role="form" id="at-pwd-form" novalidate="" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="POST">

                        <div class="at-form-authentication">
                            <label for="select-authentication">
                                <?php echo htmlentities($translate["authentication-method"]); ?>
                            </label>
                            <select class="select-authentication">
                                <option value="password">
                                    <?php echo htmlentities($translate["password"]); ?>
                                </option>
                            </select>
                        </div>
                        <div class="at-input">
                            <label for="at-field-username_and_email">
                                <?php echo htmlentities($translate["username"]) . " " . htmlentities($translate["or"]) . " " .htmlentities($translate["email"]); ?>
                            </label><br />
                            <input type="text" id="at-field-username_and_email" name="at-field-username_and_email" placeholder="" autocapitalize="none" autocorrect="off">
                        </div>
                        <div class="at-input">
                            <label for="at-field-password">
                                <?php echo htmlentities($translate["password"]); ?>
                            </label><br />
                            <input type="password" id="at-field-password" name="at-field-password" placeholder="" autocapitalize="none" autocorrect="off">
                        </div>
                        <div class="at-select-lang">
                            <p>
                                <select class="select-lang">
                                    <option <?php if ($lang=="ar" ) {echo 'selected="selected"' ;}; ?> value="ar">Arabic / العربية
                                    </option>
                                    <option <?php if ($lang=="ar-EG" ) {echo 'selected="selected"' ;}; ?> value="ar-EG">Arabic (Egypt) /
                                        مَصرى</option>
                                    <option <?php if ($lang=="hy" ) {echo 'selected="selected"' ;}; ?> value="hy">Armenian / Հայերեն
                                    </option>
                                    <option <?php if ($lang=="eu" ) {echo 'selected="selected"' ;}; ?> value="eu">Basque / Euskara
                                    </option>
                                    <option <?php if ($lang=="br" ) {echo 'selected="selected"' ;}; ?> value="br">Breton / Brezhoneg
                                    </option>
                                    <option <?php if ($lang=="bg" ) {echo 'selected="selected"' ;}; ?> value="bg">Bulgarian / Български
                                    </option>
                                    <option <?php if ($lang=="ca" ) {echo 'selected="selected"' ;}; ?> value="ca">Catalan / Català
                                    </option>
                                    <option <?php if ($lang=="zh-CN" ) {echo 'selected="selected"' ;}; ?> value="zh-CN">Chinese (China) /
                                        简体中文</option>
                                    <option <?php if ($lang=="zh-HK" ) {echo 'selected="selected"' ;}; ?> value="zh-HK">Chinese (Hong
                                        Kong) / 繁体中文（香港)</option>
                                    <option <?php if ($lang=="zh-TW" ) {echo 'selected="selected"' ;}; ?> value="zh-TW">Chinese (Taiwan) /
                                        繁體中文（台灣)</option>
                                    <option <?php if ($lang=="hr" ) {echo 'selected="selected"' ;}; ?> value="hr">Croatian / Hrvatski
                                    </option>
                                    <option <?php if ($lang=="cs" ) {echo 'selected="selected"' ;}; ?> value="cs">Czech / čeština‎
                                    </option>
                                    <option <?php if ($lang=="da" ) {echo 'selected="selected"' ;}; ?> value="da">Danish / Dansk</option>
                                    <option <?php if ($lang=="nl" ) {echo 'selected="selected"' ;}; ?> value="nl">Dutch / Nederlands
                                    </option>
                                    <option <?php if ($lang=="en" ) {echo 'selected="selected"' ;}; ?> value="en">English</option>
                                    <option <?php if ($lang=="en-GB" ) {echo 'selected="selected"' ;}; ?> value="en-GB">English (UK)
                                    </option>
                                    <option <?php if ($lang=="eo" ) {echo 'selected="selected"' ;}; ?> value="eo">Esperanto</option>
                                    <option <?php if ($lang=="fi" ) {echo 'selected="selected"' ;}; ?> value="fi">Finnish / Suomi</option>
                                    <option <?php if ($lang=="fr" ) {echo 'selected="selected"' ;}; ?> value="fr">French / Français
                                    </option>
                                    <option <?php if ($lang=="gl" ) {echo 'selected="selected"' ;}; ?> value="gl">Galician / Galego
                                    </option>
                                    <option <?php if ($lang=="ka" ) {echo 'selected="selected"' ;}; ?> value="ka">Georgian / ქართული
                                    </option>
                                    <option <?php if ($lang=="de" ) {echo 'selected="selected"' ;}; ?> value="de">German (Germany) /
                                        Deutsch</option>
                                    <option <?php if ($lang=="de-CH" ) {echo 'selected="selected"' ;}; ?> value="de-CH">German
                                        (Switzerland) / Deutsch (Schweiz)</option>
                                    <option <?php if ($lang=="el" ) {echo 'selected="selected"' ;}; ?> value="el">Greek / Ελληνικά
                                    </option>
                                    <option <?php if ($lang=="he" ) {echo 'selected="selected"' ;}; ?> value="he">Hebrew / עברית</option>
                                    <option <?php if ($lang=="hu" ) {echo 'selected="selected"' ;}; ?> value="hu">Hungarian / Magyar
                                    </option>
                                    <option <?php if ($lang=="hi" ) {echo 'selected="selected"' ;}; ?> value="hi">Hindi / हिन्दी</option>
                                    <option <?php if ($lang=="ig" ) {echo 'selected="selected"' ;}; ?> value="ig">Igbo</option>
                                    <option <?php if ($lang=="id" ) {echo 'selected="selected"' ;}; ?> value="id">Indonesian / Bahasa
                                        Indonesia</option>
                                    <option <?php if ($lang=="it" ) {echo 'selected="selected"' ;}; ?> value="it">Italian / Italiano
                                    </option>
                                    <option <?php if ($lang=="ja" ) {echo 'selected="selected"' ;}; ?> value="ja">Japanese / 日本語</option>
                                    <option <?php if ($lang=="km" ) {echo 'selected="selected"' ;}; ?> value="km">Khmer / ភាសាខ្មែរ
                                    </option>
                                    <option <?php if ($lang=="ko" ) {echo 'selected="selected"' ;}; ?> value="ko">Korean / 한국어</option>
                                    <option <?php if ($lang=="lv" ) {echo 'selected="selected"' ;}; ?> value="lv">Latvian / Latviešu
                                    </option>
                                    <option <?php if ($lang=="lt" ) {echo 'selected="selected"' ;}; ?> value="lt">Lithuanian / Lietuvių
                                        kalba</option>
                                    <option <?php if ($lang=="mk" ) {echo 'selected="selected"' ;}; ?> value="mk">Macedonian / македонски
                                        јазик</option>
                                    <option <?php if ($lang=="mn" ) {echo 'selected="selected"' ;}; ?> value="mn">Mongolian / Монгол
                                    </option>
                                    <option <?php if ($lang=="nb" ) {echo 'selected="selected"' ;}; ?> value="nb">Norwegian Bokmål / Norsk
                                        bokmål</option>
                                    <option <?php if ($lang=="oc" ) {echo 'selected="selected"' ;}; ?> value="oc">Occitan (post 1500)
                                    </option>
                                    <option <?php if ($lang=="fa" ) {echo 'selected="selected"' ;}; ?> value="fa">Persian / فارسی</option>
                                    <option <?php if ($lang=="fa-IR" ) {echo 'selected="selected"' ;}; ?> value="fa-IR">Persian (Iran) /
                                        فارسی/پارسی (ایران‎)</option>
                                    <option <?php if ($lang=="pa" ) {echo 'selected="selected"' ;}; ?> value="pa">Panjabi (Punjabi) /
                                        ਪੰਜਾਬੀ</option>
                                    <option <?php if ($lang=="pl" ) {echo 'selected="selected"' ;}; ?> value="pl">Polish / Polski</option>
                                    <option <?php if ($lang=="pt" ) {echo 'selected="selected"' ;}; ?> value="pt">Portuguese (Portugal) /
                                        Português</option>
                                    <option <?php if ($lang=="pt-BR" ) {echo 'selected="selected"' ;}; ?> value="pt-BR">Portuguese
                                        (Brazil) / Português do Brasil</option>
                                    <option <?php if ($lang=="ro" ) {echo 'selected="selected"' ;}; ?> value="ro">Romanian / Română
                                    </option>
                                    <option <?php if ($lang=="ru" ) {echo 'selected="selected"' ;}; ?> value="ru">Russian / Русский
                                    </option>
                                    <option <?php if ($lang=="sr" ) {echo 'selected="selected"' ;}; ?> value="sr">Serbian / Српски језик
                                    </option>
                                    <option <?php if ($lang=="sk" ) {echo 'selected="selected"' ;}; ?> value="sk">Slovak / Slovenčina
                                    </option>
                                    <option <?php if ($lang=="sl" ) {echo 'selected="selected"' ;}; ?> value="sl">Slovenian / slovenščina
                                    </option>
                                    <option <?php if ($lang=="es" ) {echo 'selected="selected"' ;}; ?> value="es">Spanish (Spain) /
                                        español</option>
                                    <option <?php if ($lang=="es-LA" ) {echo 'selected="selected"' ;}; ?> value="es-LA">Spanish (Latin
                                        America) / español de América Latina</option>
                                    <option <?php if ($lang=="es-AR" ) {echo 'selected="selected"' ;}; ?> value="es-AR">Spanish
                                        (Argentina) / español de Argentina</option>
                                    <option <?php if ($lang=="es-CL" ) {echo 'selected="selected"' ;}; ?> value="es-CL">Spanish (Chile) /
                                        español de Chile</option>
                                    <option <?php if ($lang=="es-MX" ) {echo 'selected="selected"' ;}; ?> value="es-MX">Spanish (Mexico) /
                                        español de México</option>
                                    <option <?php if ($lang=="es-PY" ) {echo 'selected="selected"' ;}; ?> value="es-PY">Spanish (Paraguay)
                                        / español de Paraguayo</option>
                                    <option <?php if ($lang=="es-PE" ) {echo 'selected="selected"' ;}; ?> value="es-PE">Spanish (Peru) /
                                        español de Perú</option>
                                    <option <?php if ($lang=="sv" ) {echo 'selected="selected"' ;}; ?> value="sv">Swedish / Svenska
                                    </option>
                                    <option <?php if ($lang=="sw" ) {echo 'selected="selected"' ;}; ?> value="sw">Swahili / Kiswahili
                                    </option>
                                    <option <?php if ($lang=="ta" ) {echo 'selected="selected"' ;}; ?> value="ta">Tamil / தமிழ்</option>
                                    <option <?php if ($lang=="th" ) {echo 'selected="selected"' ;}; ?> value="th">Thai / ไทย</option>
                                    <option <?php if ($lang=="tr" ) {echo 'selected="selected"' ;}; ?> value="tr">Turkish / Türkçe
                                    </option>
                                    <option <?php if ($lang=="uk" ) {echo 'selected="selected"' ;}; ?> value="uk">Ukrainian / Українська
                                    </option>
                                    <option <?php if ($lang=="vi" ) {echo 'selected="selected"' ;}; ?> value="vi">Vietnamese / Tiếng Việt
                                    </option>
                                </select>
                            </p>
                        </div>
                        <input type="submit" name="login" class="at-btn submit" id="at-btn" value="<?php echo htmlentities($translate["log-in"]); ?>">
                    </form>

                    <?php
/*
        <div class="at-pwd-link">
          <p>
          <a href="/forgot-password" id="at-forgotPwd" class="at-link at-pwd">Forgot password</a>
          </p>
        </div>

          <!--          Don't you have account? Register -->

*/
?>
                    <div class="at-signup-link">
                        <p>
                            <a href="/sign-up" id="at-signUp" class="at-link at-signup">
                                <?php echo htmlentities($translate["registration"]); ?>
                            </a>
                        </p>
                    </div>
                </td>
            </tr>
        </table>
    </center>

    <?php
/* 
  Login page
*/

} else if ($page == "login") {

?>

<section class="auth-layout">
<h1 class="at-form-landing-logo"></h1><img src="wekan-logo.svg" alt="" width="300" height="auto"><br>
<section class="auth-dialog">
    <div class="at-form">
        <div class="at-title">
    <h3>Kirjaudu sisään</h3>
  </div>
  <div class="at-error">    
     <p>Täytyy olla kirjautuneena sisään</p>
  </div>
        <div class="at-pwd-form"><div class="at-form-authentication" style="display: none;"><label>Authentication method</label>
<select class="select-authentication"><option value="password">Password</option></select></div>
    <form role="form" id="at-pwd-form" novalidate="" action="#" method="POST">
    <div class="at-input">    
      <label for="at-field-username_and_email">
        Käyttäjätunnus tai sähköposti 
      </label>
    <input type="text" id="at-field-username_and_email" name="at-field-username_and_email" placeholder="Käyttäjätunnus tai sähköposti" autocapitalize="none" autocorrect="off">
  </div>    
    <div class="at-input">
      <label for="at-field-password">
        Salasana 
      </label>    
    <input type="password" id="at-field-password" name="at-field-password" placeholder="Salasana" autocapitalize="none" autocorrect="off">
  </div>
        <div class="at-pwd-link">
    <p>
      <a href="/forgot-password" id="at-forgotPwd" class="at-link at-pwd">Unohditko salasanasi?</a>
    </p>
  </div>
      <button type="submit" class="at-btn submit" id="at-btn">
    Kirjaudu sisään
  </button>
    </form>
  </div>
        <div class="at-signup-link">
    <p>
      Eikö sinulla ole tiliä?
      <a href="/sign-up" id="at-signUp" class="at-link at-signup">Rekisteröidy</a>
    </p>
  </div>
    </div>
  <div class="at-form-lang"><select class="select-lang js-userform-set-language"><option value="id">Bahasa Indonesia</option><option value="br">Brezhoneg</option><option value="ca">Català</option><option value="da">Dansk</option><option value="de">Deutsch</option><option value="de-CH">Deutsch (Schweiz)</option><option value="en">English</option><option value="en-GB">English (UK)</option><option value="eo">Esperanto</option><option value="eu">Euskara</option><option value="fr">Français</option><option value="gl">Galego</option><option value="hr">Hrvatski</option><option value="ig">Igbo</option><option value="it">Italiano</option><option value="sw">Kiswahili</option><option value="lv">Latviešu</option><option value="lt">Lietuvių kalba</option><option value="hu">Magyar</option><option value="nl">Nederlands</option><option value="nb">Norsk bokmål</option><option value="oc">Occitan</option><option value="pl">Polski</option><option value="pt">Português</option><option value="pt-BR">Português do Brasil</option><option value="ro">Română</option><option value="sk">Slovenčina</option><option value="fi">Suomi</option><option value="sv">Svenska</option><option value="vi">Tiếng Việt</option><option value="tr">Türkçe</option><option value="es">español</option><option value="es-LA">español de América Latina</option><option value="es-AR">español de Argentina</option><option value="es-CL">español de Chile</option><option value="es-MX">español de México</option><option value="es-PY">español de Paraguayo</option><option value="es-PE">español de Perú</option><option value="sl">slovenščina</option><option value="cs">čeština‎</option><option value="el">Ελληνικά</option><option value="bg">Български</option><option value="mn">Монгол</option><option value="ru">Русский</option><option value="sr">Српски језик</option><option value="uk">Українська</option><option value="mk">македонски јазик</option><option value="hy">Հայերեն</option><option value="he">עברית</option><option value="ar">العربية</option><option value="fa">فارسی</option><option value="fa-IR">فارسی/پارسی (ایران‎)</option><option value="ar-EG">مَصرى</option><option value="hi">हिन्दी</option><option value="pa">ਪੰਜਾਬੀ</option><option value="ta">தமிழ்</option><option value="th">ไทย</option><option value="ka">ქართული</option><option value="km">ភាសាខ្មែរ</option><option value="ja">日本語</option><option value="zh-CN">简体中文</option><option value="zh-HK">繁体中文（香港）</option><option value="zh-TW">繁體中文（台灣）</option><option value="ko">한국어</option></select></div></section></section></body>

<?php

/*
  Sign Up page (for registering new user)
*/

} else if ($page == "signup") {

/*
  Forgot Password page
*/

} else if ($page == "forgotpassword") {

/*
  All Boards page
*/

} else if ($page == "allboards") {

?>


    <div id="header-quick-access" class="">
        <img src="/logo-header.png" alt=""><span class="allBoards">
            <a href="/"><img src="img/home.png">
                All boards</a></span>
        <ul class="header-quick-access-list">
            <!--li-->
            <!--  a(href="{{pathFor 'public'}}")-->
            <!--    span.fa.fa-globe-->
            <!--    | {{_ 'public'}}-->
            <li class="current empty">Star a board to add a shortcut in this bar.</li>
        </ul>
        <!-- Next line is used only for spacing at header,-->
        <!-- there is no visible clickable icon.-->
        <div id="header-new-board-icon"></div>
        <!--  Hide duplicate create board button,-->
        <!--  because it did not show board templates correctly.-->
        <!--a#header-new-board-icon.js-create-board-->
        <!--  i.fa.fa-plus(title="Create a new board")-->
        <div id="notifications" class="board-header-btns right">
            <a class="notifications-drawer-toggle fa fa-bell" href="#"></a>
        </div>
        <div id="header-user-bar">
            <a class="header-user-bar-name js-open-header-member-menu" href="#">
                <div class="header-user-bar-avatar"><a class="member js-member" title=" (testtest) Normal" href="#" aria-label=" (testtest) Normal">
                        <svg class="avatar avatar-initials" viewBox="0 0 12 15">
                            <text x="50%" y="13" text-anchor="middle">T</text>
                        </svg>

                    </a></div>
                testtest
            </a>
        </div>
    </div>
    <div id="header" class="">
        <div id="header-main-bar" class="wrapper">


            <h1>My Boards</h1>
            <!--.board-header-btns.right-->
            <!--  a.board-header-btn.js-open-archived-board-->
            <!--    i.fa.fa-archive-->
            <!--    span {{_ 'archives'}}-->
            <!--  a.board-header-btn(href="{{pathFor 'board' id=templatesBoardId slug=templatesBoardSlug}}")-->
            <!--    i.fa.fa-clone-->
            <!--    span {{_ 'templates'}}-->

        </div>
    </div>
    <div id="content">
        <div class="wrapper">
            <ul class="board-list clearfix js-boards ui-sortable">
                <li class="js-add-board"><a class="board-list-item label" href="#">Add Board</a></li>
                <li class="board-color-belize js-board ui-sortable-handle"><a class="js-open-board board-list-item" href="/b/ttHaGXzTJLsW9BRCu/hei"><span class="details"><span class="board-list-item-name">
                                <div class="viewer" dir="auto">
                                    <p>Hei</p>
                                </div>
                            </span>
                            <i class="fa js-star-board fa-star-o" title="Click to star this board. It will show up at top of your boards list." aria-label="Click to star this board. It will show up at top of your boards list."></i>
                            <p class="board-list-item-desc">
                                <div class="viewer" dir="auto">
                                    <p>Jops</p>
                                </div>
                            </p>


                            <i class="fa js-clone-board fa-clone" title="Duplicate Board" aria-label="Duplicate Board"></i><i class="fa js-archive-board fa-archive" title="Move Board to Archive" aria-label="Move Board to Archive"></i>
                        </span></a></li>
                <li class="board-color-nephritis js-board ui-sortable-handle"><a class="js-open-board board-list-item" href="/b/KBuy7ZBR8m5HngdZn/toka"><span class="details"><span class="board-list-item-name">
                                <div class="viewer" dir="auto">
                                    <p>Toka</p>
                                </div>
                            </span>
                            <i class="fa js-star-board fa-star-o" title="Click to star this board. It will show up at top of your boards list." aria-label="Click to star this board. It will show up at top of your boards list."></i>
                            <p class="board-list-item-desc">
                                <div class="viewer" dir="auto"></div>
                            </p>


                            <i class="fa js-clone-board fa-clone" title="Duplicate Board" aria-label="Duplicate Board"></i><i class="fa js-archive-board fa-archive" title="Move Board to Archive" aria-label="Move Board to Archive"></i>
                        </span></a></li>
                <li class="board-color-pumpkin js-board ui-sortable-handle"><a class="js-open-board board-list-item" href="/b/P8tDMSkGFsmzpXgio/kolmas"><span class="details"><span class="board-list-item-name">
                                <div class="viewer" dir="auto">
                                    <p>Kolmas</p>
                                </div>
                            </span>
                            <i class="fa js-star-board fa-star-o" title="Click to star this board. It will show up at top of your boards list." aria-label="Click to star this board. It will show up at top of your boards list."></i>
                            <p class="board-list-item-desc">
                                <div class="viewer" dir="auto"></div>
                            </p>


                            <i class="fa js-clone-board fa-clone" title="Duplicate Board" aria-label="Duplicate Board"></i><i class="fa js-archive-board fa-archive" title="Move Board to Archive" aria-label="Move Board to Archive"></i>
                        </span></a></li>
            </ul>
        </div>
    </div>


<?php 

/*
  One Board page
*/

} else if ($page == "board") {

/*
  Board Settings page
*/

} else if ($page == "boardsettings") {

/*
  Swimlane page
*/

} else if ($page == "swimlane") {

/*
  Swimlane Settings page
*/

} else if ($page == "swimlanesettings") {

/*
  One Card page
*/

} else if ($page == "card") {

/*
  Card Settings page
*/

} else if ($page == "cardsettings") {

/*
  Search All Boards page
*/

} else if ($page == "searchallboards") {

/*
  My Cards page
*/

} else if ($page == "mycards") {

/*
  Calendar page
*/

} else if ($page == "calendar") {

/*
  Gantt page
*/

} else if ($page == "gantt") {  

/*
  Admin Panel page
*/

} else if ($page == "adminpanel") {

}
  
?>

</body>

</html>