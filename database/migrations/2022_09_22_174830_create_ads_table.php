<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAdsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ads', function (Blueprint $table) {
            $table->id();
            $table->integer('type');
            $table->string('title');
            $table->text('description');
            $table->timestamp('start_date');
            $table->foreignId('category_id')->nullable()->constrained()->onDelete('set null');
            $table->foreignId('advertiser_id')->nullable()->constrained()->onDelete('set null');
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
        Schema::dropIfExists('ads');
    }
}
