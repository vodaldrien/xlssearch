<?php

namespace App\Http\Controllers;

use App\Imports\XLSImport;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Maatwebsite\Excel\Facades\Excel;

class XLSController extends Controller
{

    public function index() {
        return view('xls.index', [
            'xls' => collect(Storage::disk('local')->allFiles('uploads'))->map(function($name) {
                return Str::after($name, 'uploads/');
            })
        ]);
    }

    public function store(Request $request) {

        $file = $request->file('xls');
        $filename = $file->getClientOriginalName();
        if ($file && Str::endsWith($filename, ['xls', 'xlsx', 'ods', 'xlsm'])) {
            $file->storeAs('uploads', $filename);
        }

        return back();
    }

    public function delete(Request $request) {
        $filename = $request->get('filename');
        Storage::disk('local')->delete("uploads/$filename");

        return back();
    }

    public function search(Request $request) {
        $needle = $request->needle;
        $results = collect();
        $xlsImport = new XLSImport;

        foreach ($request->xls_files as $file) {
            Excel::import($xlsImport, storage_path('app/uploads/') . $file);
            $results->put($file, $xlsImport->rows);
        }
        $searchResults = $results->mapWithKeys(fn(Collection $rows, String $file) => [
                    $file => $rows->filter(fn(Collection $cols, $rowNumber) => self::xlsCotnains($cols, $needle))
                ]
        )->filter(fn(Collection $items) => $items->isNotEmpty());

        return response()->json([
            'xls_files_found' => $searchResults->keys(),
            'markup' => self::xlsResultsToMarkup($searchResults)
        ]);
    }

    public static function xlsCotnains(Collection $cols, String $needle) {
        $needle = translate_diacritics(trim(strtolower($needle)));
        $needles = explode('***', $needle);
        $haystack = translate_diacritics(trim(strtolower($cols->implode(' '))));
        return Str::containsAll($haystack, $needles);
    }

    public static function xlsResultsToMarkup(Collection $searchResults): String {

        return view('xls.results', [
            'count' => $searchResults->count(),
            'results' => $searchResults
        ]);

    }
}
