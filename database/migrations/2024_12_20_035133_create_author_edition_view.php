<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        DB::statement('drop view if exists author_edition');
        DB::statement(
            "create view author_edition as (select distinct `pa`.`author_id` AS `author_id`, `bulle`.`posts`.`edition_id` AS `edition_id`
                from ((`bulle`.`posts` join `bulle`.`post_author` `pa`
                   on ((`bulle`.`posts`.`id` = `pa`.`post_id`))) join `bulle`.`authors` `a` on ((`pa`.`author_id` = `a`.`id`))))"
        );
    }


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement('drop view if exists author_edition');
    }
};
