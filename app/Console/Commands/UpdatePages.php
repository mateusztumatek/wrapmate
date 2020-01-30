<?php

namespace App\Console\Commands;

use App\Page;
use Illuminate\Console\Command;

class UpdatePages extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'my:pages';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        foreach (Page::all() as $page){
            $page->image = 'pages/Group-6.png';
            $page->banner_title = $page->title;
            $page->banner_description = $page->page_description;
            $page->update();
        }
    }
}
