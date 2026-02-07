<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Insurance extends Model
{
    protected $table = 'insurances';

    public $incrementing = false;

    protected $keyType = 'string';

    protected $fillable = [
        'id',
        'name',
    ];

    public function vouchers()
    {
        return $this->hasMany(Voucher::class, 'insurance_id');
    }

    public function activeVouchers()
    {
        return $this->hasMany(Voucher::class)->active();
    }
}
