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
        Schema::create('company_settings', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('company_id')->unsigned();
            $table->enum('currencies_symbol_placement', ['Before amount', 'After amount'])->default('Before amount');
            $table->enum('date_format', ['mm/dd/yy', 'dd/mm/yy', 'mm-dd-yy', 'dd-mm-yy'])->default('mm/dd/yy');
            $table->enum('time_format', ['24 Hour', '12 Hour'])->default('24 Hour');
            $table->string('time_zone')->default('Asia/Jakarta');
            $table->string('currencies')->nullable();
            $table->enum('trx_editable_type', ['By Days', 'By Status'])->default('By Days');
            $table->integer('trx_editable_by_days')->nullable();
            $table->string('trx_editable_by_status')->nullable();
            $table->string('product_sku_prefix')->nullable();
            $table->bigInteger('product_default_unit_id')->unsigned();
            $table->string('invoice_prefix')->nullable();
            $table->enum('zip_code_source', ['Local Database', 'Raja Ongkir', 'bachors/apiapi'])->default('bachors/apiapi');
            $table->json('zip_code_source_settings')->nullable();
            $table->timestamps();
            $table->softDeletes();
            $table->foreign('company_id')->references('id')->on('companies');
            $table->foreign('product_default_unit_id')->references('id')->on('product_units');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('settings');
    }
};
