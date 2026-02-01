<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
        public function up(): void
        {
            Schema::create('fraudapis', function (Blueprint $table) {
                $table->id(); // Primary ID
                $table->string('type');
                $table->string('url');
                $table->string('api_key'); // অথবা $table->text('api_key') যদি বড় হয়
                $table->boolean('active_status')->default(true); // 1 = active, 0 = inactive
                $table->timestamps(); // created_at & updated_at
            });
        }


    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('fraudapis');
    }
};
