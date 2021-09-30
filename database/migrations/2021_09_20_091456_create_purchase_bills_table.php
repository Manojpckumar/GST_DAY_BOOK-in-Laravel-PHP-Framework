<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePurchaseBillsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('purchase_bills', function (Blueprint $table) {
            $table->id();

            $table->text('store_code');
            $table->text('ref_invnum');
            $table->text('party_name');
            $table->text('gst_num');
            $table->text('inv_num');
            $table->date('bill_date');
            $table->text('bill_des');
            $table->text('state_ofpurchase');
            $table->text('bill_amount');
            
            $table->text('cgst_sum');
            $table->text('sgst_sum');
            $table->text('igst_sum');
            $table->text('gst_sum');

            $table->text('bill_copy');

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
        Schema::dropIfExists('purchase_bills');
    }
}
