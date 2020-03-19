<?php

namespace AntiHax\commands;

use AntiHax\Main;
use pocketmine\command\Command;
use pocketmine\command\CommandSender;
use pocketmine\command\ConsoleCommandSender;
use pocketmine\command\PluginIdentifiableCommand;
use pocketmine\Player;
use pocketmine\plugin\Plugin;

class AHCommand extends Command implements PluginIdentifiableCommand {

	private $pl;

	public function __construct(Main $pl)
	{
		parent::__construct(
			"antihax",
			"To enable or disable the antihax plugin !",
			"antihax",
			['antihax','ah']
		);
		$this->pl = $pl;
		$this->setPermission("antihax.perm");
		$this->setPermissionMessage("§4You dont have permission for this !");
	}

	public function execute(CommandSender $p, string $commandLabel, array $args) : bool {
		if($p instanceof Player && $p->hasPermission("antihax.perm")) {
			if(!isset($args[0])){
				$p->sendMessage("§4Please make: /antihax on|off !");
				return false;
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
		} else {
			$p->sendMessage("§4You dont have permission for this !");
			return false;
		}
		return true;
	}

	public function getPlugin(): Plugin
	{
		return $this->pl;
	}
}