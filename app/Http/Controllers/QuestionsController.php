<?php

namespace App\Http\Controllers;

use Exception;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

/**
 * @OA\Info(
 *    title="API Energia", version="1.0.0")
 * @OA\Server(url="http://localhost/pruebaEnergia/public/")
 */
class QuestionsController extends Controller
{

    /**
     * Display a listing of questions.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

    /**
     * @OA\Get(
     *     path="/api/questions/{tagged}/{fromdate}/{todate}",
     *     summary="Show",
     *     description="Show a list of questions0",
     *     operationId="ApiV1GetQuestions",
     *     tags={"Question"},
     *     @OA\Parameter(
     *         name="tagged",
     *         in="path",
     *         required=true,
     *         example="di"
     *     ),
     *     @OA\Parameter(
     *         name="fromdate",
     *         in="path",
     *         required=false,
     *         example=1612137600
     *     ),
     *     @OA\Parameter(
     *         name="todate",
     *         in="path",
     *         required=false,
     *         example=1617321600
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Success",
     *         @OA\JsonContent(
     *              @OA\Property(
     *                  property="items",
     *                  type="array",
     *                  @OA\Items(type="string")
     *              ),
     *              @OA\Property(
     *                  property="has_more",
     *                  type="boolean",
     *                  example=true
     *              ),
     *              @OA\Property(
     *                  property="quota_max",
     *                  type="integer",
     *                  example=300
     *              ),
     *              @OA\Property(
     *                  property="quota_remaining",
     *                  type="integer",
     *                  example=100
     *              )
     *         )
     *     )
     * )
     */
    /**
     * @OA\Get(
     *     path="/api/questions/{tagged}/{fromdate}",
     *     summary="Show",
     *     description="Show a list of questions",
     *     operationId="ApiV1GetQuestions1",
     *     tags={"Question"},
     *     @OA\Parameter(
     *         name="tagged",
     *         in="path",
     *         required=true,
     *         example="di"
     *     ),
     *     @OA\Parameter(
     *         name="fromdate",
     *         in="path",
     *         required=false,
     *         example=1612137600
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Success",
     *         @OA\JsonContent(
     *              @OA\Property(
     *                  property="items",
     *                  type="array",
     *                  @OA\Items(type="string")
     *              ),
     *              @OA\Property(
     *                  property="has_more",
     *                  type="boolean",
     *                  example=true
     *              ),
     *              @OA\Property(
     *                  property="quota_max",
     *                  type="integer",
     *                  example=300
     *              ),
     *              @OA\Property(
     *                  property="quota_remaining",
     *                  type="integer",
     *                  example=100
     *              )
     *         )
     *     )
     * )
     */
    /**
     * @OA\Get(
     *     path="/api/questions/{tagged}",
     *     summary="Show",
     *     description="Show a list of questions",
     *     operationId="ApiV1GetQuestions2",
     *     tags={"Question"},
     *     @OA\Parameter(
     *         name="tagged",
     *         in="path",
     *         required=true,
     *         example="di"
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Success",
     *         @OA\JsonContent(
     *              @OA\Property(
     *                  property="items",
     *                  type="array",
     *                  @OA\Items(type="string")
     *              ),
     *              @OA\Property(
     *                  property="has_more",
     *                  type="boolean",
     *                  example=true
     *              ),
     *              @OA\Property(
     *                  property="quota_max",
     *                  type="integer",
     *                  example=300
     *              ),
     *              @OA\Property(
     *                  property="quota_remaining",
     *                  type="integer",
     *                  example=100
     *              )
     *         )
     *     )
     * )
     */
    public function questions($tagged, $fromdate = '', $todate = '')
    {
        $request = [
            'tagged' => $tagged,
            'fromdate' => $fromdate,
            'todate' => $todate,
            'site' => env('SITE_STACK_STACKECHANGE'),
        ];

        $validator = Validator::make($request, [
            'tagged' => 'required',
            'fromdate' => 'integer|gte:0',
            'todate' => 'integer|gte:0',
        ]);

        try {
            if ($validator->fails()) {
                $code = 422;
                $resp = createErrorResponse($code, $validator->errors());
            }else{
                $resp = Http::get(env('URL_QUESTIONS'), $request)->json();
                $code = 200;
            }
        } catch(Exception $ex) {
            $code = 500;
            $resp = createErrorResponse($code);
        }

        return response()->json($resp, $code);
    }
}
