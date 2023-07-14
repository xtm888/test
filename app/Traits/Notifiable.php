<?php

namespace App\Traits;

use App\Jobs\BitmessageNotify;
//use App\Models\Notification;

trait Notifiable
{

    /**
     * Create new notifications for specified user
     *
     * @param string $content
     * @param string|null $routeName
     * @param string|null $routePramas
     */
    public function notify(string $content,string $routeName = null,string $routePramas = null) {
        $this->notifications()->create(['description' => $content,'route_name'=>$routeName,'route_params'=> $routePramas]);

        /**
         * Bitmessage
         */
        if (config('bitmessage.enabled')){
            if ($this->bitmessage_address !== NULL){
                // if its enabled send message
                BitmessageNotify::dispatch('Notification from marketplace',$content,$this->bitmessage_address)->delay(now()->addSecond());
            }
        }
    }

    /**
     * Return user's unread notifications
     *
     * @return mixed
     */
    public function unreadNotifications(){
        return $this->notifications()->where('read',0);
    }

    public function getUnReadCount()
    {
        $unReadMsg = 0;
        foreach (auth()->user()->conversations as $conversation) {
            if ($conversation->pivot->unRead == 1) {
                $unReadMsg++;
            }
        }
        return $unReadMsg;
    }

}
