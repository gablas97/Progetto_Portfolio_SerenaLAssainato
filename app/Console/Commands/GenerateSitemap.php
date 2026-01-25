<?php

namespace App\Console\Commands;

use App\Models\Insight;
use App\Models\Project;
use Spatie\Sitemap\Sitemap;
use Spatie\Sitemap\Tags\Url;
use Illuminate\Console\Command;

class GenerateSitemap extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'sitemap:generate';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Generate the sitemap for the application';

    /**
     * Execute the console command.
     */
    public function handle()
    {
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
        $this->info('Sitemap generated successfully.');
    }
}
