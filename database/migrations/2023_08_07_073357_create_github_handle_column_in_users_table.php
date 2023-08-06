<?php

use App\Models\User;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    public function up() : void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->after('description', fn () => $table->string('github_handle')->nullable());
        });

        if (! app()->runningUnitTests()) {
            User::factory()->create([
                'name' => 'Benjamin Crozat',
                'email' => 'hello@benjamincrozat.com',
                'github_handle' => 'benjamincrozat',
                'twitter_handle' => 'benjamincrozat',
            ]);
        }
    }

    public function down() : void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('github_handle');
        });
    }
};
