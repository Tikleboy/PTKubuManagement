<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\CompanyProfile;
use App\Models\ServiceCategory;
use App\Models\Service;
use App\Models\Project;
use App\Models\ProjectImage;
use App\Models\GalleryCategory;
use App\Models\GalleryImage;
use App\Models\ContactSetting;
use App\Models\WebsiteSetting;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // 1. Initial Administrator Provisioning
        $adminEmail = env('ADMIN_INITIAL_EMAIL', 'admin@kubumanagementbali.com');
        if (! User::where('email', $adminEmail)->exists()) {
            $initialPassword = env('ADMIN_INITIAL_PASSWORD');

            if (empty($initialPassword)) {
                if (app()->environment('production')) {
                    if ($this->command) {
                        $this->command->warn('Production seeding: ADMIN_INITIAL_PASSWORD is not set. Skipping administrator provisioning. Use [php artisan admin:create] to provision an administrator.');
                    }
                } else {
                    if ($this->command) {
                        $this->command->info('Seeding: ADMIN_INITIAL_PASSWORD is not set. Skipping initial administrator provisioning.');
                    }
                }
            } else {
                User::create([
                    'name' => env('ADMIN_INITIAL_NAME', 'Kubu Administrator'),
                    'email' => $adminEmail,
                    'role' => User::ROLE_SUPER_ADMIN,
                    'password' => Hash::make($initialPassword),
                ]);
            }
        }

        // 2. Company Profile
        CompanyProfile::firstOrCreate(
            ['id' => 1],
            [
                'name' => 'PT. KUBU MANAGEMENT BALI',
                'tagline' => 'Professional Property Care Services in Bali',
                'subtagline' => 'LANDSCAPE • HOUSEKEEPING • PROPERTY CARE',
                'description' => "PT KUBU MANAGEMENT BALI adalah perusahaan jasa profesional yang bergerak di bidang pengelolaan lanskap, perawatan taman, dan tata graha (housekeeping) untuk hotel, vila, properti hunian, serta properti komersial di Bali.\n\nDidirikan dan dipimpin oleh I Wayan Suardika & Ni Putu Devi Handayani, KUBU MANAGEMENT hadir dengan komitmen untuk memberikan pelayanan berkualitas, menjaga keindahan lingkungan, serta memastikan setiap properti dikelola dengan baik, bersih, nyaman, dan terawat.\n\nDengan mengutamakan profesionalisme, ketelitian, dan kepuasan pelanggan, PT KUBU MANAGEMENT BALI terus berupaya menjadi mitra terpercaya dalam menciptakan lingkungan properti yang asri, harmonis, dan bernilai tinggi. Berlandaskan semangat pelayanan dan tanggung jawab, kami percaya bahwa setiap detail memiliki arti penting dalam menghadirkan kenyamanan dan kualitas terbaik bagi setiap klien.\n\nKUBU MANAGEMENT BALI — Merawat Keindahan, Menjaga Kenyamanan, Membangun Kepercayaan.",
                'vision' => 'Menjadi mitra layanan properti profesional tepercaya di Bali.',
                'mission' => [
                    'Memberikan pelayanan profesional dan dapat diandalkan.',
                    'Menjaga standar kualitas, kebersihan, dan estetika properti secara konsisten.',
                    'Mengembangkan tenaga kerja yang kompeten, disiplin, dan terlatih.',
                    'Memberikan solusi yang disesuaikan dengan kebutuhan setiap klien.',
                ],
                'about_image' => 'images/kubu/landscape_service.jpg',
                'hero_image' => 'images/kubu/hero_bali.jpg',
            ]
        );

        // 3. Website Settings
        WebsiteSetting::firstOrCreate(
            ['id' => 1],
            [
                'meta_title' => 'PT. KUBU MANAGEMENT BALI | Professional Property Care Services in Bali',
                'meta_description' => 'Professional landscape, garden maintenance, and housekeeping services for villas, hotels, residences, and commercial properties in Bali.',
                'hero_headline' => 'KUBU MANAGEMENT BALI',
                'hero_badge' => 'LANDSCAPE • HOUSEKEEPING • PROPERTY CARE',
                'hero_subheadline' => 'Professional Property Care Services in Bali',
                'hero_description' => 'Professional landscape, garden maintenance, and housekeeping services for villas, hotels, residences, and commercial properties in Bali.',
            ]
        );

        // 4. Contact Settings
        ContactSetting::firstOrCreate(
            ['id' => 1],
            [
                'whatsapp_number' => '+62 857-3826-1654',
                'default_whatsapp_message' => 'Halo KUBU MANAGEMENT BALI, saya ingin mendapatkan informasi mengenai layanan Landscape/Housekeeping.',
                'email' => 'info@kubumanagementbali.com',
                'instagram' => '@kubumanagementbali',
                'instagram_url' => 'https://instagram.com/kubumanagementbali',
                'office_address' => 'Jalan Pura Banyukuning No.1, Padangsambian, Kecamatan Denpasar Barat, Kota Denpasar, Bali 80119',
                'google_maps_embed' => 'https://maps.google.com/maps?q=Jalan+Pura+Banyukuning+No.1,+Padangsambian,+Denpasar+Barat,+Kota+Denpasar,+Bali+80119&t=&z=16&ie=UTF8&iwloc=&output=embed',
                'operating_hours' => 'Senin - Sabtu: 08:00 - 17:00 WITA',
            ]
        );

        // 5. Service Categories
        $catLandscape = ServiceCategory::firstOrCreate(
            ['slug' => 'kubu-landscape'],
            [
                'name' => 'Kubu Landscape & Garden',
                'subtitle' => 'Professional garden maintenance, landscape care and outdoor property management.',
                'description' => 'Kami mengelola dan merawat keindahan taman tropis properti Anda dengan standar estetika tinggi, ketepatan jadwal, dan tenaga kerja berpengalaman.',
                'icon' => 'leaf',
                'image' => 'images/kubu/landscape_service.jpg',
                'sort_order' => 1,
                'is_active' => true,
            ]
        );

        $catClean = ServiceCategory::firstOrCreate(
            ['slug' => 'kubu-clean'],
            [
                'name' => 'Kubu Clean / Housekeeping',
                'subtitle' => 'Reliable housekeeping services to maintain cleanliness, comfort and presentation.',
                'description' => 'Layanan kebersihan dan penataan properti menyeluruh untuk menjaga kenyamanan tamu, standar higienis, dan ketelitian detail di setiap sudut ruangan.',
                'icon' => 'sparkles',
                'image' => 'images/kubu/housekeeping_service.jpg',
                'sort_order' => 2,
                'is_active' => true,
            ]
        );

        // 6. Services under Landscape
        $landscapeServices = [
            [
                'title' => 'Garden Maintenance',
                'slug' => 'garden-maintenance',
                'description' => 'Pemeliharaan teratur untuk memastikan tanaman dan rumput taman tetap rapi, subur, serta terbebas dari hama dan gulma liar.',
                'features' => [
                    'Pemangkasan tanaman',
                    'Pemupukan berkala',
                    'Penyiraman terjadwal',
                    'Pengendalian gulma',
                    'Perawatan tanaman spesifik',
                ],
                'image' => 'images/kubu/landscape_service.jpg',
                'sort_order' => 1,
            ],
            [
                'title' => 'Landscape Maintenance',
                'slug' => 'landscape-maintenance',
                'description' => 'Pengelolaan landscape menyeluruh untuk area luar properti, menjaga keselarasan arsitektur tropis dan tanaman penunjang villa serta hotel.',
                'features' => [
                    'Maintenance taman',
                    'Perawatan area outdoor',
                    'Perawatan tanaman tropis',
                    'Maintenance villa/hotel garden',
                ],
                'image' => 'images/kubu/hero_bali.jpg',
                'sort_order' => 2,
            ],
            [
                'title' => 'Garden Improvement',
                'slug' => 'garden-improvement',
                'description' => 'Peremajaan dan revitalisasi area taman yang membutuhkan penataan baru agar tampil lebih segar, asri, dan selaras dengan konsep properti.',
                'features' => [
                    'Penataan ulang taman',
                    'Penggantian tanaman',
                    'Penambahan tanaman',
                    'Perbaikan area taman',
                ],
                'image' => 'images/kubu/project_after.jpg',
                'sort_order' => 3,
            ],
            [
                'title' => 'Irrigation',
                'slug' => 'irrigation',
                'description' => 'Instalasi, pengecekan rutin, dan perbaikan sistem penyiraman otomatis atau manual untuk efisiensi distribusi air tanaman.',
                'features' => [
                    'Pemeriksaan sistem penyiraman',
                    'Perawatan irrigation berkala',
                    'Perbaikan sistem penyiraman',
                ],
                'image' => 'images/kubu/irrigation_service.jpg',
                'sort_order' => 4,
            ],
        ];

        foreach ($landscapeServices as $s) {
            Service::updateOrCreate(
                ['slug' => $s['slug']],
                array_merge($s, ['service_category_id' => $catLandscape->id, 'is_published' => true])
            );
        }

        // 7. Services under Housekeeping
        $housekeepingServices = [
            [
                'title' => 'Villa Housekeeping',
                'slug' => 'villa-housekeeping',
                'description' => 'Standar pembersihan menyeluruh untuk villa privat dan komersial dengan perhatian tinggi terhadap privasi, kenyamanan, dan higienitas.',
                'features' => [
                    'Cleaning kamar tidur',
                    'Bathroom cleaning & sanitasi',
                    'Kitchen cleaning & peralatan',
                    'Living area & outdoor patio',
                    'Linen management & laundry prep',
                ],
                'image' => 'images/kubu/housekeeping_service.jpg',
                'sort_order' => 1,
            ],
            [
                'title' => 'Hotel Housekeeping',
                'slug' => 'hotel-housekeeping',
                'description' => 'Dukungan staf housekeeping profesional untuk hotel dan resort dengan standar operasional ketat untuk perputaran kamar yang cepat dan bersih.',
                'features' => [
                    'Room attendant harian',
                    'Public area cleaning',
                    'Linen handling & logistik',
                    'Cleaning support event',
                    'Turn-down service malam',
                ],
                'image' => 'images/kubu/bathroom_service.jpg',
                'sort_order' => 2,
            ],
            [
                'title' => 'Residential Housekeeping',
                'slug' => 'residential-housekeeping',
                'description' => 'Perawatan kebersihan berkala atau harian untuk hunian pribadi, apartemen, dan residence eksklusif di seluruh area Bali.',
                'features' => [
                    'Villa pribadi',
                    'Rumah tinggal',
                    'Apartemen',
                    'Residence kompleks',
                ],
                'image' => 'images/kubu/housekeeping_service.jpg',
                'sort_order' => 3,
            ],
        ];

        foreach ($housekeepingServices as $s) {
            Service::updateOrCreate(
                ['slug' => $s['slug']],
                array_merge($s, ['service_category_id' => $catClean->id, 'is_published' => true])
            );
        }

        // 8. Projects (Placeholders / Demonstration Portfolio as specified)
        $projects = [
            [
                'title' => 'Villa A',
                'slug' => 'villa-a',
                'category' => 'Landscape Maintenance',
                'location' => 'Seminyak, Bali',
                'description' => 'Pemeliharaan landscape berkala untuk area courtyard dan taman tropis villa, meliputi pemangkasan presisi, pemupukan organik, dan pemeliharaan rumput.',
                'main_image' => 'images/kubu/project_after.jpg',
                'sort_order' => 1,
            ],
            [
                'title' => 'Hotel B',
                'slug' => 'hotel-b',
                'category' => 'Garden Management',
                'location' => 'Ubud, Bali',
                'description' => 'Pengelolaan taman dan lanskap hotel lereng bukit dengan vegetasi lebat, jalan setapak batu alam, dan pemeliharaan area gazebo/bale santai.',
                'main_image' => 'images/kubu/hero_bali.jpg',
                'sort_order' => 2,
            ],
            [
                'title' => 'Villa C',
                'slug' => 'villa-c',
                'category' => 'Housekeeping Service',
                'location' => 'Canggu, Bali',
                'description' => 'Layanan tata graha menyeluruh untuk villa hunian dan sewa, memastikan standar higienis kamar tidur, kamar mandi terbuka, dan living room.',
                'main_image' => 'images/kubu/housekeeping_service.jpg',
                'sort_order' => 3,
            ],
            [
                'title' => 'Resort D',
                'slug' => 'resort-d',
                'category' => 'Landscape & Housekeeping',
                'location' => 'Uluwatu, Bali',
                'description' => 'Paket manajemen properti komprehensif mengintegrasikan perawatan taman tropis pinggir tebing dan kebersihan suite hotel berbintang.',
                'main_image' => 'images/kubu/bathroom_service.jpg',
                'sort_order' => 4,
            ],
        ];

        foreach ($projects as $p) {
            $project = Project::updateOrCreate(['slug' => $p['slug']], $p);

            // Add Before -> Process -> Final Result storytelling images
            ProjectImage::updateOrCreate(
                ['project_id' => $project->id, 'image_type' => 'before'],
                [
                    'image_path' => 'images/kubu/project_before.jpg',
                    'caption' => 'Kondisi awal sebelum perawatan dan revitalisasi',
                    'sort_order' => 1,
                ]
            );
            ProjectImage::updateOrCreate(
                ['project_id' => $project->id, 'image_type' => 'process'],
                [
                    'image_path' => 'images/kubu/project_process.jpg',
                    'caption' => 'Proses pengerjaan tenaga ahli & teknisi Kubu Management',
                    'sort_order' => 2,
                ]
            );
            ProjectImage::updateOrCreate(
                ['project_id' => $project->id, 'image_type' => 'after'],
                [
                    'image_path' => 'images/kubu/project_after.jpg',
                    'caption' => 'Hasil akhir yang rapi, bersih, dan memikat',
                    'sort_order' => 3,
                ]
            );
        }

        // 9. Gallery Categories & Images
        $galleryCats = [
            // LANDSCAPE
            ['name' => 'Garden', 'slug' => 'garden', 'parent_group' => 'landscape', 'sort_order' => 1],
            ['name' => 'Maintenance', 'slug' => 'maintenance', 'parent_group' => 'landscape', 'sort_order' => 2],
            ['name' => 'Planting', 'slug' => 'planting', 'parent_group' => 'landscape', 'sort_order' => 3],
            ['name' => 'Landscape Project', 'slug' => 'landscape-project', 'parent_group' => 'landscape', 'sort_order' => 4],
            // HOUSEKEEPING
            ['name' => 'Room', 'slug' => 'room', 'parent_group' => 'housekeeping', 'sort_order' => 5],
            ['name' => 'Villa', 'slug' => 'villa', 'parent_group' => 'housekeeping', 'sort_order' => 6],
            ['name' => 'Hotel', 'slug' => 'hotel', 'parent_group' => 'housekeeping', 'sort_order' => 7],
            ['name' => 'Cleaning', 'slug' => 'cleaning', 'parent_group' => 'housekeeping', 'sort_order' => 8],
        ];

        $catMap = [];
        foreach ($galleryCats as $gc) {
            $catMap[$gc['slug']] = GalleryCategory::updateOrCreate(['slug' => $gc['slug']], $gc);
        }

        // Gallery Items
        $galleryItems = [
            [
                'title' => 'Tropical Villa Sanctuary Garden',
                'caption' => 'Penataan dan pemangkasan rumput terawat dengan bale santai Bali.',
                'image_path' => 'images/kubu/hero_bali.jpg',
                'parent_group' => 'landscape',
                'gallery_category_id' => $catMap['garden']->id,
                'sort_order' => 1,
            ],
            [
                'title' => 'Professional Shrub & Border Pruning',
                'caption' => 'Tenaga berkualifikasi merawat bunga heliconia dan tanaman hias tropis.',
                'image_path' => 'images/kubu/landscape_service.jpg',
                'parent_group' => 'landscape',
                'gallery_category_id' => $catMap['maintenance']->id,
                'sort_order' => 2,
            ],
            [
                'title' => 'Soil Preparation & Plant Staging',
                'caption' => 'Pemasangan tanaman baru dan perbaikan struktur tanah bernutrisi.',
                'image_path' => 'images/kubu/project_process.jpg',
                'parent_group' => 'landscape',
                'gallery_category_id' => $catMap['planting']->id,
                'sort_order' => 3,
            ],
            [
                'title' => 'Manicured Courtyard Revival',
                'caption' => 'Hasil pengerjaan penataan landscape villa privat di Seminyak.',
                'image_path' => 'images/kubu/project_after.jpg',
                'parent_group' => 'landscape',
                'gallery_category_id' => $catMap['landscape-project']->id,
                'sort_order' => 4,
            ],
            [
                'title' => 'Automated Mist Sprinkler Operation',
                'caption' => 'Perawatan efisien sistem irigasi otomatis di taman villa.',
                'image_path' => 'images/kubu/irrigation_service.jpg',
                'parent_group' => 'landscape',
                'gallery_category_id' => $catMap['maintenance']->id,
                'sort_order' => 5,
            ],
            [
                'title' => 'Master Bedroom Turn-Down Standard',
                'caption' => 'Penataan linen rapi, bantal dekoratif, dan kebersihan lantai marmer.',
                'image_path' => 'images/kubu/housekeeping_service.jpg',
                'parent_group' => 'housekeeping',
                'gallery_category_id' => $catMap['room']->id,
                'sort_order' => 6,
            ],
            [
                'title' => 'Open-Air Luxury Bathroom Sanitization',
                'caption' => 'Kebersihan bathtub terrazzo, shower glass jernih, dan handuk tertata.',
                'image_path' => 'images/kubu/bathroom_service.jpg',
                'parent_group' => 'housekeeping',
                'gallery_category_id' => $catMap['cleaning']->id,
                'sort_order' => 7,
            ],
            [
                'title' => 'Villa Suite Deep-Clean Presentation',
                'caption' => 'Kesiapan kamar villa untuk menyambut tamu VIP dengan kesegaran maksimal.',
                'image_path' => 'images/kubu/housekeeping_service.jpg',
                'parent_group' => 'housekeeping',
                'gallery_category_id' => $catMap['villa']->id,
                'sort_order' => 8,
            ],
        ];

        foreach ($galleryItems as $gi) {
            GalleryImage::updateOrCreate(['title' => $gi['title']], $gi);
        }
    }
}
