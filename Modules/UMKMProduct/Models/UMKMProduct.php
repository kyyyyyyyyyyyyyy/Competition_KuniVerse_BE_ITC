<?php

namespace Modules\UMKMProduct\Models;

use App\Models\BaseModel;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class UMKMProduct extends BaseModel
{
    use HasFactory;
    use SoftDeletes;

    protected $table = 'umkm_products';

    /**
     * Create a new factory instance for the model.
     *
     * @return \Illuminate\Database\Eloquent\Factories\Factory
     */
    protected static function newFactory()
    {
        return \Modules\UMKMProduct\database\factories\UMKMProductFactory::new();
    }
}
