<?php


namespace App\Providers;


use App\Services\CsvServiceImport;
use Carbon\Laravel\ServiceProvider;

class CsvServiceProvider extends ServiceProvider
{

    public function boot()
    {
        $this->app->bind(
            CsvServiceImport::class, function () {
                return new CsvServiceImport(__DIR__ . '/../../storage');
            }

        );
    }


}
