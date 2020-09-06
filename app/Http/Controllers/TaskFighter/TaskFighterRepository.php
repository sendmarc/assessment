<?php
namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;

class TaskFighterRepository {

    public function selectAll(){
        $tasks = DB::table('tasks')->select('*')->get();
        return $tasks;
    }


    public function insert($request){
        DB::insert("insert into tasks set name = '{$request->name}', priority = '{$request->priority}', dueIn = '{$request->dueIn}'");
        return 'created';

    }

    public function delete($request){
        DB::delete("delete from tasks where id = '{$request->id}'");
        return 'deleted';
    }

    public function update($request){
        DB::update("update tasks set priority = '{$request->priority}', dueIn = '{$request->dueIn}' where id = '{$request->id}'");
    }
}
