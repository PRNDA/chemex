<?php

namespace App\Models;

use Dcat\Admin\Traits\HasDateTimeFormatter;
use Dcat\Admin\Traits\ModelTree;
use Illuminate\Database\Eloquent\HigherOrderBuilderProxy;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * @method static where(string $key, string $value1, string $value2 = null)
 * @method static pluck(string $string, string $string1)
 */
class ConsumableRecord extends Model
{
    use HasDateTimeFormatter;
    use SoftDeletes;
    use ModelTree;

    /**
     * 需要被包括进排序字段的字段，一般来说是虚拟出来的关联字段.
     *
     * @var string[]
     */
    public $sortIncludeColumns = [
        'category.name',
        'vendor.name',
    ];
    /**
     * 需要被排除出排序字段的字段，一般来说是关联字段的原始字段.
     *
     * @var string[]
     */
    public $sortExceptColumns = [
        'category_id',
        'vendor_id',
        'deleted_at',
    ];
    protected $table = 'consumable_records';

    /**
     * 模型事件
     */
    protected static function booting()
    {
        static::saving(function ($model) {
            if (!empty($model->deleted_at)) {
                abort(401, 'you can not do that.');
            }
        });
    }

    public function category(): HasOne
    {
        return $this->hasOne(ConsumableCategory::class, 'id', 'category_id');
    }

    public function vendor(): HasOne
    {
        return $this->hasOne(VendorRecord::class, 'id', 'vendor_id');
    }

    /**
     * 耗材总数.
     *
     * @return HigherOrderBuilderProxy|int|mixed
     */
    public function allCounts()
    {
        $consumable_track = $this->track()->first();
        if (empty($consumable_track)) {
            return 0;
        } else {
            return $consumable_track->number;
        }
    }

    /**
     * 耗材记录有很多耗材履历.
     * @return HasOne
     */
    public function track(): HasOne
    {
        return $this->hasOne(ConsumableTrack::class, 'consumable_id', 'id');
    }
}
