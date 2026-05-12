<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ActivityLog extends Model
{
    protected $fillable = [
        'user_id',
        'action',
        'model',
        'model_id',
        'details',
        'ip_address',
        'user_agent',
    ];

    protected $casts = [
        'details' => 'array',
    ];

    public function user()
    {
        return $this->belongsTo(\App\Models\User::class);
    }

    /**
     * Helper to log an activity
     */
    public static function log($action, $model = null, $modelId = null, $details = null)
    {
        return self::create([
            'user_id' => auth()->id(),
            'action' => $action,
            'model' => $model,
            'model_id' => $modelId,
            'details' => $details,
            'ip_address' => request()->ip(),
            'user_agent' => request()->userAgent(),
        ]);
    }
}
