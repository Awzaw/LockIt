<?php

namespace LockIt;

use pocketmine\scheduler\PluginTask;
use pocketmine\math\Vector3;
use pocketmine\item\Item;
use pocketmine\tile\Chest;
use pocketmine\level\Level;
use pocketmine\block\Block;

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
        $newdoor = Block::get(Item::IRON_DOOR_BLOCK);
        
            $this->block->getLevel()->setBlock(new Vector3($this->block->getX(), $this->block->getY(), $this->block->getZ()), $this->block);  
            unset ($this->plugin->tasks[spl_object_hash($this->block)]);

    }

}
