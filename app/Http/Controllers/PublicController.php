<?php

namespace App\Http\Controllers;

use App\Models\Insight;
use App\Models\Project;
use ReCaptcha\ReCaptcha;
use Spatie\Sitemap\Sitemap;

use Illuminate\Http\Request;
use Spatie\Sitemap\Tags\Url;
use Illuminate\Support\Facades\Log;
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
        request()->session()->put('contact_form_loaded_at', now());

        return view('contacts');
    }

    public function send(Request $request)
    {
        // Controllo honeypot
        if ($request->filled('website_url')) {
            Log::warning('Honeypot triggered', ['ip' => $request->ip()]);
            return response()->noContent();
        }

        // Controllo tempo minimo
        $loadedAt = $request->session()->get('contact_form_loaded_at');

        if (!$loadedAt || $loadedAt->diffInSeconds(now()) < 5) {
            Log::warning('Form submitted too fast', ['ip' => $request->ip()]);
            return abort(429, 'Too fast');
        }

        // 3. Verifica reCAPTCHA
        $recaptcha = new ReCaptcha(config('services.recaptcha.secret'));
        $resp = $recaptcha->verify($request->input('g-recaptcha-response'), $request->ip());
        
        if (!$resp->isSuccess() || $resp->getScore() < 0.5) {
            Log::warning('reCAPTCHA failed', [
                'ip' => $request->ip(),
                'score' => $resp->getScore()
            ]);
            return back()->withErrors(['recaptcha' => 'Verifica fallita. Riprova.']);
        }

        // Validazione
        $validated = $request->validate([
            'name' => 'required|string|max:100|min:2|regex:/^[\p{L}\p{M}\s\'-]+$/u',
            'email' => 'required|email:rfc|max:255',
            'message' => 'required|string|min:15|max:2000',
        ]);

        // Dati per l'email
        $data = [
            'name' => strip_tags($validated['name']),
            'email' => filter_var($validated['email'], FILTER_SANITIZE_EMAIL),
            'user_message' => strip_tags($validated['message']),
            'ip' => $request->ip(),
            'user_agent' => $request->userAgent(),
        ];

        // Invia email
        try {
            Mail::send('emails.contact', $data, function($message) use ($data) {
                $message->to('arch.serenal@gmail.com')
                        ->subject('Nuovo messaggio da ' . $data['name'])
                        ->replyTo($data['email']);
            });

            // Reset timestamp
            $request->session()->forget('contact_form_loaded_at');

            return redirect()->back()->with('success', __('ui.contact_success'));
        } catch (\Exception $e) {
            Log::error('Email send failed', ['error' => $e->getMessage()]);
            return back()->withErrors(['email' => 'Errore invio. Riprova.']);
        }
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
