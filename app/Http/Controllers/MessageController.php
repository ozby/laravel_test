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
    public function index(Request $request, $archived = false)
    {
        $this->validate($request, [
            'status' => 'in:' . Message::STATUS_READ . ',' . Message::STATUS_UNREAD,
            'offset' => 'required|numeric',
            'limit' => 'required|numeric',
        ]);

        $status = $request->get("status");
        $offset = (int)$request->get("offset");
        $limit = (int)$request->get("limit");

        $message = Message::where('isArchived', '=', $archived);
        if ($status) {
            $collection = $message->where('status', '=', $status)->skip($offset)->take($limit)->get();
        } else {
            $collection = $message->skip($offset)->take($limit)->get();
        }

        return $collection;
    }
    /**
     * @SWG\Get(
     *   path="/listArchived",
     *   summary="Gets list of archived messages",
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
    public function indexArchived(Request $request)
    {
        return $this->index($request, true);
    }

    /**
     * @SWG\Put(
     *   path="/read/{uid}",
     *   summary="Mark a message as read",
     *   @SWG\Parameter(
     *            name="uid",
     *            in="path",
     *            required=true,
     *            type="integer",
     *            description="Id of the message"
     *   ),
     *   @SWG\Response(response=200, description="successful operation")
     * )
     *
     * Mark a message as read
     *
     * @return Message
     */
    public function read(int $uid)
    {
        $response = Message::find($uid);
        if ($response instanceof Message && $response->status === Message::STATUS_UNREAD) {
            $response = clone $response;
            $response->status = Message::STATUS_READ;
            $response->save();
        }

        return $response;
    }


    /**
     * @SWG\Put(
     *   path="/archive/{uid}",
     *   summary="Mark a message as archived",
     *   @SWG\Parameter(
     *            name="uid",
     *            in="path",
     *            required=true,
     *            type="integer",
     *            description="Id of the message"
     *   ),
     *   @SWG\Response(response=200, description="successful operation")
     * )
     *
     * Mark a message as read
     *
     * @return Message
     */
    public function archive(int $uid)
    {
        $response = Message::find($uid);
        if ($response->isArchived === false) {
            $response = clone $response;
            $response->isArchived = true;
            $response->save();
        }

        return $response;
    }

    /**
     * @SWG\Get(
     *   path="/show/{uid}",
     *   summary="Display a message",
     *   @SWG\Parameter(
     *            name="uid",
     *            in="path",
     *            required=true,
     *            type="integer",
     *            description="Id of the message"
     *   ),
     *   @SWG\Response(response=200, description="successful operation")
     * )
     *
     * Display a message
     *
     * @return Message
     */
    public function show(int $uid)
    {
        $response = Message::find($uid);
        return $response;
    }



}
