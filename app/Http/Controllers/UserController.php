<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserController extends Controller
{
   public function stats($id) {
    $solvedCount = Solution::where('user_id', $id)->count();
    return response()->json(['solved_count' => $solvedCount]);
}

}
