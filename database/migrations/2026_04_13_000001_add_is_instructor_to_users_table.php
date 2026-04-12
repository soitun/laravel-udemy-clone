<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->boolean('is_instructor')->default(false)->after('password');
        });

        $ids = DB::table('courses')
            ->whereNotNull('user_id')
            ->distinct()
            ->pluck('user_id');

        if ($ids->isNotEmpty()) {
            DB::table('users')->whereIn('id', $ids)->update(['is_instructor' => true]);
        }
    }

    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('is_instructor');
        });
    }
};
