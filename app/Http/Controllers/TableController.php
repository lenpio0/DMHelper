<?php

namespace App\Http\Controllers;
use App\Models\Table;
use Illuminate\Http\Request;

class TableController extends Controller
{
    public function fetchAll()
    {
        $tables = Table::with(['characters', 'globInfos', 'dmInfos'])->get();
        return response()->json($tables);
    }
}
