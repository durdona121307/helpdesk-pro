<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        DB::statement("
            ALTER TABLE tickets
            MODIFY COLUMN status
            ENUM('open', 'in_progress', 'closed')
            NOT NULL DEFAULT 'open'
        ");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("
            ALTER TABLE tickets
            MODIFY COLUMN status
            ENUM('open', 'pending', 'closed')
            NOT NULL DEFAULT 'open'
        ");
    }
};