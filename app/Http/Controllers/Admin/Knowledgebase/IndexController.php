<?php

namespace Pterodactyl\Http\Controllers\Admin\Knowledgebase;

use Illuminate\View\View;
use Prologue\Alerts\AlertsMessageBag;
use Illuminate\Http\RedirectResponse;
use Pterodactyl\Http\Controllers\Controller;
use Pterodactyl\Exceptions\Model\DataValidationException;
use Pterodactyl\Exceptions\Repository\RecordNotFoundException;
use Pterodactyl\Http\Requests\Admin\Knowledgebase\IndexFormRequest;
use Pterodactyl\Contracts\Repository\KnowledgebaseRepositoryInterface;

class IndexController extends Controller
{
    public AlertsMessageBag $alert;
    public KnowledgebaseRepositoryInterface $knowledgebase;

    public function __construct(KnowledgebaseRepositoryInterface $knowledgebase, AlertsMessageBag $alert)
    {
        $this->alert = $alert;
        $this->knowledgebase = $knowledgebase;
    }

    /**
     * @return View
     */
    public function index(): View
    {
        return view('admin.knowledgebase.index', [
            'status' => $this->knowledgebase->get('status', false)
        ]);
    }

    /**
     * @param IndexFormRequest $request
     * @return RedirectResponse
     * @throws DataValidationException
     * @throws RecordNotFoundException
     */
    public function update(IndexFormRequest $request): RedirectResponse
    {
        foreach ($request->normalize() as $key => $value) {
            $this->knowledgebase->set($key, $value);
        }

        $this->alert->success('Knowledgebase has been successfully updated.')->flash();
        return redirect()->route('admin.knowledgebase');
    }
}
