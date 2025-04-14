<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('thesis_posts', function (Blueprint $table) {
            $table->id();
            $table->foreignId('posted_by')->constrained('users')->onDelete('cascade');
            $table->string('department');
            $table->string('thesis_topic')->nullable();
            $table->string('thesis_field');
            $table->text('details');
            $table->timestamps();
        });
    }
    
    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('thesis_posts');
    }
};
