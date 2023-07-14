<?php

namespace App\Models;

use App\Events\Admin\UserPermissionsUpdated;
use App\Exceptions\RequestException;
use App\Marketplace\Utility\CurrencyConverter;
use App\Traits\Adminable;
use App\Traits\Displayable;
use App\Traits\Notifiable;
use App\Traits\Uuids;
use App\Traits\Vendorable;
use Carbon\Carbon;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\DB;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

//use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{

    /**
     * Traits used by User model
     */
    use Uuids;
    use Notifiable;
    use Vendorable;
    use Adminable;
    use Displayable;

    /**
     * Permissions of the User
     *
     * @var array
     */
    public static $permissions = ['categories', 'messages', 'users', 'products', 'logs', 'disputes', 'tickets', 'vendorpurchase', 'purchases'];
    public static $permissionsLong = [
        'categories' => 'Categories',
        'messages' => 'Messages',
        'users' => 'Users',
        'products' => 'Products',
        'logs' => 'Logs',
        'disputes' => 'Disputes',
        'tickets' => 'Tickets',
        'vendorpurchase' => 'Vendor Purchases',
        'purchases' => 'Purchases'
    ];

    public $incrementing = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Returns User with only username which is not persisted in db used for market conversations
     * NOT USED YET
     * @return User
     */
    public static function stub()
    {
        $stubUser = new User();
        $stubUser->username = 'MARKET MESSAGE';
        return $stubUser;
    }

    /**
     * Collection of users just buyers
     * NOT USED YET
     * @return User[]|\Illuminate\Database\Eloquent\Collection
     */
    public static function buyers()
    {
        $allUsers = User::all();
        $onlyBuyers = $allUsers->diff(Admin::allUsers());
        $onlyBuyers = $onlyBuyers->diff(Vendor::allUsers());

        return $onlyBuyers;
    }

    /**
     * Finds user by username
     *
     * NOT USED YET
     * @param string $username
     * @return User
     */
    public static function findByUsername(string $username): User
    {
        $user = self::where('username', $username)->first();
        if ($user == null) {
            throw new NotFoundHttpException('User not found');
        }
        return $user;
    }

    /**
     * Overrides remeber token setting during logout
     * NOT USED YET
     * WARN1
     * @param string $value
     */
    public function setRememberToken($value)
    {
        // do nothing
    }

    /**
     * Determines if the user has pgp key set
     *
     * NOT USED YET
     * @return bool
     */
    public function hasPGP()
    {
        return $this->pgp_key != null;
    }

    /**
     * Collection of old keys  that are not in usage
     *
     * NOT USED YET
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function pgpKeys()
    {
        return $this->hasMany(PGPKey::class, 'user_id', 'id');
    }

    /**
     * Sets the login 2fa on or off
     *
     * NOT USED YET
     * @param $turn
     * @throws RequestException
     */
    public function set2fa($turn)
    {
        if ($turn == true && $this->pgp_key == null)
            throw new RequestException("To turn on the Two Factor Authetication you will need to add PGP key first!");
        elseif ($turn == $this->login_2fa)
            throw new RequestException("Test");
        else {
            // set the login 2fa
            $this->login_2fa = $turn == true;
            $this->save();
        }
    }

    /**
     * Return user's notifications
     *
     * NOT USED YET
     * CHANGE1
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function notifications()
    {
        return $this->hasMany(Notification::class);
    }

    /**
     * Return amount of recent products
     *
     * NOT USED YET
     * @param int $amount
     * @return \Illuminate\Database\Eloquent\Collection|\Illuminate\Support\Collection
     */
    public function recentProducts($amount = 3)
    {
        return $this->products()->take($amount)->get();
    }

    /**
     * Return Product that user have
     *
     * NOT USED YET
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function products()
    {
        return $this->hasMany(Product::class, 'user_id')->where('active', true)->orderByDesc('created_at');
    }

    /**
     * Returns collection of whishes
     *
     * NOT USED YET
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function whishes()
    {
        return $this->hasMany(Wishlist::class, 'user_id', 'id');
    }

    /**
     * Returns true if this user is whishing product
     *
     * NOT USED YET
     * @param Product $product
     * @return bool
     */
    public function isWhishing(Product $product)
    {
        return Wishlist::added($product, $this);
    }

    /**
     * PGP KEY FUNCTIONS
     * NOT USED YET
     * @param $value
     * @return mixed
     */
    public function getMsgPublicKeyAttribute($value)
    {
        return decrypt($value);
    }

    public function setMsgPublicKeyAttribute($value)
    {
        $this->attributes['msg_public_key'] = encrypt($value);
    }

    public function getMsgPrivateKeyAttribute($value)
    {
        return decrypt($value);
    }

    public function setMsgPrivateKeyAttribute($value)
    {
        $this->attributes['msg_private_key'] = encrypt($value);
    }

    /**
     * Returns string time how long passed since user joined
     *
     * NOT USED YET
     * @return string
     */
    public function getJoinedAttribute()
    {
        return Carbon::parse($this->created_at)->diffForHumans();
    }

    /**
     * Define vendor relationship of purchases
     *
     * NOT USED YET
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function sales()
    {
        return $this->hasMany(Purchase::class, 'vendor_id', 'id');
    }

    /**
     * Returns number of all purchases for this user or number of purchases in particular state
     *
     * NOT USED YET
     * @param string $state
     * @return int
     */
    public function purchasesCount($state = ''): int
    {
        if (!array_key_exists($state, Purchase::$states))
            return $this->purchases()->count();

        return $this->purchases()->where('state', $state)->count();
    }

    /**
     * Define relationship of purchases
     *
     * NOT USED YET
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function purchases()
    {
        return $this->hasMany(Purchase::class, 'buyer_id', 'id');
    }

    /**
     * Set the bitcoin address
     * NOT USED YET
     * @param $address
     * @param string $coin
     */
    public function setAddress($address, string $coin = 'btc')
    {
        $newAddress = new Address;
        $newAddress->address = $address;
        $newAddress->user_id = $this->id;
        $newAddress->coin = $coin;
        $newAddress->save();
    }

    /**
     * Relationship with the conversations where the user is sender
     *
     * NOT USED YET
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function senderconversations()
    {
        return $this->hasMany(Conversation::class, 'sender_id', 'id');
    }

    /**
     * NOT USED YET
     * Relationship with the conversations where the user is receiver
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function receiverconversations()
    {
        return $this->hasMany(Conversation::class, 'receiver_id', 'id');
    }

    /**
     * NOT USED YET
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function getConversationsAttribute()
    {
        return $this->conversations()->get();
    }

    /**
     * NOT USED YET
     * All conversations as Query Builder
     *
     */
    public function conversations()
    {
//        return Message::where('user_id', $this->id)->orWhere('receiver_id', $this->id);
        return $this->belongsToMany(Conversation::class)->withPivot('unRead');
    }

    /**
     * Returns the most recent address of the given coin for this user
     * NOT USED YET
     *
     * @param $coin
     * @return \Illuminate\Database\Eloquent\Model|\Illuminate\Database\Eloquent\Relations\HasMany|object
     * @throws RequestException
     */
    public function coinAddress($coin)
    {
        if (!in_array($coin, array_keys(config('coins.coin_list'))))
            throw new RequestException('Purchase completion attempt unsuccessful, coin not suported by marketpalce');

        $usersAddress = $this->addresses()->where('coin', $coin)->orderByDesc('created_at')->first();
        if (is_null($usersAddress) && $coin == 'btcm')
            throw new RequestException('User ' . $this->username . ' doesn\'t have a valid public key for making multisig address!');
        if (is_null($usersAddress))
            throw new RequestException('User ' . $this->username . ' doesn\'t have a valid address for sending funds! If this is user who referred you please notify him!');
        return $usersAddress;
    }

    /**
     * Return collection of addresses
     *
     * NOT USED YET
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function addresses()
    {
        return $this->hasMany(Address::class, 'user_id', 'id');
    }

    /**
     * Returns how many addresses have user for this $coin
     *
     * NOT USED YET
     * @param $coin
     * @return int
     * @throws RequestException
     */
    public function numberOfAddresses($coin)
    {
        if (!in_array($coin, array_keys(config('coins.coin_list'))))
            throw new RequestException('There is no coin under that name!');

        return $this->addresses()->where('coin', $coin)->count();
    }

    /**
     * Returns registration date in format: Month/Year (Jan/2018)
     * NOT USED YET
     *
     * @return string
     */
    public function memberSince()
    {
        return date_format($this->created_at, "M/Y");
    }

    /**
     * Generate deposit addresses for this User
     * NOT USED YET
     */
    public function generateDepositAddresses()
    {
        $coinsClasses = config('coins.coin_list');

        // vendor fee in usd
        $marketVendorFee = config('marketplace.vendor_fee');

        // for each supported coin generate instance of the coin
        foreach ($coinsClasses as $coinClass) {
            $coinsService = new $coinClass();
            try {
                // Add new deposit address
                $newDepositAddress = new VendorPurchase;
                $newDepositAddress->user_id = $this->id;

                $newDepositAddress->address = $coinsService->generateAddress(['user' => $this->id]);
                $newDepositAddress->coin = $coinsService->coinLabel();

                $newDepositAddress->save();
            } catch (\Exception $e) {
                \Illuminate\Support\Facades\Log::error($e);
            }
        }
    }

    /**
     * One to many relationship with the deposit addresses
     * NOT USED YET
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function vendorPurchases()
    {
        return $this->hasMany(VendorPurchase::class, 'user_id', 'id');
    }

    /**
     * Relationship with User who referred $this user
     * NOT USED YET
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function referredBy()
    {
        return $this->hasOne(User::class, 'id', 'referred_by');
    }

    /**
     * Returns if the user has referred by user
     * NOT USED YET
     * @return bool
     */
    public function hasReferredBy()
    {
        return $this->referredBy != null;
    }

    public function referredByUsername()
    {
        return $this->referredBy->username;
    }

    /**
     * Returns true if the user has any permission
     * NOT USED YET
     * @return bool
     */
    public function hasPermissions()
    {
        return $this->permissions()->exists();
    }

    /**
     * Relationship with permissions, User can have 0..* permissions
     * NOT USED YET
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function permissions()
    {
        return $this->hasMany(Permission::class, 'user_id', 'id');
    }

    /**
     * Returns if the user has specific permission
     *
     * NOT USED YET
     * @param $name
     * @return bool
     */
    public function hasPermission($name)
    {
        return $this->permissions()->where('name', $name)->exists();
    }

    /**
     * Deletes all old permissions, and sets the new permissions
     * NOT USED YET
     * ChangeUserGroupRequest will be trigger
     * @param array $permissions
     * @throws RequestException
     */
    public function setPermissions(array $permissions)
    {
        // check if there is forbidden permissions
        if (!empty(array_diff($permissions, self::$permissions)))
            throw new RequestException("There are forbidden permissions!");

        try {
            DB::beginTransaction();
            // delete old permissions
            Permission::where('user_id', $this->id)->delete();

            // insert new permissions
            foreach ($permissions as $inputPermission) {
                $newPermission = new Permission;
                $newPermission->name = $inputPermission;
                $newPermission->setUser($this);
                $newPermission->save();
            }

            DB::commit();
            event(new UserPermissionsUpdated($this, auth()->user()->admin));
        } catch (\Exception $e) {
            DB::rollBack();
            \Illuminate\Support\Facades\Log::error($e);
            throw new RequestException("Error happened with the database please try again!");
        }
    }

    /**
     * Relationship with the tickets
     * NOT USED YET
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function tickets()
    {
        return $this->hasMany(Ticket::class, 'user_id', 'id');
    }

    /**
     * Collection of tickets replies
     * NOT USED YET
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function replies()
    {
        return $this->hasMany(TicketReply::class, 'user_id', 'id');
    }

    /**
     * Returns bool if the user is banned
     * NOT USED YET
     * @return bool
     */
    public function isBanned(): bool
    {
        if (!$this->bans()->exists()) return false;

        // Find the ban sorted by time
        $latestBan = $this->bans()->orderByDesc('until')->first();

        // if the until time is greather than now
        if (Carbon::parse($latestBan->until)->gte(Carbon::now()))
            return true;

        return false;
    }

    /**
     * Relationship with the bans
     * NOT USED YET
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function bans()
    {
        return $this->hasMany(Ban::class, 'user_id', 'id');
    }

    /**
     * Make ban from now
     * NOT USED YET
     * @param $days
     */
    public function ban($days)
    {
        $newBan = new Ban;

        if ($this->bans()->exists()) {
            $latestBan = $this->bans()->orderByDesc('until')->first();
            if (Carbon::parse($latestBan->until)->lt(Carbon::now()->addDays($days)))
                $newBan = $latestBan;
        }


        $newBan->user_id = $this->id;
        $newBan->until = Carbon::now()->addDays($days);
        $newBan->save();
    }

    /* NOT USED YET */
    public function getLocalCurrency()
    {
        if (!CurrencyConverter::isEnabled()) {
            return 'USD';
        }
        return CurrencyConverter::getLocalCurrency();
    }

    /* NOT USED YET */
    public function getId()
    {
        return $this->id;
    }

}
