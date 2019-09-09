<?php

use Illuminate\Database\Seeder;

use Illuminate\Console\Command;

use Fanintek\Fantasena\Models\User;

class UserTableSeeder extends Seeder
{
    protected $command;

    protected $user;

    protected $driver;

    public function __construct()
    {
        $this->command  = new Command;
        $this->user     = new User;
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
        DB::table($this->user->getTable())->truncate();
        if ($this->driver == "mysql") DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        $users = config('fanrbac.users');

        foreach($users as $user) {
            $this->command->info("[INFO] Membuat user dengan email {$user['email']}...");
            User::create([
                'first_name' => $user['first_name'],
                'last_name' => $user['last_name'],
                'email' => $user['email'],
                'password' => Hash::make($user['password']),
                'is_active' => $user['is_active'],
                'email_verified_at' => \Carbon\Carbon::now()
            ]);
        }

        $finish = (microtime(true) - $start);
        $this->command->info("[DONE] UserTableSeeder telah selesai dalam {$finish} ms");
    }
}
