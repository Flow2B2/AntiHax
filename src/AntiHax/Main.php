<?php

namespace AntiHax;

use AntiHax\commands\AHCommand;
use AntiHax\listeners\AHFly;
use AntiHax\listeners\AHReach;
use pocketmine\event\Listener;
use pocketmine\plugin\PluginBase;
use pocketmine\Server;
use pocketmine\utils\Config;
use pocketmine\utils\TextFormat;

class Main extends PluginBase implements Listener{

	/** @var Main $instance */
	public static $instance;
	/** @var Config $config */
	public $config;

	public function onEnable()
	{
		$this->getLogger()->info(TextFormat::GREEN . "AntiHax - ON !");
		$this->loadManagers();
		self::$instance = $this;
		@mkdir($this->getDataFolder());
		if(!file_exists($this->getDataFolder() . "config.yml")){
			$this->saveResource('config.yml');
		}
		$this->config = new Config($this->getDataFolder() . 'config.yml', Config::YAML);
		$this->config->set("antihax-use", false);
		$this->config->save();
		Server::getInstance()->getCommandMap()->register('antihax', new AHCommand($this));
	}

	private function loadManagers(){
		Server::getInstance()->getPluginManager()->registerEvents(new AHFly($this), $this);
		Server::getInstance()->getPluginManager()->registerEvents(new AHReach($this), $this);
	}

	public static function getInstance() : self {
		return self::$instance;
	}
}