<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Unit;
use App\Models\Category;
use App\Models\UnitCategory;
use App\Models\Activity;

class UnitSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $unit1 = Unit::create([
            'name' => 'Teknik Sipil',
        ]);
        $unit2 = Unit::create([
            'name' => 'PUTI',
        ]);
        $unit3 = Unit::create([
            'name' => 'Teknik Informatika dan Komputer',
        ]);
        $unit4 = Unit::create([
            'name' => 'Teknik Grafika Penerbitan',
        ]);
        $unit5 = Unit::create([
            'name' => 'Akuntansi',
        ]);
        $unit6 = Unit::create([
            'name' => 'Teknik Mesin',
        ]);
        $unit7 = Unit::create([
            'name' => 'Administrasi Niaga',
        ]);
        $unit8 = Unit::create([
            'name' => 'Teknik Elektro',
        ]);
        $unit9 = Unit::create([
            'name' => 'PUT CoA',
        ]);
        $unit10 = Unit::create([
            'name' => 'up2m',
        ]);
        $unit11 = Unit::create([
            'name' => 'Sentra Bisnis Lain',
        ]);

        $category1 = Category::create([
            'name' => 'Jasa',
        ]);
        $category2 = Category::create([
            'name' => 'Pelatihan',
        ]);
        $category3 = Category::create([
            'name' => 'Inovasi',
        ]);
        $category4 = Category::create([
            'name' => 'Produk',
        ]);

        UnitCategory::create([
            'unit_id' => $unit1->id,
            'category_id' => $category1->id,
        ]);

        UnitCategory::create([
            'unit_id' => $unit1->id,
            'category_id' => $category2->id,
        ]);

        UnitCategory::create([
            'unit_id' => $unit2->id,
            'category_id' => $category3->id,
        ]);

        UnitCategory::create([
            'unit_id' => $unit2->id,
            'category_id' => $category4->id,
        ]);

        UnitCategory::create([
            'unit_id' => $unit2->id,
            'category_id' => $category1->id,
        ]);

        UnitCategory::create([
            'unit_id' => $unit3->id,
            'category_id' => $category4->id,
        ]);
        UnitCategory::create([
            'unit_id' => $unit3->id,
            'category_id' => $category1->id,
        ]);
        UnitCategory::create([
            'unit_id' => $unit3->id,
            'category_id' => $category2->id,
        ]);

        UnitCategory::create([
            'unit_id' => $unit4->id,
            'category_id' => $category3->id,
        ]);
        UnitCategory::create([
            'unit_id' => $unit4->id,
            'category_id' => $category1->id,
        ]);
        UnitCategory::create([
            'unit_id' => $unit4->id,
            'category_id' => $category2->id,
        ]);

        UnitCategory::create([
            'unit_id' => $unit5->id,
            'category_id' => $category2->id,
        ]);

        UnitCategory::create([
            'unit_id' => $unit6->id,
            'category_id' => $category3->id,
        ]);
        UnitCategory::create([
            'unit_id' => $unit6->id,
            'category_id' => $category4->id,
        ]);
        UnitCategory::create([
            'unit_id' => $unit6->id,
            'category_id' => $category1->id,
        ]);
        UnitCategory::create([
            'unit_id' => $unit6->id,
            'category_id' => $category2->id,
        ]);

        UnitCategory::create([
            'unit_id' => $unit7->id,
            'category_id' => $category1->id,
        ]);
        UnitCategory::create([
            'unit_id' => $unit7->id,
            'category_id' => $category3->id,
        ]);

        UnitCategory::create([
            'unit_id' => $unit8->id,
            'category_id' => $category1->id,
        ]);
        UnitCategory::create([
            'unit_id' => $unit8->id,
            'category_id' => $category2->id,
        ]);
        UnitCategory::create([
            'unit_id' => $unit8->id,
            'category_id' => $category3->id,
        ]);
        UnitCategory::create([
            'unit_id' => $unit8->id,
            'category_id' => $category4->id,
        ]);

        UnitCategory::create([
            'unit_id' => $unit9->id,
            'category_id' => $category1->id,
        ]);
        UnitCategory::create([
            'unit_id' => $unit9->id,
            'category_id' => $category2->id,
        ]);

        UnitCategory::create([
            'unit_id' => $unit10->id,
            'category_id' => $category1->id,
        ]);
        UnitCategory::create([
            'unit_id' => $unit10->id,
            'category_id' => $category2->id,
        ]);

        UnitCategory::create([
            'unit_id' => $unit11->id,
            'category_id' => $category2->id,
        ]);




        Activity::create([
            'unit_id' => $unit1->id,
            'category_id' => $category1->id,
            'name' => 'Penyelidikan Sondir',
        ]);
        Activity::create([
            'unit_id' => $unit1->id,
            'category_id' => $category1->id,
            'name' => 'Penyelidikan Lab',
        ]);
        Activity::create([
            'unit_id' => $unit1->id,
            'category_id' => $category1->id,
            'name' => 'Pemetaan',
        ]);
        Activity::create([
            'unit_id' => $unit1->id,
            'category_id' => $category1->id,
            'name' => 'Volume cut and Fill',
        ]);
        Activity::create([
            'unit_id' => $unit1->id,
            'category_id' => $category1->id,
            'name' => 'Interior kantor',
        ]);
        Activity::create([
            'unit_id' => $unit1->id,
            'category_id' => $category1->id,
            'name' => 'Interior Eksekutif',
        ]);
        Activity::create([
            'unit_id' => $unit1->id,
            'category_id' => $category1->id,
            'name' => 'Design gedung, jembatan',
        ]);

        Activity::create([
            'unit_id' => $unit1->id,
            'category_id' => $category2->id,
            'name' => 'Pelatihan System Kontrol Kualitas Beton',
        ]);
        Activity::create([
            'unit_id' => $unit1->id,
            'category_id' => $category2->id,
            'name' => 'Pelatihan System Pengujian Index Properties Tanah',
        ]);
        Activity::create([
            'unit_id' => $unit1->id,
            'category_id' => $category2->id,
            'name' => 'Pelatihan Tekla Structures dalam menunjang BIM (Building Information Modelling)',
        ]);
        Activity::create([
            'unit_id' => $unit1->id,
            'category_id' => $category2->id,
            'name' => 'Pelatihan Teknik Beton Aspal',
        ]);
        Activity::create([
            'unit_id' => $unit1->id,
            'category_id' => $category2->id,
            'name' => 'Pelatihan Teknologi Beton Berkinerja Tinggi',
        ]);
        Activity::create([
            'unit_id' => $unit1->id,
            'category_id' => $category2->id,
            'name' => 'Pelatihan Teknologi Konstruksi Beton/Pembesian',
        ]);
        Activity::create([
            'unit_id' => $unit1->id,
            'category_id' => $category2->id,
            'name' => 'Pelatihan Teknologi Penggunaan Alat Theodolite',
        ]);
        Activity::create([
            'unit_id' => $unit1->id,
            'category_id' => $category2->id,
            'name' => 'Pelatihan Teknologi Penggunaan Alat Waterpass',
        ]);

        Activity::create([
            'unit_id' => $unit2->id,
            'category_id' => $category3->id,
            'name' => 'Penelitian',
        ]);

        Activity::create([
            'unit_id' => $unit2->id,
            'category_id' => $category4->id,
            'name' => 'Pengembangan Alat',
        ]);

        Activity::create([
            'unit_id' => $unit2->id,
            'category_id' => $category1->id,
            'name' => 'Pengujian fatik',
        ]);
        Activity::create([
            'unit_id' => $unit2->id,
            'category_id' => $category1->id,
            'name' => 'Pengujian Toughness',
        ]);
        Activity::create([
            'unit_id' => $unit2->id,
            'category_id' => $category1->id,
            'name' => 'Pengujian SHMS',
        ]);
        Activity::create([
            'unit_id' => $unit2->id,
            'category_id' => $category1->id,
            'name' => 'Design jembatan menggunakan software MIDAS',
        ]);
        Activity::create([
            'unit_id' => $unit2->id,
            'category_id' => $category2->id,
            'name' => 'Design jembatan menggunakan software MIDAS',
        ]);

        Activity::create([
            'unit_id' => $unit3->id,
            'category_id' => $category4->id,
            'name' => 'Software',
        ]);

        Activity::create([
            'unit_id' => $unit3->id,
            'category_id' => $category1->id,
            'name' => 'IT Konsultan',
        ]);
        Activity::create([
            'unit_id' => $unit3->id,
            'category_id' => $category1->id,
            'name' => 'IT Audit',
        ]);
        Activity::create([
            'unit_id' => $unit3->id,
            'category_id' => $category1->id,
            'name' => 'Pentest',
        ]);
        Activity::create([
            'unit_id' => $unit3->id,
            'category_id' => $category1->id,
            'name' => 'Video Editing',
        ]);
        Activity::create([
            'unit_id' => $unit3->id,
            'category_id' => $category1->id,
            'name' => 'Motion Grafis',
        ]);
        Activity::create([
            'unit_id' => $unit3->id,
            'category_id' => $category1->id,
            'name' => 'Pembuatan Media pembelajaran',
        ]);
        Activity::create([
            'unit_id' => $unit3->id,
            'category_id' => $category1->id,
            'name' => 'Pembuatan Company Profile',
        ]);

        Activity::create([
            'unit_id' => $unit3->id,
            'category_id' => $category2->id,
            'name' => 'IT Training',
        ]);

        Activity::create([
            'unit_id' => $unit4->id,
            'category_id' => $category3->id,
            'name' => 'Penelitian',
        ]);
        
        Activity::create([
            'unit_id' => $unit4->id,
            'category_id' => $category1->id,
            'name' => 'Percetakan',
        ]);
        Activity::create([
            'unit_id' => $unit4->id,
            'category_id' => $category1->id,
            'name' => 'Design Consultant',
        ]);
        Activity::create([
            'unit_id' => $unit4->id,
            'category_id' => $category1->id,
            'name' => 'Teknik Kemasan',
        ]);
        Activity::create([
            'unit_id' => $unit4->id,
            'category_id' => $category1->id,
            'name' => 'Jurnalistik',
        ]);

        Activity::create([
            'unit_id' => $unit4->id,
            'category_id' => $category2->id,
            'name' => 'Marketing Tools Design',
        ]);
        Activity::create([
            'unit_id' => $unit4->id,
            'category_id' => $category2->id,
            'name' => 'Packaging and Promo Design',
        ]);
        Activity::create([
            'unit_id' => $unit4->id,
            'category_id' => $category2->id,
            'name' => 'Infographic Design',
        ]);
        Activity::create([
            'unit_id' => $unit4->id,
            'category_id' => $category2->id,
            'name' => 'Video Editing',
        ]);
        Activity::create([
            'unit_id' => $unit4->id,
            'category_id' => $category2->id,
            'name' => 'Motion Graphic',
        ]);
        Activity::create([
            'unit_id' => $unit4->id,
            'category_id' => $category2->id,
            'name' => 'Pembuatan Sablon pada Kain',
        ]);
        Activity::create([
            'unit_id' => $unit4->id,
            'category_id' => $category2->id,
            'name' => 'Pengoperasioan Autocad',
        ]);
        Activity::create([
            'unit_id' => $unit4->id,
            'category_id' => $category2->id,
            'name' => 'Book Binding',
        ]);
        Activity::create([
            'unit_id' => $unit4->id,
            'category_id' => $category2->id,
            'name' => 'Animation 2D',
        ]);
        Activity::create([
            'unit_id' => $unit4->id,
            'category_id' => $category2->id,
            'name' => 'Book Design',
        ]);
        Activity::create([
            'unit_id' => $unit4->id,
            'category_id' => $category2->id,
            'name' => 'Catalog Design',
        ]);
        Activity::create([
            'unit_id' => $unit4->id,
            'category_id' => $category2->id,
            'name' => 'Web Design',
        ]);
        Activity::create([
            'unit_id' => $unit4->id,
            'category_id' => $category2->id,
            'name' => 'Vector Design',
        ]);
        Activity::create([
            'unit_id' => $unit4->id,
            'category_id' => $category2->id,
            'name' => 'Vector Illustration ',
        ]);
        Activity::create([
            'unit_id' => $unit4->id,
            'category_id' => $category2->id,
            'name' => 'Digital Imaging',
        ]);

        Activity::create([
            'unit_id' => $unit5->id,
            'category_id' => $category2->id,
            'name' => 'WPPE Pemasaran',
        ]);
        Activity::create([
            'unit_id' => $unit5->id,
            'category_id' => $category2->id,
            'name' => 'WMI',
        ]);
        Activity::create([
            'unit_id' => $unit5->id,
            'category_id' => $category2->id,
            'name' => 'Komputerisasi Akuntansi',
        ]);
        Activity::create([
            'unit_id' => $unit5->id,
            'category_id' => $category2->id,
            'name' => 'Audit Tools Workshop',
        ]);

        Activity::create([
            'unit_id' => $unit6->id,
            'category_id' => $category3->id,
            'name' => 'Penelitian',
        ]);

        Activity::create([
            'unit_id' => $unit6->id,
            'category_id' => $category4->id,
            'name' => 'Produksi Part/Komponen Permesinan',
        ]);
        Activity::create([
            'unit_id' => $unit6->id,
            'category_id' => $category4->id,
            'name' => 'Part/komponen presisi',
        ]);
        Activity::create([
            'unit_id' => $unit6->id,
            'category_id' => $category4->id,
            'name' => 'Produksi injeksi plastic, dan blow molding.',
        ]);

        Activity::create([
            'unit_id' => $unit6->id,
            'category_id' => $category4->id,
            'name' => 'Produksi injeksi plastic, dan blow molding.',
        ]);

        Activity::create([
            'unit_id' => $unit6->id,
            'category_id' => $category1->id,
            'name' => 'Rancang bangun Mesin',
        ]);
        Activity::create([
            'unit_id' => $unit6->id,
            'category_id' => $category1->id,
            'name' => 'Jasa design welding',
        ]);
        Activity::create([
            'unit_id' => $unit6->id,
            'category_id' => $category1->id,
            'name' => 'Jasa piping design',
        ]);
        Activity::create([
            'unit_id' => $unit6->id,
            'category_id' => $category1->id,
            'name' => 'Jasa pemesinan',
        ]);
        Activity::create([
            'unit_id' => $unit6->id,
            'category_id' => $category1->id,
            'name' => 'Mashining mold',
        ]);
        Activity::create([
            'unit_id' => $unit6->id,
            'category_id' => $category1->id,
            'name' => 'CNC Programming',
        ]);
        Activity::create([
            'unit_id' => $unit6->id,
            'category_id' => $category1->id,
            'name' => 'Machining fixture',
        ]);
        Activity::create([
            'unit_id' => $unit6->id,
            'category_id' => $category1->id,
            'name' => 'Machining dies',
        ]);
        Activity::create([
            'unit_id' => $unit6->id,
            'category_id' => $category1->id,
            'name' => 'Rancang mold injeksi',
        ]);
        Activity::create([
            'unit_id' => $unit6->id,
            'category_id' => $category1->id,
            'name' => 'Rancang mold blow',
        ]);
        Activity::create([
            'unit_id' => $unit6->id,
            'category_id' => $category1->id,
            'name' => 'Perawatan Automotif',
        ]);
        Activity::create([
            'unit_id' => $unit6->id,
            'category_id' => $category1->id,
            'name' => 'Perawatan Alat Berat',
        ]);
        Activity::create([
            'unit_id' => $unit6->id,
            'category_id' => $category1->id,
            'name' => 'Rancang Bangun Peralatan Ergonomi',
        ]);
        Activity::create([
            'unit_id' => $unit6->id,
            'category_id' => $category1->id,
            'name' => 'Uji Tarik',
        ]);
        Activity::create([
            'unit_id' => $unit6->id,
            'category_id' => $category1->id,
            'name' => 'Uji metalografi',
        ]);
        Activity::create([
            'unit_id' => $unit6->id,
            'category_id' => $category1->id,
            'name' => 'Uji keras',
        ]);
        Activity::create([
            'unit_id' => $unit6->id,
            'category_id' => $category1->id,
            'name' => 'Uji NDT',
        ]);
        Activity::create([
            'unit_id' => $unit6->id,
            'category_id' => $category1->id,
            'name' => 'Inspeksi',
        ]);
        Activity::create([
            'unit_id' => $unit6->id,
            'category_id' => $category1->id,
            'name' => 'Perawatan',
        ]);
        Activity::create([
            'unit_id' => $unit6->id,
            'category_id' => $category1->id,
            'name' => 'Rancang bangun robot',
        ]);
        Activity::create([
            'unit_id' => $unit6->id,
            'category_id' => $category1->id,
            'name' => 'Rancang bangun control industri',
        ]);
        Activity::create([
            'unit_id' => $unit6->id,
            'category_id' => $category1->id,
            'name' => 'Audit Energi',
        ]);
        Activity::create([
            'unit_id' => $unit6->id,
            'category_id' => $category1->id,
            'name' => 'Design Pembangkit',
        ]);

        Activity::create([
            'unit_id' => $unit6->id,
            'category_id' => $category2->id,
            'name' => 'Pemesinan dasar (Bubut, Frais, dan gerinda).',
        ]);
        Activity::create([
            'unit_id' => $unit6->id,
            'category_id' => $category2->id,
            'name' => 'Pelatihan Mekanik dasar',
        ]);
        Activity::create([
            'unit_id' => $unit6->id,
            'category_id' => $category2->id,
            'name' => 'Operasi CNC',
        ]);
        Activity::create([
            'unit_id' => $unit6->id,
            'category_id' => $category2->id,
            'name' => 'CNC Programming.',
        ]);
        Activity::create([
            'unit_id' => $unit6->id,
            'category_id' => $category2->id,
            'name' => 'Design mold',
        ]);
        Activity::create([
            'unit_id' => $unit6->id,
            'category_id' => $category2->id,
            'name' => 'Design fixture',
        ]);
        Activity::create([
            'unit_id' => $unit6->id,
            'category_id' => $category2->id,
            'name' => 'Design dies',
        ]);
        Activity::create([
            'unit_id' => $unit6->id,
            'category_id' => $category2->id,
            'name' => 'Operasi Mesin Plastik',
        ]);
        Activity::create([
            'unit_id' => $unit6->id,
            'category_id' => $category2->id,
            'name' => 'Kelistrikan Automotif',
        ]);
        Activity::create([
            'unit_id' => $unit6->id,
            'category_id' => $category2->id,
            'name' => 'Pelatihan perawatan excavator',
        ]);
        Activity::create([
            'unit_id' => $unit6->id,
            'category_id' => $category2->id,
            'name' => 'Pelatihan perawatan Wheel loader',
        ]);
        Activity::create([
            'unit_id' => $unit6->id,
            'category_id' => $category2->id,
            'name' => 'Pelatihan perawatan forklift',
        ]);
        Activity::create([
            'unit_id' => $unit6->id,
            'category_id' => $category2->id,
            'name' => 'Operator excavator',
        ]);
        Activity::create([
            'unit_id' => $unit6->id,
            'category_id' => $category2->id,
            'name' => 'Operator loader',
        ]);
        Activity::create([
            'unit_id' => $unit6->id,
            'category_id' => $category2->id,
            'name' => 'Operator forklift',
        ]);
        Activity::create([
            'unit_id' => $unit6->id,
            'category_id' => $category2->id,
            'name' => 'Pelatihan perwatan Mesin Kapal',
        ]);
        Activity::create([
            'unit_id' => $unit6->id,
            'category_id' => $category2->id,
            'name' => 'Pelatihan CATIA',
        ]);
        Activity::create([
            'unit_id' => $unit6->id,
            'category_id' => $category2->id,
            'name' => 'Pelatihan SW',
        ]);
        Activity::create([
            'unit_id' => $unit6->id,
            'category_id' => $category2->id,
            'name' => 'Pelatihan ANSYS CFD',
        ]);
        Activity::create([
            'unit_id' => $unit6->id,
            'category_id' => $category2->id,
            'name' => 'Pelatihan Desain',
        ]);
        Activity::create([
            'unit_id' => $unit6->id,
            'category_id' => $category2->id,
            'name' => 'Pelatihan Ergonomi',
        ]);
        Activity::create([
            'unit_id' => $unit6->id,
            'category_id' => $category2->id,
            'name' => 'Pelatihan manajemen Qualitas',
        ]);
        Activity::create([
            'unit_id' => $unit6->id,
            'category_id' => $category2->id,
            'name' => 'Pelatihan Tata Letak fasilitas',
        ]);
        Activity::create([
            'unit_id' => $unit6->id,
            'category_id' => $category2->id,
            'name' => 'Pelatihan Sistem kerja',
        ]);
        Activity::create([
            'unit_id' => $unit6->id,
            'category_id' => $category2->id,
            'name' => 'Inspeksi welding',
        ]);
        Activity::create([
            'unit_id' => $unit6->id,
            'category_id' => $category2->id,
            'name' => 'metalografi',
        ]);
        Activity::create([
            'unit_id' => $unit6->id,
            'category_id' => $category2->id,
            'name' => 'Inspeksi pengukuran',
        ]);
        Activity::create([
            'unit_id' => $unit6->id,
            'category_id' => $category2->id,
            'name' => 'Pelatihan failure analysis',
        ]);
        Activity::create([
            'unit_id' => $unit6->id,
            'category_id' => $category2->id,
            'name' => 'pelatihan manajemen perawatan',
        ]);
        Activity::create([
            'unit_id' => $unit6->id,
            'category_id' => $category2->id,
            'name' => 'pelatihan case khusus perawatan',
        ]);
        Activity::create([
            'unit_id' => $unit6->id,
            'category_id' => $category2->id,
            'name' => 'Robotic',
        ]);
        Activity::create([
            'unit_id' => $unit6->id,
            'category_id' => $category2->id,
            'name' => 'Mekatronik',
        ]);
        Activity::create([
            'unit_id' => $unit6->id,
            'category_id' => $category2->id,
            'name' => 'Audit Energi',
        ]);
        Activity::create([
            'unit_id' => $unit6->id,
            'category_id' => $category2->id,
            'name' => 'Energi Terbarukan',
        ]);
        Activity::create([
            'unit_id' => $unit6->id,
            'category_id' => $category2->id,
            'name' => 'Turbin',
        ]);
        Activity::create([
            'unit_id' => $unit6->id,
            'category_id' => $category2->id,
            'name' => 'Pompa',
        ]);
        Activity::create([
            'unit_id' => $unit6->id,
            'category_id' => $category2->id,
            'name' => 'PLTD',
        ]);
        Activity::create([
            'unit_id' => $unit6->id,
            'category_id' => $category2->id,
            'name' => 'PLTU',
        ]);
        Activity::create([
            'unit_id' => $unit6->id,
            'category_id' => $category2->id,
            'name' => 'PLTG',
        ]);
        Activity::create([
            'unit_id' => $unit6->id,
            'category_id' => $category2->id,
            'name' => 'Simulasi',
        ]);

        Activity::create([
            'unit_id' => $unit7->id,
            'category_id' => $category1->id,
            'name' => 'Technical Assistant terhadap penyusunan kurikulum berbasis kompetensi',
        ]);
        Activity::create([
            'unit_id' => $unit7->id,
            'category_id' => $category1->id,
            'name' => 'MICE Event Organizer',
        ]);
        Activity::create([
            'unit_id' => $unit7->id,
            'category_id' => $category1->id,
            'name' => 'TUK MICE',
        ]);

        Activity::create([
            'unit_id' => $unit7->id,
            'category_id' => $category3->id,
            'name' => 'Riset Bisnis MICE',
        ]);
        Activity::create([
            'unit_id' => $unit7->id,
            'category_id' => $category3->id,
            'name' => 'Indonesia  MICE Directory',
        ]);

        Activity::create([
            'unit_id' => $unit8->id,
            'category_id' => $category1->id,
            'name' => 'TUK Tegangan Menengah',
        ]);
        Activity::create([
            'unit_id' => $unit8->id,
            'category_id' => $category1->id,
            'name' => 'TUK Drive Test',
        ]);
        Activity::create([
            'unit_id' => $unit8->id,
            'category_id' => $category1->id,
            'name' => 'TUK Instalasi Jaringan Fiber Optik',
        ]);
        Activity::create([
            'unit_id' => $unit8->id,
            'category_id' => $category1->id,
            'name' => 'Kerjasama Pendidikan',
        ]);

        Activity::create([
            'unit_id' => $unit8->id,
            'category_id' => $category3->id,
            'name' => 'Penelitian',
        ]);

        Activity::create([
            'unit_id' => $unit8->id,
            'category_id' => $category4->id,
            'name' => 'Air Mineral',
        ]);
        Activity::create([
            'unit_id' => $unit8->id,
            'category_id' => $category4->id,
            'name' => 'Pabrikasi Antena',
        ]);
        Activity::create([
            'unit_id' => $unit8->id,
            'category_id' => $category4->id,
            'name' => 'Modul IOT',
        ]);
        Activity::create([
            'unit_id' => $unit8->id,
            'category_id' => $category4->id,
            'name' => 'Modul Robotik',
        ]);

        Activity::create([
            'unit_id' => $unit8->id,
            'category_id' => $category2->id,
            'name' => 'Pelatihan LabVIEW core 1',
        ]);
        Activity::create([
            'unit_id' => $unit8->id,
            'category_id' => $category2->id,
            'name' => 'Pelatihan LabVIEW core 2',
        ]);
        Activity::create([
            'unit_id' => $unit8->id,
            'category_id' => $category2->id,
            'name' => 'Pelatihan LabVIEW Real-Time',
        ]);
        Activity::create([
            'unit_id' => $unit8->id,
            'category_id' => $category2->id,
            'name' => 'Pelatihan LabVIEW FPGA',
        ]);
        Activity::create([
            'unit_id' => $unit8->id,
            'category_id' => $category2->id,
            'name' => 'Pelatihan Industrial Proses (Water Treatment Plant)',
        ]);
        Activity::create([
            'unit_id' => $unit8->id,
            'category_id' => $category2->id,
            'name' => 'Pelatihan Instalasi Penerangan dan Daya (1Phase dan 3 Phase pada Gedung)',
        ]);
        Activity::create([
            'unit_id' => $unit8->id,
            'category_id' => $category2->id,
            'name' => 'Pelatihan Penggunaan Alat Ukur dasar dan kelistrikan',
        ]);
        Activity::create([
            'unit_id' => $unit8->id,
            'category_id' => $category2->id,
            'name' => 'Pelatihan Pemrograman PLC Dasar',
        ]);
        Activity::create([
            'unit_id' => $unit8->id,
            'category_id' => $category2->id,
            'name' => 'Pemrograman PLC Advance',
        ]);
        Activity::create([
            'unit_id' => $unit8->id,
            'category_id' => $category2->id,
            'name' => 'Pemrograman SCADA (Supervisory Control And Data Accuisition)',
        ]);
        Activity::create([
            'unit_id' => $unit8->id,
            'category_id' => $category2->id,
            'name' => 'Tegangan Menengah',
        ]);
        Activity::create([
            'unit_id' => $unit8->id,
            'category_id' => $category2->id,
            'name' => 'Pelatihan disain Antena dan Propagasi',
        ]);
        Activity::create([
            'unit_id' => $unit8->id,
            'category_id' => $category2->id,
            'name' => 'Pelatihan Instalasi Jaringan Fiber Optik',
        ]);
        Activity::create([
            'unit_id' => $unit8->id,
            'category_id' => $category2->id,
            'name' => 'Pelatihan Mikrokontroler Dasar',
        ]);
        Activity::create([
            'unit_id' => $unit8->id,
            'category_id' => $category2->id,
            'name' => 'Pelatihan Pemeliharaan dan Perbaikan Instalasi Listrik Gedung/Pabrik',
        ]);

        Activity::create([
            'unit_id' => $unit9->id,
            'category_id' => $category1->id,
            'name' => 'Pelayanan Servis Motor dan Mobil',
        ]);
        Activity::create([
            'unit_id' => $unit9->id,
            'category_id' => $category1->id,
            'name' => 'Konversi ke Kendaraan Listrik untuk Motor dan Mobil',
        ]);

        Activity::create([
            'unit_id' => $unit9->id,
            'category_id' => $category2->id,
            'name' => 'Pelayanan Servis Motor dan Mobil',
        ]);
        Activity::create([
            'unit_id' => $unit9->id,
            'category_id' => $category2->id,
            'name' => 'Konversi ke Kendaraan Listrik untuk Motor dan Mobil',
        ]);

        Activity::create([
            'unit_id' => $unit10->id,
            'category_id' => $category1->id,
            'name' => 'Pendaftaran KI melalui Wahana HKI PNJ ',
        ]);
        Activity::create([
            'unit_id' => $unit10->id,
            'category_id' => $category1->id,
            'name' => 'Pendaftaran Seminar Nasional dan Internasional ',
        ]);
        Activity::create([
            'unit_id' => $unit10->id,
            'category_id' => $category1->id,
            'name' => 'Narasumber tenaga Ahli atau profesional (Pengelolaan Jurnal / HKI / ',
        ]);
        Activity::create([
            'unit_id' => $unit10->id,
            'category_id' => $category1->id,
            'name' => 'Reviewer Proposal P2M nasional (BIMA, MF, Rister LPDP)',
        ]);
        Activity::create([
            'unit_id' => $unit10->id,
            'category_id' => $category1->id,
            'name' => 'Pendamping halal ',
        ]);
        Activity::create([
            'unit_id' => $unit10->id,
            'category_id' => $category1->id,
            'name' => 'Auditor Halal (belum ada auditor halal di PNJ)',
        ]);

        Activity::create([
            'unit_id' => $unit10->id,
            'category_id' => $category2->id,
            'name' => 'Pelatihan Pekerti',
        ]);
        Activity::create([
            'unit_id' => $unit10->id,
            'category_id' => $category2->id,
            'name' => 'Pelatihan Applies Approach',
        ]);

        Activity::create([
            'unit_id' => $unit11->id,
            'category_id' => $category2->id,
            'name' => 'Leadership Training',
        ]);
        Activity::create([
            'unit_id' => $unit11->id,
            'category_id' => $category2->id,
            'name' => 'Tata Kelola Vokasi',
        ]);

        
        
        

    }
}
