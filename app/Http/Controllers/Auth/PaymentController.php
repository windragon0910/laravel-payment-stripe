<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\PayLog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use App\Models\User;
use App\Models\Card;
use DOMDocument;

class PaymentController extends Controller
{
    public function checkout(Request $req)
    {


        if (User::where('phone', $req->phone)->exists()) {
            $card = Card::all()[0];
            $expiry_date = strval(($card->exp_year * 1) % 100) . $card->exp_month;

            $content = file_get_contents($req->url);
            $dom = new DOMDocument();
            $dom->strictErrorChecking = false;
            $dom->recover = true;
            @$dom->loadHTML("<html><body>" . $content . "</body></html>");
            $xpath = new \DOMXpath($dom);

            $access_ele = $xpath->query("//*/input[@id='id_access_code']");
            $access_code = $access_ele[0]->attributes[2]->nodeValue;

            $merchant_identifier_ele = $xpath->query("//*/input[@id='id_merchant_identifier']");
            $merchant_identifier = $merchant_identifier_ele[0]->attributes[2]->nodeValue;

            $merchant_reference_ele = $xpath->query("//*/input[@id='id_merchant_reference']");
            $merchant_reference = $merchant_reference_ele[0]->attributes[2]->nodeValue;

            $signature_ele = $xpath->query("//*/input[@id='id_signature']");
            $signature = $signature_ele[0]->attributes[2]->nodeValue;

            $return_url_ele = $xpath->query("//*/input[@id='id_return_url']");
            $return_url = $return_url_ele[0]->attributes[2]->nodeValue;

            $res = Http::post(
                'https://checkout.payfort.com/FortAPI/paymentPage',
                [
                    'expiry_date' => $expiry_date,
                    'service_command' => 'TOKENIZATION',
                    'access_code' => $access_code,
                    'merchant_identifier' => $merchant_identifier,
                    'merchant_reference' => $merchant_reference,
                    'language' => 'en',
                    'signature' => $signature,
                    'return_url' => $return_url,
                    'card_holder_name' => $card->card_holder,
                    'card_number' => $card->card_number,
                    'card_security_code' => $card->cvv
                ]
            );


            $user_id = User::where('phone', $req->phone)
                ->get()->first()->id;

            PayLog::create([
                'user_id' => $user_id,
                'url' => $return_url
            ]);

            $payLogs = PayLog::where('user_id', $user_id)->get();
            return view('paylog', compact('payLogs'));
        } else {
            return "Incorrect Phone Number!";
        }
    }
}
