<?php

namespace awzaw\lockit;

use pocketmine\scheduler\PluginTask;
use pocketmine\math\Vector3;
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

        $newdoor = Block::get($this->block->getId());

        $newbit = $this->block->getDamage() ^ 0x4;
        $this->block->setDamage($newbit);

        $this->block->getLevel()->addSound(new DoorSound($this->block));

        $this->block->getLevel()->setBlock(new Vector3($this->block->getX(), $this->block->getY(), $this->block->getZ()), $this->block, true);
        $taskstring = $this->block->getX() . ":" . $this->block->getY() . ":" . $this->block->getZ() . ":" . $this->block->getLevel()->getName();
        unset($this->getOwner()->tasks[$taskstring]);
    }

}
