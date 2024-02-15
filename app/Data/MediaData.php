<?php

namespace App\Data;

use Spatie\MediaLibrary\MediaCollections\Models\Media;

class MediaData
{
    public function __construct(
        public readonly  ?string $name,
        public readonly  ?string $url,
        public readonly  ?string $type,
    ) {}

    public static function fromModel(?Media $media) :?self{

        if(!$media){
            return null;
        }
        return new self(
            name: $media->name,
            url: $media->getUrl(),
            type: self::mediaType($media)
        );
    }

    private static function mediaType(Media $media): ?string
    {
        $type = $media->type;
        if ($type === 'image') {
            return 'image';
        }
        if ($type === 'video') {
            return 'video';
        }
        return null;
    }
}
