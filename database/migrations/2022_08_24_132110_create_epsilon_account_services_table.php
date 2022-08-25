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
        Schema::create('epsilon_account_services', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id')->index();
            $table->integer('epsilon_service_id')->index();
            $table->string('name')->nullable();
            $table->string('port')->nullable();
            $table->string('protected')->nullable();
            $table->string('bandwidth')->nullable();
            $table->string('pricing_model')->nullable();
            $table->string('status')->nullable();
            $table->string('type')->nullable();
            $table->string('type_short_name')->nullable();
            $table->dateTime('cancellation_date')->nullable();
            $table->integer('vlan')->nullable();
            $table->integer('nni_vlan')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('epsilon_account_services');
    }
};
