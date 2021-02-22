<?php

namespace App\Http\Controllers;

use App\Models\Todo;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TodoController extends Controller
{

    public function __construct()
    {

    }
    public function index()
    {
        return view('todo/todo');
    }
    public function getTodayTasks()
    {
        $date = Carbon::now();
        $data = Todo::where('date' , $date->format('Y-m-d'))->where('user_id' , Auth::user()->id)->get();
        return $data;
    }
    public function getTasks($start = '2021-02-14' , $end = '2021-02-18')
    {
        $data = Todo::whereDate('date' , '<=' , $end)->whereDate('date','>=' , $start)->where('user_id' , 1)->get();


        $task = array();

        foreach($data as $item){
            if(!in_array($item->date,$task)){
                $task[$item['date']][] = [
                    'id' => $item['id'],
                    'title' => $item['title'],
                    'description' => $item->description,
                    'status' => $item->status,
                    'date'          =>$item->date
                ];
            }
        }

        // return $data;
        return $task;
    }
    public function storeTask(Request $request)
    {
        $date = Carbon::now();
        $validate = $request->validate([
            'title' =>'required|max:255',
            // 'description' => '',
            // 'date'=>'date|required',
            // 'status'=>'required'
        ]);

        $data = new Todo;
        $data->title        = $request->title;
        // $data->description  = $request->description;
        $data->date         = $date->format('Y-m-d');
        $data->status       = 'active';
        $data->user_id      = Auth::user()->id;
        $data->save();

        if($data){
            return 'ok';
        }else{
            return 'a problem has accourd';
        }
    }

    public function updateTask(Request $request)
    {
        //do some validation

        $update = Todo::findOrFail($request->id);

        $update->title = $request->title;
        $update->description = $request->description;
        $update->status = $request->status;
        $update->save();

        if($update){
            return 'updated';
        }
    }

    public function deletetask(Request $request)
    {
        $task = Todo::findOrFail($request->id);
        $task->delete();
        return 'deleted';
    }
}
