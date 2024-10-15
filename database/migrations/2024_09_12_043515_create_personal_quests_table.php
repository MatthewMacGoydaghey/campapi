<?php

use App\Models\User;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('personal_quests', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->text('description');
            $table->integer('scores');
            $table->enum('status', ["Active", "Complited"])->default('Active');
            $table->foreignId('sent_to')->constrained(
                table: 'users', indexName: 'to_user_id'
            );
            $table->foreignId('sent_by')->constrained(
                table: 'users', indexName: 'from_user_id'
            );
            $table->timestamps();
            $table->date('expires_at')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('personal_quests');
    }
};
