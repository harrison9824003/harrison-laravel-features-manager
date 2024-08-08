<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePjPermissionTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pj_permission', function (Blueprint $table) {
            $table->id();
            $table->integer('feature_id')->comment('功能 id');
            $table->string('permission', 100)->comment('權限名稱');
            $table->string('name', 100)->comment('權限中文名稱');
            $table->integer('code')->comment('guard 權限代碼');
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
        Schema::dropIfExists('pj_permission');
    }
}
