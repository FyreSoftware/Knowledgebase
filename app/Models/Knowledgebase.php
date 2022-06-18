<?php

namespace Pterodactyl\Models;

class Knowledgebase extends Model
{
    /**
     * @var string
     */
    protected $table = 'knowledgebase';

    /**
     * @var bool
     */
    public $timestamps = false;

    /**
     * @var array
     */
    protected $fillable = ['key', 'value'];

    /**
     * @var array
     */
    public static $validationRules = [
        'key' => 'required|string|between:1,191',
        'value' => 'string',
    ];
}
