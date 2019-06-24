<?php

namespace App\Http\Controllers;

use App\Breeds;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;
use GuzzleHttp\Exception\ConnectException;
use Illuminate\Database\QueryException;

class BreedsController extends Controller
{

    public function getInfo(){
   		try {
	    	$name = Input::get('name');
	    	if($name){
	    		try {
	    			$breed = DB::table('breeds')->where('name', 'like', '%' . $name . '%')->get();
	    			if(count($breed) > 0){
	    				foreach ($breed as $value) {
	    					$filtered_array = array_filter((array)$value,'strlen');
	    					unset($filtered_array['cat_id']);
	    					unset($filtered_array['experimental']);
	    					$response[] = $filtered_array;
	    				}
	    				return json_encode($response);
	    			} else {
			    		$client = new Client();
			    		$response = $client->get('https://api.thecatapi.com/v1/breeds/search', [
						    'headers' => [
						        'x-api-key' => '4c6c1ab5-575b-4598-b70b-c9d9a8116736',
						    ],
						    'query' => [
						        'q' => $name,
						    ],
						]);
						$response = json_decode($response->getBody(), true);
						foreach ($response as $new_breed) {
							$this->createBreed($new_breed);
						}
						return $response;
	    			}
	    		} catch (ConnectException | RequestException | QueryException |Exception $e) {
	    			return response()->json([
			            'error' => 'Service unavailable'
			        ], 503);
	    		}
	    	} else {
	    		return response()->json([
		            'message' => 'No Content'
		        ], 204);
	    	}
   		} catch (Exception $e) {
   			return response()->json([
	            'error' => 'Service unavailable'
	        ], 503);
   		}
    }

    public function createBreed($breed){
    	if(array_key_exists("weight", $breed)){
			$breed["weight_imperial"] = $breed["weight"]["imperial"];
			$breed["weight_metric"] = $breed["weight"]["metric"];
			unset($breed["weight"]);
		}
		DB::table('breeds')->insert($breed);
    }
}
