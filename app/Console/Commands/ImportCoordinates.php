<?php

namespace App\Console\Commands;

use App\Dto\CoordinatesDTO;
use App\Services\CsvServiceImport;
use App\Services\reverseGeoService;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use PhpParser\Error;

class ImportCoordinates extends Command
{
    /**
     * @var CsvServiceImport
     */
    public $csvServiceImport;

    /**
     * @var reverseGeoService
     */
    public $reverseGeoService;
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'import:run';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Write data from coordinates_dataset.csv to table coordinates_log';

    /**
     * Create a new command instance.
     *
     * @param CsvServiceImport $csvServiceImport
     * @param reverseGeoService $reverseGeoService
     */
    public function __construct(CsvServiceImport $csvServiceImport, reverseGeoService $reverseGeoService)
    {
        $this->csvServiceImport = $csvServiceImport;
        $this->reverseGeoService = $reverseGeoService;
        parent::__construct();

    }

    /**
     * Execute the console command.
     *
     * @return void
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function handle()
    {
        $coordinates  = $this->csvServiceImport->parseCsv('coord.csv');
        foreach ($coordinates as $coordinate) {
            /**
             * @var CoordinatesDTO $coordinate
             */
            try {
                $full_address = $this->reverseGeoService->parseAddress($coordinate->getLantitude(), $coordinate->getLoungitude());
                DB::insert('insert into coordinates_log (latitude, longitude, full_address) values 
                (?,?,?)', [$coordinate->getLantitude(), $coordinate->getLoungitude(), $full_address]);
            } catch (\Exception $e) {
                echo 'Ошибка запроса: координаты не существуют';
            }
        }

    }
}
