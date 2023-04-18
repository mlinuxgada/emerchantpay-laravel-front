<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRssItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('rss_items', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('rss_url_id')->unsigned()->index()->nullable();
            $table->string('title');
            $table->string('source');
            $table->string('source_url');
            $table->string('link');
            $table->dateTime('publish_date');
            $table->text('description');
            $table->timestamps();

            $table->foreign('rss_url_id')->references('id')->on('rss_urls')->onDelete('cascade');
            $table->index('title');
            $table->index('source');
            $table->index('source_url');
            $table->index('publish_date');
            $table->index('created_at');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('rss_items');
    }
}
