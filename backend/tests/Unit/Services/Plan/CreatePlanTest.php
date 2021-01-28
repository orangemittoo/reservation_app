<?php

namespace Tests\Unit;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
// use PHPUnit\Framework\TestCase;
use App\Services\Plan\CreatePlan;

class CreatePlanTest extends TestCase
{
    use RefreshDatabase;

    /**
     * @test
     * @runInSeparateProcess
     * @return void
     */
    public function createPlan()
    {
        $plan_fees = [
            [
                'fee' => 10000,
                'date' => '2021-02-01'
            ],
            [
                'fee' => 20000,
                'date' => '2021-02-01'
            ]
        ];
        $plan_stocks = [
            [
                'remaining_num' => 10,
                'date' => '2021-02-01'
            ],
            [
                'remaining_num' => 20,
                'date' => '2021-02-01'
            ]
        ];
        $cancellation_rules = [
            [
                'before_day_num' => 1,
                'percentage' => 50
            ],
            [
                'before_day_num' => 3,
                'percentage' => 20
            ],
            [
                'before_day_num' => 7,
                'percentage' => 10
            ]
        ];
        (new CreatePlan)->execute([
            'name' => 'hotel',
            'plan_fees' => $plan_fees,
            'plan_stocks' => $plan_stocks,
            'cancellation_rules' => $cancellation_rules
        ]);
        $this->assertDatabaseHas('plans', [
            'name' => 'hotel'
        ]);
        $this->assertDatabaseHas('plan_fees', [
            'fee' => 10000,
            'date' => '2021-02-01'
        ]);
        $this->assertDatabaseHas('plan_fees', [
            'fee' => 20000,
            'date' => '2021-02-01'
        ]);
        $this->assertDatabaseHas('plan_stocks', [
            'remaining_num' => 10,
            'date' => '2021-02-01'
        ]);
        $this->assertDatabaseHas('plan_stocks', [
            'remaining_num' => 20,
            'date' => '2021-02-01'
        ]);
        $this->assertDatabaseHas('cancellation_rules', [
            'before_day_num' => 1,
            'percentage' => 50
        ]);
        $this->assertDatabaseHas('cancellation_rules', [
            'before_day_num' => 3,
            'percentage' => 20
        ]);
        $this->assertDatabaseHas('cancellation_rules', [
            'before_day_num' => 7,
            'percentage' => 10
        ]);
    }
}
