<?php
declare(strict_types=1);

namespace App\Client\Contract;

use App\Model\PublicAPIEntry;

interface PublicAPIClientContract
{
    public function random(?string $title = null): PublicAPIEntry;
}
