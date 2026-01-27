<?php

namespace App\Http\Controllers;

use App\Models\Insight;
use App\Models\Project;
use Illuminate\Http\Request;
use function Pest\Laravel\session;

use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;

class PublicController extends Controller
{
    public function homepage()
    {
        $latestProjects = Project::orderBy('execution_year', 'desc')->take(3)->get();
        $latestInsights = Insight::orderBy('date', 'desc')->take(3)->get();
        
        return view('welcome', compact('latestProjects', 'latestInsights'));
    }

    public function about()
    {
        return view('about');
    }

    public function contacts()
    {
        return view('contacts');
    }

    public function send(Request $request)
    {
        // Validazione
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'message' => 'required|string|min:10',
        ], [
            'name.required' => 'Il nome è obbligatorio',
            'email.required' => 'L\'email è obbligatoria',
            'email.email' => 'Inserisci un\'email valida',
            'message.required' => 'Il messaggio è obbligatorio',
            'message.min' => 'Il messaggio deve contenere almeno 10 caratteri',
        ]);

        // Dati per l'email
        $data = [
            'name' => $validated['name'],
            'email' => $validated['email'],
            'user_message' => $validated['message'],
        ];

        // Invia email
        Mail::send('emails.contact', $data, function($message) use ($data) {
            $message->to('arch.serenal@gmail.com')
                    ->subject('Nuovo messaggio da ' . $data['name'])
                    ->replyTo($data['email']);
        });

        return redirect()->back()->with('success', __('ui.contact_success'));
    }

    public function setLanguage($lang)
    {
        if (!in_array($lang, ['it', 'en', 'fr'])) {
            abort(400);
        }

        Session::put('locale', $lang);

        return redirect()->back();
    }

}
