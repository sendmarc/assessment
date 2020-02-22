<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTasksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tasks', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->text('name')->default('Task name');
            $table->smallInteger('priority')->default(1);
            $table->smallInteger('dueIn')->default(30);
            $table->timestamps();
        });

		// Insert defaults
		DB::table('tasks')->insert(
			[
				'name' => 'Get Older',
				'priority' => 100,
				'created_at' => now(),
				'updated_at' => now()
			]
		);

		DB::table('tasks')->insert(
			[
				'name' => 'Breathe',
				'priority' => 1000,
				'created_at' => now(),
				'updated_at' => now()
			]
		);

		DB::table('tasks')->insert(
			[
				'name' => 'Complete Assessment',
				'priority' => 20,
				'created_at' => now(),
				'updated_at' => now()
			]
		);
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
