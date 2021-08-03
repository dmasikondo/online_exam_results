<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRolesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('roles', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('label')->nullable();
            $table->timestamps();
        });

        // insert some role names
        DB::table('roles')->insert([
                ['name' => 'administration','created_at'=>now(),'updated_at'=>now()],
                ['name' =>'automotive','created_at'=>now(),'updated_at'=>now()], 
                ['name' =>'applied arts','created_at'=>now(),'updated_at'=>now()], 
                ['name' =>'civil engineering','created_at'=>now(),'updated_at'=>now()], 
                ['name' =>'central maintenance','created_at'=>now(),'updated_at'=>now()], 
                ['name' =>'construction engineering','created_at'=>now(),'updated_at'=>now()], 
                ['name' =>'commerce','created_at'=>now(),'updated_at'=>now()], 
                ['name' =>'electrical engineering','created_at'=>now(),'updated_at'=>now()], 
                ['name' =>'information and communication technology','created_at'=>now(),'updated_at'=>now()], 
                ['name' =>'IT Unit','created_at'=>now(),'updated_at'=>now()], 
                ['name' =>'mass communication','created_at'=>now(),'updated_at'=>now()], 
                ['name' =>'mechanical engineering','created_at'=>now(),'updated_at'=>now()],                 
                ['name' =>'office management', 'created_at'=>now(),'updated_at'=>now()], 
                ['name' =>'printing and graphic arts', 'created_at'=>now(),'updated_at'=>now()], 
                ['name' =>'science technology', 'created_at'=>now(),'updated_at'=>now()], 
                ['name' =>'tourism and hospitality','created_at'=>now(),'updated_at'=>now()]
            ]);

        Schema::create('role_user', function (Blueprint $table) {
            $table->primary(['user_id','role_id']);
            $table->foreignId('user_id');
            $table->foreignId('role_id');
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
        Schema::dropIfExists('role_user');
        Schema::dropIfExists('roles');
    }
}
