<?php

namespace AntiHax\listeners;

use AntiHax\Main;
use pocketmine\event\Listener;
use pocketmine\event\player\PlayerToggleFlightEvent;

class AHFly implements Listener{

	/** @var Main $pl */
	private $pl;

	public function __construct(Main $pl)
	{
		$this->pl = $pl;
	}

	public function onMove(PlayerToggleFlightEvent $e){
		if(Main::getInstance()->config->get("antihax-use") == true){
			if($e->getPlayer()->isFlying() && !$e->getPlayer()->hasPermission("antihax.fly")){
				$e->getPlayer()->kick("§4[Anti-Hax] STOP HACKING IN THIS SERVER OR UR GET BANNED !", false);
			}
		}
	}
}