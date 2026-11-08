<?php

namespace App\Support;

final class PatchNotes
{
    /**
     * Returns the latest patch notes items from public/data/patch-notes.json.
     *
     * @return array<int, array{published_at: string, content: string, discord_url?: string}>
     */
    public static function latest(int $limit = 3): array
    {
        $fallback = [
            [
                'published_at' => 'Waiting for first update',
                'content' => 'Patch notes will appear here soon.',
            ],
        ];

        $path = public_path('data/patch-notes.json');

        if (! is_file($path)) {
            return $fallback;
        }

        $json = json_decode((string) file_get_contents($path), true);

        if (! is_array($json)) {
            return $fallback;
        }

        if (! empty($json['items']) && is_array($json['items'])) {
            $items = $json['items'];
        } elseif (! empty($json['content'])) {
            $items = [$json];
        } else {
            $items = [];
        }

        return $items ? array_slice($items, 0, $limit) : $fallback;
    }
}
