<?php

namespace Wild;

use pocketmine\plugin\PluginBase;
use pocketmine\command\Command;
use pocketmine\command\CommandSender;
use pocketmine\level\{Level,Position};
use pocketmine\math\Vector3;
use pocketmine\{Server,Player};
use pocketmine\utils\TextFormat as C;
use pocketmine\event\entity\EntityDamageEvent;
class Main extends PluginBase {
    
    public $iswildin = [];
    
    public function onEnable(){
              $this->getLogger()->info(C::AQUA . "Enabled Plugin Wild");
    }
    public function onDisable(){
              $this->getLogger()->info(C::RED . "Disabling Wild Plugin.");
    }
    
    public function onCommand(CommandSender $s, Command $cmd, $label, array $args){
    if(strtolower($cmd->getName() == "wild")){
        if($s->hasPermission("wild.command")){
        if($s instanceof Player){
            $x = rand(1,999);
            $y = 128;
            $z = rand(1,999);
            
            $s->teleport(new Position($x,$y,$z));
            $s->sendMessage(C::RED."Teleporting to Random Place!");
            $s->sendMessage(C::RED."Dont worry you will not take any fall damage!");
            $this->iswildin[$s->getName()] = true;
        
        }
        }else{
            $s->sendMessage(C::RED."You do not have permission");
        }
        return true;
    }
                            }
    public function onDamage(EntityDamageEvent $event){
       if($event->getEntity() instanceof Player){
           if(isset($this->iswildin[$event->getEntity->getName()])){
               $p = $event->getEntity();
               unset($this->iswildin[$p->getName()]);
                     $event->setCancelled();
           }
       }
    }
}
