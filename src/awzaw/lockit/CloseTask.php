<?php

namespace awzaw\lockit;

use pocketmine\scheduler\Task;
use pocketmine\math\Vector3;
use pocketmine\block\Block;
use pocketmine\level\sound\DoorSound;

class CloseTask extends Task {

    private $plugin;
    private $block;

    public function __construct(Main $plugin, $block) {
		$this->plugin = $plugin;
        $this->block = $block;
    }

    public function onRun(int $tick) {

        $this->block->getLevel()->addSound(new DoorSound($this->block));

        $this->block->getLevel()->setBlock(new Vector3($this->block->getX(), $this->block->getY(), $this->block->getZ()), $this->block, true, true);
        $taskstring = $this->block->getX() . ":" . $this->block->getY() . ":" . $this->block->getZ() . ":" . $this->block->getLevel()->getName();
        unset($this->plugin->tasks[$taskstring]);
    }

}
