<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class KeywordsController extends Controller
{

        /**
   * Display homepage.
   *
   * @return Response
   */
  public function getallKeywords()
  {
    $keywords = new GetKeywords();
    $prices = $keywords->runExample();
    return response()->json( $prices);
  }
}
