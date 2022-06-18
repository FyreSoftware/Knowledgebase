<?php

namespace Pterodactyl\Http\Requests\Admin\Knowledgebase;

use Pterodactyl\Http\Requests\Admin\AdminFormRequest;

class IndexFormRequest extends AdminFormRequest
{

    /**
     * @return array
     */
    public function rules(): array
    {
        return [
            'status' => 'boolean'
        ];
    }
}
