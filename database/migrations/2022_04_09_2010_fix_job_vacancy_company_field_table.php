<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::table('job_vacancies')->truncate();

        Schema::table('job_vacancies', function($table) {
            $table->dropColumn('company');

            $table->foreignId('company_id')
                ->constrained('companies')
                ->nullable(false)
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        // Not necessary
    }
};
