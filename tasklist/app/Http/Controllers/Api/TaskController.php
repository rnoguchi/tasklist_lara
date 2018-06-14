<?php
/**
 * Created by PhpStorm.
 * User: noguchi-ryota
 * Date: 2018/05/22
 * Time: 17:40
 */

namespace App\Http\Controllers\Api;

use App\Model\Tasks;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Validator;


class TaskController extends Controller
{
    /**
     * @param Request $request
     * @return array
     */
    public function save(Request $request)
    {
        $validateData = Validator::make($request->all(), [
           'title' =>  'required:tasks|max:60',
            'body' =>  'required:tasks|max:600'
        ]);

        if ($validateData->fails()) {
            return $validateData->errors();
        }

        $user = $request->user();
        $task = new Tasks();
        $task->fill(['user_id' => 1]);
        $task->fill(['title' => $request['title']]);
        $task->fill(['body' => $request['body']]);
        $task->save();
        return ['status' => 'success'];
    }
}