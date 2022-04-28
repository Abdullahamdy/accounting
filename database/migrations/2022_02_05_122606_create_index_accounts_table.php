<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateIndexAccountsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('index_accounts', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('account_number')->unique();
            $table->string('account_name')->unique();
            $table->bigInteger('index_account_id')->nullable()->index();
            $table->float('balance')->default(0);
            $table->timestamps();
            $table->timestamp('deleted_at')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('index_accounts');
    }
}
