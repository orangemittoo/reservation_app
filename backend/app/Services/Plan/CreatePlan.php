<?php

namespace App\Services\Plan;

use App\Accommodation;

class CreatePlan
{
    public function execute(Accommodation $accommodation, array $params)
    {
        $plan = $accommodation->plans()->create($params['plan']);
        $plan->plan_fees()->createMany($params['plan_fees']);
        $plan->plan_stocks()->createMany($params['plan_stocks']);
        $plan->cancellation_rules()->createMany($params['cancellation_rules']);
    }
}
