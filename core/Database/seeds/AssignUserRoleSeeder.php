<?php

use Illuminate\Database\Seeder;
use Illuminate\Console\Command;

use Spatie\Permission\Models\Role;
use Fanintek\Fantasena\Models\User;

class AssignUserRoleSeeder extends Seeder
{
    protected $command;

    protected $driver;

    public function __construct()
    {
        $this->command = new Command;
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
        DB::table(config('permission.table_names.model_has_permissions'))->truncate();
        if ($this->driver == "mysql") DB::statement('SET FOREIGN_KEY_CHECKS=1;');
        
        $assigns = config('fanrbac.assign_user_role');

        foreach($assigns as $assign) {
            $user = User::where('email', $assign['email'])->first();
            $role = Role::where('name', $assign['role'])->first();

            if (!empty($user) && !empty($role)) {
                $this->command->info("[INFO] Memberikan user dengan email {$assign['email']} sebagai {$assign['role']}...");
                $user->assignRole($assign['role']);
            } else {
                $this->command->error("[ERROR] User dengan email {$assign['email']} atau role {$assign['role']} tidak ditemukan!");
            }
        }

        $finish = (microtime(true) - $start);
        $this->command->info("[DONE] AssignUserRoleSeeder telah selesai dalam {$finish} ms");
    }
}
