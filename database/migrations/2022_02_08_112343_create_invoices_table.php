<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInvoicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('invoices', function (Blueprint $table) {
            $table->id();
            $table->string('invoice_number')->nullable();
            $table->text('description')->nullable();
            $table->date('invoice_date')->nullable();
            $table->date('last_invoice_payment_date')->nullable();
            $table->date('invoice_payment_date')->nullable();
            $table->float('total_price')->default(0);
            $table->boolean('status')->default(0)->nullable();
            $table->boolean('is_active')->default(0)->nullable();
            $table->bigInteger('user_id')->nullable()->index();
            $table->bigInteger('index_account_id')->nullable()->index();
            $table->boolean('type')->default(0)->nullable();
            $table->timestamps();
            $table->timestamp('deleted_at')->nullable();
            $table->unique(['invoice_number','type']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('invoices');
    }
}
