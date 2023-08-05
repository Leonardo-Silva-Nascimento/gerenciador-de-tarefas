<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class TableTask extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tasks', function (Blueprint $table) {
            $table->id(); 
            $table->string('title');
            $table->string('description')->nullable(); 
            $table->unsignedBigInteger('assignee_id'); 
            $table->dateTime('due_date')->nullable(); 

            $table->timestamps();
            
            // Definindo a chave estrangeira
            $table->foreign('assignee_id')
                ->references('id')
                ->on('employees')
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
        Schema::dropIfExists('tasks');
    }
}
