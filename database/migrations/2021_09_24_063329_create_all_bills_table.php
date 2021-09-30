<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAllBillsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('all_bills', function (Blueprint $table) {
            
            $table->id();
            $table->text('store_code');
            $table->text('party_name');
            $table->text('gst_num');
            $table->text('inv_num');
            $table->text('bill_type');
            $table->date('bill_date');
            $table->text('sbill_amnt');
            $table->text('pbill_amnt');
            $table->text('ebill_amnt');
            $table->text('slab_ref');
            $table->text('bill_naration');
            $table->text('sale_type');
            $table->text('stateof_sp');
            $table->text('bill_copy');

            $table->text('cgst_sums');
            $table->text('sgst_sums');
            $table->text('igst_sums');
            $table->text('gst_sums');

            $table->text('cgst_sump');
            $table->text('sgst_sump');
            $table->text('igst_sump');
            $table->text('gst_sump');

            $table->text('exp_type');
            
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
        Schema::dropIfExists('all_bills');
    }
}
