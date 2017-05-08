<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use Auth;

use PDF;

class PdfController extends Controller
{
    public function __construct()
    {
        $this->middleware('verified');
        
        $this->middleware('can_see_certificates', ['only' => [
            'make_certificate',
            'get_certificates',
        ]]);

    }

    public function get_certificates()
    {
        $user = Auth::user();

        $type = [];

        if($user->hasRole('site') && !$user->site->disq()){
            $type[] = 'site';
        }

        if($user->hasRole('grader_a') || $user->hasRole('grader_b')){
            if($user->grader->has_graded()){
                $type[] = 'grader';
            }
        }

        if($user->hasRole('member') && $user->hasRole('grader_b')){
            $type[] = 'member';
        }

        return view('pages.get_certificates', compact(['type']));

    }

    public function make_certificate($type)
    {
        if(!isset($type) || !in_array($type, ['site', 'grader', 'member']) ){
            return redirect()->route('home');
        }

        $user = Auth::user();

        $data = [];

        if($type == 'site'){
            if($user->hasRole('site') && !$user->site->disq()){
                $data['title'] = $user->site->title;
            } else {
                return redirect()->route('home');
            }
        }

        if($type == 'grader'){
            if($user->hasRole('grader_a') || $user->hasRole('grader_b')){
                if($user->grader->has_graded()){
                    $data['title'] = $user->grader->last_name . ' ' . $user->grader->first_name;
                } else {
                    return redirect()->route('home');
                }
            }
        }

        if($type == 'member'){
            if($user->hasRole('member') && $user->hasRole('grader_b')){
                $data['title'] = $user->grader->last_name . ' ' . $user->grader->first_name;
            } else {
                return redirect()->route('home');
            }
        }

        $data['type'] = $type;

        $filename = 'certificate-' . $type .'.pdf';

        $pdf = PDF::loadView('pdfs.certificate', $data)->setPaper('a4', 'landscape')->setWarnings(false);

        return $pdf->download($filename);

    }   

}
