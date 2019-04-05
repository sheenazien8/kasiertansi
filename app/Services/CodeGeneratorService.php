<?php
namespace App\Services;

use App\Models\Purchase;
use App\Models\Transaction;

class CodeGeneratorService
{
    public function generateCode()
    {
        $codeParts = collect();
        $codeParts->push('INV');
        $codeParts->push(auth()->id());
        $codeParts->push('00');
        $codeParts->push(date('y'));
        $codeParts->push(date('m'));
        $prefix = implode('', $codeParts->toArray());
        $sequence = 1;
        $lastItem = Transaction::where('invoice_number', 'LIKE', '%%'.$prefix.'%%')
                    ->orderBy('created_at', 'desc')
                    ->first();
        $digits = 6;
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
        $codeParts->push(auth()->id().rand(00, 999));
        $codeParts->push('00');
        $codeParts->push(date('y'));
        $codeParts->push(date('m'));
        $prefix = implode('', $codeParts->toArray());
        $sequence = 1;
        $lastItem = Purchase::where('invoice_number', 'LIKE', '%%'.$prefix.'%%')
                    ->orderBy('created_at', 'desc')
                    ->first();
        $digits = 6;
        if ($lastItem) {
            $lastSequence = intval(substr($lastItem->invoice_number, -$digits));
            $sequence = ++$lastSequence;
        }


        $codeParts->push(str_pad($sequence, $digits, '0', STR_PAD_LEFT));

        return implode('', $codeParts->toArray());
    }
}
