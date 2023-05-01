<?php

namespace App\Http\Controllers;

use App\Models\React;
use Auth;
use Illuminate\Http\Request;

class ReactController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function reactions(Request $request)
    {
        $check = React::where([
            ['user_id', Auth::user()->id],
            ['type', $request->react_type],
            ['type_id', $request->type_id],
        ]);

        if (!$check->exists()) {
            $new_react = new React;
            $new_react->user_id = Auth::user()->id;
            $new_react->type_id = $request->type_id;
            $new_react->type = $request->react_type;
            $new_react->emoji = $request->emoji;
            $new_react->save();

            return response()->json([
                'title' => 'Success',
                'status' => 'add',
                'countReact' => count(React::where([
                    ['type', $request->react_type],
                    ['type_id', $request->type_id],
                    ['type', $request->react_type],
                    ['status', 'activate'],
                ])->get())
            ]);
        } else {

            if ($check->first()->emoji != $request->emoji) {
                $check->update([
                    'emoji' => $request->emoji,
                    'status' => 'activate'
                ]);

                return response()->json([
                    'title' => 'Success',
                    'status' => 'activate',
                    'countReact' => count(React::where([
                        ['type', $request->react_type],
                        ['type_id', $request->type_id],
                        ['type', $request->react_type],
                        ['status', 'activate'],
                    ])->get())
                ]);

            } else {
                if ($check->first()->status == 'activate') {
                    $check->update([
                        'emoji' => $request->emoji,
                        'status' => 'deactivate'
                    ]);

                    return response()->json([
                        'title' => 'Success',
                        'status' => 'deactivate',
                        'countReact' => count(React::where([
                            ['type', $request->react_type],
                            ['type_id', $request->type_id],
                            ['type', $request->react_type],
                            ['status', 'activate'],
                        ])->get())
                    ]);
                } else {
                    $check->update([
                        'emoji' => $request->emoji,
                        'status' => 'activate'
                    ]);

                    return response()->json([
                        'title' => 'Success',
                        'status' => 'activate',
                        'countReact' => count(React::where([
                            ['type', $request->react_type],
                            ['type_id', $request->type_id],
                            ['type', $request->react_type],
                            ['status', 'activate'],
                        ])->get())
                    ]);
                }

            }
        }



    }
}
