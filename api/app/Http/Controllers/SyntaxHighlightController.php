<?php
namespace App\Http\Controllers;

use App\Models\SyntaxHighlight;

class SyntaxHighlightController extends Controller
{
    public function index()
    {
        $syntaxHighlights = SyntaxHighlight::orderBy('label')->get();
        return response()->json($syntaxHighlights);
    }
}
