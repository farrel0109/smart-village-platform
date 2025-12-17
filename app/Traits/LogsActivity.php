<?php

namespace App\Traits;

use App\Models\ActivityLog;

trait LogsActivity
{
    /**
     * Boot the LogsActivity trait for a model.
     */
    protected static function bootLogsActivity(): void
    {
        static::created(function ($model) {
            self::logActivity('created', $model, "{$model->getTable()} created");
        });

        static::updated(function ($model) {
            if ($model->wasChanged() && !$model->wasRecentlyCreated) {
                self::logActivity('updated', $model, "{$model->getTable()} updated");
            }
        });

        static::deleted(function ($model) {
            self::logActivity('deleted', $model, "{$model->getTable()} deleted");
        });
    }

    /**
     * Log an activity for this model.
     */
    protected static function logActivity(string $action, $model, string $description): void
    {
        ActivityLog::log($action, $model, $description);
    }
}
