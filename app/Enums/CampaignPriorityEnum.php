<?php

namespace App\Enums;

use Spatie\Enum\Laravel\Enum;
/**
 * @method static self BAIXA()
 * @method static self MEDIA()
 * @method static self ALTA()
 * @method static self URGENTE()
 * @typescript
 * @typescript-transformer \Spatie\TypeScriptTransformer\Transformers\SpatieEnumTransformer::class
 */
final class CampaignPriorityEnum extends Enum
{
}
