<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;

/**
 * Class SuppliersAccountLog
 */
class SuppliersAccountLog extends Model
{
    protected $table = 'suppliers_account_log';

    protected $primaryKey = 'log_id';

    public $timestamps = false;

    protected $fillable = [
        'user_id',
        'user_money',
        'frozen_money',
        'change_time',
        'change_desc',
        'change_type'
    ];

    protected $guarded = [];


    /**
     * @return mixed
     */
    public function getUserId()
    {
        return $this->user_id;
    }

    /**
     * @return mixed
     */
    public function getUserMoney()
    {
        return $this->user_money;
    }

    /**
     * @return mixed
     */
    public function getFrozenMoney()
    {
        return $this->frozen_money;
    }

    /**
     * @return mixed
     */
    public function getChangeTime()
    {
        return $this->change_time;
    }

    /**
     * @return mixed
     */
    public function getChangeDesc()
    {
        return $this->change_desc;
    }

    /**
     * @return mixed
     */
    public function getChangeType()
    {
        return $this->change_type;
    }

    /**
     * @param $value
     * @return $this
     */
    public function setUserId($value)
    {
        $this->user_id = $value;
        return $this;
    }

    /**
     * @param $value
     * @return $this
     */
    public function setUserMoney($value)
    {
        $this->user_money = $value;
        return $this;
    }

    /**
     * @param $value
     * @return $this
     */
    public function setFrozenMoney($value)
    {
        $this->frozen_money = $value;
        return $this;
    }

    /**
     * @param $value
     * @return $this
     */
    public function setChangeTime($value)
    {
        $this->change_time = $value;
        return $this;
    }

    /**
     * @param $value
     * @return $this
     */
    public function setChangeDesc($value)
    {
        $this->change_desc = $value;
        return $this;
    }

    /**
     * @param $value
     * @return $this
     */
    public function setChangeType($value)
    {
        $this->change_type = $value;
        return $this;
    }
}
