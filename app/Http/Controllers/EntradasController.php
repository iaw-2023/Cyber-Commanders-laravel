<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Funcion;
use App\Models\Entrada;
use App\Http\Requests\EntradaStoreRequest;
use Auth0\SDK\Auth0;
use Auth0\SDK\Configuration\SdkConfiguration;
use Auth0\SDK\Exception\InvalidTokenException;
use Exception;
use Illuminate\Http\Request;


use MercadoPago\Client\Common\RequestOptions;
use MercadoPago\Client\Payment\PaymentClient;
use MercadoPago\Exceptions\MPApiException;
use MercadoPago\MercadoPagoConfig;


class EntradasController extends Controller
{
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $funciones = Funcion::all();
        return view('vistas.crear_entrada')->with(compact('funciones'));
    }

    public function indexApi()
    {
        $entradas = Entrada::all();

        return response()->json($entradas, 200);
    }

    /**
     * @OA\Post(
     *     path="/rest/storeEntrada",
     *     description="Con esta ruta se guarda una nueva entrada asociada a una funcion y ciertos productos. Para agregar elementos al arreglo de extras se debe copiar y pegar el contenido encerrado por llaves",
     *     summary="Crear una nueva entrada",
     *     tags={"entradas"},
     *     @OA\RequestBody(
     *         @OA\MediaType(
     *             mediaType="application/json",
     *             @OA\Schema(
     *                 type="object",
     *           @OA\Property(property="funcion_id", type="integer"),
     *           @OA\Property(
     *              property="extras",
     *               type="array",
     *               @OA\Items(
     *                  @OA\Property(property="id", type="integer"),
     *                  @OA\Property(property="cantidad", type="integer")
     *              )
     *          ),
     *             )
     *          )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Operacion exitosa",
     *         @OA\MediaType(
     *             mediaType="application/json"
     *         )
     *     ),
     *     @OA\Response(
     *         response=422,
     *         description="Error: Unprocessable Content. Algun parametro no es valido",
     *         @OA\MediaType(
     *             mediaType="application/json"
     *         )
     *     ),
     *
     * )
     */
    public function storeEntrada(EntradaStoreRequest $request)
    {
        $auth0 = new Auth0([
            'strategy' => SdkConfiguration::STRATEGY_API,
            'domain' => env('AUTH0_DOMAIN'),
            'clientId' => env('AUTH0_CLIENT_ID'),
            'clientSecret' => env('AUTH0_CLIENT_SECRET'),
            'audience' => ['https://cyber-commanders-laravel.vercel.app/rest/']
        ]);

        $token = $request->bearerToken();
        if ($token === null) {
            return response()->json(["message" => "No Autorizado"], 401);
        } else {
            try {

                $decodedToken = $auth0->decode($token);
                $infoToken = $decodedToken->toArray();
                $user_id = $infoToken['sub'];



                $entrada = new Entrada();
                $funcion = Funcion::findOrFail($request->funcion_id);


                $entrada->user_id = $user_id;

                $entrada->funcion_id = $funcion->id;
                $extras = $request->extras;

                $entrada->save();


                foreach ($extras as $extra) {
                    $entrada->extras()->attach($extra['id'], ['cantidad' => $extra['cantidad']]);
                }
                return response()->json(['success' => 'true', 'message' => 'Operacion Exitosa. Entrada guardada'], 200);
            } catch (InvalidTokenException $exception) {
                return response()->json(["error" => $exception->getMessage()], 401);
            } catch (Exception $exception) {
                return response()->json(["error" => $exception->getMessage()], 401);
            }
        }
        return response()->json(['success' => 'true', 'message' => 'Operacion Exitosa.'], 200);
    }


    public function indexApiRequest(Request $request)
    {
        $auth0 = new Auth0([
            'strategy' => SdkConfiguration::STRATEGY_API,
            'domain' => env('AUTH0_DOMAIN'),
            'clientId' => env('AUTH0_CLIENT_ID'),
            'clientSecret' => env('AUTH0_CLIENT_SECRET'),
            'audience' => ['https://cyber-commanders-laravel.vercel.app/rest/']
        ]);

        $token = $request->bearerToken();
        if ($token === null) {
            return response()->json(["message" => "No Autorizado"], 401);
        } else {
            try {
                $decodedToken = $auth0->decode($token);
                $infoToken = $decodedToken->toArray();
                $sub = $infoToken['sub'];

                $entradas = Entrada::where('user_id', $sub)
                    ->with([
                        'extras:id,producto,tamaño,precio,extras_entradas.cantidad', // Incluye la cantidad en la relación
                        'funcion:id,fecha,precio,sala_id,pelicula_id',
                        'funcion.sala:id,nombre',
                        'funcion.pelicula:id,nombre'
                    ])
                    ->get([
                        'id', 'funcion_id', 'user_id'
                    ]);

                return response()->json($entradas, 200);
            } catch (InvalidTokenException $exception) {
                return response()->json(["error" => $exception->getMessage()], 401);
            }
        }
    }




    public function procesarCompra(Request $request)
    {
        $auth0 = new Auth0([
            'strategy' => SdkConfiguration::STRATEGY_API,
            'domain' => env('AUTH0_DOMAIN'),
            'clientId' => env('AUTH0_CLIENT_ID'),
            'clientSecret' => env('AUTH0_CLIENT_SECRET'),
            'audience' => ['https://https://cyber-commanders-laravel.vercel.app/rest/']
        ]);

        $token = $request->bearerToken();
        if ($token === null) {
            return response()->json(["message" => "No Autorizado"], 401);
        }

        try {
            $decodedToken = $auth0->decode($token);
            $infoToken = $decodedToken->toArray();
            $user_id = $infoToken['sub'];

            // Procesar datos de la entrada
            $entradaData = $request->input('entradaData');
            $extras = $entradaData['extras'];
            $funcion_id = $entradaData['funcion_id'];

            $entrada = new Entrada();
            $entrada->user_id = $user_id;
            $entrada->funcion_id = $funcion_id;
            $entrada->save();

            foreach ($extras as $extra) {
                $entrada->extras()->attach($extra['id'], ['cantidad' => $extra['cantidad']]);
            }

            // Procesar pago con MercadoPago
            MercadoPagoConfig::setAccessToken("TEST-7426401162927896-072911-835d4edc71f4306f5974898fd7bfde75-603075297");
            MercadoPagoConfig::setRuntimeEnviroment(MercadoPagoConfig::LOCAL);

            $client = new PaymentClient();
            $paymentData = $request->input('mpData');

            $request_options = new RequestOptions();
            $payment = $client->create($paymentData, $request_options);

            $response = [
                'status' => $payment->status,
                'status_detail' => $payment->status_detail,
                'id' => $payment->id,
                'email' => $paymentData['payer']['email']
            ];


            return response()->json(['success' => 'true', 'message' => 'Operación Exitosa', 'paymentResponse' => $response], 200);
        } catch (InvalidTokenException $exception) {
            return response()->json(["error" => $exception->getMessage()], 401);
        } catch (MPApiException $e) {
            return response()->json(["error" => $e->getMessage()], 401);
        } catch (\Exception $e) {
            return response()->json(["error" => $e->getMessage()], 500);
        }
    }
}
