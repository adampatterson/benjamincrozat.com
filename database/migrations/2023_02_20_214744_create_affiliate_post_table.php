<?php

use App\Models\Affiliate;
use App\Models\Posts\Post;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    public function up() : void
    {
        Schema::create('affiliate_post', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Affiliate::class);
            $table->foreignIdFor(Post::class);
            $table->unsignedInteger('position')->default(0);
            $table->boolean('highlight')->default(false);
            $table->string('highlight_title')->nullable();
            $table->string('highlight_text')->nullable();
        });
    }

    public function down() : void
    {
        Schema::dropIfExists('affiliate_post');
    }
};
