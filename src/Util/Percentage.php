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
    public function findPercentageInSteps(int $userPercentage): int
    {
        $realPercentage = 0;
        foreach (self::STEPS as $percentage => $step) {
            if ($userPercentage < $percentage) {
                break;
            }

            $realPercentage = $percentage;
        }

        return $realPercentage;
    }
    /**
     * @param $count
     * @param $total
     * @return int
     */
    public function calculatePercentageAverage($count, $total): int
    {
        return round(($count / $total) * 100);
    }
}