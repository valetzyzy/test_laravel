<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Client;
use App\Http\Resources\Client as ClientResource;
use Hash;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;
use Validator;

class ClientController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function index()
    {
        return ClientResource::collection(Client::all());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return ClientResource
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'first_name' => 'required|min:5',
            'last_name' => 'required|min:5',
            'email' => 'required|email|unique:clients,email',
            'password' => 'required|min:6'
        ]);

        if ($validator->fails()) {
            throw new BadRequestHttpException($validator->getMessageBag());
        }

        $client = new Client($request->all());
        $client->password = Hash::make($request->get('password'));
        $client->save();

        return new ClientResource($client);
    }

    /**
     * Display the specified resource.
     *
     * @param Client $client
     * @return ClientResource
     */
    public function show(Client $client)
    {
        return new ClientResource($client);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param Client $client
     * @return ClientResource
     */
    public function update(Request $request, Client $client)
    {
        $validator = Validator::make($request->all(), [
            'first_name' => 'sometimes|required|min:5',
            'last_name' => 'sometimes|required|min:5',
            'email' => 'sometimes|required|email',
        ]);

        if ($validator->fails()) {
            throw new BadRequestHttpException($validator->getMessageBag());
        }

        $client->update($validator->validate());

        return new ClientResource($client);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Client $client
     * @return \Illuminate\Http\JsonResponse
     * @throws \Exception
     */
    public function destroy($client)
    {
        Client::whereId($client)->delete();
    }
}
