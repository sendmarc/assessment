<?php
namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;

/*
    All database activity is moved into its own class
    this is if we decide to change the database
    we can update the queries in one place
*/
class TaskFighterRepository {

    public function selectAll(){
        $tasks = DB::table('tasks')->select('*')->get();
        return $tasks;
    }

    public function insert($request){
        if(DB::insert("insert into tasks set name = '{$request->name}', priority = '{$request->priority}', dueIn = '{$request->dueIn}'")){
            return true;
        }else{
            return false;
        }
    }

    public function delete($request){
        if(DB::delete("delete from tasks where id = '{$request->id}'")){
            return true;
        }else{
            return false;
        }
    }

    public function update($request){
        DB::update("update tasks set priority = '{$request->priority}', dueIn = '{$request->dueIn}' where id = '{$request->id}'");
    }
}
