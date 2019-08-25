<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMenusTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('menus', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('parent_id')->nullable();
            $table->string('menu_label', 50);
            $table->enum('menu_link_type', ['ROUTE_NAME', 'ROUTE_ACTION', 'URL'])->default('ROUTE_NAME');
            $table->string('menu_data');
            $table->string('menu_icon')->nullable();
            $table->json('granted_to');//->default(json_encode(['roles' => [], 'users' => []]));
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('menus');
    }
}
