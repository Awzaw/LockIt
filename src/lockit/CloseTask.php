<?php

namespace LockIt;

use pocketmine\scheduler\PluginTask;
use pocketmine\math\Vector3;
use pocketmine\item\Item;
use pocketmine\tile\Chest;
use pocketmine\level\Level;
use pocketmine\block\Block;
use pocketmine\level\sound\DoorSound;

class CloseTask extends PluginTask {

    private $plugin;
    private $block;

    public function __construct(Main $plugin, $block) {
        parent::__construct($plugin);

        $this->plugin = $plugin;
        $this->block = $block;
    }

    public function onRun($tick) {

        //$this->block->getLevel()->setBlock($this->block, Block::get(Item::IRON_DOOR_BLOCK));
        $newdoor = Block::get($this->block->getId());
 
//                      try closing it?
//            
                        echo("Damage before\n");
                        var_dump($this->block->getDamage());
                        $newbit = $this->block->getDamage() ^0x4;
                        $this->block->setDamage($newbit);
                        echo("Damage after\n");
                        var_dump($this->block->getDamage());
                        
                        $this->block->getLevel()->addSound(new DoorSound($this->block));

        $this->block->getLevel()->setBlock(new Vector3($this->block->getX(), $this->block->getY(), $this->block->getZ()), $this->block, true);

        $taskstring = $this->block->getX() . ":" . $this->block->getY() . ":" . $this->block->getZ() . ":" . $this->block->getLevel()->getName();
        unset($this->getOwner()->tasks[$taskstring]);
    }

}
