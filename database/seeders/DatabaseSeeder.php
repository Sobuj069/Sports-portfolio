<?php

namespace Database\Seeders;

use App\Models\GalleryItem;
use App\Models\MediaArticle;
use App\Models\Race;
use App\Models\SiteSetting;
use App\Models\Sponsor;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // 1. Admin User
        User::updateOrCreate(
            ['email' => 'admin@nickho-motorsports.nl'],
            [
                'name' => 'Nick Ho Admin',
                'password' => Hash::make('password'),
            ]
        );

        // 2. Site Settings
        $settings = [
            'driver_name' => 'Nick Ho',
            'hero_bio' => 'For me, racing is about more than chasing speed, it’s about chasing my limits. Every lap is a test. Not just of the car, but of myself.',
            'hero_subquote' => 'Every lap is a test. Not just of the car, but of myself.',
            'city' => 'Rotterdam',
            'country' => 'The Netherlands',
            'years_in_motorsport' => '10+',
            'age' => '21',
            'car_number' => '98',
            'podiums' => '17',
            'circuits_raced' => '14',
            'next_race_name' => 'Next race',
            'next_race_time' => 'February 20, 2026 14:10',
            'quote_part1' => 'I’m driven by progress, by finding that',
            'quote_highlight1' => 'one percent of improvement',
            'quote_part2' => 'that most people overlook. Every mistake is a lesson, every session a chance, to become',
            'quote_highlight2' => 'sharper, more focused, more complete.',
            'contact_phone' => '+31 6 83 63 09 88',
            'contact_email' => 'nick@nickho-motorsports.nl',
            'instagram_url' => 'https://www.instagram.com/nickho_98',
            'linkedin_url' => 'https://www.linkedin.com/in/nick-ho-042054327/',
            'meta_title' => 'Nick Ho - Dutch Racing Driver | Porsche Carrera Cup',
            'meta_description' => 'Official website of Nick Ho, 21-year-old Dutch racing driver competing in the Porsche Carrera Cup Deutschland and Porsche Sprint Challenge Southern Europe.',
        ];

        foreach ($settings as $key => $val) {
            SiteSetting::updateOrCreate(['key' => $key], ['value' => $val, 'group' => 'general']);
        }

        // 3. Races
        $races = [
            [
                'title' => 'Race 3 - Circuit Ricardo Tormo',
                'series' => 'Porsche Sprint Challenge Southern Europe',
                'date_string' => '20-21.02.2026',
                'race_time' => '2026-02-20 14:10:00',
                'sort_order' => 1,
            ],
            [
                'title' => 'Race 4 - Circuit de Barcelona-Catalunya',
                'series' => 'Porsche Sprint Challenge Southern Europe',
                'date_string' => '27-28.02.2026',
                'race_time' => '2026-02-27 23:00:00',
                'sort_order' => 2,
            ],
            [
                'title' => 'Race 1 - WEC Imola',
                'series' => 'Porsche Sixt Carrera Cup Deutschland',
                'date_string' => '17-19.04.2026',
                'race_time' => '2026-04-17 23:00:00',
                'sort_order' => 3,
            ],
            [
                'title' => 'Race 2 - DTM Red Bull Ring',
                'series' => 'Porsche Sixt Carrera Cup Deutschland',
                'date_string' => '24-26.04.2026',
                'race_time' => '2026-04-24 23:00:00',
                'sort_order' => 4,
            ],
            [
                'title' => 'Race 3 - GT Open Spa-Francorchamps',
                'series' => 'Porsche Sixt Carrera Cup Deutschland',
                'date_string' => '15-17.05.2026',
                'race_time' => '2026-05-15 23:00:00',
                'sort_order' => 5,
            ],
            [
                'title' => 'Race 4 - DTM Zandvoort',
                'series' => 'Porsche Sixt Carrera Cup Deutschland',
                'date_string' => '22-24.05.2026',
                'race_time' => '2026-05-22 23:00:00',
                'sort_order' => 6,
            ],
            [
                'title' => 'Race 5 - DTM Lausitzring',
                'series' => 'Porsche Sixt Carrera Cup Deutschland',
                'date_string' => '19-21.06.2026',
                'race_time' => '2026-06-19 23:00:00',
                'sort_order' => 7,
            ],
            [
                'title' => 'Race 7 - DTM Nurburgring',
                'series' => 'Porsche Sixt Carrera Cup Deutschland',
                'date_string' => '14-16.08.2026',
                'race_time' => '2026-08-14 23:00:00',
                'sort_order' => 8,
            ],
        ];

        foreach ($races as $r) {
            Race::updateOrCreate(['title' => $r['title']], $r);
        }

        // 4. Sponsors
        $sponsors = [
            ['name' => 'Okinii', 'logo_path' => '6a60b5ab4df0819ae3787c9a_Vector_21.svg', 'sort_order' => 1],
            ['name' => "McDonald's", 'logo_path' => '6a60b563fe5ceb25a71da632_McDonalds_Golden_Arches_1.svg', 'sort_order' => 2],
            ['name' => 'Vector Partner', 'logo_path' => '6a60b5b8644365cdabe9ba6e_Vector.svg', 'sort_order' => 3],
            ['name' => 'Boring Agency', 'logo_path' => '6a6866145f1206dddde8043b_BORING_wordmark_1.svg', 'sort_order' => 4],
            ['name' => 'Driver Sponsor 1', 'logo_path' => '6a60b36ecf41f8691e4cc0aa_DRIVER_SPONSORS-1_1.svg', 'sort_order' => 5],
            ['name' => 'Driver Sponsor 2', 'logo_path' => '6a60b34bc265f561cf3b653f_DRIVER_SPONSORS_1.svg', 'sort_order' => 6],
            ['name' => 'Logo S 1', 'logo_path' => '6a60b49ee96f3a7b4fb3aab1_LOGO_S_1.svg', 'sort_order' => 7],
            ['name' => 'ODB Group', 'logo_path' => '6a60b09c2de65c51e9127f22___ODB_GROUP_LOGO_TRANSPARENT_BLACK.svg', 'sort_order' => 8],
            ['name' => 'Driver Sponsor 4', 'logo_path' => '6a60b3eaa9846541d71cd7c0_DRIVER_SPONSORS-4_1.svg', 'sort_order' => 9],
            ['name' => 'Partner Image 7', 'logo_path' => '6a60b496cf41f8691e4daa76_image_7.png', 'sort_order' => 10],
            ['name' => 'Driver Sponsor 3', 'logo_path' => '6a60b3d7f90c5d5ec014b32c_DRIVER_SPONSORS-3_1.svg', 'sort_order' => 11],
            ['name' => 'Subtract', 'logo_path' => '6a60b57d12e166dbcab24571_Subtract_1.svg', 'sort_order' => 12],
            ['name' => 'Logo S 3', 'logo_path' => '6a60b4ce80defad148811ec4_LOGO_S-3_1.svg', 'sort_order' => 13],
            ['name' => 'Driver Sponsor 2B', 'logo_path' => '6a60b3cfa409f7add0a3b2fc_DRIVER_SPONSORS-2_1.svg', 'sort_order' => 14],
            ['name' => 'Logo S 2', 'logo_path' => '6a60b4ba6244770225f0f855_LOGO_S-2_1.svg', 'sort_order' => 15],
            ['name' => 'Driver Sponsor 5', 'logo_path' => '6a60b3f9911a06dd68929739_DRIVER_SPONSORS-5_1.svg', 'sort_order' => 16],
            ['name' => 'Frame 191', 'logo_path' => '6a60b4727435c0c78b148f03_Frame_191_1.svg', 'sort_order' => 17],
            ['name' => 'Frame 192', 'logo_path' => '6a60b47cc5e70a0e4be7452c_Frame_192_1.svg', 'sort_order' => 18],
            ['name' => 'Logo S 1B', 'logo_path' => '6a60b4aba0b988f98323af47_LOGO_S-1_1.svg', 'sort_order' => 19],
            ['name' => 'Frame 188', 'logo_path' => '6a60b4374df0819ae376c4ce_Frame_188_1.svg', 'sort_order' => 20],
            ['name' => 'Logo S 4', 'logo_path' => '6a60b4de189100d64947f851_LOGO_S-4_1.svg', 'sort_order' => 21],
            ['name' => 'Logo S 5', 'logo_path' => '6a60b553cf41f8691e4e4aca_LOGO_S-5_1.svg', 'sort_order' => 22],
            ['name' => 'Frame 190', 'logo_path' => '6a60b455644365cdabe87b0a_Frame_190_1.svg', 'sort_order' => 23],
            ['name' => 'Frame 189', 'logo_path' => '6a60b444ade01a0985b7991e_Frame_189_1.svg', 'sort_order' => 24],
            ['name' => 'Driver Sponsor 7', 'logo_path' => '6a60b40fcaef8fdfeb1eec59_DRIVER_SPONSORS-7_1.svg', 'sort_order' => 25],
            ['name' => 'Driver Sponsor 6', 'logo_path' => '6a60b4050f977527cb2dfc63_DRIVER_SPONSORS-6_1.svg', 'sort_order' => 26],
        ];

        foreach ($sponsors as $s) {
            Sponsor::updateOrCreate(['name' => $s['name']], $s);
        }

        // 5. Media Articles
        $articles = [
            [
                'title' => 'Autocoureur Nick Ho boekt eerste overwinning in Porsche Carrera Cup Benelux! "Mega start"',
                'url' => 'https://www.racexpress.nl/porsche-carrera-cup-benelux/autocoureur-nick-ho-boekt-eerste-overwinning-in-porsche-carrera-cup-benelux-mega-start/n/146956',
                'image_path' => '6a73465374d30fca53a148fe_6a56323c2a1b0f4b0481a57d_invruhvwiuvrh3i.avif',
                'sort_order' => 1,
            ],
            [
                'title' => 'Nick Ho pakt zege tijdens de Racing Day op Assen',
                'url' => 'https://www.autosport.nu/nieuws/benelux/nick-ho-pakt-zege-tijdens-de-racing-day-op-assen/',
                'image_path' => '6a73465374d30fca53a1490a_6a6872eb33ed553a05321d1d_2025810-RB-Racing-Day6583.avif',
                'sort_order' => 2,
            ],
            [
                'title' => 'Autocoureur Nick Ho pakt knap podium in Porsche Carrera Cup Benelux',
                'url' => 'https://www.racexpress.nl/porsche-carrera-cup-benelux/autocoureur-nick-ho-pakt-knap-podium-in-porsche-carrera-cup-benelux/n/144905',
                'image_path' => '6a73465374d30fca53a14901_6a6872ebecea11eeabcb0ad8_DSC00116-2.avif',
                'sort_order' => 3,
            ],
            [
                'title' => 'Nick Ho combineert een carrière in de autosport met zijn studie Bedrijfskunde',
                'url' => 'https://www.erasmusmagazine.nl/2023/10/11/geen-alledaagse-combinatie-nick-ho-combineert-een-carriere-in-de-autosport-met-bedrijfskunde/',
                'image_path' => '6a73465374d30fca53a14904_6a6872eb3034b3427cf0f7d1_erasmussport_nickho_garage_Porsche-Sprint-Challenge-Benelux_(1).avif',
                'sort_order' => 4,
            ],
            [
                'title' => 'Kampioen Nick Ho (16) blikt terug op succesvol seizoen in GK4 Kart Series: "Mijn eerste titel, super"',
                'url' => 'https://www.racexpress.nl/gk4-kartseries/kampioen-nick-ho-16-blikt-terug-op-succesvol-seizoen-n-gk4-kart-series-mijn-eerste-titel-super/n/117978',
                'image_path' => '6a73465374d30fca53a148fb_6a5631ab856551aebe0cc5e0_nick_ho_rx_imgl3382-YNqMWyg4qJCk3NXV_(1)-compressed.avif',
                'sort_order' => 5,
            ],
        ];

        foreach ($articles as $a) {
            MediaArticle::updateOrCreate(['title' => $a['title']], $a);
        }

        // 6. Gallery Items (Radial Slider)
        $gallery = [
            ['title' => 'Nick Ho in race suit', 'image_path' => '6a7348b536541951a5fa98c2_6a577aee13ab25d9e3dfbe32_704107799_18104257217513141_3312629906142609607_n-compressed.avif', 'sort_order' => 1],
            ['title' => 'Helmet visor close-up', 'image_path' => '6a7348b536541951a5fa98d5_6a577aefdd0e95ec34d3d42f_728225845_18109349909513141_4910303138862411203_n-compressed.avif', 'sort_order' => 2],
            ['title' => 'Porsche 911 GT3 front track', 'image_path' => '6a7348c75fbc38125d903576_6a5631ab8780e706b665db54_porsche_279996-mk34oDJD4pheLq4b-compressed.avif', 'sort_order' => 3],
            ['title' => 'Podium celebration', 'image_path' => '6a7348c75fbc38125d903570_6a577aef7b4c400345ff749e_742942837_18111445322513141_3902259570972602308_n-compressed.avif', 'sort_order' => 4],
            ['title' => 'Cockpit preparation', 'image_path' => '6a7348c75fbc38125d90356d_6a577aee7b01569b5b25bf8c_703645956_18584464981016022_2037459611557151547_n-compressed.avif', 'sort_order' => 5],
            ['title' => 'Porsche curve speed', 'image_path' => '6a7348c75fbc38125d903579_6a5631acd120bf05c0531844_porsche_280041-mjE4o2G2WxHoNk3k-compressed.avif', 'sort_order' => 6],
            ['title' => 'Zolder Round 6 Race Day', 'image_path' => '6a7348c75fbc38125d90356a_6a5631ad203b547c0adc472c_pccb-2024-round-6-zolder---day-3-196-YZ9EoejeXjh6yaWa-compressed.avif', 'sort_order' => 7],
            ['title' => 'Assen Circuit speed shot', 'image_path' => '6a7348c75fbc38125d90357c_6a5631a9f28ba56e56dd2fa7_586_20250810_pccb_assen_2025-mP43bywM9bcXKz9w-compressed.avif', 'sort_order' => 8],
            ['title' => 'Zandvoort 2025 Porsche Cup', 'image_path' => '6a7348c75fbc38125d903573_6a5631a9314beef45877e8ac_054_20250926_pccb_zandvoort_2025_2-AVLxv4rl7OUNVo7G-compressed.avif', 'sort_order' => 9],
        ];

        foreach ($gallery as $g) {
            GalleryItem::updateOrCreate(['image_path' => $g['image_path']], $g);
        }
    }
}
