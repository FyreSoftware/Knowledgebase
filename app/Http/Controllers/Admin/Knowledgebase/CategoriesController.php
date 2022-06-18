<?php

namespace Pterodactyl\Http\Controllers\Admin\Knowledgebase;

use Carbon\Carbon;
use Illuminate\View\View;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\DB;
use Prologue\Alerts\AlertsMessageBag;
use Illuminate\Http\RedirectResponse;
use Pterodactyl\Http\Requests\Admin\Knowledgebase\CategoryFormRequest;

class CategoriesController extends Controller
{
    public AlertsMessageBag $alert;

    /**
     * @param AlertsMessageBag $alert
     */
    public function __construct(AlertsMessageBag $alert)
    {
        $this->alert = $alert;
    }

    /**
     * @return View
     */
    public function index(): View
    {
        return view('admin.knowledgebase.categories.index', [
            'categories' => DB::table('knowledgebase_categories')->paginate(10)
        ]);
    }

    /**
     * @return View
     */
    public function new(): View
    {
        return view('admin.knowledgebase.categories.new');
    }

    /**
     * @param CategoryFormRequest $request
     * @return RedirectResponse
     */
    public function store(CategoryFormRequest $request): RedirectResponse
    {
        DB::table('knowledgebase_categories')->insert([
            'name' => $request->input('name'),
            'description' => $request->input('description'),
            'updated_at' => Carbon::now(),
            'created_at' => Carbon::now()
        ]);

        $this->alert->success('Category has been successfully created.')->flash();
        return redirect()->route('admin.knowledgebase.categories.index');
    }

    /**
     * @param int $id
     * @return View
     */
    public function edit(int $id): View
    {
        return view('admin.knowledgebase.categories.edit', [
            'category' => DB::table('knowledgebase_categories')->where('id', '=', $id)->first()
        ]);
    }

    /**
     * @param CategoryFormRequest $request
     * @param int $id
     * @return RedirectResponse
     */
    public function update(CategoryFormRequest $request, int $id): RedirectResponse
    {
        DB::table('knowledgebase_categories')->where('id', '=', $id)->update([
            'name' => $request->input('name'),
            'description' => $request->input('description'),
            'updated_at' => Carbon::now()
        ]);

        $this->alert->success('Category has been successfully updated.')->flash();
        return redirect()->route('admin.knowledgebase.categories.index');
    }

    /**
     * @param int $id
     * @return RedirectResponse
     */
    public function delete(int $id): RedirectResponse
    {
        DB::table('knowledgebase_categories')->delete($id);

        $this->alert->success('Category has been successfully deleted.')->flash();
        return redirect()->route('admin.knowledgebase.categories.index');
    }
}
