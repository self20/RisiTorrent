<?php
/**
 *   https://github.com/Bigjoos/
 *   Licence Info: GPL
 *   Copyright (C) 2010 U-232 v.3
 *   A bittorrent tracker source based on TBDev.net/tbsource/bytemonsoon.
 *   Project Leaders: Mindless, putyn.
 **/
 //== Also thanks to original creators http://www.bootstrapzen.com/item/261/white-login-form-boxed/ for the login page

require_once(dirname(__FILE__).DIRECTORY_SEPARATOR.'include'.DIRECTORY_SEPARATOR.'bittorrent.php');
require_once(INCL_DIR.'user_functions.php');
require_once(CLASS_DIR.'page_verify.php');
dbconn();
global $CURUSER;
if(!$CURUSER){
get_template();
}

ini_set('session.use_trans_sid', '0');
$stdhead = array(/** include js **/'js' => array('jquery','jquery.simpleCaptcha-0.2'));
$lang = array_merge( load_language('global'), load_language('login') );
$newpage = new page_verify();
$newpage->create('takelogin');
  $left='';
  //== 09 failed logins
	function left ()
	{
	global $INSTALLER09;
	$total = 0;
	$ip = sqlesc(getip());
	$fail = sql_query("SELECT SUM(attempts) FROM failedlogins WHERE ip={$ip}") or sqlerr(__FILE__, __LINE__);
	list($total) = mysqli_fetch_row($fail);
	$left = $INSTALLER09['failedlogins'] - $total;
	if ($left <= 2)
	$left = "<font color='red' size='4'>{$left}</font>";
	else
	$left = "<font color='green' size='4'>{$left}</font>";
	return $left;
	}
	//== End Failed logins

    $HTMLOUT = '';

    unset($returnto);
    if (!empty($_GET["returnto"])) {
      $returnto = htmlspecialchars($_GET["returnto"]);
    }
    $HTMLOUT .= "<!DOCTYPE html PUBLIC \"-//W3C//DTD XHTML 1.0 Transitional//EN\" \"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd\">
<html xmlns=\"http://www.w3.org/1999/xhtml\" xml:lang=\"en\" lang=\"en\">
<TITLE>Welcome to &nbsp;" . $INSTALLER09["site_name"] . "</TITLE>
        <meta http-equiv='Content-Language' content='en-us' />
        <meta http-equiv='Content-Type' content='text/html; charset=utf-8' /><meta name='MSSmartTagsPreventParsing' content='TRUE' />

		<script src='http://netdna.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js'></script>
	<meta http-equiv='Content-Type' content='text/html; charset=UTF-8' />
	<meta http-equiv='X-UA-Compatible' content='IE=edge'>
	<meta name='viewport' content='width=1,initial-scale=1,user-scalable=1' />
	<title>Insert title here</title>
	<!-- Custom CSS -->
	<link rel='stylesheet' type='text/css' href='style.css' />
	<!-- Google Font -->
	<link href='http://fonts.googleapis.com/css?family=Lato:100italic,100,300italic,300,400italic,400,700italic,700,900italic,900' rel='stylesheet' type='text/css'>
    <!-- Bootstrap Core CSS -->
	<link type='text/css' rel='stylesheet' href='http://netdna.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css'>
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src='https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js'></script>
      <script src='https://oss.maxcdn.com/respond/1.4.2/respond.min.js'></script>
    <![endif]-->
	<!-- jQuery Library -->
    <script src='http://cdnjs.cloudflare.com/ajax/libs/jquery/1.10.0/jquery.min.js'></script>
    <!-- Bootstrap Core JS -->
	<script src='http://netdna.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js'></script>

		    <link rel='stylesheet' href='./style.css' type='text/css' />

         <style>

		</style>

			 	<section class='container'>
	    <section class='login-form'>
		<form method='post' action='takelogin.php'>
			<div>

				         <div <h4>Bienvenue sur </h4>" . $INSTALLER09["site_name"] . "</a>

			</div>
			<input type='username' name='username' placeholder='Pseudo' required class='form-control input-lg text-center' />
			<input type='password' name='password' placeholder='Mot de passe' required class='form-control input-lg text-center' />
			<button type='submit' name='go' class='btn btn-lg btn-block btn-info'>Connexion</button>
			<div>
				<a href='signup.php'>Créer un compte</a> ou <a href='recover.php'>mot de passe oubliée</a>
			</div>
		</form>
		</section>
	</section>";

    if (isset($returnto))
    $HTMLOUT .= "<input type='hidden' name='returnto' value='" . htmlentities($returnto) . "' />\n";

echo $HTMLOUT . stdfoot();
