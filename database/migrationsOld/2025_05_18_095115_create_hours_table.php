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
        Schema::create('hours', function (Blueprint $table) {
            $table->id();
            $table->string('period');
            $table->date('week_ending');
            $table->unsignedBigInteger('week_number');
            $table->string('employee');
            $table->unsignedBigInteger('emp_no');
            $table->decimal('mon1', 8, 2)->default(0);
            $table->decimal('mon2', 8, 2)->default(0);
            $table->decimal('mon3', 8, 2)->default(0);
            $table->integer('job_no_mon1')->nullable();
            $table->integer('job_no_mon2')->nullable();
            $table->integer('job_no_mon3')->nullable();
            $table->decimal('tue1', 8, 2)->default(0);
            $table->decimal('tue2', 8, 2)->default(0);
            $table->decimal('tue3', 8, 2)->default(0);
            $table->integer('job_no_tue1')->nullable();
            $table->integer('job_no_tue2')->nullable();
            $table->integer('job_no_tue3')->nullable();
            $table->decimal('wed1', 8, 2)->default(0);
            $table->decimal('wed2', 8, 2)->default(0);
            $table->decimal('wed3', 8, 2)->default(0);
            $table->integer('job_no_wed1')->nullable();
            $table->integer('job_no_wed2')->nullable();
            $table->integer('job_no_wed3')->nullable();
            $table->decimal('thu1', 8, 2)->default(0);
            $table->decimal('thu2', 8, 2)->default(0);
            $table->decimal('thu3', 8, 2)->default(0);
            $table->integer('job_no_thu1')->nullable();
            $table->integer('job_no_thu2')->nullable();
            $table->integer('job_no_thu3')->nullable();
            $table->decimal('fri1', 8, 2)->default(0);
            $table->decimal('fri2', 8, 2)->default(0);
            $table->decimal('fri3', 8, 2)->default(0);
            $table->integer('job_no_fri1')->nullable();
            $table->integer('job_no_fri2')->nullable();
            $table->integer('job_no_fri3')->nullable();
            $table->decimal('sat1', 8, 2)->default(0);
            $table->decimal('sat2', 8, 2)->default(0);
            $table->decimal('sat3', 8, 2)->default(0);
            $table->integer('job_no_sat1')->nullable();
            $table->integer('job_no_sat2')->nullable();
            $table->integer('job_no_sat3')->nullable();
            $table->decimal('sun1', 8, 2)->default(0);
            $table->decimal('sun2', 8, 2)->default(0);
            $table->decimal('sun3', 8, 2)->default(0);
            $table->integer('job_no_sun1')->nullable();
            $table->integer('job_no_sun2')->nullable();
            $table->integer('job_no_sun3')->nullable();
            $table->decimal('tot_mon', 8, 2)->nullable();
            $table->decimal('tot_tue', 8, 2)->nullable();
            $table->decimal('tot_wed', 8, 2)->nullable();
            $table->decimal('tot_thu', 8, 2)->nullable();
            $table->decimal('tot_fri', 8, 2)->nullable();
            $table->decimal('tot_sat', 8, 2)->nullable();
            $table->decimal('tot_sun', 8, 2)->nullable();
            $table->boolean('late')->default(false);
            $table->boolean('mon_overnight')->default(false);
            $table->boolean('tue_overnight')->default(false);
            $table->boolean('wed_overnight')->default(false);
            $table->boolean('thu_overnight')->default(false);
            $table->boolean('fri_overnight')->default(false);
            $table->boolean('sat_overnight')->default(false);
            $table->boolean('sun_overnight')->default(false);
            $table->unsignedBigInteger('period_id');
            $table->decimal('bonus_hours', 8, 2)->default(0.00);
            $table->decimal('expenses', 8, 2)->default(0.00);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('hours');
    }
};
