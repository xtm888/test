<?php

namespace App\Models;

use App\Traits\Uuids;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Conversation extends Model
{
    use Uuids;
    use SoftDeletes;

    public $incrementing = false;
    protected $primaryKey = 'id';
    protected $keyType = 'string';

    protected $guarded = [];

    public static function createSystemMessage($toUserId, $title, $body)
    {
        $newSystemMessage = self::create([
            'subject' => $title,
            'isSystem' => true
        ]);

        $newSystemMessage->messages()->create([
            'user_id' => $toUserId,
            'body' => $body
        ]);

        $newSystemMessage->users()->attach($toUserId, ['unRead' => 1]);

        return $newSystemMessage;
    }

    public function users()
    {
        return $this->belongsToMany(User::class);
    }

    public function messages()
    {
        return $this->hasMany(Message::class);
    }

    public function lastMessage()
    {
        return $this->hasOne(Message::class)->latest();
    }

    public function markMessagesAsRead($id)
    {
        $user = auth()->user();
        $makeRead = $user->conversations->find($id);
        $makeRead->pivot->update(['unRead' => 0]);
    }






    /**
     * Update time of the conversation
     */
    public function updateTime()
    {
        $this -> updated_at = Carbon::now();
        $this -> save();
    }

    public function IsSystem()
    {
        return $this->isSystem;
    }

}
