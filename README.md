# Quickblox-PHP-API

Here is the PHP API for quickblox. Please follow the steps to get the records from the quickblox using php curl:

1. Get the All users:

$tokenAuth = quickAuth();
$quickGetUsers = quickGetUsers($tokenAuth->session->token);


2. Add new user:

$tokenAuth = quickAuth();
$quickGetUsers = quickAddUsers($tokenAuth->session->token , 'username','user password','user email address');


3. Get the All Dialogs:

$tokenAuth = quickAuth();
$quickGetUsers = quickGetDialog($tokenAuth->session->token);


4. Get the All Messages:

$tokenAuth = quickAuth();
$quickGetUsers = quickGetMessage($tokenAuth->session->token , $dialogId); // $dialogId you can get from the quickGetDialog() function



