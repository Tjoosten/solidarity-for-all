<?php

namespace App\Models;

use App\Models\Relations\Creatorable;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Category
 *
 * @package App\Models
 */
class Category extends Model
{
    use Creatorable;

    /**
     * Protected fields for the internal mass-assignment system.
     *
     * @var array
     */
    protected $guarded = [];
}
