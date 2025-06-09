<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;


use App\Models\Property;
use App\Models\Inquiry;
use App\Models\Sale;
use Carbon\Carbon;

class ReportController extends Controller
{
    public function overview(Request $request)
    {
        $user = $request->user();

        if ($user->role === 'admin') {
            $properties = Property::count();
            $views = Property::sum('views');
            $inquiries = Inquiry::count();
            $sales = Sale::count();
        } else if (in_array($user->role, ['seller', 'agent'])) {
            $properties = Property::where('user_id', $user->id)->count();
            $views = Property::where('user_id', $user->id)->sum('views');
            $inquiries = Inquiry::whereHas('property', fn($q) => $q->where('user_id', $user->id))->count();
          $sales = Sale::whereHas('property', fn($q) => $q->where('user_id', $user->id))->count();
        } else {
            return response()->json(['error' => 'Unauthorized'], 403);
        }
        return response()->json([
            'properties' => $properties,
            
        ]);
       return response()->json(compact('properties', 'views', 'inquiries', 'sales'));
    }

    public function monthly(Request $request)
    {
        $user = $request->user();
        $start = Carbon::now()->startOfMonth();
        $end = Carbon::now()->endOfMonth();

        $propertyQuery = Property::whereBetween('created_at', [$start, $end]);
        $inquiryQuery = Inquiry::whereBetween('created_at', [$start, $end]);
        $saleQuery = Sale::whereBetween('created_at', [$start, $end]);

        if (in_array($user->role, ['seller', 'agent'])) {
            $propertyQuery->where('user_id', $user->id);
            $inquiryQuery->whereHas('property', fn($q) => $q->where('user_id', $user->id));
            $saleQuery->whereHas('property', fn($q) => $q->where('user_id', $user->id));
        }

        return response()->json([
            'new_properties' => $propertyQuery->count(),
            'inquiries' => $inquiryQuery->count(),
            'sales' => $saleQuery->count(),
        ]);
    }
}
