<?php

require_once(MODELS . "user/account.php");

require_once(LIB . "DatabaseConnection.php");

$account = new Account();
if (isset($_GET['action'])){
    if ($_GET['action'] == 'modifiedAccount'){
        $account->modifyAccount();
    }
}
$accountInfos = $account->getAccountInfo();

require_once(TEMPLATES . "account.php");