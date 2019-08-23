<?php

use Illuminate\Database\Seeder;
use Illuminate\Console\Command;

use Fanintek\Fantasena\Models\FanMenu;

class RBACMenu extends Seeder
{
    protected $command;

    protected $fanMenu;

    public function __construct()
    {
        $this->command = new Command;
        $this->fanMenu = new FanMenu;
    }

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $start = microtime(true);

        // Truncate Datas
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        DB::table($this->fanMenu->getTable())->truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        $menus = config('fanrbac.menus');
        
        foreach($menus as $menu) {
            if (array_key_exists('children', $menu)) {
                $this->command->info("[INFO] Membuat Menu {$menu['label']}...");
                $header = FanMenu::create([
                    'menu_label' => $menu['label'],
                    'menu_url' => '#',
                    'menu_route' => null,
                    'menu_icon' => $menu['icon'],
                    'granted_to' => json_encode($menu['granted_to'])
                ]);

                foreach($menu['children'] as $child) {
                    $this->command->info("[INFO] Membuat Menu {$child['label']}...");
                    FanMenu::create([
                        'parent_id' => $header->id,
                        'menu_label' => $child['label'],
                        'menu_url' => (isset($child['url'])) ? $child['url'] : null,
                        'menu_route' => (isset($child['route'])) ? $child['route'] : null,
                        'menu_icon' => $child['icon'],
                        'granted_to' => json_encode($child['granted_to'])
                    ]);
                }
            } else {
                if (array_key_exists('route', $menu) && array_key_exists('url', $menu)) {
                    $this->command->error("[ERROR] Tidak boleh menggunakan route dan url secara bersamaan pada menu {$menu['label']}, harap pilih salah satu.");
                } else {
                    $this->command->info("[INFO] Membuat Menu {$menu['label']}...");
                    FanMenu::create([
                        'menu_label' => $menu['label'],
                        'menu_url' => (isset($menu['url'])) ? $menu['url'] : null,
                        'menu_route' => (isset($menu['route'])) ? $menu['route'] : null,
                        'menu_icon' => $menu['icon'],
                        'granted_to' => json_encode($menu['granted_to'])
                    ]);
                }
            }
        }

        $finish = (microtime(true) - $start);
        $this->command->info("[DONE] AssignUserRoleSeeder telah selesai dalam {$finish} ms");
    }
}
