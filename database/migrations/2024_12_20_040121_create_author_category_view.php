<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        DB::statement('drop view if exists author_category');
        DB::statement(
            "create view author_category as select distinct pa.author_id AS author_id, posts.category_id AS category_id
                from ((posts join post_author pa
                   on ((posts.id = pa.post_id))) join authors a on ((pa.author_id = a.id)))"
        );
    }


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement('drop view if exists author_category');
    }
};
