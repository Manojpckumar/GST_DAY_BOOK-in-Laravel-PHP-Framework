<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePurchaseBillSlabsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('purchase_bill_slabs', function (Blueprint $table) {
            $table->id();
            
            $table->text('gst_slab');
            $table->text('inv_noref');
            $table->text('tax_amount');
            $table->text('pro_unit');
            $table->text('pro_cgst');
            $table->text('pro_sgst');
            $table->text('pro_igst');

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
        Schema::dropIfExists('purchase_bill_slabs');
    }
}
