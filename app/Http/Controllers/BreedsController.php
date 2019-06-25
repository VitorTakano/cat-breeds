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

	/**
	 *
	 * Returns the species of the cat if it is found in database, otherwise is searched in external API and added in local database;
	 *
	 * @param    
	 * @return   json
	 *
	 */
    public function getInfo(){
		$name = Input::get('name');
		if($name){
			try {
				$breed = DB::table('breeds')->where('name', 'like', '%' . $name . '%')->get();
				if(count($breed) > 0){
					foreach ($breed as $value) {
						$response[] = $this->filterResponse($value);
					}
					return json_encode($response);
				} else {
		 			return $this->createBreed($name);
				}
			} catch (Exception $e) {
				report($e);
				return false;
			}
		} else {
			return response()->json([
	            'error' => 'Internal server error'
	        ], 500);
		}
    }

    /**
	 *
	 * Filter null fields and experimental field;
	 *
	 * @param    object $bread The object to be filtered
	 * @return   json
	 *
	*/
    public function filterResponse($bread){
    	$filtered_array = array_filter((array)$bread,'strlen');
		unset($filtered_array['cat_id']);
		unset($filtered_array['experimental']);
		if(array_key_exists('weight_imperial', $filtered_array)){
			$filtered_array['weight']['imperial'] = $filtered_array['weight_imperial'];
			$filtered_array['weight']['metric'] = $filtered_array['weight_metric'];
			unset($filtered_array["weight_imperial"]);
			unset($filtered_array["weight_imperial"]);
		}
		return $filtered_array;
    }

    /**
	 *
	 * Search external api for cat breed and add to database;
	 *
	 * @param    string $name name of the breed;
	 * @return   json
	 *
	 */
    public function createBreed($name){
    	try {
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
				$this->insertBreed($new_breed);
			}
			return $response;
		} catch (Exception $e) {
			return response()->json([
	            'error' => 'Internal server error'
	        ], 500);
		}
    }

    /**
	 *
	 * Insert Breed at database;
	 *
	 * @param    object $bread to be add at the database;
	 * @return   void
	 *
	 */
    public function insertBreed($breed){
    	if(array_key_exists("weight", $breed)){
			$breed["weight_imperial"] = $breed["weight"]["imperial"];
			$breed["weight_metric"] = $breed["weight"]["metric"];
			unset($breed["weight"]);
		}
		DB::table('breeds')->insert($breed);
    }

    /**
	 *
	 * Returns breed by ID;
	 *
	 * @param    string $id to be found at the database;
	 * @return   json
	 *
	 */
    public function getbyId($id){
    	return Breeds::find($id);
    }
}
