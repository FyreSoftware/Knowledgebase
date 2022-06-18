<?php

namespace Pterodactyl\Http\Requests\Admin\Knowledgebase;

use Pterodactyl\Http\Requests\Admin\AdminFormRequest;

class CategoryFormRequest extends AdminFormRequest
{

    /**
     * @return array
     */
    public function rules(): array
    {
        return [
            'name' => 'required|string',
            'description' => 'required|string'
        ];
    }
}
