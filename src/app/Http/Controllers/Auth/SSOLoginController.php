<?php

namespace CapeAndBay\AnchorCMS\app\Http\Controllers\Auth;

use Illuminate\Http\Request;
use CapeAndBay\AnchorCMS\AnchorCMS;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use CapeAndBay\AnchorCMS\app\Http\Controllers\Controller;

class SSOLoginController extends Controller
{
    protected $request;
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    public function login($anchor_side_uuid, AnchorCMS $anchor)
    {
        $redirect_uri = '/';

        $data = $this->request->all();

        // Validate the request or go to the homepage (actually 404)
        if(array_key_exists('email', $data))
        {
            // Use the DockingPort object to call AnchorCMS and confirm the ID passed in or fail.
            $docking_port = $anchor->get('docking-port');
            $docking_port->setUserUUID($anchor_side_uuid);
            $response = $docking_port->confirmIdentity();

            // The response returns true or fail
            if($response && array_key_exists('success', $response) && ($response['success'] == true))
            {
                //  Evaluate the response - look for email and check if exists in users.
                if($response['user']['email'] == $data['email'])
                {
                    $user_table = config('anchor-cms.users_table');
                    $model = new $user_table();
                    $user = $model->whereEmail($data['email'])->first();

                    if(is_null($user))
                    {
                        // If not exists, create user and create role as user and (if set) backpack user.
                    }

                    // auth the user and redirect to redirect URL in the config
                    if(config('anchor-cms.cms_driver') == 'backpack')
                    {
                        try
                        {
                            $buser = \App\Models\BackpackUser::find($user->id);
                            backpack_auth()->login($buser);
                        }
                        catch(\Exception $e){
                            info('Backpack not installed, reverting to traditional Auth');
                            Auth::login($user);
                        }

                    }
                    else
                    {
                        Auth::login($user);
                    }

                    $redirect_uri = config('anchor-cms.single-sign-on-redirect');
                }
            }
            else
            {
                activity('sso-fail')
                    ->withProperties(['user_uuid' => $anchor_side_uuid, 'email' => $data['email'],'response' => $response])
                    ->log('Failed SSO');
            }
        }

        return $docking_port->disembark($redirect_uri);
    }
}
