<?php

namespace App\Http\Controllers;

use App\Imports\ExcelSheetDataImport;
use Illuminate\Http\Request;
use App\Imports\ListeImport;
use App\Liste;
use Maatwebsite\Excel\Facades\Excel;

class ImportExcelController extends Controller
{
    function index()
    {
       $listes = Liste::all();
       return view('welcome', compact('listes'));
    }

    function import(Request $request)
    {
       $this->validate($request, [
         'select_file'  => 'required|mimes:xls,xlsx'
       ]);

       $fileName = pathinfo($request->file('select_file')->getClientOriginalName(), PATHINFO_FILENAME);
      //  $import = (new ListeImport())->fromFile($fileName);
      //  $path = $request->file('select_file')->getRealPath();
      //  $data = Excel::import($import, $path);

         $liste = Liste::latest('created_at', 'desc')->first();

         $import = ( new ExcelSheetDataImport() )->fromFile($fileName);
         $import->onlySheets( 'JOURNALIER(NORMALE)', 'ABSENCE', 'EXCEPTIONNELS' );
         Excel::import( $import, $request->file('select_file') );
         return redirect(route('home.liste', $liste->id));
         // return redirect('/')->with('success', 'Imported Successfully.');
    }
}
