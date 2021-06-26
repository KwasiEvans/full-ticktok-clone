<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\User;

class SearchController extends Controller
{
    public function search(Request $request)
    {
    	$searchTerm = $request->search;
    	$data = User::query()
			   ->orWhere('username', 'LIKE', "%{$searchTerm}%") 
			   ->orWhere('first_name', 'LIKE', "%{$searchTerm}%") 
			   ->orWhere('last_name', 'LIKE', "%{$searchTerm}%") 
			   ->orWhere('email', 'LIKE', "%{$searchTerm}%")
			   ->paginate(15);
		return view('search',compact('data'));
    }
}
