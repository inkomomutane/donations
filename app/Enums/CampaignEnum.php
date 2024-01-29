<?php

namespace App\Enums;

use Spatie\Enum\Laravel\Enum;
/**
 * @method static self ACTIVA()
 * @method static self PENDENTE()
 * @method static self COMPLETA()
 * @method static self SUSPENSA()
 * @typescript
 * @typescript-transformer \Spatie\TypeScriptTransformer\Transformers\SpatieEnumTransformer::class
 */
final class CampaignEnum extends Enum
{

}
