<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Topdot\Menu\Models\Menu;

class MenuSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Menu::all()->each(function($menu){
            $menu->delete();
        });
        Menu::truncate();

        $this->createHeaderMenu();
        $this->createQuickLinksMenu();
        $this->createFooterMenu();
    }

    public function createHeaderMenu()
    {
        $menu = Menu::create([
            'name' => 'header'
        ]);

        $menu->items()->create([
            'title' => 'SHOP BOXES & SUPPLIES',
            'link' => '/products'
        ]);

        $submMenu = $menu->items()->create([
            'title' => 'SERVICES',
            'link' => '#'
        ]);

        /** Service Submenut */
        $submMenu->children()->create([
            'menu_id' => $menu->id,
            'title' => 'Shipping Services',
            'link' => '#'
        ]);

        $submMenu->children()->create([
            'menu_id' => $menu->id,
            'title' => 'Packing Services',
            'link' => '#'
        ]);

        $submMenu->children()->create([
            'menu_id' => $menu->id,
            'title' => 'Moving Consultations',
            'link' => '#'
        ]);

        $submMenu->children()->create([
            'menu_id' => $menu->id,
            'title' => 'Valet Storage',
            'link' => '#'
        ]);
        
        $submMenu->children()->create([
            'menu_id' => $menu->id,
            'title' => 'Mailbox Rentals',
            'link' => '#'
        ]);

        $submMenu->children()->create([
            'menu_id' => $menu->id,
            'title' => 'Amazon Package Pickups',
            'link' => '#'
        ]);

        $submMenu->children()->create([
            'menu_id' => $menu->id,
            'title' => 'Conference Room',
            'link' => '#'
        ]);

        $submMenu->children()->create([
            'menu_id' => $menu->id,
            'title' => 'Ship Your Bike',
            'link' => '#'
        ]);

        /**
         * Remaining menus
         */
        $menu->items()->create([
            'title' => 'TRACK A PACKAGE',
            'link' => '#'
        ]);

        $menu->items()->create([
            'title' => 'RESOURCES',
            'link' => '#'
        ]);

        $menu->items()->create([
            'title' => 'ABOUT US',
            'link' => '#'
        ]);

        $menu->items()->create([
            'title' => 'CONTACT',
            'link' => '#'
        ]);
        
    }

    public function createQuickLinksMenu()
    {
        $menu = Menu::create([
            'name' => 'quick-links'
        ]);

        $menu->items()->create([
            'title' => 'Boxes and Supplies',
            'link' => '#'
        ]);

        $menu->items()->create([
            'title' => 'Moving Consultations',
            'link' => '#'
        ]);

        $menu->items()->create([
            'title' => 'Valet Storage',
            'link' => '#'
        ]);

        $menu->items()->create([
            'title' => 'Ship Your Bike',
            'link' => '#'
        ]);

        $menu->items()->create([
            'title' => 'Mailbox Rentals',
            'link' => '#'
        ]);

        $menu->items()->create([
            'title' => 'Conference Rooms',
            'link' => '#'
        ]);

        $menu->items()->create([
            'title' => 'Track a Package',
            'link' => '#'
        ]);

        $menu->items()->create([
            'title' => 'Resources/Blog',
            'link' => '#'
        ]);

        $menu->items()->create([
            'title' => 'About Us',
            'link' => '#'
        ]);

        $menu->items()->create([
            'title' => 'Contact',
            'link' => '#'
        ]);


    }

    public function createFooterMenu()
    {
        $menu = Menu::create([
            'name' => 'footer-links'
        ]);

        $menu->items()->create([
            'title' => 'Terms and Conditions',
            'link' => '#'
        ]);

        $menu->items()->create([
            'title' => 'Privacy Policy',
            'link' => '#'
        ]);
    }
}
