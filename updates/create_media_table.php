<?php namespace GromIT\Instagram\Updates;

use Schema;
use October\Rain\Database\Schema\Blueprint;
use October\Rain\Database\Updates\Migration;

/**
 * CreateMediaTable Migration
 */
class CreateMediaTable extends Migration
{
    public function up()
    {
        Schema::create('gromit_instagram_media', function (Blueprint $table) {
            $table->increments('id');

            $table->unsignedInteger('account_id');
            $table
                ->foreign('account_id', 'medias_post')
                ->references('id')
                ->on('gromit_instagram_accounts')
                ->onDelete('CASCADE');

            $table->bigInteger('media_id');
            $table->string('type');
            $table->string('link');
            $table->longText('caption')->nullable();
            $table->integer('likes_count')->default(0);
            $table->integer('comments_count')->default(0);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('gromit_instagram_media');
    }
}
