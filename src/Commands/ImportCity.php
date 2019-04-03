<?php

namespace HaydenZhou\LaravelChinaCities\Commands;

use Illuminate\Console\Command;
use HaydenZhou\LaravelChinaCities\City;

class ImportCity extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'city:seed';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Seed the cities table with cities csv file';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $this->info('Start Seeding...');

        $file = fopen(__DIR__."/../../cities.csv", 'r');
        $row = 1;
        while (($data = fgetcsv($file)) !== FALSE) { //每次读取CSV里面的一行内容
            if ($row == 1) {
                $row++;
                continue;
            }
            // print_r($data);//此为一个数组，要获得每一个数据，访问数组下标即可
            $cities[] = $data;
            $row++;
        }

        
        $this->info(count($cities));

        $bar = $this->output->createProgressBar(count($cities));
        $bar->start();


        if (City::count()) {
            return $this->error('数据库有数据，请先清理数据库');
        }
        if ($cities) {
            // 所有的code 数组
            $allCodes = array_map(function ($item) {
                return $item[0];
            }, $cities);
            
            foreach ($cities as $city) {
                $cityCode = $city[0];

                $parentCode = null;
                if ($cityCode % 10000 == 0) {
                    $parentCode = null;
                } elseif ($cityCode % 100 == 0) {
                    $parentCode = floor($cityCode / 10000) . '0000';
                } else {
                    $parentCode = floor($cityCode / 100) . '00';
                    if (!in_array($parentCode, $allCodes)) {
                        $parentCode = floor($cityCode / 10000) . '0000';
                    }
                }

                City::Create([
                    'parent_code' => $parentCode,
                    'code' => $city[0],
                    'name' => $city[1]
                ]);
                $bar->advance();
            }
        }

        $bar->finish();

        $this->info('Start finished');
    }

}
