<?php
/**
 * Created by PhpStorm.
 * User: Faisal Abdul Hamid
 * Date: 28/04/2017
 * Time: 18.34
 */

namespace App\Support;

use Illuminate\Support\Facades\Validator;

trait FilterPaginateOrder
{
    protected $operators = [
        'sama_dengan' => '=',
        'tidak_sama_dengan' => '<>',
        'kurang_dari' => '<',
        'lebih_dari' => '>',
        'kurang_dari_sama_dengan' => '<=',
        'lebih_dari_sama_dengan' => '>=',
        'di_dalam' => 'IN',
        'tidak_di_dalam' => 'NOT IN',
        'seperti' => 'LIKE',
        'antara' => 'BETWEEN'
    ];

    public function scopeFilterPaginateFilter($query)
    {
        $request = request();

        $v = Validator::make($request->all(), [
            'kolom' => 'required|in:'.implode(',', $this->filter),
            'urutan' => 'required|in:asc,desc',
            'per_page' => 'required|integer|min:1',
            'cari_operator' => 'required|in:'.implode(',', array_keys($this->operators)),
            'cari_kolom' => 'required|in:'.implode(',', $this->filter),
            'cari_kueri_1' => 'max:255',
            'cari_kueri_2' => 'max:255',
        ]);

        if($v->fails()){
            return response()->json($v->messages());//dd($v->messages());
        }

        return $query->orderBy($request->kolom, $request->urutan)
            ->where(function($query) use ($request){
                //Check if search query is empty
                if($request->has('cari_kueri_1')){
                    //determine  the type of search_column
                    //check if its related model, eg: customer.id
                    if($this->isRelatedColumn($request)){
                        list($relation, $relatedColumn) = explode('.', $request->cari_kolom);
                        return $query->whereHas($relation, function($query) use ($relatedColumn, $request){
                            return $this->buildQuery(
                                $relatedColumn,
                                $request->cari_operator,
                                $request,
                                $query
                            );
                        });
                    }else{
                        // regular column
                        return $this->buildQuery(
                            $request->cari_kolom,
                            $request->cari_operator,
                            $request,
                            $query
                        );
                    }
                }
            })
            ->paginate($request->per_page);
    }

    public function isRelatedColumn($request)
    {
        return strpos($request->cari_kolom, '.') !== false;
    }

    protected function buildQuery($kolom, $operator, $request, $query)
    {
        switch ($operator){
            case 'sama_dengan':
            case 'tidak_sama_dengan':
            case 'kurang_dari':
            case 'lebih_dari':
            case 'kurang_dari_sama_dengan':
            case 'lebih_dari_sama_dengan':
                $query->where($kolom, $this->operators[$operator], $request->cari_kolom_1);
                break;
            case 'di_dalam':
                $query->whereIn($kolom, explode(',', $request->cari_kolom_1));
                break;
            case 'tidak_di_dalam':
                $query->whereNotIn($kolom, explode(',', $request->cari_kolom_1));
                break;
            case 'seperti':
                $query->where($kolom, 'like', '%'.$request->cari_kolom_1.'%');
                break;
            case 'antara':
                $query->whereBetween($kolom, [
                    $request->cari_kolom_1,
                    $request->cari_kolom_2,
                ]);
                break;
            default:
                throw new Exception('Tidak Sesuai Operator', 1);
                break;
        }

        return $query;
    }
}