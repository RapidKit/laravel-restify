<?php

declare(strict_types=1);

namespace RapidKit\LaravelRestify\Bases;

use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class BaseModel extends \Illuminate\Database\Eloquent\Model
{
    use HasFactory, HasUlids;

    public $filterable = [];

    public $sortable = [];
}
