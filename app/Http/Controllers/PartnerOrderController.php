<?php

namespace App\Http\Controllers;

use App\Models\Partner;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\DB;

class PartnerOrderController extends Controller
{
    /**
     * Update the order of partners
     */
    public function update(Request $request): JsonResponse
    {
        try {
            $request->validate([
                'partner_id' => 'required|exists:partners,id',
                'direction' => 'required|in:up,down',
            ]);

            $partner = Partner::findOrFail($request->partner_id);
            
            DB::transaction(function () use ($partner, $request) {
                if ($request->direction === 'up') {
                    $this->moveUp($partner);
                } else {
                    $this->moveDown($partner);
                }
                
                // Normalize positions to prevent gaps
                $this->normalizePositions();
            });

            return response()->json([
                'success' => true,
                'partners' => Partner::orderBy('sort_order')->get(),
            ]);
        } catch (\Illuminate\Validation\ValidationException $e) {
            return response()->json([
                'success' => false,
                'message' => 'Validation failed',
                'errors' => $e->errors(),
            ], 422);
        } catch (\Exception $e) {
            \Log::error('Partner order update failed', [
                'error' => $e->getMessage(),
                'request' => $request->all(),
            ]);
            
            return response()->json([
                'success' => false,
                'message' => 'Failed to update partner order',
            ], 500);
        }
    }

    /**
     * Move partner up in order
     */
    private function moveUp(Partner $partner): void
    {
        $previousPartner = Partner::where('sort_order', '<', $partner->sort_order)
            ->orderBy('sort_order', 'desc')
            ->first();

        if ($previousPartner) {
            // Swap positions
            $tempOrder = $partner->sort_order;
            $partner->sort_order = $previousPartner->sort_order;
            $previousPartner->sort_order = $tempOrder;

            $partner->save();
            $previousPartner->save();
        }
    }

    /**
     * Move partner down in order
     */
    private function moveDown(Partner $partner): void
    {
        $nextPartner = Partner::where('sort_order', '>', $partner->sort_order)
            ->orderBy('sort_order', 'asc')
            ->first();

        if ($nextPartner) {
            // Swap positions
            $tempOrder = $partner->sort_order;
            $partner->sort_order = $nextPartner->sort_order;
            $nextPartner->sort_order = $tempOrder;

            $partner->save();
            $nextPartner->save();
        }
    }

    /**
     * Normalize positions to ensure sequential ordering without gaps
     */
    private function normalizePositions(): void
    {
        $partners = Partner::orderBy('sort_order')->get();
        
        foreach ($partners as $index => $partner) {
            $newPosition = $index + 1;
            if ($partner->sort_order !== $newPosition) {
                $partner->sort_order = $newPosition;
                $partner->save();
            }
        }
    }
}