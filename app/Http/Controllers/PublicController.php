<?php

namespace App\Http\Controllers;

use App\Models\Insight;
use App\Models\Project;
use Spatie\Sitemap\Sitemap;
use Illuminate\Http\Request;

use Spatie\Sitemap\Tags\Url;
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
        cookie()->queue('locale', $lang, 60 * 24 * 30);

        return redirect()->back();
    }

    public function generate_sitemap($token)
    {
        if ($token !== env('SITEMAP_TOKEN')) {
            abort(403, 'Token non valido.');
        }

        $sitemap = Sitemap::create()
            ->add(Url::create('/')->setPriority(1.0))
            ->add(Url::create('/projects')->setPriority(0.9))
            ->add(Url::create('/insights')->setPriority(0.9))
            ->add(Url::create('/about')->setPriority(0.8))
            ->add(Url::create('/contact')->setPriority(0.8));

        $projects = Project::all();
        foreach ($projects as $project) {
            $sitemap->add(Url::create("/projects/{$project->id}")->setPriority(0.8));
        }

        $insights = Insight::all();
        foreach ($insights as $insight) {
            $sitemap->add(Url::create("/insights/{$insight->id}")->setPriority(0.8));
        }

        $sitemap->writeToFile(public_path('sitemap.xml'));

        return response('Sitemap generata correttamente!', 200);
    }
}
