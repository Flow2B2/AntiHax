<?php

namespace AntiHax\commands;

use AntiHax\Main;
use pocketmine\command\Command;
use pocketmine\command\CommandSender;
use pocketmine\command\ConsoleCommandSender;
use pocketmine\Player;

class AHCommand extends Command{

	public function __construct(string $name, string $description = "", string $usageMessage = null, array $aliases = [])
	{
		parent::__construct($name, $description, $usageMessage, $aliases);
	}

	public function execute(CommandSender $p, string $commandLabel, array $args)
	{
		if($p instanceof Player && $p->hasPermission("antihax.perm")) {
			if(!isset($args[0])){
				$p->sendMessage("§4Please make: /antihax on|off !");
				return;
			}
			switch ($args[0]){
				case "on":
					Main::getInstance()->config->set("antihax-use", true);
					$p->sendMessage("§aYou turn the AntiHax on true !");
				break;
				case "off":
					Main::getInstance()->config->set("antihax-use", false);
					$p->sendMessage("§4You turn the AntiHax on off !");
				break;
			}
		}
	}
}