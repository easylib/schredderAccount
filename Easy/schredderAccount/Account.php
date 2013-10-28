<?php
namespace Easy\schredderAccount;
class Account
{
	private $loginSession;
	private $appSession;
	private $key;
	public function __construct()
	{
		$this->c = new \Easy\Curl\Curl();
		$this->c->addCookie("Client", "PHP");
	}
	public function setLoginSession($session)
	{
		$this->loginSession = $session;
		$this->c->addCookie("loginSession", $session);
	}
	public function setAppSession($session)
	{
		$this->appSession = $session;
		$this->c->addCookie("appSession", $session);
	}
	public function appLogin($key, $secret, $save = true)
	{
		$this->key = $key;
		$r = $this->c->get("http://account.schredder.pw/api/app/login?key=".$key."&secret=".$secret);
		$appSession = json_decode($r, true);
		if($save)
		{
			$this->setAppSession($appSession["session"]);
		}
		#$appSession = $appSession["session"];
		return $appSession["session"];
	}
	public function getLoginURL()
	{
		return "http://account.schredder.pw/login";
	}
	public function getLoginSession($callback = NULL)
	{
		if($callback==NULL)
		{
			$callback="http://".$_SERVER["HTTP_HOST"].$_SERVER["REQUEST_URI"];
		}
		return "http://account.schredder.pw/app?key=".$this->key."&callback=".urlencode($callback);
	}
	public function isLogin()
	{
		$r = $this->c->get("http://account.schredder.pw/api/user/login/");
		var_dump($r);
		#$r = file_get_contents("http://account.schredder.pw/api/loginSession?key=".base64_encode($this->loginSession));
        $d = json_decode($r, true);
        if(isset($d["status"])&&$d["status"]==false)
        {
        	return false;
        }
        $this->id = $d["id"];
        return $d["login"];
	}
	public function checkRight($right, $userID=NULL)
	{
		if($userID==NULL)
		{
			$userID==$this->id;
		}
		$r = $this->c->get("http://account.schredder.pw/api/user/userRights/?userID=".$userID."&right=".$right);
		return $r[$right];
	}
	/*public function test()
	{
		return $this->c->get("http://account.schredder.pw/api/app/testSession");
	}*/
}
?>