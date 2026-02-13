<?php 

namespace App\Http\public;
use App\Http\Controllers\Controller;

class PublicController extends Controller
{
    public function index()
    {
        return view('pages.public.index');
    }
}

?>