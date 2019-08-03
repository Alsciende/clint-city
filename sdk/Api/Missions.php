<?php

declare(strict_types=1);

namespace Sdk\Api;

use Sdk\Model\CharacterWithDescriptionAndSummary;
use Sdk\Model\CharacterWithDescriptionAndSummaryAndVariation;
use Sdk\Model\CharacterWithVariation;
use Sdk\Model\MissionProgress;
use Sdk\Model\Preset;

class Missions extends Client
{
    const GROUP_ALL = 'all';
    const GROUP_IN_PROGRESS = 'inprogress';
    const GROUP_COMPLETED = 'completed';

    /**
     * @return array
     */
    public function getMissions(string $group = self::GROUP_ALL): array
    {
        $items = $this->executeCommand(new Command('missions.getMissions', [
            'group' => $group
        ]));

        return $this->denormalizeArray($items, MissionProgress::class);
    }

    public function getLastProgressMissions(int $nbMissions = 5): array
    {
        $items = $this->executeCommand(new Command('missions.getLastProgressMissions', [
            'nbMissions' => $nbMissions
        ]));

        return $this->denormalizeArray($items, MissionProgress::class);
    }
}
