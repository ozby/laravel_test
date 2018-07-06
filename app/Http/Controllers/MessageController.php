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
     *            name="status",
     *            in="query",
     *            required=false,
     *            type="string",
     *            description="Read status",
     *          enum={"read", "unread"}
     *  ),
     *   @SWG\Parameter(
     *            name="offset",
     *            in="query",
     *            required=true,
     *            type="integer",
     *            description="From"
     *  ),
     *   @SWG\Parameter(
     *            name="limit",
     *            in="query",
     *            required=true,
     *            type="integer",
     *            description="How many records should be returned"
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
        $this->validate($request, [
            'status' => 'in:' . Message::STATUS_READ . ',' . Message::STATUS_UNREAD,
            'offset' => 'required|numeric',
            'limit' => 'required|numeric',
        ]);

        $status = $request->get("status");
        $offset = (int)$request->get("offset");
        $limit = (int)$request->get("limit");

        if ($status) {
            $collection = Message::where('status', '=', $status)->skip($offset)->take($limit)->get();
        } else {
            $collection = Message::skip($offset)->take($limit)->get();
        }

        return $collection;
    }
}
