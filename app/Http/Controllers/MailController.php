<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\AddnewsMail;
use App\Models\User;
use App\Models\News;

class MailController extends Controller
{
        public function sendEmail()
        {
            $news = News::latest()->first();  // Assuming you want to email the latest news item
            $users = User::all();

            foreach ($users as $user) {
                Mail::to($user->email)->send(new AddNewsMail($news));
            }

            return 'Emails sent!';
        }
}
