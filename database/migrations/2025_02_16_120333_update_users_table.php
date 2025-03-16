<?php

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
        Schema::table('users', function (Blueprint $table) {

            $table->string('firstname')->after('name');
            $table->string('password')->nullable()->change();
            $table->date('datePremiereEmbauche')->nullable()->after('password');
            $table->enum('role', ['superadmin', 'admin', 'user'])->default('user')->after('datePremiereEmbauche');

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
