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
        if (config('permission.teams')) {
            Schema::create('teams', function (Blueprint $table) {
                $table->id();
                $table->timestamps();
                $table->integer('order_column')->default(0);
                $table->string('name');
                $table->text('description')->nullable();
                $table->string('color', 7)->nullable();

                $table->foreignIdFor(User::class, 'owner_id')
                    ->constrained('users')
                    ->setNullOnDelete();

                $table->index('order_column');
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('teams');
    }
};
