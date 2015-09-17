## Quickblox-PHP-API
Here is the PHP API for quickblox. Please follow the steps to get the records from the quickblox using php curl:

###Get the All users:

$tokenAuth = quickAuth();
$quickGetUsers = quickGetUsers($tokenAuth->session->token);


###Add new user:

$tokenAuth = quickAuth();
$quickGetUsers = quickAddUsers($tokenAuth->session->token , 'username','user password','user email address');


###Get the All Dialogs:

$tokenAuth = quickAuth();
$quickGetUsers = quickGetDialog($tokenAuth->session->token);


###Get the All Messages:

$tokenAuth = quickAuth();
$quickGetUsers = quickGetMessage($tokenAuth->session->token , $dialogId); // $dialogId you can get from the quickGetDialog() function
