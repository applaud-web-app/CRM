<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class EmailController extends Controller
{
   public function loadEmailTemplates()
   {
    return view("email.emailtemplate");
   }

   public function previewBday()
   {
    return view("email.Birthday");
   }
}
