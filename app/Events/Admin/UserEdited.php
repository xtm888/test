<?php

namespace App\Events\Admin;

use App\Models\User;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class UserEdited
{
    use Dispatchable, SerializesModels;

    /**
     * Edited data
     *
     * @var array
     */
    public $editedData = [];
    /**
     * On what fields are changes registered
     *
     * @var array
     */
    private $listeningForChanges = [
        'username',
        'referral_code',
    ];

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(User $oldUserData, User $newUserData, User $admin)
    {

        $oldUser = $this->removeKeys($oldUserData->getAttributes());
        $newUser = $this->removeKeys($newUserData->getAttributes());
        $diff1 = array_diff($oldUser, $newUser);
        $diff2 = array_diff($newUser, $oldUser);

        $this->editedData = [
            'field' => key($diff1),
            'old' => reset($diff1),
            'new' => reset($diff2),
            'admin' => $admin,
            'user' => $newUserData
        ];
    }

    public function removeKeys($unfilteredArray)
    {
        $array = [];
        foreach ($this->listeningForChanges as $field) {
            $array[$field] = $unfilteredArray[$field];
        }
        return $array;
    }
}
