<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class WebhookLog extends Model
{
    protected $table = 'webhooks_logs';
    protected $primaryKey = 'id';

 	public $timestamps = true;
    public $incrementing = true;
}
