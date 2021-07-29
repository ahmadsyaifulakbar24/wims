<?php

namespace App\Http\Controllers\API\Ptkp;

use App\Helpers\ResponseFormatter;
use App\Http\Controllers\Controller;
use App\Http\Resources\Ptkp\PtkpResource;
use App\Models\Ptkp;
use Facade\FlareClient\Http\Response;
use Illuminate\Http\Request;

class PtkpController extends Controller
{
    public function fetch($ptkp_id = null)
    {
        $ptkp = Ptkp::query();
        if($ptkp_id) {
            return ResponseFormatter::success(
                new PtkpResource($ptkp->find($ptkp_id)),
                'success get ptkp data'
            );
        }

        return ResponseFormatter::success(
            PtkpResource::collection($ptkp->get()),
            'success get ptkp data'
        );

    }

    public function create(Request $request)
    {
        $this->validate($request, [
            'ptkp' => ['required', 'string', 'unique:ptkp,ptkp'],
            'rate' => ['required', 'numeric'],
            'description' => ['required', 'string'],
        ]);

        $input = $request->all();
        $ptkp = Ptkp::create($input);
        return ResponseFormatter::success(
            new PtkpResource($ptkp),
            'succes create ptkp data'
        );
    }

    public function update(Request $request, Ptkp $ptkp)
    {
        $this->validate($request, [
            'ptkp' => ['required', 'string', 'unique:ptkp,ptkp,'.$ptkp->id],
            'rate' => ['required', 'numeric'],
            'description' => ['required', 'string'],
        ]);

        $input = $request->all();
        $ptkp->update($input);
        return ResponseFormatter::success(
            new PtkpResource($ptkp),
            'success update ptkp data'
        );
    }

    public function delete(Ptkp $ptkp)
    {
        $result = $ptkp->delete();
        return ResponseFormatter::success(
            $result,
            'success delete ptkp data'
        );
    }
}
