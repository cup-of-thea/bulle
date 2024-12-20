<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        DB::statement(
            "create or replace view author_category as (select distinct `pa`.`author_id` AS `author_id`, `bulle`.`posts`.`category_id` AS `category_id`
                from ((`bulle`.`posts` join `bulle`.`post_author` `pa`
                   on ((`bulle`.`posts`.`id` = `pa`.`post_id`))) join `bulle`.`authors` `a` on ((`pa`.`author_id` = `a`.`id`))))"
        );
    }


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement('drop view author_category');
    }
};
