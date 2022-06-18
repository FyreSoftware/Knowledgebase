<?php

namespace Pterodactyl\Http\Controllers\Api\Client;

use Illuminate\Support\Facades\DB;
use Pterodactyl\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;

class KnowledgebaseController extends Controller
{
    public function categories(): JsonResponse
    {
        $categories = DB::table('knowledgebase_categories')->get();
        return new JsonResponse($categories, 200, [], null,true);
    }

    public function questions(int $id): JsonResponse
    {
        $questions = DB::table('knowledgebase_questions')->where('category', '=', $id)->get();
        return new JsonResponse($questions, 200, [], null, true);
    }

    public function question(int $id): JsonResponse
    {
        $question = DB::table('knowledgebase_questions')->where('id', '=', $id)->first();
        return new JsonResponse(json_encode($question), 200, [], null, true);
    }
}
