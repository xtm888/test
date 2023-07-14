<?php

namespace App\Models;

use App\Traits\Uuids;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class DisputeMessage extends Model
{
    use Uuids;

    public $incrementing = false;
    protected $primaryKey = 'id';
    protected $keyType = 'string';

    /**
     * \App\Dispute instance
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function dispute()
    {
        return $this->belongsTo(Dispute::class, 'dispute_id');
    }

    /**
     * Set dispute of this message
     *
     * @param Dispute $dispute
     */
    public function setDispute(Dispute $dispute)
    {
        $this->dispute_id = $dispute->id;
    }

    /**
     * Set author of the message
     *
     * @param User $author
     */
    public function setAuthor(User $author)
    {
        $this->author_id = $author->id;
    }

    /**
     * Return author of the purchase
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function author()
    {
        return $this->hasOne(User::class, 'id', 'author_id');
    }

    /**
     * Past time since message is created
     *
     * @return string
     */
    public function getTimeAgoAttribute()
    {
        return Carbon::parse($this->created_at)->diffForHumans();
    }

}
