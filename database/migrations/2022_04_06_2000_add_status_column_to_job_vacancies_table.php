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
    public function up()
    {
        Schema::table('job_vacancies', function (Blueprint $table) {
            $table->enum('status', ['published', 'unpublished'] )
                ->nullable(false)
                ->after('user_id')
                ->default('unpublished');
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {

        Schema::table('job_vacancies', function (Blueprint $table) {
            $table->dropColumn('status');
        });
    }
};
