<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Http;
use JetBrains\PhpStorm\NoReturn;

class GetRealWeather extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'Weather:command'; //Weather:command=phpartisanWeather:command= Weather:get-real

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'this command will get real weather trough an open API. ';

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
     * @return void
     */



    #[NoReturn]
    public function handle()
    {



        $response = Http::get('https://jsonplaceholder.typicode.com/users');
        $data = json_decode($response->body(), true); // true = associative array

        $emails = array_column($data, 'email'); // extract all email fields

        dd($emails);




    }

    }

