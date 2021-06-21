<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdatePostsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('posts', function (Blueprint $table) {
            //DEFINIZIONE COLONNA
            $table->unsignedBigInteger('category_id')->nullable()->after('slug');
            
            // DEFINIZIONE FOREIGN KEY
            $table->foreign('category_id')
                ->references('id')//DEFINISCE LA COLONNA DI RIGERIMENTO
                ->on('categories')//DEFINISCE LA TABELLA DI RIFERIMENTO
                ->onDelete('set null');//SE UNA CATEGORIA VIENE CANCELLATA, LE COLONNE CHE LA CONTENEVANO DIVENTANO NULL
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('posts', function (Blueprint $table) {
            //RIMOZIONE DELLA RELAZIONE
            $table->dropForeign('post_category_id_foreign');

            //RIMOZIONE DELLA COLONNA
            $table->dropColumn('category_id');
        });
    }
}
