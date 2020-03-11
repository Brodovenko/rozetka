<?php

namespace app\modules\discounts\services;

class DiscountAggregator
{
    /**
     * @var int
     */
    private $resultPercent = 0;

    /**
     * @var array
     */
    private $appliedDiscounts = [];

    /**
     * @param array $discounts
     */
    public function aggregate(array $discounts): void
    {
        $discountsByTypes = [];

        foreach ($discounts as $discount) {
            $discountsByTypes[$discount->getType()][] = $discount;
        }

        $percentsByTypes = [];
        foreach ($discountsByTypes as $type => $discountsOfType) {
            $percentsByTypes[$type] = array_reduce($discountsOfType, function ($carry, $discount) {
                $carry += $discount->getPercent();
                return $carry;
            }, 0);
        }
        $this->resultPercent = $percentsByTypes ? max($percentsByTypes) : 0;
        $appliedType = array_search($this->resultPercent, $percentsByTypes);
        $this->appliedDiscounts = $appliedType ? $discountsByTypes[$appliedType] : [];
    }

    /**
     * @return int
     */
    public function getResultPercent(): int
    {
        return $this->resultPercent;
    }

    /**
     * @return array
     */
    public function getAppliedDiscounts(): array
    {
        return $this->appliedDiscounts;
    }
}