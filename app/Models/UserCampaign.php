<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserCampaign extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id',
        'campaign_id',
        'is_owner',
    ];
}
