<?php

namespace App\Http\Controllers;

use App\Http\Requests\Expense\StoreRequest;
use App\Http\Requests\Expense\UpdateRequest;
use App\Http\Resources\ExpenseResource;
use App\Models\Expense;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class ExpenseController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        try{
            $query = Expense::where('user_id',$request->user()->id)->latest();
            $query->when($request->has('search'),function ($q) use($request) {
                $searchKey = $request['search'];
                $q->where(function($subquery) use($searchKey){
                    $subquery->where('title','like','%'.$searchKey.'%')
                        ->orWhere('amount','like','%'.$searchKey.'%')
                        ->orWhere('category','like','%'.$searchKey.'%');
                });
            });
            $perPage = $request->get('per_page',10);
            $expenses = $query->paginate($perPage);
            if(count($expenses) == 0){
                return response()->json([
                    "message"=>"Expenses not found"
                ],404);
            }
            return response()->json([
                "message"=>"Expenses retrieved successfully",
                "data"=>ExpenseResource::collection($expenses),
                "total"=>$expenses->total(),
                "per_page"=>$expenses->perPage(),
                "current_page"=>$expenses->currentPage(),
                "last_page"=>$expenses->lastPage()
            ],200);
        }catch(Exception $e){
            Log::error("User Register Error Section : ".$e->getMessage());
            return response()->json([
                "message" => "Internal Server Error"
            ],500);
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreRequest $request)
    {
        try{
            $data = $request->validated();
            $data['user_id'] = request()->user()->id;
            $expense = Expense::create($data);
            return response()->json([
                "message" => "Expense retrieved successfully",
                "data" => ExpenseResource::make($expense)
            ],201);
        }catch(Exception $e){
            Log::error("User Register Error Section : ".$e->getMessage());
            return response()->json([
                "message" => "Internal Server Error"
            ],500);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        try{
            $expense = Expense::find($id);
            if(!$expense){
                return response()->json([
                    "message"=>"Expense not found"
                ],404);
            }
            if($expense->user_id !== request()->user()->id){
                return response()->json([
                    "message"=>"Unauthorized"
                ],403);
            }
            return response()->json([
                "message" => "Expense retrieved successfully",
                "data" => ExpenseResource::make($expense)
            ],200);
        }catch(Exception $e){
            Log::error("User Register Error Section : ".$e->getMessage());
            return response()->json([
                "message" => "Internal Server Error"
            ],500);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateRequest $request, string $id)
    {
        try{
            $expense = Expense::find($id);
            if(!$expense){
                return response()->json([
                    "message"=>"Expense not found"
                ],404);
            }
            if($expense->user_id !== request()->user()->id){
                return response()->json([
                    "message"=>"Unauthorized"
                ],403);
            }
            $data = $request->validated();
            $expense->update($data);
            return response()->json([
                "message" => "Expense updated successfully",
                "data" => ExpenseResource::make($expense)
            ],200);
        }catch(Exception $e){
            Log::error("User Register Error Section : ".$e->getMessage());
            return response()->json([
                "message" => "Internal Server Error"
            ],500);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try{
            $expense = Expense::find($id);
            if(!$expense){
                return response()->json([
                    "message"=>"Expense not found"
                ],404);
            }
            if($expense->user_id !== request()->user()->id){
                return response()->json([
                    "message"=>"Unauthorized"
                ],403);
            }
            $expense->delete();
            return response()->json([
                "message" => "Expense deleted successfully"
            ],200);
        }catch(Exception $e){
            Log::error("User Register Error Section : ".$e->getMessage());
            return response()->json([
                "message" => "Internal Server Error"
            ],500);
        }
    }
}
