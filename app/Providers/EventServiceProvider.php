<?php

namespace App\Providers;

use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Event;
use Aacotroneo\Saml2\Events\Saml2LoginEvent;
use App\User;
use Illuminate\Support\Facades\Auth;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        Registered::class => [
            SendEmailVerificationNotification::class,
        ],
    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        parent::boot();

        Event::listen('Aacotroneo\Saml2\Events\Saml2LoginEvent', function (Saml2LoginEvent $event) {
            $messageId = $event->getSaml2Auth()->getLastMessageId();
            // Add your own code preventing reuse of a $messageId to stop replay attacks

            $user = $event->getSaml2User();
            $userData = [
                'id' => $user->getUserId(),
                'attributes' => $user->getAttributes(),
                'assertion' => $user->getRawSamlAssertion()
            ];
            // dd($userData);
            $createData = [
                'name' => $userData['attributes']['firstname'][0] . ' ' . $userData['attributes']['lastname'][0],
                'email' => $userData['attributes']['email'][0],
                'username' => $userData['attributes']['uid'][0],
                'firstname' => $userData['attributes']['firstname'][0],
                'lastname' => $userData['attributes']['lastname'][0],
                // 'rank' => $userData['attributes']['rank'][0],
                'password' => '',
            ];
            $laravelUser = User::firstWhere('username', $createData['username']);

            if (!$laravelUser) {
                $laravelUser = User::create($createData);
            }

            Auth::login($laravelUser, true);
        });

        //
    }
}
