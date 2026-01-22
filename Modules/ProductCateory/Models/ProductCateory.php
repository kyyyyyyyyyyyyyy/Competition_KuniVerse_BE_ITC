<?php

namespace Modules\ProductCateory\Models;

use App\Models\BaseModel;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class ProductCateory extends BaseModel
{
    use HasFactory;
    use SoftDeletes;

    protected $table = 'product_categories';
    

    /**
     * Create a new factory instance for the model.
     *
     * @return \Illuminate\Database\Eloquent\Factories\Factory
     */
    protected static function newFactory()
    {
        return \Modules\ProductCateory\database\factories\ProductCateoryFactory::new();
    }
}
