<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Wishlist;

class ExportWishlistsCsv extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'wishlist:export';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Export wishlists of all users into csv file';

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
     * @return int
     */
    public function handle()
    {
        $wishlists = Wishlist::all();

        $data = [];
        foreach($wishlists as $wishlist) {
            $data[] = array(
                'user' => $wishlist->user->name,
                'title' => $wishlist->name,
                'items' => $wishlist->products()->count(),
            );
        }

        $filename = date('Y_m_d') . '_wishlist_export.csv';
        $fp = fopen($filename, 'w');

        fputcsv($fp, ['User','Title','Items']);
        foreach ($data as $d) {
            fputcsv($fp, $d);
        }

        fclose($fp);

        $this->info('Export completed src/' . $filename);
    }
}
