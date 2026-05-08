<?php

namespace App\Http\Controllers\People;

use App\Http\Controllers\Controller;
use App\Models\Certificate\CitizenCertificate;
use App\Models\Organization\TradeLicense;
use App\Models\Vehicle;
use App\Models\Tax\Tax;
use Illuminate\Http\Request;

class PeopleStatusController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:people');
    }

    /**
     * Check application status
     */
    public function checkStatus(Request $request)
    {
        $type = $request->type;
        $id = $request->id;
        $status = 'Not Found';
        $data = null;

        switch ($type) {
            case 'certificate':
                $data = class_exists(CitizenCertificate::class) ? CitizenCertificate::where('system_id', $id)->first() : null;
                break;
            case 'trade_license':
                $data = class_exists(TradeLicense::class) ? TradeLicense::where('system_id', $id)->first() : null;
                break;
            case 'vehicle':
                $data = class_exists(Vehicle::class) ? Vehicle::where('registration_id', $id)->first() : null;
                break;
            case 'tax':
                $data = class_exists(Tax::class) ? Tax::where('id', $id)->first() : null;
                break;
            case 'grant':
                $status = 'Service coming soon (শীঘ্রই আসছে)';
                break;
        }

        if ($data) {
            // Standardizing status logic
            // Most models seem to use 1 for approved, 0 or null for pending
            if (isset($data->status)) {
                if ($data->status == 1) {
                    $status = 'Approved (অনুমোদিত)';
                } elseif ($data->status == 2) {
                    $status = 'Rejected (প্রত্যাখ্যাত)';
                } else {
                    $status = 'Pending (অপেক্ষমান)';
                }
            } else {
                $status = 'Pending (অপেক্ষমান)';
            }
        }

        return back()->with('status_check', [
            'type' => $type,
            'id' => $id,
            'status' => $status,
            'found' => $data ? true : false
        ]);
    }
}
