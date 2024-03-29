<?php

use Illuminate\Database\Seeder;
use Illuminate\Console\Command;

use Spatie\Permission\Models\Role;

class RoleTableSeeder extends Seeder
{
    protected $command;

    protected $role;

    protected $driver;

    public function __construct()
    {
        $this->command  = new Command;
        $this->role     = new Role;
        $this->driver   = \DB::connection()->getPDO()->getAttribute(PDO::ATTR_DRIVER_NAME);
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
        DB::table($this->role->getTable())->truncate();
        if ($this->driver == "mysql") DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        $roles = config('fanrbac.roles');
        
        if (count($roles) > 0) {
            foreach($roles as $role) {
                $this->command->info("[INFO] Membuat role {$role}...");
                Role::create(['name' => $role]);
            }
        } else {
            $this->command->error('[ERROR] Roles tidak boleh kosong, harap isi minimal satu role.');
        }

        $finish = (microtime(true) - $start);
        $this->command->info("[DONE] RoleTableSeeder telah selesai dalam {$finish} ms");
    }
}
