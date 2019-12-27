<?php

namespace OrdinaryJellyfish\ReactStatic;

use Psr\Http\Message\ServerRequestInterface;
use React\Http\Response;

class StaticServer
{
    public static function serve(string $path)
    {
        return function (ServerRequestInterface $request, $next) use ($path) {
            $filePath = $request->getUri()->getPath();
            $file = $path.$filePath;

            if (file_exists($file)) {
                $fileExt = pathinfo($file, PATHINFO_EXTENSION);
                $finfo = finfo_open(FILEINFO_MIME_TYPE);
                $fileType = finfo_file($finfo, $file);
                finfo_close($finfo);
                $fileContents = file_get_contents($file);

                // Fix for incorrect mime types
                switch ($fileExt) {
                    case 'css':
                        $fileType = 'text/css';

                    break;
                    case 'js':
                        $fileType = 'application/javascript';

                    break;
                }

                return new Response(200, ['Content-Type' => $fileType], $fileContents);
            }

            return $next($request);
        };
    }
}
