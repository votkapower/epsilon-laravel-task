<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Http;

class EpsilonAccountService extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function user()
    {
        return $this->belongsTo(User::class,'user_id');
    }

    public function getIsProtectedAttribute()
    {
       return strtolower($this->protected) != 'unprotected';
    }
    
    public function getViewLinkAttribute()
    {
       return $this->id ? route('services.view', $this->id) : '#';
    }

    public static function getAccountAccessToken()
    {
       if(auth()->user()->access_token) return auth()->user()->access_token;

       $result= Http::acceptJson()->post(config('epsilon.api_credentials.endpoint').'/api/oauth2/access-token',[
                "grant_type"=> "client_credentials",
                "client_id"=> config('epsilon.api_credentials.client_id'),
                "client_secret"=> config('epsilon.api_credentials.client_secret')
        ])->json();

        // update user credentials information
        auth()->user()->update([
            'epsilon_access_token' => $result['access_token'],
            'epsilon_refresh_token' => $result['refresh_token'],
            'epsilon_access_token_expires_in' => $result['expires_in'],
        ]);

        return $result['access_token'];

    }
 

    
    public static function getRemoteAccountServices()
    {
       $access_token  = self::getAccountAccessToken();

       $servicesResponse= Http::withToken($access_token)->get(config('epsilon.api_credentials.endpoint').'/api/services');

      
       if($servicesResponse->failed() && $servicesResponse->status() == 401){
            auth()->user()->update(['epsilon_access_token'=>null]);
            $access_token  = self::getRefreshAcountToken();
            return  self::getRemoteAccountServices();
            exit;
       }
       $servicesResponseBody = $servicesResponse->json();
       return $servicesResponseBody['services'];
    }

    

    
    public static function getSyncRemoteAccountServices()
    {
       $remoteServices= self::getRemoteAccountServices();
       $user = auth()->user();
       foreach ($remoteServices as $service) {
           $user->accountServices()->updateOrCreate(
                ['epsilon_service_id'=>$service['id'] ], // updating by these paramteres
                [
                    'name'=> $service['name'],
                    'port'=> $service['port']['name'],
                    'protected'=> $service['protected'],
                    'bandwidth'=> $service['bandwidth'],
                    'pricing_model'=> $service['pricing_model'],
                    'status'=> $service['status'],
                    'type'=> $service['type'],
                    'type_short_name'=> $service['type_short_name'],
                    'cancellation_date' => $service['cancellation_date'],
                    'vlan' => $service['vlan'],
                    'nni_vlan' => $service['nni_vlan'],
                ]
            );
       }
    }
}
