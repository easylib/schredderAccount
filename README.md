Mit der schredderAccount Classe kann in PHP einfach die Nutzerverwaltung von accounts.schredder.pw genutzt werden. Die Installation erfolgt einfach per Composer:

    {
       "repositories": [
            { "type": "vcs", "url": "https://github.com/easylib/Curl.git" },
            { "type": "vcs", "url": "https://github.com/easylib/schredderAccount.git" }
    	],
        "require": {
            "Easylib/Curl": "dev-master",
            "Easylib/schredderAccount": "dev-master"
        }
    }

Danach kann einfache eine Instanz der Classe erzeugt werden. Hier ein einfaches Beispiel, was überprüft, ob der Besucher der Webseite eingelogt ist, und wenn nicht ein Link anzeigt womit sich der User einloggen kann. Danach wird der User auf die Seite zurückgeliefert und Mensch kannauf das GET Parameter "session" zugreifen, welches die User-Session beinhaltet.

    require 'vendor/autoload.php';
    $a = new Easy\schredderAccount\Account();
    $a->appLogin("test", "test");
    $a->setLoginSession(base64_decode($_GET["session"]));
    if(!$a->isLogin())
    {
    	echo "<a href='".$a->getLoginSession()."'>Login</a>";
    }
    else
    {
    	echo "Du bist eingeloggt";
    }    