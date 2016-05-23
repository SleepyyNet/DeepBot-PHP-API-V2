<?php
namespace Deepbot;

class API
{
	public static $instance = NULL;
	public static $isConnected = FALSE;
	protected $config = NULL;
	public static $message = NULL;

	public static function instance( $config = array() )
	{
		if(API::$instance === NULL)
			API::$instance = new API($config);

		return API::$instance;
	}

	public function __construct( $config )
	{
		$this->config = $config;
	}

	public function makeRequest($command)
	{
		$loop 			= \React\EventLoop\Factory::create();
		$connector 		= new \Ratchet\Client\Factory($loop);
		$config 		= $this->config;
		API::$message 	= NULL;

		$connector('ws://'.$config['server'].':'.$config['port'])->then(function(\Ratchet\Client\WebSocket $conn) use ($config, $command, $loop)
		{
			$conn->send('api|register|' . $config['secret']);
			$conn->on('message', function($msg) use($loop)
			{
				$parsed = json_decode($msg, TRUE);
				if($parsed['function'] === 'register')
				{
					if($parsed['msg'] === 'success')
					{
						API::$isConnected = TRUE;
					}
					else
					{
						throw new \Exception($parsed['msg']);
					}
				}
				else
				{
					API::$message = $parsed['msg'];
				}
			});

			$conn->send($command);

		}, function($e) use($loop)
		{
			echo "Could not connect: {$e->getMessage()}\n";
			$loop->stop();
		});

	    $loop->addPeriodicTimer(0.05, function () use($loop)
	    {
	    	if(API::$message !== NULL)
	    	{
	    		$loop->stop();
	    	}
	    });

		$loop->run();



		return API::$message;
	}

	public function getUser($username)
	{
		return $this->makeRequest('api|get_user|' . $username);
	}

	public function getUsers($offset = 1, $limit = 100)
	{
		return $this->makeRequest('api|get_users|'.$offset.'|'.$limit);
	}

	public function getUserCount()
	{
		return $this->makeRequest('api|get_users_count');
	}

	public function getUserPoints($username)
	{
		return $this->makeRequest('api|get_points|'.$username);
	}

	public function getUserHours($username)
	{
		return $this->makeRequest('api|get_hours|'.$username);
	}

	public function getUserRank($username)
	{
		return $this->makeRequest('api|get_rank|'.$username);
	}

	public function getTopUsers($offset = 1, $limit = 100)
	{
		return $this->makeRequest('api|get_top_users|'.$offset.'|'.$limit);
	}

	public function setUserPoints($username, $newValue)
	{
		return $this->makeRequest('api|set_points|'.$username.'|'.$newValue);
	}

	public function addPoints($username, $points)
	{
		return $this->makeRequest('api|add_points|'.$username.'|'.$points);
	}

	public function delPoints($username, $points)
	{
		return $this->makeRequest('api|del_points|'.$username.'|'.$points);
	}

	public function setUserVip($username, $level, $days)
	{
		return $this->makeRequest('api|set_vip|'.$username.'|'.$level.'|'.$days);
	}

	public function getCommands($offset = 1, $limit = 100)
	{
		return $this->makeRequest('api|get_commands|'.$offset.'|'.$limit);
	}

	public function getCommandsCount()
	{
		return $this->makeRequest('api|get_command_count');
	}

	public function getCommand($command)
	{
		return $this->makeRequest('api|get_command|'.$command);
	}

	public function runCommand($command)
	{
		return $this->makeRequest('api|run_command|'.$command);
	}

	public function getQuotes($offset = 1, $limit = 100)
	{
		return $this->makeRequest('api|get_quotes|'.$offset.'|'.$limit);
	}

	public function getQuotesCount()
	{
		return $this->makeRequest('api|get_quotes_count');
	}

	public function getSongs($offset = 1, $limit = 100)
	{
		return $this->makeRequest('api|get_songs|'.$offset.'|'.$limit);
	}

	public function getSongsCount()
	{
		return $this->makeRequest('api|get_songs_count');
	}
}
