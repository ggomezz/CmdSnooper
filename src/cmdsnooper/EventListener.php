<?php

namespace cmdsnooper;

use pocketmine\event\Listener;
use pocketmine\event\player\PlayerCommandPreprocessEvent;
use pocketmine\event\player\PlayerQuitEvent;
use cmdsnooper\CmdSnooper;

class EventListener implements Listener {
	public $plugin;
	
	public function __construct(CmdSnooper $plugin) {
		$this->plugin = $plugin;
	}

	public function getPlugin() {
		return $this->plugin;
	}
	
	public function onPlayerCmd(PlayerCommandPreprocessEvent $event) {
		$sender = $event->getPlayer();
		$msg = $event->getMessage();
		
		if($this->getPlugin()->cfg->get("Console.Logger") == "true") {
			if($msg[0] == "/") {
				if(stripos($msg, "login") || stripos($msg, "log") || stripos($msg, "reg") || stripos($msg, "register")) {
					$this->getPlugin()->getLogger()->info($sender->getName() . "> §4Hidden for security reasons");	
				} else {
					$this->getPlugin()->getLogger()->info($sender->getName() . "> " . $msg);
				}
				
			}
		}
			
			if(!empty($this->getPlugin()->snoopers)) {
				foreach($this->getPlugin()->snoopers as $snooper) {
					 if($msg[0] == "/") {
						if(stripos($msg, "login") || stripos($msg, "log") || stripos($msg, "reg") || stripos($msg, "register")) {
							$snooper->sendMessage($sender->getName() . "> §4Hidden for security reasons");	
						} else {
							$snooper->sendMessage($sender->getName() . "> " . $msg);
						}
						
					}
	     			}		
     			}
   		}
		
		public function onQuit(PlayerQuitEvent $ev) {
			if(isset($this->snoopers[$ev->getPlayer()->getName()])) {
				$this->getServer()->broadcastMessage("WE DID IT");
				//$sender->sendMessage("§8Snoop> §eYou have left snoop mode");
				unset($this->snoopers[$ev->getPlayer()->getName()]);
				//return true;
					
			}
		}
	}
