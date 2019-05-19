<?php
namespace App\Services;

use App\Models\Purchase;
use App\Models\Transaction;
use App\Models\Item;

class CodeGeneratorService
{
    public function generateCode()
    {
        $codeParts = collect();
        $codeParts->push('INV');
        $codeParts->push(date('y'));
        $prefix = implode('', $codeParts->toArray());
        $sequence = 1;
        $lastItem = Transaction::where('invoice_number', 'LIKE', $prefix.'%%')
                    ->where('user_id', auth_cache()->id)
                    ->orderBy('created_at', 'desc')
                    ->first();
        $digits = 6;
        $codeParts->push(date('m'));
        $codeParts->push(auth_cache()->id);
        $codeParts->push('00');
        if ($lastItem) {
            $lastSequence = intval(substr($lastItem->invoice_number, -$digits));
            $sequence = ++$lastSequence;
        }


        $codeParts->push(str_pad($sequence, $digits, '0', STR_PAD_LEFT));

        return implode('', $codeParts->toArray());
    }

    public function generateCodePurchasing()
    {
        $codeParts = collect();
        $codeParts->push('INV');
        $codeParts->push(date('y'));
        $prefix = implode('', $codeParts->toArray());
        $sequence = 1;
        $lastItem = Purchase::where('invoice_number', 'LIKE', $prefix.'%%')
                    ->where('user_id', auth_cache()->id)
                    ->orderBy('created_at', 'desc')
                    ->first();

        $digits = 6;
        $codeParts->push(date('m'));
        $codeParts->push(auth_cache()->id.'100');
        $codeParts->push('00');
        if ($lastItem) {
            $lastSequence = intval(substr($lastItem->invoice_number, -$digits));
            $sequence = ++$lastSequence;
        }


        $codeParts->push(str_pad($sequence, $digits, '0', STR_PAD_LEFT));

        return implode('', $codeParts->toArray());
    }

    public function generateCodeItem()
    {
        $codeParts = collect();
        $codeParts->push('ITEM');
        $codeParts->push(date('y'));
        $prefix = implode('', $codeParts->toArray());
        $sequence = 1;
        $lastItem = Item::where('code', 'LIKE', $prefix.'%%')
                    ->where('user_id', auth_cache()->id)
                    ->orderBy('created_at', 'desc')
                    ->first();
        $digits = 6;
        $codeParts->push(date('m'));
        $codeParts->push(auth_cache()->id.'100');
        $codeParts->push('00');

        if ($lastItem) {
            $lastSequence = intval(substr($lastItem->code, -$digits));
            $sequence = ++$lastSequence;
        }

        $codeParts->push(str_pad($sequence, $digits, '0', STR_PAD_LEFT));

        return implode('', $codeParts->toArray());
    }
}
