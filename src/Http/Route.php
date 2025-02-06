<?php

namespace App\Http;

use App\Enums\EnumMethod;

class Route {

    private static array $routes = [];

    public static function get(string $path, string $action): void {
        self::$routes[] = [
            'path' => $path,
            'action' => $action,
            'method' => EnumMethod::GET,
        ];
    }

    public static function post(string $path, string $action): void {
        self::$routes[] = [
            'path' => $path,
            'action' => $action,
            'method' => EnumMethod::POST,
        ];
    }

    public static function put(string $path, string $action): void {
        self::$routes[] = [
            'path' => $path,
            'action' => $action,
            'method' => EnumMethod::PUT,
        ];
    }

    public static function delete(string $path, string $action): void {
        self::$routes[] = [
            'path' => $path,
            'action' => $action,
            'method' => EnumMethod::DELETE,
        ];
    }

    public static function routes(): array {
        return self::$routes;
    }
}