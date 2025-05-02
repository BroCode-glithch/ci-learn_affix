<?php

if (!function_exists('isUnlocked')) {
    function isUnlocked($courseId, $unlockedCourses)
    {
        return !empty($unlockedCourses[$courseId]);
    }
}
