<?php

namespace App\Http\Controllers;

use App\Models\GalleryItem;
use App\Models\MediaArticle;
use App\Models\Race;
use App\Models\SiteSetting;
use App\Models\Sponsor;
use Illuminate\View\View;

class HomeController extends Controller
{
    /**
     * Display the home page with all dynamic sections.
     */
    public function index(): View
    {
        $settings = SiteSetting::allKeyed();
        $races = Race::where('is_active', true)->orderBy('sort_order')->get();
        $sponsors = Sponsor::where('is_active', true)->orderBy('sort_order')->get();
        $articles = MediaArticle::where('is_active', true)->orderBy('sort_order')->get();
        $galleryItems = GalleryItem::where('is_active', true)->orderBy('sort_order')->get();

        return view('home', compact(
            'settings',
            'races',
            'sponsors',
            'articles',
            'galleryItems'
        ));
    }

    /**
     * Display the privacy policy page.
     */
    public function privacy(): View
    {
        return view('privacy');
    }

    /**
     * Download the official Sponsor Guide PDF.
     */
    public function downloadSponsorGuide()
    {
        $filePath = public_path('assets/sponsorguide-2026.pdf');
        if (! file_exists($filePath)) {
            $filePath = public_path('assets/images/6a7353eacfea04bb015bbdbe_sponsorguide-2026.pdf');
        }

        if (file_exists($filePath)) {
            return response()->download($filePath, 'Nick_Ho_Sponsorguide_2026.pdf');
        }

        return redirect()->route('home')->with('error', 'Sponsor guide temporarily unavailable.');
    }
}
