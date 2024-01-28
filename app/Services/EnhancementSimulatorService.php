<?php

namespace App\Services;

final class EnhancementSimulatorService
{
    private array $successRates = [
        1 => 0.70,
        2 => 0.50,
        3 => 0.40,
        4 => 0.30
    ];

    private $failureDownRate = 0.40;
    private $costs = [
        1 => 11.5,
        2 => 17.5,
        3 => 34.5,
        4 => 80.5
    ];

    public function simulate($scenario, $maxAttempts) {
        $totalSales = 0;
        $currentLevel = $scenario->baseLevel;
        $totalAttempts = 0;

        while ($totalAttempts < $maxAttempts) {
            if ($currentLevel == $scenario->targetLevel) {
                $totalSales++;
                $currentLevel = $scenario->baseLevel;
            }

            $totalAttempts++;

            if (rand(0, 100) / 100 <= $this->successRates[$currentLevel][$currentLevel + 1]) {
                $currentLevel = min($currentLevel + 1, $scenario->targetLevel);
            } else {
                if (rand(0, 100) / 100 <= $this->failureDownRate && $currentLevel > 0) {
                    $currentLevel--;
                }
            }
        }

        $totalRevenue = $totalSales * $scenario->salePrice;
        $totalPurchaseCost = $totalSales * $scenario->purchaseCost;
        $totalEnhancementCost = $this->calculateTotalEnhancementCost($scenario, $totalSales);
        $totalProfit = $totalRevenue - $totalPurchaseCost - $totalEnhancementCost;

        return [
            'Total Revenue' => $totalRevenue,
            'Total Profit' => $totalProfit,
            'Total Purchase Cost' => $totalPurchaseCost,
            'Total Enhancement Cost' => $totalEnhancementCost,
            'Sales Count' => $totalSales,
            'Average Attempts to Target Level' => $totalAttempts / $totalSales
        ];
    }

    private function calculateTotalEnhancementCost($scenario, $totalSales) {
        $totalCost = 0;
        for ($level = $scenario->baseLevel; $level < $scenario->targetLevel; $level++) {
            $totalCost += $this->costs[$level] * $totalSales;
        }
        return $totalCost;
    }
}
