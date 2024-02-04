<?php

use App\Models\JobPost;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('candidates', function (Blueprint $table) {
            $table->id();
            $table->string('firstname');
            $table->string('lastname')->nullable();
            $table->date('date_of_birth')->nullable();
            $table->char('gender', 2);
            $table->string('phone')->nullable();
            $table->string('email')->nullable();
            $table->string('resume')->nullable();
            $table->foreignIdFor(JobPost::class);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('candidates');
    }
};
