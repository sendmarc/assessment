<?php
namespace App\Services;
use App\Services\TaskTick\BreatheTickService;
use App\Services\TaskTick\CompleteAssessmentTickService;
use App\Services\TaskTick\DefaultTickService;
use App\Services\TaskTick\GetOlderTickService;
use App\TaskFighter;
use Illuminate\Support\Arr;

final class TaskTickService{
    /**
     * This holds special task services
     * @var array
     */
    private static $aliases = [
        'GetOlder' => GetOlderTickService::class,
        'Breathe' => BreatheTickService::class,
        'CompleteAssessment' => CompleteAssessmentTickService::class
    ];

    /**
     * @param string      $taskName
     * @param TaskFighter $taskFighter
     *
     * @return TaskFighter
     */
    public static function getService(string $taskName, TaskFighter $taskFighter) : TaskFighter
    {
        $serviceToUse = Arr::get(self::$aliases, $taskName, DefaultTickService::class);

        return (new $serviceToUse($taskFighter))->taskFighter;
    }
}
