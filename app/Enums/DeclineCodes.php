<?php

namespace App\Enums;

use Illuminate\Support\Collection;

/**
 * Decline codes
 *
 * Casts with
 * protected $casts = [
 *      'decline_code' => \App\Enums\DeclineCodes::class
 * ];
 */
enum DeclineCodes: string
{
    case CALL_ISSUER = 'call_issuer';
    case CARD_NOT_SUPPORTED = 'card_not_supported';
    case DO_NOT_HONOR = 'do_not_honor';
    case EXPIRED_CARD = 'expired_card';
    case GENERIC_DECLINE = 'generic_decline';

    public static function all(): Collection
    {
        return collect(DeclineCodes::cases())->map(
            fn(DeclineCodes $code) => $code->details()
        );
    }

    public function details(): array
    {
        return match ($this) {
            self::CALL_ISSUER => [
                'name'  => 'Call Issuer',
                'value' => 'call_issuer',
                'description' => 'The card was declined for an unknown reason.',
                'next_steps' => 'The customer needs to contact their card issuer for more information.',
            ],

            self::CARD_NOT_SUPPORTED => [
                'name'  => 'Card Not Supported',
                'value' => 'card_not_supported',
                'description' => 'The card does not support this type of purchase.',
                'next_steps' => 'The customer needs to contact their card issuer to make sure their card can be used to make this type of purchase.',
            ],

            self::DO_NOT_HONOR => [
                'name'  => 'Do Not Honor',
                'value' => 'do_not_honor',
                'description' => 'The card was declined for an unknown reason.',
                'next_steps' => 'The customer needs to contact their card issuer for more information.',
            ],

            self::EXPIRED_CARD => [
                'name'  => 'Expired Card',
                'value' => 'expired_card',
                'description' => 'The card has expired.',
                'next_steps' => 'The customer needs to use another card.',
            ],

            self::GENERIC_DECLINE => [
                'name'  => 'Generic Decline',
                'value' => 'generic_decline',
                'description' => 'The card was declined for an unknown reason.',
                'next_steps' => 'The customer needs to contact their card issuer for more information.',
            ],
        };
    }
}
