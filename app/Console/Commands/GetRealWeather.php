<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Http;

class GetRealWeather extends Command
{
    /**
     * The name and signature of the console command.
     *
     * Example usage:
     * php artisan Weather:command Belgrade
     */
    protected $signature = 'Weather:command {city}';// Declares the command name and expects a 'city' argument

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Get real weather data for a city via WeatherAPI.';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        // Get city from artisan argument
        $city = $this->argument('city');// Retrieves the 'city' argument passed in the command

        // Use API key from .env file
        $apiKey = env('WEATHER_API_KEY');

        // Call the WeatherAPI
        $response = Http::get('http://api.weatherapi.com/v1/current.json', [
            'key' => $apiKey,
            'q' => $city,
            'aqi' => 'no',
        ]);

        if ($response->failed()) {
            //  decode the error message from the response body
            $errorData = $response->json();

            // Check if the error structure exists
            $errorMessage = $errorData['error']['message'] ?? 'Unknown error occurred';

            $this->error("API Error: {$errorMessage}");
            return 1;
        }

        $data = $response->json();

        // Show weather in console
        $this->info("Weather in {$data['location']['name']}, {$data['location']['country']}:");
        $this->line("Temperature: {$data['current']['temp_c']}°C");
        $this->line("Feels like: {$data['current']['feelslike_c']}°C");
        $this->line("Condition: {$data['current']['condition']['text']}");

        return 0;
    }



}
//**<?php
//
//namespace App\Console\Commands; // Declares the namespace for this command class
//
//use Illuminate\Console\Command; // Imports Laravel's base Command class
//use Illuminate\Support\Facades\Http; // Imports Laravel's HTTP client for making API requests
//
//class GetRealWeather extends Command // Defines a new Artisan command class
//{
//    /**
//     * The name and signature of the console command.
//     * This defines how the command is called from the terminal.
//     * Example usage:
//     * php artisan Weather:command Belgrade
//     */
//    protected $signature = 'Weather:command {city}'; // Declares the command name and expects a 'city' argument
//
//    /**
//     * The console command description.
//     * This is shown when running `php artisan list` or `php artisan help Weather:command`
//     */
//    protected $description = 'Get real weather data for a city via WeatherAPI.'; // Describes what the command does
//
//    /**
//     * Execute the console command.
//     * This is the main logic that runs when the command is executed.
//     *
//     * @return int
//     */
//    public function handle() // Entry point for the command logic
//    {
//        // Get city from artisan argument
//        $city = $this->argument('city'); // Retrieves the 'city' argument passed in the command
//
//        // Use API key from .env file
//        $apiKey = env('WEATHER_API_KEY'); // Loads the WeatherAPI key from the .env file for security
//
//        // Call the WeatherAPI
//        $response = Http::get('http://api.weatherapi.com/v1/current.json', [ // Sends a GET request to WeatherAPI
//            'key' => $apiKey, // API key for authentication
//            'q' => $city, // City name to query weather for
//            'aqi' => 'no', // Disables air quality index data to simplify response
//        ]);
//
//        // Check if the API call failed
//        if ($response->failed()) { // If the response status is not 200 OK
//            $this->error("Failed to fetch weather for {$city}"); // Show error message in console
//            return 1; // Return non-zero exit code to indicate failure
//        }
//
//        $data = $response->json(); // Decode the JSON response into a PHP array
//
//        // Show weather in console
//        $this->info("Weather in {$data['location']['name']}, {$data['location']['country']}:"); // Display location info
//        $this->line("Temperature: {$data['current']['temp_c']}°C"); // Display current temperature
//        $this->line("Feels like: {$data['current']['feelslike_c']}°C"); // Display "feels like" temperature
//        $this->line("Condition: {$data['current']['condition']['text']}"); // Display weather condition (e.g., Sunny)
//
//        return 0; // Return 0 to indicate successful execution
//    }
//}**//

