<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * Class Item
 *
 * @package App\Models
 */
class Item extends Model
{
    /**
     * Protected fields for the internal mass-assign system.
     *
     * @var array
     */
    protected $guarded = [];

    /**
     * Data for the storage location.
     *
     * @return BelongsTo
     */
    public function location(): BelongsTo
    {
        return $this->belongsTo(Location::class);
    }

    /**
     * Data relation for the category that is attached to the item.
     *
     * @return BelongsTo
     */
    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    /**
     * A sure method to generate a unique API key
     *
     * @throws \Exception When an error of any kind occures.
     *
     * @return string
     */
    public static function generateItemCode(): string
    {
        do {
            $itemCode = random_int(1000, 9999);
        } // Already in the DB? Fail. Try again

        while (self::codeExists($itemCode));

        return $itemCode;
    }

    /**
     * Checks whether a item code in the database or not
     *
     * @param $key
     * @return bool
     */
    private static function codeExists(string $code): bool
    {
        $apiKeyCount = self::where('item_code', '=', $code)->limit(1)->count();

        return $apiKeyCount > 0;
    }
}
