<?php

namespace App\Util;

class Percentage
{
    public const STEPS = [
        0 => 'Create account',
        20 => 'Activate account',
        40 => 'Provide profile information',
        50 => 'What jobs are you interested in?',
        70 => 'Do you have relevant experience in these jobs?',
        90 => 'Are you a freelancer?',
        99 => 'Waiting for approval',
        100 => 'Approval',
    ];

    /**
     * @param int $userPercentage
     * @return int
     */
    public function findStepInFlow(int $userPercentage): int
    {
        $currentStep = -1;
        foreach (self::STEPS as $percentage => $step) {
            if ($userPercentage < $percentage) {
                break;
            }
            $currentStep++;
        }

        return $currentStep;
    }
    /**
     * @param int $count
     * @param int $total
     * @return int
     */
    public function calculatePercentageAverage(int $count, int $total): int
    {
        if ($total === 0) {
            throw new \BadFunctionCallException();
        }

        return round(($count / $total) * 100);
    }
}