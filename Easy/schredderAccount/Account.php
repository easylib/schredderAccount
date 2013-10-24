<?php
namespace Easy\schredderAccount;
class Account
{
	public function isLogin()
	{
		$r = file_get_contents("http://account.schredder.pw/api/loginSession?key=".base64_encode($_COOKIE["loginSession"]));
        $d = json_decode($r, true);
        return $d["login"];
	}
}
?>