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
        $latestProjects = Project::latest()->take(4)->get();
        $latestInsights = Insight::latest()->take(4)->get();
        
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
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'message' => 'required|string|min:10',
        ], [
            'first_name.required' => 'Il nome è obbligatorio',
            'last_name.required' => 'Il cognome è obbligatorio',
            'email.required' => 'L\'email è obbligatoria',
            'email.email' => 'Inserisci un\'email valida',
            'message.required' => 'Il messaggio è obbligatorio',
            'message.min' => 'Il messaggio deve contenere almeno 10 caratteri',
        ]);

        // Dati per l'email
        $data = [
            'first_name' => $validated['first_name'],
            'last_name' => $validated['last_name'],
            'email' => $validated['email'],
            'user_message' => $validated['message'],
        ];

        // Invia email
        Mail::send('emails.contact', $data, function($message) use ($data) {
            $message->to('arch.serenal@gmail.com')
                    ->subject('Nuovo messaggio da ' . $data['first_name'] . ' ' . $data['last_name'])
                    ->replyTo($data['email']);
        });

        return redirect()->back()->with('success', 'Il tuo messaggio è stato inviato con successo! Ti risponderò al più presto.');
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
