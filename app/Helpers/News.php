<?php

namespace App\Helpers;
use Illuminate\Support\Facades\Http;
use \Exception;


class News
{

	/**
	 * Query news api
	 */
	public static function api($limit = 6, $page = 1, $query = 'Real Estate', $lang = 'en')
	{
		try {
            $response = Http::withHeaders([
                'x-rapidapi-host' => 'free-news.p.rapidapi.com',
                'x-rapidapi-key' => env('RAPID_API_KEY')
            ])->get('https://free-news.p.rapidapi.com/v1/search', [
                'q' => $query,
                'lang' => $lang,
                'page' => $page,
                'page_size' => $limit,
            ]);

            if ($response->failed()) {
            	return [
            		'status' => 0,
            		'info' => 'Request failed. Try again'
            	];
            }

            $result = (array)$response->json();
            if (strtolower($result['status']) === 'ok') {
            	return [
            		'status' => 1,
            		'info' => 'Request successfull',
            		'data' => $result
            	];
            }

            return [
        		'status' => 0,
        		'info' => 'Invalid request. Try again'
        	];
<<<<<<< HEAD
        } catch (Exception $error) {
=======
        } catch (Exception $exception) {
>>>>>>> b0e72cfb0b42dc80ca26a72be07e041bc89300f5
            return [
        		'status' => 0,
        		'info' => 'An error occured. Try again later'
        	];
        }
	}

}