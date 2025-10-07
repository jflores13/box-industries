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
        // Update services table
        Schema::table('services', function (Blueprint $table) {
            // Rename existing columns to *_en
            $table->renameColumn('name', 'name_en');
            $table->renameColumn('short_description', 'short_en');
            $table->renameColumn('long_description', 'long_en');

            // Add Spanish columns after their English counterparts
            $table->string('name_es')->after('name_en');
            $table->text('short_es')->nullable()->after('short_en');
            $table->longText('long_es')->nullable()->after('long_en');
        });

        // Update products table
        Schema::table('products', function (Blueprint $table) {
            // Rename existing columns to *_en
            $table->renameColumn('short_description', 'short_en');
            $table->renameColumn('long_description', 'long_en');
            $table->renameColumn('button_text', 'button_en');

            // Add Spanish columns
            $table->text('short_es')->nullable()->after('short_en');
            $table->text('long_es')->nullable()->after('long_en');
            $table->string('button_es')->nullable()->after('button_en');

            // Add home_en and home_es columns
            $table->string('home_en')->nullable()->after('button_es');
            $table->string('home_es')->nullable()->after('home_en');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Revert services table
        Schema::table('services', function (Blueprint $table) {
            $table->dropColumn(['name_es', 'short_es', 'long_es']);

            // Rename English columns back to original names
            $table->renameColumn('name_en', 'name');
            $table->renameColumn('short_en', 'short_description');
            $table->renameColumn('long_en', 'long_description');
        });

        // Revert products table
        Schema::table('products', function (Blueprint $table) {
            $table->dropColumn(['short_es', 'long_es', 'button_es', 'home_en', 'home_es']);

            // Rename English columns back to original names
            $table->renameColumn('short_en', 'short_description');
            $table->renameColumn('long_en', 'long_description');
            $table->renameColumn('button_en', 'button_text');
        });
    }
};
