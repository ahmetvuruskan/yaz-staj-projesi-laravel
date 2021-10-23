<?php

namespace App\Http\Controllers\Frontend;

use App\Events\SendOrderSms;
use App\Mail\OrderCreatedMail;
use App\Mail\SiparisAlindi;
use App\Models\Orders;
use App\Models\Pages;
use Illuminate\Support\Facades\Event;
use App\Events\SendSms;
use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\PaymentSettings;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use SoapClient;


class ShopController extends Controller
{
    public function singleProduct($slug)
    {
        $data['singleProduct'] = Product::where('product_slug', $slug)
            ->where('showcase', '1')
            ->join('photos', 'products.product_id', '=', 'photos.product_id')
            ->first(); // Ürün bilgileri
        $data['category'] = Category::all(); // Ürün sayfası kategoriler

        $data['lasts'] = Product::where('product_category', $data['singleProduct']['product_category'])
            ->where('photos.showcase', '1')
            ->where('.products.product_id', '!=', $data['singleProduct']['product_id'])
            ->join('photos', 'products.product_id', '=', 'photos.product_id')
            ->orderBy('product_quantity', 'desc')
            ->take(3)
            ->get();

        $data['related'] = Product::where('product_category', $data['singleProduct']['product_category'])
            ->where('photos.showcase', '1')
            ->where('.products.product_id', '!=', $data['singleProduct']['product_id'])
            ->join('photos', 'products.product_id', '=', 'photos.product_id')
            ->get();


        return view('Frontend.singleProduct')->with('data', $data);

    }

    public function categoryIndex($slug)
    {
        $data['activeCategory'] = Category::where('category_slug', $slug)->get();
        $data['allprods'] = Product::where('products.product_category', $data['activeCategory'][0]['id'])
            ->where('photos.showcase', '1')
            ->join('photos', 'products.product_id', '=', 'photos.product_id')
            // Laravel pagination metodundan yararlanarak sayfalama yapıyoruz....
            ->paginate(24);

        $data['categories'] = Category::all();

        return view('Frontend.allproducts')->with('data', $data);
    }

    public function pay($product_id)
    {
        $data['product'] = Product::where('products.product_id', $product_id)
            ->join('photos', 'products.product_id', '=', 'photos.product_id')
            ->first();
        return view('Frontend.pay')->with('data', $data);

    }

    public function virtualTerminal(Request $request)
    {


        if (empty($request->identity_number)) {
            // Tc kimlik kısmı boş gelirse
            $request->identity_number = "11111111111";
        }

        $orderId = uniqid('ORD-');

        $paymentSettings = PaymentSettings::first();

        $options = new \Iyzipay\Options();
        $options->setApiKey($paymentSettings->api_key);
        $options->setSecretKey($paymentSettings->secret_key);
        if ($paymentSettings['status'] == '0') {
            $options->setBaseUrl("https://sandbox-api.iyzipay.com");
        } else {
            $options->setBaseUrl("https://api.iyzipay.com");
        }
        $paymentRequest = new \Iyzipay\Request\CreatePaymentRequest();
        $paymentRequest->setLocale(\Iyzipay\Model\Locale::TR);
        $paymentRequest->setConversationId($orderId); //Sipariş Numarası
        $paymentRequest->setPrice(intval($request->price)); // Sepet Tutarı
        $paymentRequest->setPaidPrice(intval($request->price)); // İndirim vade farkı vs. hesaplanmış POS’tan geçecek nihai tutar. Price değerinden küçük, büyük veya eşit olabilir.
        $paymentRequest->setCurrency(\Iyzipay\Model\Currency::TL); // Para Birimi
        $paymentRequest->setInstallment(1); // Taksit bilgisi  sabit 1 olarak gidecek
        $paymentCard = new \Iyzipay\Model\PaymentCard();
        $paymentCard->setCardHolderName(trim($request->card_holder));
        $paymentCard->setCardNumber($request->card_number); // Kart numarası
        $paymentCard->setExpireMonth($request->expiry_month); // Son kullanım ay
        $paymentCard->setExpireYear($request->expiry_year); // Son kullanım yıl
        $paymentCard->setCvc($request->cvv_code); // cvv code
        $paymentCard->setRegisterCard(0); // Kartı kaydet 0:hayır 1 : evet
        $paymentRequest->setPaymentCard($paymentCard);  // requeste kartımızın bilgilerini set ediyoruz.
        $userId = uniqid('USER-'); // Benzersiz kullanıcı idsi yaratma
        $buyer = new \Iyzipay\Model\Buyer();
        $buyer->setId($userId); // benzersiz kullanıcı id
        $buyer->setName($request->firstname); // isim
        $buyer->setSurname($request->lastname); // soyisim
        $buyer->setGsmNumber($request->phone); // Telefon
        $buyer->setIdentityNumber($request->identity_number); // Tc
        $buyer->setEmail($request->email); // email
        $buyer->setRegistrationAddress($request->address . ' ' . $request->address2); // adres
        $buyer->setIp('127.0.0.1'); // Localden istek attığımız için 127.0.0.1
        $buyer->setCity($request->il); // il
        $buyer->setCountry("Turkey"); // ülke
        $paymentRequest->setBuyer($buyer); // requeste alıcıyı set ediyoruz.

        $shippingAddress = new \Iyzipay\Model\Address(); // kargo adresi
        $shippingAddress->setContactName($request->firstname . ' ' . $request->lastname); // Adres isim soyisim
        $shippingAddress->setCity($request->il); // İl
        $shippingAddress->setCountry("Turkey"); // Ülke
        $shippingAddress->setAddress($request->address . ' ' . $request->address2); //Kargo adresi
        $paymentRequest->setShippingAddress($shippingAddress); // requeste shipping adresi set ediyoruz

        $billingAddress = new \Iyzipay\Model\Address();
        $billingAddress->setContactName($request->firstname . ' ' . $request->lastname); // Fatura sahibi isim
        $billingAddress->setCity($request->il); // Fatura için şehir
        $billingAddress->setCountry("Turkey"); // Fatura ülke
        $billingAddress->setAddress($request->address . ' ' . $request->il . '/' . $request->ilce); // Fatura adresi
        $paymentRequest->setBillingAddress($billingAddress); // Fatura bilgilerini set ediyoruz
        $basketItems = array(); // Alışveriş sepetindeki ürünleri  dizi olarak göndereceğimiz için  dizi değişkeni oluşturuyoruz.
        $firstBasketItem = new \Iyzipay\Model\BasketItem();
        $firstBasketItem->setId($request->product_id); // Ürün id
        $firstBasketItem->setName($request->product_name); // ürün adı
        $category_id = Category::where('id', $request->category_id)->pluck('category_name'); // kategori adı nı çekiyoruz.
        $firstBasketItem->setCategory1($category_id[0]); // kategori adını set ediyoruz
        $firstBasketItem->setItemType(\Iyzipay\Model\BasketItemType::PHYSICAL);  // Ürünün  sanal mı fiziksel mi olduğunu belirtiyoruz
        $firstBasketItem->setPrice(intval($request->price)); // Ürün fiyatı
        $basketItems[0] = $firstBasketItem; // Ürünü dizimize ekliyoruz.
        $paymentRequest->setBasketItems($basketItems); // requeste ürünleri ekliyoruz
        $pay = \Iyzipay\Model\Payment::create($paymentRequest, $options); // Ödeme isteğini gönderiyoruz..

        if ($pay->getStatus() == "success") {
            Orders::insert([
                'order_unique_id' => $orderId,
                'order_product_id' => $request->product_id,
                'amount' => (int)$request->price,
                'shipping_adress' => $request->address . ' ' . $request->address2 . ' ' . $request->il . '/' . $request->ilce,
                'order_mail' => $request->email,
                'order_phone' => $request->phone
            ]);
            $quantity = Product::where('product_id', $request->product_id)->pluck('product_quantity');
            Product::where('product_id', $request->product_id)->update([
                'product_quantity' => $quantity[0] - 1
            ]);
            //Sms api başlangıç
            $curl = curl_init();
            $params = [
                'api_id' => 'e02252eff3289b9af0ca7a3b', // Firmadan aldığımız api id
                'api_key' => '95cb0da6233045ed8d6c4103', // Firmadan aldığımız api key
                'sender' => '08502740533', // Sms başlığımız
                'message_type' => 'normal',
                'message' => "Sayın " . $request->firstname . " " . $request->lastname . " Siparişiniz başarı ile alınmıştır.", // Mesaj bilgisi
                'phones' => [ // Mesaj gidecek cep telefonu numaraları.
                    $request->phone
                ]
            ];
            $curl_options = [
                CURLOPT_URL => 'https://api.vatansms.net/api/v1/1toN', // İstek urlsi
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_TIMEOUT => 0,
                CURLOPT_FOLLOWLOCATION => true,
                CURLOPT_CUSTOMREQUEST => 'POST', // Method
                CURLOPT_POSTFIELDS => json_encode($params), // Apimiz verilerimizi json olarak kabul ediyor o yüzden json encode yapıyoruz.
                CURLOPT_HTTPHEADER => [
                    'Content-Type: application/json'
                ]
            ];
            curl_setopt_array($curl, $curl_options); // Bilgileri set ediyoruz.

            $response = curl_exec($curl); // İstedğimizi gönderip sonucumuzu response değişkenine alıyoruz

            curl_close($curl); // Curl işlemini sonlandırıyoruz.
            //Sms bitiş
            //Mail api başlangç
            //Mail apisi test modunda olduğu için mail kullanıcnın mail kutusuna mail gitmeyip api kontrol panelinden görünmektedir mail api:ok

            Mail::to($request->email)->send(new SiparisAlindi($orderId));
            /* Mail gönderimi için Mail sınıfından yararlanıyoruz.
            * Localde çalıştığımız için mailtrap mail test apisi kullanacağız.
            */
            $detay = Orders::where('order_unique_id', $orderId)
                ->join('products', 'products.product_id', '=', 'orders.order_product_id')
                ->get();
            //mail api bitiş
            return view('mail')->with('detay', $detay);

        } else {
            return view('Frontend.fail');
        }
    }

    public function page($slug)
    {
        $page = Pages::where('page_slug', $slug)->first();
        return view('Frontend.pages')->with('page', $page);
    }
}
