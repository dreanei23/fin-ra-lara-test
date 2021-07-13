<?php

namespace App\Observers;

use App\Models\Stat;

class StatObserver
{
    /**
     * Срабатывает перед запись в БД.
     * Сразу посчитаем необходимые параметры для записи в БД
     *
     * @param  \App\Models\Stat  $stat
     * @return void
     */
    public function creating(Stat $stat)
    {
        if (!empty($stat->cost) && !empty($stat->clicks)) {
            $stat->CPC = (float)$stat->cost/$stat->clicks;
            $stat->CPM = $stat->CPC * 1000;
        }

        if (!empty($stat->clicks) && !empty($stat->views)) {
            $stat->CTR = $stat->clicks/$stat->views;
        }
    }

    /**
     * Handle the Stat "updated" event.
     *
     * @param  \App\Models\Stat  $stat
     * @return void
     */
    public function updated(Stat $stat)
    {
        //
    }

    /**
     * Handle the Stat "deleted" event.
     *
     * @param  \App\Models\Stat  $stat
     * @return void
     */
    public function deleted(Stat $stat)
    {
        //
    }

    /**
     * Handle the Stat "restored" event.
     *
     * @param  \App\Models\Stat  $stat
     * @return void
     */
    public function restored(Stat $stat)
    {
        //
    }

    /**
     * Handle the Stat "force deleted" event.
     *
     * @param  \App\Models\Stat  $stat
     * @return void
     */
    public function forceDeleted(Stat $stat)
    {
        //
    }
}
