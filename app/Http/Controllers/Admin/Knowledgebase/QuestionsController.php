<?php

namespace Pterodactyl\Http\Controllers\Admin\Knowledgebase;

use Carbon\Carbon;
use Illuminate\View\View;
use Illuminate\Support\Facades\DB;
use Prologue\Alerts\AlertsMessageBag;
use Illuminate\Http\RedirectResponse;
use Pterodactyl\Http\Controllers\Controller;
use Pterodactyl\Http\Requests\Admin\Knowledgebase\QuestionFormRequest;

class QuestionsController extends Controller
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
        return view('admin.knowledgebase.questions.index', [
            'questions' => DB::table('knowledgebase_questions')->paginate(10),
            'categories' => DB::table('knowledgebase_categories')->get()
        ]);
    }

    /**
     * @return View
     */
    public function new(): View
    {
        return view('admin.knowledgebase.questions.new', [
            'categories' => DB::table('knowledgebase_categories')->paginate(10)
        ]);
    }

    /**
     * @param QuestionFormRequest $request
     * @return RedirectResponse
     */
    public function store(QuestionFormRequest $request): RedirectResponse
    {
        DB::table('knowledgebase_questions')->insert([
            'subject' => $request->input('subject'),
            'information' => $request->input('information'),
            'category' => $request->input('category'),
            'author' => $request->user()->name_first.' '.$request->user()->name_last,
            'updated_at' => Carbon::now(),
            'created_at' => Carbon::now()
        ]);

        $this->alert->success('Question has been created successfully.')->flash();
        return redirect()->route('admin.knowledgebase.questions.index');
    }

    /**
     * @param int $id
     * @return View
     */
    public function edit(int $id): View
    {
        return view('admin.knowledgebase.questions.edit', [
            'question' => DB::table('knowledgebase_questions')->where('id', '=', $id)->first(),
            'categories' => DB::table('knowledgebase_categories')->paginate(10)
        ]);
    }

    /**
     * @param QuestionFormRequest $request
     * @param int $id
     * @return RedirectResponse
     */
    public function update(QuestionFormRequest $request, int $id): RedirectResponse
    {
        DB::table('knowledgebase_questions')->where('id', '=', $id)->update([
            'subject' => $request->input('subject'),
            'information' => $request->input('information'),
            'category' => $request->input('category'),
            'author' => $request->user()->name_first.' '.$request->user()->name_last,
            'updated_at' => Carbon::now()
        ]);

        $this->alert->success('Question has been updated successfully.')->flash();
        return redirect()->route('admin.knowledgebase.questions.index');
    }

    /**
     * @param int $id
     * @return RedirectResponse
     */
    public function delete(int $id): RedirectResponse
    {
        DB::table('knowledgebase_questions')->delete($id);

        $this->alert->success('Questions has been successfully deleted.')->flash();
        return redirect()->route('admin.knowledgebase.categories.index');
    }
}
