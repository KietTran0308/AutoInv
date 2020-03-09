<?php

namespace Auto\Inv;

use pocketmine\{Server, Player};
use pocketmine\{Command, CommandSender};
use pocketmine\utils\TextFormat as TF;
use pocketmine\event\Listener;
use pocketmine\event\block\BlockBreakEvent;
use pocketmine\plugin\PluginBase;

use pocketmine\math\Vector3;
use pocketmine\level\sound\EndermanTeleportSound;

class Load extends PluginBase implements Listener{
    
    public function onEnable(): void{
        $this->getServer()->getPluginManager()->registerEvents($this, $this);
        $this->getLogger()->info("❤❤❤❤ Auto Inv OnEnable ❤❤❤❤");
        $this->getLogger()->notice("Code By WoolChannel3295");
    }
    
    public function onAuto(BlockBreakEvent $ev): void{
        $player = $ev->getPlayer();
        foreach($ev->getDrops() as $drop){
            if($player->getInventory()->canAddItem($drop)){
                $ev->getPlayer()->getInventory()->addItem($drop);
		    }else{
		        $level = $player->getLevel();
                $x = $player->getX();
                $y = $player->getY();
                $z = $player->getZ();
                $pos = new Vector3($x, $y, $z);
                $level->addSound(new EndermanTeleportSound($pos));
		        $player->addTitle("§b§l• §r§aFull Đồ Rồi §b§l•");
		    }
        }
        $ev->setDrops([]);
	}
}