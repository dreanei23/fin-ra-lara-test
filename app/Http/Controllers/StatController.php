<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests\StatStoreRequest;
use App\Http\Requests\StatGetRequest;
use App\Models\Stat;
use Exception;

class StatController extends Controller
{

    protected $default_order_type = 'asc';

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(StatGetRequest $request)
    {

        $stat = Stat::whereBetween('date', [$request->from_date, $request->to_date]);
        
        //orderBy
        if ($request->filled('sortBy')) {
            $orderBy = $this->parseOrderBy($request->sortBy);
            $stat = $stat->OrderBy($orderBy[0], $orderBy[1]);
        }


        //groupBy
        if ($request->filled('groupBy')) {
            $stat = $stat->selectRaw('date, SUM(views) as views, SUM(clicks) as clicks, SUM(cost) as cost, SUM(CPC) as CPC, SUM(CPM) as CPM, SUM(CTR) as CTR, COUNT(*) as COUNT');
            $stat = $stat->GroupBy($request->groupBy);
        }

        
        try {
            $stat = $stat->get();
        } catch(Exception $e) {
            return response()->json(['status'=>'error', 'message'=>'Проверьте правильность переданных параметров']);
        }
        

        return response()->json($stat);
    }

 

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StatStoreRequest $request)
    {
        if ($request->clear == '1') {
            Stat::truncate();
            $stat = response()->json([
                'status' => 'deleted',
            ]);
        } else {
            $stat = Stat::create($request->toArray());
        }
        
        return $stat;
    }

    /**
     * Парсим sortBy в формате field|order_type
     */
    private function parseOrderBy($orderBy) {
        $sortBy = explode('|', $orderBy);

        if (empty($sortBy['1'])) {
            $sortBy['1'] = $this->default_order_type;
        }
        return $sortBy;
    }



}
