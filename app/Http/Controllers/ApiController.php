<?php namespace BookStack\Http\Controllers;

use Activity;
use BookStack\Entities\EntityRepo;
use Illuminate\Http\Response;
use Views;

class ApiController extends Controller
{
    protected $entityRepo;

    /**
     * HomeController constructor.
     * @param EntityRepo $entityRepo
     */
    public function __construct(EntityRepo $entityRepo)
    {
        $this->entityRepo = $entityRepo;
        parent::__construct();
    }


    /**
     * Display the homepage.
     * @return Response
     */
    public function latestPages($apikey)
    {
		$apikeyConfig = env('API_KEY', '');
		if(!$apikeyConfig || $apikeyConfig != $apikey) {
			return response()->json([
				'name' => 'error'
			]);
		}

        $recentlyUpdatedPages = $this->entityRepo->getRecentlyUpdated('page', 12);
        return response()->json($recentlyUpdatedPages);
    }

}
