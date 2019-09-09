<?php

use Illuminate\Database\Seeder;
use Illuminate\Console\Command;

use Fanintek\Fantasena\Models\FanMenu;

class RBACMenu extends Seeder
{
    protected $command;

    protected $fanMenu;

    protected $driver;

    public function __construct()
    {
        $this->command = new Command;
        $this->fanMenu = new FanMenu;
        $this->driver  = \DB::connection()->getPDO()->getAttribute(PDO::ATTR_DRIVER_NAME);
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
        if ($this->driver == "mysql") DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        DB::table($this->fanMenu->getTable())->truncate();
        if ($this->driver == "mysql") DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        $menus = config('fanrbac.menus');
        
        foreach($menus as $menu) {
            if (array_key_exists('children', $menu)) {
                $this->command->info("[INFO] Membuat Menu {$menu['label']}...");
                $header = FanMenu::create([
                    'menu_label' => $menu['label'],
                    'menu_link_type' => 'URL',
                    'menu_data' => '#',
                    'menu_icon' => $menu['icon'],
                    'granted_to' => (isset($menu['granted_to'])) ? json_encode($menu['granted_to']) : json_encode(['roles'=> [], 'users' => []])
                ]);

                foreach($menu['children'] as $child) {
                    $this->command->info("[INFO] Membuat Menu {$child['label']}...");
                    
                    $child['parent_id'] = $header->id;

                    $this->createMenu($child);
                }
            } else {
                $this->createMenu($menu);
            }
        }

        $finish = (microtime(true) - $start);
        $this->command->info("[DONE] AssignUserRoleSeeder telah selesai dalam {$finish} ms");
    }

    protected function createMenu($menu) {
        $this->command->info("[INFO] Membuat Menu {$menu['label']}...");
        FanMenu::create([
            'parent_id' => (isset($menu['parent_id'])) ? $menu['parent_id'] : null,
            'menu_label' => $menu['label'],
            'menu_link_type' => $menu['type'],
            'menu_data' => $menu['data'],
            'menu_icon' => $menu['icon'],
            'granted_to' => (isset($menu['granted_to'])) ? json_encode($menu['granted_to']) : json_encode(['roles'=> [], 'users' => []])
        ]);
    }
}
