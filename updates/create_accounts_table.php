<?php namespace GromIT\Instagram\Updates;

use October\Rain\Database\Schema\Blueprint;
use October\Rain\Database\Updates\Migration;
use Schema;

/**
 * CreateAccountsTable Migration
 */
class CreateAccountsTable extends Migration
{
    public function up()
    {
        Schema::create('gromit_instagram_accounts', function (Blueprint $table) {
            $table->increments('id');
            $table->bigInteger('instagram_id');
            $table->string('username');
            $table->string('full_name')->nullable();
            $table->string('external_url')->nullable();
            $table->integer('follows_count')->default(0);
            $table->integer('followed_by_count')->default(0);
            $table->integer('media_count')->default(0);
            $table->string('rapid_api_key');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('gromit_instagram_accounts');
    }
}
