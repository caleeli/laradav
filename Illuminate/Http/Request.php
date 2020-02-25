<?php

namespace Illuminate\Http;

use Laradav\Foundation\BaseClass;

class Request extends BaseClass
{
    const HEADER_X_FORWARDED_ALL = 0b11110; // All "X-Forwarded-*" headers
}
