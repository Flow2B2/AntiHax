<?php

namespace AntiHax\listeners;

use AntiHax\Main;
use pocketmine\event\entity\EntityDamageByEntityEvent;
use pocketmine\event\Listener;
use pocketmine\Player;

class AHReach implements Listener{

	/** @var Main $pl */
	private $pl;

	public function __construct(Main $pl)
	{
		$this->pl = $pl;
	}

	public function onHit(EntityDamageByEntityEvent $e){
		if(Main::getInstance()->config->get("antihax-use") == true){
			if($e->getEntity() instanceof Player && $e->getDamager() instanceof Player){
				if(!$e->getDamager()->hasPermission("antihax.reach")){
					$d = $e->getDamager();
					$p = $e->getEntity();
					if($d->distance($p) > 3.9){
						$e->setCancelled();
						$d->kick("§4[Anti-Hax] STOP HACKING IN THIS SERVER OR UR GET BANNED !", false);
					}
				}
			}
		}
	}
}