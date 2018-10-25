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
		$latest = array();
		$apikeyConfig = env('API_KEY', '');

		if(!$apikeyConfig || $apikeyConfig != $apikey) {
			return response()->json([
				'name' => 'error'
			]);
		}

		$recentlyUpdatedPages = $this->entityRepo->getRecentlyUpdated('page', 10);
		$books = $this->entityRepo->getAll('book');

		foreach($recentlyUpdatedPages as $page) {
			$pageInfo = array(
				'name' => $page->name,
				'slug' => $page->slug,
				'updated_at' => $page->updated_at
			);

			foreach($books as $book) {
				if($book->id == $page->book_id) {
					$pageInfo['book_slug'] = $book->slug;
				}
			}
			array_push($latest, $pageInfo);
		}

        return response()->json($latest);
    }

}
