<?php

namespace Pterodactyl\Http\Requests\Admin\Knowledgebase;

use Pterodactyl\Http\Requests\Admin\AdminFormRequest;

class QuestionFormRequest extends AdminFormRequest
{

    /**
     * @return array
     */
    public function rules(): array
    {
        return [
            'subject' => 'required|string',
            'information' => 'required|string',
            'category' => 'required|int'
        ];
    }
}
