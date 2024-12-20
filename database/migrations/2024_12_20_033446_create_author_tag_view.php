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
        DB::statement('drop view if exists author_tag');
        DB::statement(
            'create view author_tag as select distinct pa.author_id AS author_id, pt.tag_id AS tag_id
            from (tags t join (((posts join post_author pa
                                 on ((posts.id = pa.post_id))) join authors a
                                on ((a.id = pa.author_id))) join post_tag pt
                               on ((posts.id = pt.post_id))) on ((t.id = pt.tag_id)))'
        );
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement('drop view if exists author_tag');
    }
};
