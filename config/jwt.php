<?php

return [

  'key' => env('JWT_KEY', 'aliaskey'),
  'algo' => env('JWT_ALGO', Array('HS256')),
  // 'iss' => env('JWT_ISS', 'http://maika-kanaka.id'),
  'iss' => env('JWT_ISS', 'http://127.0.0.1'),
  'aud' => env('JWT_AUD', 'http://127.0.0.1'),
  'iat' => env('JWT_IAT', 1356999524),
  'nbf' => env('JWT_NBF', 1357000000)
];
