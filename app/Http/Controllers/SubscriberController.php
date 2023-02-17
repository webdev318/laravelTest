<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreSubscriberRequest;
use App\Models\Subscriber;
use App\Models\Website;
use Illuminate\Http\Response;

class SubscriberController extends Controller
{
    /**
     * Store a newly created resource in storage.
     *
     * @param \App\Http\Requests\StoreSubscriberRequest $request
     * @param Website $website
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(StoreSubscriberRequest $request, Website $website)
    {
        $subscriber = new Subscriber();
        $subscriber->website()->associate($website);
        $subscriber->name = $request->name;
        $subscriber->email = $request->email;
        $subscriber->save();

        return response()->json([
            'status' => true,
            'message' => "Thank you for subscribing to {$website->name}",
            'data' => null,
        ], Response::HTTP_CREATED);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\Website $website
     * @param \App\Models\Subscriber $subscriber
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(Website $website, Subscriber $subscriber)
    {
        abort_if(
            $website->id !== $subscriber->website_id,
            'You are not subscribed to this website.',
        );

        $subscriber->delete();

        return response('', Response::HTTP_NO_CONTENT);
    }
}
