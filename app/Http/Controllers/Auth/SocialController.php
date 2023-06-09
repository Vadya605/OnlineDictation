<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Laravel\Socialite\Facades\Socialite;
use GuzzleHttp\Client;
use App\Services\Auth\SocialService;
use Illuminate\Http\Response;
use Exception;
use Auth;


class SocialController extends Controller
{
    private $client;
    private $socialService;

    public function __construct(Client $client, SocialService $socialService)
    {
        $this->client = new Client([
            'verify' => storage_path('app/ca-bundle.crt'),
        ]);

        $this->socialService = $socialService;
    }

    public function index()
    {
        return Socialite::driver('vkontakte')->redirect();
    }

    public function callback()
    {
        try{
            $userSocialite = Socialite::driver('vkontakte')
                ->setHttpClient($this->client)
                ->user();
                
            if($user = $this->socialService->save($userSocialite)){
                Auth::login($user);
                return redirect()->route('dictationWriting');
            }
            return back(Response::HTTP_BAD_REQUEST); 
            //что можно веруть здесь

        }catch(Exception $exp){
            return redirect()->route('home');
            //что можно веруть здесь
        }
        
    }
}
