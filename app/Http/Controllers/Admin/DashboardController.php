<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Contact;
use App\Models\GalleryItem;
use App\Models\MediaArticle;
use App\Models\Race;
use App\Models\Sponsor;
use Illuminate\View\View;

class DashboardController extends Controller
{
    /**
     * Show the admin dashboard.
     */
    public function index(): View
    {
        $stats = [
            'races' => Race::count(),
            'sponsors' => Sponsor::count(),
            'articles' => MediaArticle::count(),
            'gallery' => GalleryItem::count(),
            'contacts' => Contact::count(),
        ];

        $recentContacts = Contact::latest()->take(5)->get();
        $upcomingRaces = Race::orderBy('sort_order')->take(4)->get();

        return view('admin.dashboard', compact('stats', 'recentContacts', 'upcomingRaces'));
    }
}
