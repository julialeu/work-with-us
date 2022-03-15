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
            $table->string('uuid')
                ->nullable(false)
                ->after('experience')
                ->unique();

            $table->string('url_token')
                ->nullable(false)
                ->after('uuid')
                ->unique();

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
            $table->dropColumn(['uuid', 'url_token']);
        });
    }
};
