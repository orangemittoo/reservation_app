<?php

namespace App\Services\Plan;

use App\Plan;

class CreatePlan
{
    public function execute(array $params)
    {
        $plan = new Plan();
        $plan->name = $params['name'];
        $plan->save();

        $plan->plan_fees()->createMany($params['plan_fees']);
        $plan->plan_stocks()->createMany($params['plan_stocks']);
        $plan->cancellation_rules()->createMany($params['cancellation_rules']);
    }
}
