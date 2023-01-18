<?php

namespace App\Http\Controllers\videoaula;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class VideoAlunoController extends Controller
{
    public function teste(Request $request)
    {
        Mail::to('laerciodasilvapedrosa@gmail.com')->queue(new Email('Janjan'));
        return 'Okay';
    }

}
