<?php

namespace App\Helpers;

use Illuminate\Database\Eloquent\Builder;

class DistanceHelper
{
    /**
     * تصفية النتائج بناءً على المسافة الجغرافية من نقطة محددة
     *
     * @param Builder $query
     * @param float $lat خط العرض للمستخدم
     * @param float $lng خط الطول للمستخدم
     * @param string|null $relationPath مسار العلاقة للوصول إلى `store` (مثلاً: `store` أو `item.store`). يمكن أن يكون null إذا لم يكن هناك علاقة.
     * @param int $radius المسافة القصوى بالكيلومترات (افتراضي: 50 كم)
     * @param string $latColumn اسم عمود خط العرض في الجدول المستهدف
     * @param string $lngColumn اسم عمود خط الطول في الجدول المستهدف
     * @return Builder
     */
    public static function filterByDistance(
        Builder $query,
        float $lat,
        float $lng,
        ?string $relationPath = null, // السماح بأن تكون العلاقة `null`
        int $radius = 50,
        string $latColumn = 'lat',
        string $lngColumn = 'lng'
    ) {
        if ($relationPath) {
            return $query->whereHas($relationPath, function ($query) use ($lat, $lng, $radius, $latColumn, $lngColumn) {
                $query->selectRaw(
                    "(6371 * acos(cos(radians(?)) * cos(radians($latColumn)) * cos(radians($lngColumn) - radians(?)) + sin(radians(?)) * sin(radians($latColumn)))) AS distance",
                    [$lat, $lng, $lat]
                )
                ->having('distance', '<=', $radius)
                ->orderBy('distance');
            });
        } else {
            return $query->selectRaw(
                "(6371 * acos(cos(radians(?)) * cos(radians($latColumn)) * cos(radians($lngColumn) - radians(?)) + sin(radians(?)) * sin(radians($latColumn)))) AS distance",
                [$lat, $lng, $lat]
            )
            ->having('distance', '<=', $radius)
            ->orderBy('distance');
        }
    }
}
