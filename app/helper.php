<?php

if (! function_exists('edit_separator')) {
    function edit_separator($path): array|string
    {
        return str_replace(['\\', '/'], DIRECTORY_SEPARATOR, $path);
    }
}
