<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\Request;

class VerifikasiEmailController extends Controller
{
    function sendEmailVerification(Request $request) {
        
        $request->user()->sendEmailVerificationNotification();
        return back();
    }
    function verify(EmailVerificationRequest $request) {
        $request->fulfill();
        return redirect()->route('profile.index');
    }
}
