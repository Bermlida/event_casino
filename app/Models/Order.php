<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\Pivot;
use Illuminate\Database\Eloquent\SoftDeletes;

class Order extends Pivot
{
    use SoftDeletes;

    /**
     * 需要被轉換成日期的屬性。
     *
     * @var array
     */
    protected $dates = ['deleted_at'];

    /**
     * 取得購買此訂單的用戶。
     */
    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }

    /**
     * 取得此訂單購買的活動。
     */
    public function activity()
    {
        return $this->belongsTo('App\Models\Activity');
    }
    
    /**
     * 取得此訂單的交易紀錄。
     */
    public function transations()
    {
        return $this->hasMany('App\Models\Transation');
    }
}
