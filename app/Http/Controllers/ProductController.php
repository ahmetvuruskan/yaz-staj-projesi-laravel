<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Photos;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class ProductController extends Controller
{


    public function index()
    {
        $product = Product::where('product_status', '1')->get();

        return view('Admin.Products.index')->with('products', $product);
    }

    public function addNew()
    {
        //  Ürün ekleme sayfamızı açan fonksiyon.
        // Veritabanında aktif olarak bulunan kategorileri çekip ürün ekleme sayfamıza gönderiyoruz.
        $categories = Category::where('category_status', '1')
            ->orderBy('id')
            ->get();
        return view('Admin.Products.addproduct')->with('categories', $categories);
    }

    public function saveProduct(Request $request)
    {
        // Ürün ekleme sayfamızdan gelen verileri doğrulama işlemine tabii tutuyoruz
        $validate = Validator::make($request->all(), [
            'product_quantity' => 'bail|numeric|min:1',
            'product_price' => 'bail|numeric|min:1',
            'product_showcase' => 'bail|file|max:2048|image',
            'product_images.*' => 'bail|file|image|max:2048'
            // product images dizi olarak geldiğinden .* ifadesi ile  bütün dizi elemanlarının kurallara tabii olmasını sağlıyoruz.
        ], [
            // Özel olarak tanımladığımız hata mesajları..
            'product_quantity.numeric' => 'Stok adedini sayı olarak girmeniz gerekmektedir Örn 10',
            'product_quantity.min' => 'Ürün stok adedi minimum 1 olmalıdır.',
            'product_price.numeric' => 'Ürün fiyatını sayı olarak girmeniz gerekmektedir. Örn 5',
            'product_price.min' => 'Ürün fiyatı en az 1₺ olmalıdır.',
            'product_showcase.file' => ' Ürün vitrin görseli resim dosyası olmak zorundadır.Dosya tipi hatalı.',
            'product_showcase.image' => ' Ürün vitrin görseli resim dosyası olmak zorundadır.Dosya tipi hatalı.',
            'product_showcase.max' => ' Ürün vitrin görselinin dosya boyutu max 2 mb olmalıdır.Daha küçük bir resim ile deneyin.',
        ]);
        if ($validate->fails()) {
            $request->flash(); // Gelen requesti flasha alıp herhangi bir hata durumunda eski değerlerin kaybolmasını engelliyoruz..
            // Validate kısmında herhangi bir hata olunca blade dosyasında hata mesajlarımızı  bastırıyoruz..
            return redirect(route('admin.product.add'))->withErrors($validate);
        }

        if ($request->hasFile('product_showcase')) {
            // Form isteğinde ilgili dosyalar varsa bu kısım çalışacak güvenlik amaçlı if içine alıyoruz.
            $showCaseFileName = uniqid('PRD-SHC-IMG') . '.' . $request->product_showcase->getClientOriginalExtension();
            $request->product_showcase->move(public_path('images/products'), $showCaseFileName);
            $photoShowCaseInsert = Photos::insert([
                'product_id' => $request->product_unique_id,
                'photo' => $showCaseFileName,
                'showcase' => '1'
            ]);
            if (!$photoShowCaseInsert) {
                return back()->with('error', 'Veritabanı bağlantı hatası.');
            }


            $productInsert = Product::insert([
                // Veritabanına gönderidğimiz verileri htmlspecialchars ile temizliyoruz
                'product_id' => htmlspecialchars($request->product_unique_id),
                'product_slug' => Str::slug(htmlspecialchars($request->product_name), '-', 'tr'),
                'product_name' => htmlspecialchars($request->product_name),
                'product_category' => $request->product_category,
                'product_quantity' => $request->product_quantity,
                'product_price' => $request->product_price,
                'product_description' => htmlspecialchars($request->product_detail),
            ]);
            if ($productInsert) {
                return redirect(route('admin.product.add'))->with('success', 'Ürün ekleme işlemi başarılı');
            }
            return redirect(route('admin.product.add'))->with('error', 'Ürün ekleme işlemi başarısız.');
        }
    }

    public function edit($id)
    {
        // Ürün düzenleme sayfamıza verilerimizi çekip dizi şeklinde gönderiyoruz..
        $data['singleProduct'] = Product::find($id);
        $data['categories'] = Category::all();

        $data['showCase'] = Photos::where('product_id', $data['singleProduct']['product_id'])
            ->where('showcase', '1')
            ->first();

        return view('Admin.Products.editproduct')->with('data', $data);
    }

    public function deletePhoto($id)
    {
        $photo = Photos::find($id)->first();

        if (Photos::where('product_id', $photo->product_id)->where('showcase', '0')->count() > 1) {
            if (Photos::find($id)->delete() && @unlink(public_path('images/product/' . $photo->photo))) {
                return 1;
            }
        }
        return null;

    }

    public function update(Request $request, $id)
    {

        $validate = Validator::make($request->all(), [
            'product_quantity' => 'bail|numeric|min:1',
            'product_price' => 'bail|numeric|min:1',
            'product_showcase' => 'bail|file|max:2048|image',
            'product_images.*' => 'bail|file|image|max:2048'
            // product images dizi olarak geldiğinden .* ifadesi ile  bütün dizi elemanlarının kurallara tabii olmasını sağlıyoruz.
        ], [
            // Özel olarak tanımladığımız hata mesajları..
            'product_quantity.numeric' => 'Stok adedini sayı olarak girmeniz gerekmektedir Örn 10',
            'product_quantity.min' => 'Ürün stok adedi minimum 1 olmalıdır.',
            'product_price.numeric' => 'Ürün fiyatını sayı olarak girmeniz gerekmektedir. Örn 5',
            'product_price.min' => 'Ürün fiyatı en az 1₺ olmalıdır.',
            'product_showcase.file' => ' Ürün vitrin görseli resim dosyası olmak zorundadır.Dosya tipi hatalı.',
            'product_showcase.image' => ' Ürün vitrin görseli resim dosyası olmak zorundadır.Dosya tipi hatalı.',
            'product_showcase.max' => ' Ürün vitrin görselinin dosya boyutu max 2 mb olmalıdır.Daha küçük bir resim ile deneyin.',
        ]);
        if ($validate->fails()) {
            // Validate kısmında herhangi bir hata olunca blade dosyasında hata mesajlarımızı  bastırıyoruz..
            return redirect(route('admin.product.add'))->withErrors($validate);
        }
        $result = null;
        if ($request->hasFile('product_showcase')) {
            $showCaseName = uniqid('PRD-SHC-IMG') . '.' . $request->product_showcase->getClientOriginalExtension();
            $request->product_showcase->move(public_path('images/products'), $showCaseName);
            $result['update'] = Photos::where('product_id', $request->product_unique_id)
                ->where('showcase', '1')->update([
                    'photo' => $showCaseName
                ]);
            if ($result['update']) {
                @unlink(public_path('images/product/' . $request->old_showcase));
            }

        }

        $status = Product::where('id', $id)->update([
            // Veritabanına gönderidğimiz verileri htmlspecialchars ile temizliyoruz
            'product_name' => htmlspecialchars($request->product_name),
            'product_slug' => Str::slug(htmlspecialchars($request->product_name), '-', 'tr'),
            'product_category' => $request->product_category,
            'product_quantity' => $request->product_quantity,
            'product_price' => $request->product_price,
            'product_description' => htmlspecialchars($request->product_description),
        ]);
        if ($status || $result['update']) {
            return redirect(route('admin.prouducts'))->with('success', 'Ürün Düzenleme Başarılı');
        }
        return redirect(route('admin.product.edit', [$id]))->with('error', 'Ürün Düzenleme Başarısız');

    }

    public function urunSil($id)
    {
        // Ürüne ait bütün resimleri ve bilgileri veritabanından siliyoruz.
        if (Photos::where('product_id', $id)->delete() && Product::where('product_id', $id)->delete()) {
            return 1;
        }
        return 0;
    }

}
