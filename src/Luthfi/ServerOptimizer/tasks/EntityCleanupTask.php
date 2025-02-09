<?php

namespace Luthfi\ServerOptimizer\tasks;

use pocketmine\scheduler\Task;
use pocketmine\utils\TextFormat as TF;
use Luthfi\ServerOptimizer\Main;

class EntityCleanupTask extends Task {

    private $plugin;

    public function __construct(Main $plugin) {
        $this->plugin = $plugin;
    }

	public function onRun(): void {
		$level = $this->plugin->getServer()->getWorldManager()->getDefaultWorld();
		if ($level === null) {
			return;
		}

		$count = 0;
		foreach ($level->getEntities() as $entity) {
			if (!$entity instanceof Player) {
				$entity->flagForDespawn();
				$count++;
			}
		}

		$this->plugin->getLogger()->info(TF::GREEN . "Cleared " . $count . " entities.");
	}
}
