<?php

declare(strict_types=1);

namespace App\Observers;

use App\Models\Car;

class CarObserver
{
    /**
     * @param \App\Models\Car $car
     * @return void
     */
    public function deleting(Car $car)
    {
        $car->users()->sync([]);
    }
}
