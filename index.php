<?php
	
// Load depedencies

require __DIR__ . '/config/config_inc.php';
require __DIR__ . '/vendor/autoload.php';

$bot = Deepbot\API::instance(array(
	'server' 	=> $config['server'],
	'port'		=> $config['port'],
	'secret'	=> $config['secret']
));

$streamer = $config['streamername'];

?>
<h2>$bot->getUser($username)</h2>
<pre>
<?php	
var_dump($bot->getUser($streamer));
?>
</pre>
<h2>getUsers($offset, $limit)</h2>
<pre>
<?php
var_dump($bot->getUsers());
?>
</pre>
<h2>getUserCount()</h2>
<pre>
<?php
var_dump($bot->getUserCount());
?>
</pre>
<h2>getTopUsers($offset, $limit)</h2>
<pre>
<?php
var_dump($bot->getTopUsers());
?>
</pre>
<h2>getUserPoints($username)</h2>
<pre>
<?php
var_dump($bot->getUserPoints($streamer));
?>
</pre>
<h2>setUserPoints($username, $newValue)</h2>
<pre>
<?php
var_dump($bot->setUserPoints($streamer, 1));
?>
</pre>
