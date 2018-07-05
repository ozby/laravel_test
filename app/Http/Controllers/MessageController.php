<?php

namespace App\Http\Controllers;

use App\Message;
use Illuminate\Http\Request;
use Jenssegers\Mongodb\Collection;

class MessageController extends Controller
{
    /**
     * @SWG\Get(
     *   path="/list",
     *   summary="Gets list of messages",
     *   @SWG\Parameter(
     *     	    name="status",
     * 			in="query",
     * 			required=false,
     * 			type="string",
     * 			description="Read status",
     *          enum={"read", "unread"}
     *  ),
     *   @SWG\Parameter(
     *     	    name="offset",
     * 			in="query",
     * 			required=true,
     * 			type="integer",
     * 			description="From"
     *  ),
     *   @SWG\Parameter(
     *     	    name="limit",
     * 			in="query",
     * 			required=true,
     * 			type="integer",
     * 			description="How many records should be returned"
     *  ),
     *   @SWG\Response(response=200, description="successful operation")
     * )
     *
     * Display a listing of the resource.
     *
     * @return Message[]|Collection
     */
    public function index(Request $request)
    {
        $messages = Message::all();

        return $messages;
    }
}
