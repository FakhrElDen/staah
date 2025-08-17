<?php

namespace App\Http\Controllers;

use App\Http\Requests\PushDataRequest;
use App\Http\Resources\PushDataResource;
use App\Models\PushData;
use App\Repositories\PropertyRepository;
use App\Repositories\RoomRepository;
use App\Repositories\RateRepository;
use App\Repositories\PushDataRepository;
use App\Repositories\PushDataItemRepository;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Symfony\Component\HttpFoundation\Response;
use Exception;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class PushDataController extends Controller
{

    public function __construct(
        protected PropertyRepository $properties,
        protected RoomRepository $rooms,
        protected RateRepository $rates,
        protected PushDataRepository $pushDataRepo,
        protected PushDataItemRepository $pushDataItems
    ) {
        //
    }

    public function show($id)
    {
        try {
            // Example auth check → throw 401 if needed
            if (!Auth::check()) {
                return response()->json([
                    'status'     => 'Fail',
                    'error_desc' => 'Unauthorized',
                    'trackingId' => $this->generateTrackingId(),
                ], Response::HTTP_UNAUTHORIZED);
            }

            $pushData = PushData::with(['property', 'room', 'rate', 'items'])->findOrFail($id);

            return response()->json([
                'status'     => 'success',
                'error_desc' => '',
                'data'       => new PushDataResource($pushData),
            ], Response::HTTP_OK);
        } catch (ModelNotFoundException $e) {
            return response()->json([
                'status'     => 'Fail',
                'error_desc' => 'Record not found',
                'trackingId' => $this->generateTrackingId(),
            ], Response::HTTP_BAD_REQUEST); // 400

        } catch (Exception $e) {
            return response()->json([
                'status'     => 'Fail',
                'error_desc' => $e->getMessage(),
                'trackingId' => $this->generateTrackingId(),
            ], Response::HTTP_INTERNAL_SERVER_ERROR); // 500
        }
    }

    public function store(PushDataRequest $request)
    {
        $validated = $request->validated();
        DB::beginTransaction();

        try {

            if (!Auth::check()) {
                return response()->json([
                    'status'     => 'Fail',
                    'error_desc' => 'Unauthorized',
                    'trackingId' => $this->generateTrackingId(),
                ], Response::HTTP_UNAUTHORIZED);
            }

            $property = $this->properties->findOrCreate($validated);
            $room = $this->rooms->findOrCreate($validated, $property->id);
            $rate = $this->rates->findOrCreate($validated, $room->id);
            $pushData = $this->pushDataRepo->create($validated, $property->id, $room->id, $rate->id);
            $this->pushDataItems->createMany($pushData->id, $validated['data']);
            
            DB::commit();

            $pushData = PushData::with(['property', 'room', 'rate', 'items'])->get();

            return response()->json([
                'status'     => 'success',
                'error_desc' => '',
                'data'       => PushDataResource::collection($pushData),
            ], Response::HTTP_OK);
        } catch (\Throwable $e) {
            DB::rollBack();

            return response()->json([
                'status'     => 'Fail',
                'error_desc' => $e->getMessage(),
                'trackingId' => $request->input('trackingId')
            ], 500);
        } catch (ModelNotFoundException $e) {
            return response()->json([
                'status'     => 'Fail',
                'error_desc' => 'Record not found',
                'trackingId' => $this->generateTrackingId(),
            ], Response::HTTP_BAD_REQUEST); // 400

        } catch (Exception $e) {
            return response()->json([
                'status'     => 'Fail',
                'error_desc' => $e->getMessage(),
                'trackingId' => $this->generateTrackingId(),
            ], Response::HTTP_INTERNAL_SERVER_ERROR); // 500
        }
    }

    private function generateTrackingId(): string
    {
        return (string) Str::uuid();
    }
}
