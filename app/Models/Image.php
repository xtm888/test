<?php

namespace App\Models;

use App\Traits\Uuids;
use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    use Uuids;

    public $incrementing = false;
    protected $primaryKey = 'id';
    protected $keyType = 'string';

    /**
     * Returns the product that holds this image
     *
     */
    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id', 'id');
    }

    /**
     *  Set the product for this images
     *
     * @param Product $product
     */
    public function setProduct(Product $product)
    {
        $this->product_id = $product->id;
    }
}
