<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class InfoForTest extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::table('subjects')->insert(['name' => 'Gastronomía', 'slug' => 'gastronomia', 'order' => 1, 'image' => 'subjects/1.png']);
        DB::table('subjects')->insert(['name' => 'Indumentaria / Accesorios', 'slug' => 'indumentariaaccesorios', 'order' => 2, 'image' => 'subjects/2.png']);
        DB::table('subjects')->insert(['name' => 'Salud / Estética', 'slug' => 'saludestetica', 'order' => 3, 'image' => 'subjects/3.png']);
        DB::table('subjects')->insert(['name' => 'Hogar / Construcción', 'slug' => 'hogarconstrucción', 'order' => 4, 'image' => 'subjects/4.png']);
        DB::table('subjects')->insert(['name' => 'Servicios', 'slug' => 'servicios', 'order' => 5, 'image' => 'subjects/5.png']);
        DB::table('subjects')->insert(['name' => 'Negocios especializados', 'slug' => 'negociosespecializados', 'order' => 6, 'image' => 'subjects/6.png']);

        DB::table('thematics')->insert(['name' => 'Mujeres', 'slug' => 'mujeres', 'highlights' => true, 'order' => 1]);

        DB::table('banners')->insert(['title' => 'Inferior Home', 'position' => 'banner_bottom_home', 'image' => 'banners/1.png']);
        DB::table('banners')->insert(['title' => 'Inferior Home Mobile', 'position' => 'banner_bottom_home_mobile', 'image' => 'banners/2.png']);
        DB::table('banners')->insert(['title' => 'Inferior Resultados', 'position' => 'banner_bottom_search', 'image' => 'banners/3.png']);
        DB::table('banners')->insert(['title' => 'Inferior Resultados Mobile', 'position' => 'banner_bottom_search_mobile', 'image' => 'banners/4.png']);
        DB::table('banners')->insert(['title' => 'Inferior Actualidad', 'position' => 'banner_bottom_news', 'image' => 'banners/5.png']);
        DB::table('banners')->insert(['title' => 'Inferior Actualidad Mobile', 'position' => 'banner_bottom_news_mobile', 'image' => 'banners/6.png']);
        DB::table('banners')->insert(['title' => 'Inferior Tu Asesor', 'position' => 'banner_bottom_adviser', 'image' => 'banners/7.png']);
        DB::table('banners')->insert(['title' => 'Inferior Tu Asesor Mobile', 'position' => 'banner_bottom_adviser_mobile', 'image' => 'banners/8.png']);
        DB::table('banners')->insert(['title' => 'Inferior Que es Franquiciar', 'position' => 'banner_bottom_about', 'image' => 'banners/9.png']);
        DB::table('banners')->insert(['title' => 'Inferior Que es Franquiciar Mobile', 'position' => 'banner_bottom_about_mobile', 'image' => 'banners/10.png']);
        DB::table('banners')->insert(['title' => 'Inferior Temática', 'position' => 'banner_bottom_thematics', 'image' => 'banners/11.png']);
        DB::table('banners')->insert(['title' => 'Inferior Temática Mobile', 'position' => 'banner_bottom_thematics_mobile', 'image' => 'banners/12.png']);
        DB::table('banners')->insert(['title' => 'Medio Home', 'position' => 'banner_middle_home', 'image' => 'banners/m1.jpeg']);
        DB::table('banners')->insert(['title' => 'Superior Home 1', 'position' => 'banner_top_home', 'image' => 'banners/s1.jpeg']);
        DB::table('banners')->insert(['title' => 'Superior Home 2', 'position' => 'banner_top_home', 'image' => 'banners/s2.jpeg']);
        DB::table('banners')->insert(['title' => 'Superior Home 3', 'position' => 'banner_top_home', 'image' => 'banners/s3.jpeg']);
        DB::table('banners')->insert(['title' => 'Superior Home 4', 'position' => 'banner_top_home', 'image' => 'banners/s4.jpeg']);
        DB::table('banners')->insert(['title' => 'Medio Tu Asesor', 'position' => 'banner_middle_adviser', 'image' => 'banners/mt.jpg']);
        DB::table('banners')->insert(['title' => 'Medio Tu Asesor Mobile', 'position' => 'banner_middle_adviser_mobile', 'image' => 'banners/mtm.jpg']);
        DB::table('banners')->insert(['title' => 'Inferior Franchising', 'position' => 'banner_bottom_franchising', 'image' => 'banners/13.png']);
        DB::table('banners')->insert(['title' => 'Inferior Franchising Mobile', 'position' => 'banner_bottom_franchising_mobile', 'image' => 'banners/13.png']);
        DB::table('banners')->insert(['title' => 'Superior Home Mobile 1', 'position' => 'banner_top_home_mobile', 'image' => 'banners/s1.jpeg']);
        DB::table('banners')->insert(['title' => 'Superior Home Mobile 2', 'position' => 'banner_top_home_mobile', 'image' => 'banners/s2.jpeg']);
        DB::table('banners')->insert(['title' => 'Superior Home Mobile 3', 'position' => 'banner_top_home_mobile', 'image' => 'banners/s3.jpeg']);
        DB::table('banners')->insert(['title' => 'Superior Home Mobile 4', 'position' => 'banner_top_home_mobile', 'image' => 'banners/s4.jpeg']);

        DB::table('franchises')->insert([
            'name'                  => 'freddo',
            'slug'                  => 'freddo',
            'business_name'         => 'freddo',
            'vat_condition'         => 'exento',
            'cuit'                  => '20-21521501-3',
            'contact_address'       => 'cabildo 300',
            'authorizes_recruitment'=> 'Lilia',
            'contrac_phone'         => '4754-8145',
            'contact_email'         => 'contact@email.com',
            'contracting_period'    => '5 years',
            'way_pay'               => 'efectivo',
            'description'           => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit . Donec convallis sem sed venenatis commodo . Nam in suscipit lacus, quis volutpat ipsum . Aliquam consequat ullamcorper ante, et vulputate magna varius a . Interdum et malesuada fames ac ante ipsum primis in faucibus . Praesent imperdiet condimentum aliquam . Phasellus at lectus dolor . Interdum et malesuada fames ac ante ipsum primis in faucibus . Vestibulum interdum metus eu tortor faucibus, a sagittis tortor finibus',
            'description_red'       => 'Helados Ricos',
            'country'               => 'Argentina',
            'country_in'            => 'Argentina, Paraguay',
            'grand_open'            => '1900',
            'franchises_local'      => '50',
            'franchises_this_year'  => '25',
            'franchises_total'      => '1500',
            'partners'              => 'Cuchuruchos',
            'contact_name'          => 'Pepe',
            'phone'                 => '44444444',
            'email'                 => 'pepeelmaillargo@gmail.com',
            'website'               => 'www.franquiciar.com.ar',
            'facebook'              => 'facebook.com',
            'twitter'               => 'twitter.com',
            'fee'                   => '500000',
            'royalty'               => '5% de las ventas',
            'total_investment'      => '5000000',
            'corporate_advertising' => 'Si',
            'canon_advertising'     => '300000',
            'financing_available'   => 'Si',
            'average_annual'        => '7000000',
            'recover_estimated'     => '5 meses',
            'premises_size'         => '82 M2',
            'employees'             => '4',
            'contract_term'         => '5 años',
            'exportable_franchise'  => 'si',
            'first_reasons'         => 'primera razón',
            'second_reasons'        => 'segunda razón',
            'third_reasons'         => 'tercera razón',
            'fourth_reasons'        => 'cuarta razón',
            'fifth_reasons'         => 'quinta razón',
            'meta_title'            => 'freddo',
            'meta_description'      => 'freddo',
            'meta_keywords'         => 'freddo',
            'user_id'               => 3,
            'subject_id'            => 1,
            'thematic_id'           => 1,
            'highlights'            => true,
            'order'                 => 1,
            'visible'               => true
        ]);
        DB::table('franchises')->insert([
            'name'                  => 'heladeria de barrio',
            'slug'                  => 'heladeria-de-barrio',
            'business_name'         => 'freddo',
            'vat_condition'         => 'exento',
            'cuit'                  => '20-21521501-3',
            'contact_address'       => 'cabildo 300',
            'authorizes_recruitment'=> 'Lilia',
            'contrac_phone'         => '4754-8145',
            'contact_email'         => 'contact@email.com',
            'contracting_period'    => '5 years',
            'way_pay'               => 'efectivo',
            'description'           => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit . Donec convallis sem sed venenatis commodo . Nam in suscipit lacus, quis volutpat ipsum . Aliquam consequat ullamcorper ante, et vulputate magna varius a . Interdum et malesuada fames ac ante ipsum primis in faucibus . Praesent imperdiet condimentum aliquam . Phasellus at lectus dolor . Interdum et malesuada fames ac ante ipsum primis in faucibus . Vestibulum interdum metus eu tortor faucibus, a sagittis tortor finibus',
            'description_red'       => 'Helados Ricos',
            'country'               => 'Argentina',
            'country_in'            => 'Argentina, Paraguay',
            'grand_open'            => '1900',
            'franchises_local'      => '50',
            'franchises_this_year'  => '25',
            'franchises_total'      => '1500',
            'partners'              => 'Cuchuruchos',
            'contact_name'          => 'Pepe',
            'phone'                 => '44444444',
            'email'                 => 'pepeelmaillargo@gmail.com',
            'website'               => 'www.franquiciar.com.ar',
            'facebook'              => 'facebook.com',
            'twitter'               => 'twitter.com',
            'fee'                   => '500000',
            'royalty'               => '5% de las ventas',
            'total_investment'      => '5000000',
            'corporate_advertising' => 'Si',
            'canon_advertising'     => '300000',
            'financing_available'   => 'Si',
            'average_annual'        => '7000000',
            'recover_estimated'     => '5 meses',
            'premises_size'         => '82 M2',
            'employees'             => '4',
            'contract_term'         => '5 años',
            'exportable_franchise'  => 'si',
            'first_reasons'         => 'primera razón',
            'second_reasons'        => 'segunda razón',
            'third_reasons'         => 'tercera razón',
            'fourth_reasons'        => 'cuarta razón',
            'fifth_reasons'         => 'quinta razón',
            'meta_title'            => 'heladeria',
            'meta_description'      => 'heladeria',
            'meta_keywords'         => 'heladeria',
            'user_id'               => 3,
            'subject_id'            => 1,
            'thematic_id'           => 1,
            'weekly'                => true,
            'highlights'            => false,
            'order'                 => 2,
            'visible'               => true
        ]);
        DB::table('franchises')->insert([
            'name'                  => 'restaurante de barrio',
            'slug'                  => 'restaurante-de-barrio',
            'business_name'         => 'freddo',
            'vat_condition'         => 'exento',
            'cuit'                  => '20-21521501-3',
            'contact_address'       => 'cabildo 300',
            'authorizes_recruitment'=> 'Lilia',
            'contrac_phone'         => '4754-8145',
            'contact_email'         => 'contact@email.com',
            'contracting_period'    => '5 years',
            'way_pay'               => 'efectivo',
            'description'           => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit . Donec convallis sem sed venenatis commodo . Nam in suscipit lacus, quis volutpat ipsum . Aliquam consequat ullamcorper ante, et vulputate magna varius a . Interdum et malesuada fames ac ante ipsum primis in faucibus . Praesent imperdiet condimentum aliquam . Phasellus at lectus dolor . Interdum et malesuada fames ac ante ipsum primis in faucibus . Vestibulum interdum metus eu tortor faucibus, a sagittis tortor finibus',
            'description_red'       => 'Milanesas',
            'country'               => 'Argentina',
            'country_in'            => 'Argentina, Cuba',
            'grand_open'            => '1900',
            'franchises_local'      => '50',
            'franchises_this_year'  => '25',
            'franchises_total'      => '1500',
            'partners'              => 'Tenedores',
            'contact_name'          => 'Pepe',
            'phone'                 => '44444444',
            'email'                 => 'pepeelmaillargo@gmail.com',
            'website'               => 'www.franquiciar.com.ar',
            'facebook'              => 'facebook.com',
            'twitter'               => 'twitter.com',
            'fee'                   => '500000',
            'royalty'               => '5% de las ventas',
            'total_investment'      => '5000000',
            'corporate_advertising' => 'Si',
            'canon_advertising'     => '300000',
            'financing_available'   => 'Si',
            'average_annual'        => '7000000',
            'recover_estimated'     => '5 meses',
            'premises_size'         => '82 M2',
            'employees'             => '4',
            'contract_term'         => '5 años',
            'exportable_franchise'  => 'si',
            'first_reasons'         => 'primera razón',
            'second_reasons'        => 'segunda razón',
            'third_reasons'         => 'tercera razón',
            'fourth_reasons'        => 'cuarta razón',
            'fifth_reasons'         => 'quinta razón',
            'meta_title'            => 'restaurante',
            'meta_description'      => 'restaurante',
            'meta_keywords'         => 'restaurante',
            'user_id'               => 3,
            'highlights'            => true,
            'subject_id'            => 2,
            'thematic_id'           => 1,
            'order'                 => 2,
            'visible'               => true
        ]);
        DB::table('franchises')->insert([
            'name'                  => 'Mc Donalds',
            'slug'                  => 'mc-donalds',
            'business_name'         => 'freddo',
            'vat_condition'         => 'exento',
            'cuit'                  => '20-21521501-3',
            'contact_address'       => 'cabildo 300',
            'authorizes_recruitment'=> 'Lilia',
            'contrac_phone'         => '4754-8145',
            'contact_email'         => 'contact@email.com',
            'contracting_period'    => '5 years',
            'way_pay'               => 'efectivo',
            'description'           => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit . Donec convallis sem sed venenatis commodo . Nam in suscipit lacus, quis volutpat ipsum . Aliquam consequat ullamcorper ante, et vulputate magna varius a . Interdum et malesuada fames ac ante ipsum primis in faucibus . Praesent imperdiet condimentum aliquam . Phasellus at lectus dolor . Interdum et malesuada fames ac ante ipsum primis in faucibus . Vestibulum interdum metus eu tortor faucibus, a sagittis tortor finibus',
            'description_red'       => 'Hamburguesas',
            'country'               => 'Argentina',
            'country_in'            => 'Argentina, Paraguay, USA',
            'grand_open'            => '1900',
            'franchises_local'      => '50',
            'franchises_this_year'  => '25',
            'franchises_total'      => '1500',
            'partners'              => 'Panes',
            'contact_name'          => 'Pepe',
            'phone'                 => '44444444',
            'email'                 => 'pepeelmaillargo@gmail.com',
            'website'               => 'www.franquiciar.com.ar',
            'facebook'              => 'facebook.com',
            'twitter'               => 'twitter.com',
            'fee'                   => '500000',
            'royalty'               => '5% de las ventas',
            'total_investment'      => '5000000',
            'corporate_advertising' => 'Si',
            'canon_advertising'     => '300000',
            'financing_available'   => 'Si',
            'average_annual'        => '7000000',
            'recover_estimated'     => '5 meses',
            'premises_size'         => '82 M2',
            'employees'             => '4',
            'contract_term'         => '5 años',
            'exportable_franchise'  => 'si',
            'first_reasons'         => 'primera razón',
            'second_reasons'        => 'segunda razón',
            'third_reasons'         => 'tercera razón',
            'fourth_reasons'        => 'cuarta razón',
            'fifth_reasons'         => 'quinta razón',
            'meta_title'            => 'Mc',
            'meta_description'      => 'Mc',
            'meta_keywords'         => 'Mc',
            'user_id'               => 3,
            'subject_id'            => 2,
            'highlights'            => true,
            'order'                 => 1,
            'visible'               => true
        ]);
        DB::table('franchises')->insert([
            'name'                  => 'Burger',
            'slug'                  => 'burger',
            'business_name'         => 'freddo',
            'vat_condition'         => 'exento',
            'cuit'                  => '20-21521501-3',
            'contact_address'       => 'cabildo 300',
            'authorizes_recruitment'=> 'Lilia',
            'contrac_phone'         => '4754-8145',
            'contact_email'         => 'contact@email.com',
            'contracting_period'    => '5 years',
            'way_pay'               => 'efectivo',
            'description'           => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit . Donec convallis sem sed venenatis commodo . Nam in suscipit lacus, quis volutpat ipsum . Aliquam consequat ullamcorper ante, et vulputate magna varius a . Interdum et malesuada fames ac ante ipsum primis in faucibus . Praesent imperdiet condimentum aliquam . Phasellus at lectus dolor . Interdum et malesuada fames ac ante ipsum primis in faucibus . Vestibulum interdum metus eu tortor faucibus, a sagittis tortor finibus',
            'description_red'       => 'Hamburguesas',
            'country'               => 'Argentina',
            'country_in'            => 'Argentina, Paraguay, USA',
            'grand_open'            => '1900',
            'franchises_local'      => '50',
            'franchises_this_year'  => '25',
            'franchises_total'      => '1500',
            'partners'              => 'Panes',
            'contact_name'          => 'Pepe',
            'phone'                 => '44444444',
            'email'                 => 'pepeelmaillargo@gmail.com',
            'website'               => 'www.franquiciar.com.ar',
            'facebook'              => 'facebook.com',
            'twitter'               => 'twitter.com',
            'fee'                   => '500000',
            'royalty'               => '5% de las ventas',
            'total_investment'      => '5000000',
            'corporate_advertising' => 'Si',
            'canon_advertising'     => '300000',
            'financing_available'   => 'Si',
            'average_annual'        => '7000000',
            'recover_estimated'     => '5 meses',
            'premises_size'         => '82 M2',
            'employees'             => '4',
            'contract_term'         => '5 años',
            'exportable_franchise'  => 'si',
            'first_reasons'         => 'primera razón',
            'second_reasons'        => 'segunda razón',
            'third_reasons'         => 'tercera razón',
            'fourth_reasons'        => 'cuarta razón',
            'fifth_reasons'         => 'quinta razón',
            'meta_title'            => 'Burger',
            'meta_description'      => 'Burger',
            'meta_keywords'         => 'Burger',
            'user_id'               => 3,
            'subject_id'            => 2,
            'subject_highlight'    => true,
            'highlights'            => false,
            'order'                 => 2,
            'visible'               => true
        ]);

        DB::table('franchises_assets')->insert([
            'image'        => 'franchises/1/1.jpg',
            'franchise_id' => 1,
            'position'     => 'logo',
            'order'        => 1
        ]);
        DB::table('franchises_assets')->insert([
            'image'        => 'franchises/1/2.jpg',
            'franchise_id' => 1,
            'position'     => 'image_top',
            'order'        => 2
        ]);
        DB::table('franchises_assets')->insert([
            'image'        => 'franchises/1/3.jpg',
            'franchise_id' => 1,
            'position'     => 'right_one',
            'order'        => 3
        ]);
        DB::table('franchises_assets')->insert([
            'image'        => 'franchises/1/4.jpg',
            'franchise_id' => 1,
            'position'     => 'left_one',
            'order'        => 4
        ]);
        DB::table('franchises_assets')->insert([
            'image'        => 'franchises/1/5.jpg',
            'franchise_id' => 1,
            'position'     => 'left_two',
            'order'        => 5
        ]);
        DB::table('franchises_assets')->insert([
            'image'        => 'franchises/1/6.jpg',
            'franchise_id' => 1,
            'position'     => 'left_three',
            'order'        => 6
        ]);

        DB::table('franchises_assets')->insert([
            'image'        => 'franchises/2/1.jpg',
            'franchise_id' => 2,
            'position'     => 'logo',
            'order'        => 1
        ]);
        DB::table('franchises_assets')->insert([
            'image'        => 'franchises/2/2.jpg',
            'franchise_id' => 2,
            'position'     => 'image_top',
            'order'        => 2
        ]);
        DB::table('franchises_assets')->insert([
            'image'        => 'franchises/2/3.jpg',
            'franchise_id' => 2,
            'position'     => 'right_one',
            'order'        => 3
        ]);
        DB::table('franchises_assets')->insert([
            'image'        => 'franchises/2/4.jpg',
            'franchise_id' => 2,
            'position'     => 'left_one',
            'order'        => 4
        ]);
        DB::table('franchises_assets')->insert([
            'image'        => 'franchises/2/5.jpg',
            'franchise_id' => 2,
            'position'     => 'left_two',
            'order'        => 5
        ]);
        DB::table('franchises_assets')->insert([
            'image'        => 'franchises/2/6.jpg',
            'franchise_id' => 2,
            'position'     => 'left_three',
            'order'        => 6
        ]);

        DB::table('franchises_assets')->insert([
            'image'        => 'franchises/3/1.jpg',
            'franchise_id' => 3,
            'position'     => 'logo',
            'order'        => 1
        ]);
        DB::table('franchises_assets')->insert([
            'image'        => 'franchises/3/2.jpg',
            'franchise_id' => 3,
            'position'     => 'image_top',
            'order'        => 2
        ]);
        DB::table('franchises_assets')->insert([
            'image'        => 'franchises/3/3.jpg',
            'franchise_id' => 3,
            'position'     => 'right_one',
            'order'        => 3
        ]);
        DB::table('franchises_assets')->insert([
            'image'        => 'franchises/3/4.jpg',
            'franchise_id' => 3,
            'position'     => 'left_one',
            'order'        => 4
        ]);
        DB::table('franchises_assets')->insert([
            'image'        => 'franchises/3/5.jpg',
            'franchise_id' => 3,
            'position'     => 'left_two',
            'order'        => 5
        ]);
        DB::table('franchises_assets')->insert([
            'image'        => 'franchises/3/6.jpg',
            'franchise_id' => 3,
            'position'     => 'left_three',
            'order'        => 6
        ]);

        DB::table('franchises_assets')->insert([
            'image'        => 'franchises/4/1.jpg',
            'franchise_id' => 4,
            'position'     => 'logo',
            'order'        => 1
        ]);
        DB::table('franchises_assets')->insert([
            'image'        => 'franchises/4/2.jpg',
            'franchise_id' => 4,
            'position'     => 'image_top',
            'order'        => 2
        ]);
        DB::table('franchises_assets')->insert([
            'image'        => 'franchises/4/3.jpg',
            'franchise_id' => 4,
            'position'     => 'right_one',
            'order'        => 3
        ]);
        DB::table('franchises_assets')->insert([
            'image'        => 'franchises/4/4.jpg',
            'franchise_id' => 4,
            'position'     => 'left_one',
            'order'        => 4
        ]);
        DB::table('franchises_assets')->insert([
            'image'        => 'franchises/4/5.jpg',
            'franchise_id' => 4,
            'position'     => 'left_two',
            'order'        => 5
        ]);
        DB::table('franchises_assets')->insert([
            'image'        => 'franchises/4/6.jpg',
            'franchise_id' => 4,
            'position'     => 'left_three',
            'order'        => 6
        ]);

        DB::table('franchises_assets')->insert([
            'image'        => 'franchises/5/1.jpg',
            'franchise_id' => 5,
            'position'     => 'logo',
            'order'        => 1
        ]);
        DB::table('franchises_assets')->insert([
            'image'        => 'franchises/5/2.jpg',
            'franchise_id' => 5,
            'position'     => 'image_top',
            'order'        => 2
        ]);
        DB::table('franchises_assets')->insert([
            'image'        => 'franchises/5/3.jpg',
            'franchise_id' => 5,
            'position'     => 'right_one',
            'order'        => 3
        ]);
        DB::table('franchises_assets')->insert([
            'image'        => 'franchises/5/4.jpg',
            'franchise_id' => 5,
            'position'     => 'left_one',
            'order'        => 4
        ]);
        DB::table('franchises_assets')->insert([
            'image'        => 'franchises/5/5.jpg',
            'franchise_id' => 5,
            'position'     => 'left_two',
            'order'        => 5
        ]);
        DB::table('franchises_assets')->insert([
            'image'        => 'franchises/5/6.jpg',
            'franchise_id' => 5,
            'position'     => 'left_three',
            'order'        => 6
        ]);

        DB::table('franchises_areas')->insert([
            'name'              => 'Palermo',
            'franchise_id'      => '1'
        ]);
        DB::table('franchises_areas')->insert([
            'name'              => 'Belgrano',
            'franchise_id'      => '1'
        ]);
        DB::table('franchises_areas')->insert([
            'name'              => 'Palermo',
            'franchise_id'      => '2'
        ]);
        DB::table('franchises_areas')->insert([
            'name'              => 'Palermo',
            'franchise_id'      => '3'
        ]);
        DB::table('franchises_areas')->insert([
            'name'              => 'Palermo',
            'franchise_id'      => '4'
        ]);
        DB::table('franchises_areas')->insert([
            'name'              => 'Palermo',
            'franchise_id'      => '5'
        ]);

        DB::table('franchises_offices')->insert([
            'name'              => 'Titulo 1',
            'full_direction'    => 'El Salvador, Buenos Aires, Ciudad Autónoma de Buenos Aires, Argentina',
            'country'           => 'Argentina',
            'lat'               => '-34.5873909',
            'lng'               => '-58.43012239999996',
            'franchise_id'      => '1'
        ]);
        DB::table('franchises_offices')->insert([
            'name'              => 'Titulo 2',
            'full_direction'    => 'Serrano, Buenos Aires, Ciudad Autónoma de Buenos Aires, Argentina',
            'country'           => 'Argentina',
            'lat'               => '-34.59413369999999',
            'lng'               => '-58.43890920000001',
            'franchise_id'      => '1'
        ]);
        DB::table('franchises_offices')->insert([
            'name'              => 'Titulo 1',
            'full_direction'    => 'El Salvador, Buenos Aires, Ciudad Autónoma de Buenos Aires, Argentina',
            'country'           => 'Argentina',
            'lat'               => '-34.5873909',
            'lng'               => '-58.43012239999996',
            'franchise_id'      => '2'
        ]);
        DB::table('franchises_offices')->insert([
            'name'              => 'Titulo 2',
            'full_direction'    => 'Serrano, Buenos Aires, Ciudad Autónoma de Buenos Aires, Argentina',
            'country'           => 'Argentina',
            'lat'               => '-34.59413369999999',
            'lng'               => '-58.43890920000001',
            'franchise_id'      => '2'
        ]);
        DB::table('franchises_offices')->insert([
            'name'              => 'Titulo 1',
            'full_direction'    => 'El Salvador, Buenos Aires, Ciudad Autónoma de Buenos Aires, Argentina',
            'country'           => 'Argentina',
            'lat'               => '-34.5873909',
            'lng'               => '-58.43012239999996',
            'franchise_id'      => '3'
        ]);
        DB::table('franchises_offices')->insert([
            'name'              => 'Titulo 2',
            'full_direction'    => 'Serrano, Buenos Aires, Ciudad Autónoma de Buenos Aires, Argentina',
            'country'           => 'Argentina',
            'lat'               => '-34.59413369999999',
            'lng'               => '-58.43890920000001',
            'franchise_id'      => '3'
        ]);
        DB::table('franchises_offices')->insert([
            'name'              => 'Titulo 1',
            'full_direction'    => 'El Salvador, Buenos Aires, Ciudad Autónoma de Buenos Aires, Argentina',
            'country'           => 'Argentina',
            'lat'               => '-34.5873909',
            'lng'               => '-58.43012239999996',
            'franchise_id'      => '4'
        ]);
        DB::table('franchises_offices')->insert([
            'name'              => 'Titulo 2',
            'full_direction'    => 'Serrano, Buenos Aires, Ciudad Autónoma de Buenos Aires, Argentina',
            'country'           => 'Argentina',
            'lat'               => '-34.59413369999999',
            'lng'               => '-58.43890920000001',
            'franchise_id'      => '4'
        ]);
        DB::table('franchises_offices')->insert([
            'name'              => 'Titulo 1',
            'full_direction'    => 'El Salvador, Buenos Aires, Ciudad Autónoma de Buenos Aires, Argentina',
            'country'           => 'Argentina',
            'lat'               => '-34.5873909',
            'lng'               => '-58.43012239999996',
            'franchise_id'      => '5'
        ]);
        DB::table('franchises_offices')->insert([
            'name'              => 'Titulo 2',
            'full_direction'    => 'Serrano, Buenos Aires, Ciudad Autónoma de Buenos Aires, Argentina',
            'country'           => 'Argentina',
            'lat'               => '-34.59413369999999',
            'lng'               => '-58.43890920000001',
            'franchise_id'      => '5'
        ]);

        DB::table('news')->insert([
            'title'       => 'noticia 1',
            'slug'        => 'noticia-1',
            'image'       => 'news/noticia1.jpg',
            'video'       => 'abgII_4Xa5c',
            'video_type'  => 'youtube',
            'author'      => 'Autor actualidad',
            'description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit . Donec convallis sem sed venenatis commodo . Nam in suscipit lacus, quis volutpat ipsum . Aliquam consequat ullamcorper ante, et vulputate magna varius a . Interdum et malesuada fames ac ante ipsum primis in faucibus . Praesent imperdiet condimentum aliquam . Phasellus at lectus dolor . Interdum et malesuada fames ac ante ipsum primis in faucibus . Vestibulum interdum metus eu tortor faucibus, a sagittis tortor finibus',
            'created_at'  => '2017-02-24 00:00:00',
            'updated_at'  => '2017-02-24 00:00:00'
        ]);
        DB::table('news')->insert([
            'title'       => 'noticia 2',
            'slug'        => 'noticia-2',
            'image'       => 'news/noticia2.jpg',
            'author'      => 'Autor actualidad',
            'description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit . Donec convallis sem sed venenatis commodo . Nam in suscipit lacus, quis volutpat ipsum . Aliquam consequat ullamcorper ante, et vulputate magna varius a . Interdum et malesuada fames ac ante ipsum primis in faucibus . Praesent imperdiet condimentum aliquam . Phasellus at lectus dolor . Interdum et malesuada fames ac ante ipsum primis in faucibus . Vestibulum interdum metus eu tortor faucibus, a sagittis tortor finibus',
            'created_at'  => '2017-02-24 00:00:00',
            'updated_at'  => '2017-02-24 00:00:00'
        ]);
        DB::table('news')->insert([
            'title'       => 'noticia 3',
            'slug'        => 'noticia-3',
            'image'       => 'news/noticia3.jpg',
            'video'       => 'abgII_4Xa5c',
            'video_type'  => 'youtube',
            'author'      => 'Autor actualidad',
            'description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit . Donec convallis sem sed venenatis commodo . Nam in suscipit lacus, quis volutpat ipsum . Aliquam consequat ullamcorper ante, et vulputate magna varius a . Interdum et malesuada fames ac ante ipsum primis in faucibus . Praesent imperdiet condimentum aliquam . Phasellus at lectus dolor . Interdum et malesuada fames ac ante ipsum primis in faucibus . Vestibulum interdum metus eu tortor faucibus, a sagittis tortor finibus',
            'created_at'  => '2017-02-24 00:00:00',
            'updated_at'  => '2017-02-24 00:00:00'
        ]);
        DB::table('news')->insert([
            'title'       => 'noticia 4',
            'slug'        => 'noticia-4',
            'image'       => 'news/noticia4.jpg',
            'author'      => 'Autor actualidad',
            'description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit . Donec convallis sem sed venenatis commodo . Nam in suscipit lacus, quis volutpat ipsum . Aliquam consequat ullamcorper ante, et vulputate magna varius a . Interdum et malesuada fames ac ante ipsum primis in faucibus . Praesent imperdiet condimentum aliquam . Phasellus at lectus dolor . Interdum et malesuada fames ac ante ipsum primis in faucibus . Vestibulum interdum metus eu tortor faucibus, a sagittis tortor finibus',
            'created_at'  => '2017-02-24 00:00:00',
            'updated_at'  => '2017-02-24 00:00:00'
        ]);
        DB::table('news')->insert([
            'title'       => 'noticia 5',
            'slug'        => 'noticia-5',
            'image'       => 'news/noticia5.jpg',
            'video'       => 'abgII_4Xa5c',
            'video_type'  => 'youtube',
            'author'      => 'Autor actualidad',
            'description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit . Donec convallis sem sed venenatis commodo . Nam in suscipit lacus, quis volutpat ipsum . Aliquam consequat ullamcorper ante, et vulputate magna varius a . Interdum et malesuada fames ac ante ipsum primis in faucibus . Praesent imperdiet condimentum aliquam . Phasellus at lectus dolor . Interdum et malesuada fames ac ante ipsum primis in faucibus . Vestibulum interdum metus eu tortor faucibus, a sagittis tortor finibus',
            'created_at'  => '2017-02-24 00:00:00',
            'updated_at'  => '2017-02-24 00:00:00'
        ]);
        DB::table('news')->insert([
            'title'       => 'noticia 6',
            'slug'        => 'noticia-6',
            'image'       => 'news/noticia6.jpg',
            'video'       => 'asYbf6OtCsU',
            'video_type'  => 'youtube',
            'author'      => 'Autor actualidad',
            'description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit . Donec convallis sem sed venenatis commodo . Nam in suscipit lacus, quis volutpat ipsum . Aliquam consequat ullamcorper ante, et vulputate magna varius a . Interdum et malesuada fames ac ante ipsum primis in faucibus . Praesent imperdiet condimentum aliquam . Phasellus at lectus dolor . Interdum et malesuada fames ac ante ipsum primis in faucibus . Vestibulum interdum metus eu tortor faucibus, a sagittis tortor finibus',
            'created_at'  => '2017-02-24 00:00:00',
            'updated_at'  => '2017-02-24 00:00:00'
        ]);
        DB::table('news')->insert([
            'title'       => 'noticia 7',
            'slug'        => 'noticia-7',
            'image'       => 'news/noticia7.jpg',
            'author'      => 'Autor actualidad',
            'description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit . Donec convallis sem sed venenatis commodo . Nam in suscipit lacus, quis volutpat ipsum . Aliquam consequat ullamcorper ante, et vulputate magna varius a . Interdum et malesuada fames ac ante ipsum primis in faucibus . Praesent imperdiet condimentum aliquam . Phasellus at lectus dolor . Interdum et malesuada fames ac ante ipsum primis in faucibus . Vestibulum interdum metus eu tortor faucibus, a sagittis tortor finibus',
            'created_at'  => '2017-02-24 00:00:00',
            'updated_at'  => '2017-02-24 00:00:00'
        ]);
        DB::table('news')->insert([
            'title'       => 'noticia 8',
            'slug'        => 'noticia-8',
            'image'       => 'news/noticia8.jpg',
            'author'      => 'Autor actualidad',
            'description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit . Donec convallis sem sed venenatis commodo . Nam in suscipit lacus, quis volutpat ipsum . Aliquam consequat ullamcorper ante, et vulputate magna varius a . Interdum et malesuada fames ac ante ipsum primis in faucibus . Praesent imperdiet condimentum aliquam . Phasellus at lectus dolor . Interdum et malesuada fames ac ante ipsum primis in faucibus . Vestibulum interdum metus eu tortor faucibus, a sagittis tortor finibus',
            'created_at'  => '2017-02-24 00:00:00',
            'updated_at'  => '2017-02-24 00:00:00'
        ]);
        DB::table('news')->insert([
            'title'       => 'noticia 9',
            'slug'        => 'noticia-9',
            'image'       => 'news/noticia9.jpg',
            'author'      => 'Autor actualidad',
            'description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit . Donec convallis sem sed venenatis commodo . Nam in suscipit lacus, quis volutpat ipsum . Aliquam consequat ullamcorper ante, et vulputate magna varius a . Interdum et malesuada fames ac ante ipsum primis in faucibus . Praesent imperdiet condimentum aliquam . Phasellus at lectus dolor . Interdum et malesuada fames ac ante ipsum primis in faucibus . Vestibulum interdum metus eu tortor faucibus, a sagittis tortor finibus',
            'created_at'  => '2017-02-24 00:00:00',
            'updated_at'  => '2017-02-24 00:00:00'
        ]);
        DB::table('news')->insert([
            'title'       => 'noticia 10',
            'slug'        => 'noticia-10',
            'image'       => 'news/noticia10.jpg',
            'author'      => 'Autor actualidad',
            'description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit . Donec convallis sem sed venenatis commodo . Nam in suscipit lacus, quis volutpat ipsum . Aliquam consequat ullamcorper ante, et vulputate magna varius a . Interdum et malesuada fames ac ante ipsum primis in faucibus . Praesent imperdiet condimentum aliquam . Phasellus at lectus dolor . Interdum et malesuada fames ac ante ipsum primis in faucibus . Vestibulum interdum metus eu tortor faucibus, a sagittis tortor finibus',
            'created_at'  => '2017-02-24 00:00:00',
            'updated_at'  => '2017-02-24 00:00:00'
        ]);
        DB::table('news')->insert([
            'title'       => 'noticia 11',
            'slug'        => 'noticia-11',
            'image'       => 'news/noticia11.jpg',
            'video'       => 'asYbf6OtCsU',
            'video_type'  => 'youtube',
            'author'      => 'Autor actualidad',
            'description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit . Donec convallis sem sed venenatis commodo . Nam in suscipit lacus, quis volutpat ipsum . Aliquam consequat ullamcorper ante, et vulputate magna varius a . Interdum et malesuada fames ac ante ipsum primis in faucibus . Praesent imperdiet condimentum aliquam . Phasellus at lectus dolor . Interdum et malesuada fames ac ante ipsum primis in faucibus . Vestibulum interdum metus eu tortor faucibus, a sagittis tortor finibus',
            'created_at'  => '2017-02-24 00:00:00',
            'updated_at'  => '2017-02-24 00:00:00'
        ]);
        DB::table('news')->insert([
            'title'       => 'noticia 12',
            'slug'        => 'noticia-12',
            'image'       => 'news/noticia12.jpg',
            'author'      => 'Autor actualidad',
            'description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit . Donec convallis sem sed venenatis commodo . Nam in suscipit lacus, quis volutpat ipsum . Aliquam consequat ullamcorper ante, et vulputate magna varius a . Interdum et malesuada fames ac ante ipsum primis in faucibus . Praesent imperdiet condimentum aliquam . Phasellus at lectus dolor . Interdum et malesuada fames ac ante ipsum primis in faucibus . Vestibulum interdum metus eu tortor faucibus, a sagittis tortor finibus',
            'created_at'  => '2017-02-24 00:00:00',
            'updated_at'  => '2017-02-24 00:00:00'
        ]);

        DB::table('tags')->insert(['name' => 'Test']);
        DB::table('tags')->insert(['name' => 'Test 2']);
        DB::table('tags')->insert(['name' => 'TagLarga']);
        DB::table('tags')->insert(['name' => 'Corta']);

        DB::table('news_tags')->insert(['news_id' => '1', 'tags_id' => '1']);
        DB::table('news_tags')->insert(['news_id' => '1', 'tags_id' => '2']);

        DB::table('news_tags')->insert(['news_id' => '2', 'tags_id' => '1']);
        DB::table('news_tags')->insert(['news_id' => '2', 'tags_id' => '2']);

        DB::table('news_tags')->insert(['news_id' => '3', 'tags_id' => '1']);

        DB::table('news_tags')->insert(['news_id' => '4', 'tags_id' => '1']);
        DB::table('news_tags')->insert(['news_id' => '4', 'tags_id' => '2']);
        DB::table('news_tags')->insert(['news_id' => '4', 'tags_id' => '4']);

        DB::table('news_tags')->insert(['news_id' => '5', 'tags_id' => '1']);
        DB::table('news_tags')->insert(['news_id' => '5', 'tags_id' => '2']);
        DB::table('news_tags')->insert(['news_id' => '5', 'tags_id' => '3']);
        DB::table('news_tags')->insert(['news_id' => '5', 'tags_id' => '4']);

        DB::table('news_tags')->insert(['news_id' => '6', 'tags_id' => '1']);
        DB::table('news_tags')->insert(['news_id' => '6', 'tags_id' => '4']);

        DB::table('news_tags')->insert(['news_id' => '7', 'tags_id' => '1']);
        DB::table('news_tags')->insert(['news_id' => '7', 'tags_id' => '2']);
        DB::table('news_tags')->insert(['news_id' => '7', 'tags_id' => '3']);
        DB::table('news_tags')->insert(['news_id' => '7', 'tags_id' => '4']);

        DB::table('news_tags')->insert(['news_id' => '8', 'tags_id' => '1']);
        DB::table('news_tags')->insert(['news_id' => '8', 'tags_id' => '2']);

        DB::table('news_tags')->insert(['news_id' => '9', 'tags_id' => '4']);

        DB::table('news_tags')->insert(['news_id' => '10', 'tags_id' => '3']);
        DB::table('news_tags')->insert(['news_id' => '10', 'tags_id' => '4']);

        DB::table('news_tags')->insert(['news_id' => '11', 'tags_id' => '1']);

        DB::table('news_tags')->insert(['news_id' => '12', 'tags_id' => '2']);
        DB::table('news_tags')->insert(['news_id' => '12', 'tags_id' => '3']);
        DB::table('news_tags')->insert(['news_id' => '12', 'tags_id' => '4']);


        DB::table('videos')->insert([
            'title'       => 'video 1',
            'slug'        => 'video-1',
            'image'       => 'videos/1.jpg',
            'video'       => 'abgII_4Xa5c',
            'description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit . Donec convallis sem sed venenatis commodo . Nam in suscipit lacus, quis volutpat ipsum . '
        ]);
        DB::table('videos')->insert([
            'title'       => 'video 2',
            'slug'        => 'video-2',
            'image'       => 'videos/2.jpg',
            'video'       => 'abgII_4Xa5c',
            'description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit . Donec convallis sem sed venenatis commodo . Nam in suscipit lacus, quis volutpat ipsum . '
        ]);
        DB::table('videos')->insert([
            'title'       => 'video 3',
            'slug'        => 'video-3',
            'image'       => 'videos/3.jpg',
            'video'       => 'asYbf6OtCsU',
            'description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit . Donec convallis sem sed venenatis commodo . Nam in suscipit lacus, quis volutpat ipsum . '
        ]);
        DB::table('videos')->insert([
            'title'       => 'video 4',
            'slug'        => 'video-4',
            'image'       => 'videos/4.jpg',
            'video'       => 'asYbf6OtCsU',
            'description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit . Donec convallis sem sed venenatis commodo . Nam in suscipit lacus, quis volutpat ipsum . '
        ]);

        DB::table('surveys')->insert(['question' => 'Pregunta 1']);

        DB::table('sponsors')->insert(['title' => 'sponsor 1', 'image' => 'sponsors/img1.png']);
        DB::table('sponsors')->insert(['title' => 'sponsor 2', 'image' => 'sponsors/img2.png']);
        DB::table('sponsors')->insert(['title' => 'sponsor 3', 'image' => 'sponsors/img3.png']);
        DB::table('sponsors')->insert(['title' => 'sponsor 4', 'image' => 'sponsors/img4.png']);
        DB::table('sponsors')->insert(['title' => 'sponsor 5', 'image' => 'sponsors/img5.png']);

        DB::table('answers')->insert(['answer' => 'Respuesta 1', 'survey_id' => 1]);
        DB::table('answers')->insert(['answer' => 'Respuesta 2', 'survey_id' => 1]);
        DB::table('answers')->insert(['answer' => 'Respuesta 3', 'survey_id' => 1]);
        DB::table('answers')->insert(['answer' => 'Respuesta 4', 'survey_id' => 1]);

        DB::table('consultants')->insert(['title' => 'Marcas que Crecen', 'image' => 'consultants/marcasquecrecen.jpg']);
        DB::table('consultants')->insert(['title' => 'Franchising Company', 'image' => 'consultants/franchisingcompany.jpg']);
        DB::table('consultants')->insert(['title' => '384 Group', 'image' => 'consultants/384group.jpg']);
        DB::table('consultants')->insert(['title' => 'Lepus', 'image' => 'consultants/lepus.jpg']);
        DB::table('consultants')->insert(['title' => 'Estudio Canudas', 'image' => 'consultants/estudiocanudas.jpg']);
        DB::table('consultants')->insert(['title' => 'Franchising Advisor', 'image' => 'consultants/franchisingadvisor.jpg']);
        DB::table('consultants')->insert(['title' => 'Francorp', 'image' => 'consultants/francorp.jpg']);
        DB::table('consultants')->insert(['title' => 'GS Marcas y Franquicias', 'image' => 'consultants/gs.jpg']);

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
    }

}
