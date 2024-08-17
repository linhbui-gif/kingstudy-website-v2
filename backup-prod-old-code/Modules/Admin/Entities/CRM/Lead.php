<?php

namespace Modules\Admin\Entities\CRM;

use Illuminate\Database\Eloquent\Model;

class Lead extends Model
{
    protected $guarded = [];

    protected $table = 'leads';

    protected $connection = 'crm_mysql';
}
