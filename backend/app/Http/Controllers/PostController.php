<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use GuzzleHttp\Client;


class PostController extends Controller
{

    private function getUsers($login){

        $client = new Client(); //GuzzleHttp\Client
        $url = "https://api.github.com/users/$login";


        $response = $client->request('GET', $url, [
            'verify'  => false,
        ]);

       return json_decode($response->getBody());
    }

    public function store(Request $request){

        $login = $request->get('login');

         $data = $this->getUsers($login);
         Storage::disk('public')->put('arquivo.json', json_encode($data));

         return response('Dados salvos com sucesso');
    }
}
