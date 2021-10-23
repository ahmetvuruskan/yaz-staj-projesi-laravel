<?php

namespace App\Http\Controllers;

use App\Models\Sliders;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Intervention\Image\Facades\Image;
use function Symfony\Component\String\s;

class SliderController extends Controller
{
    public function index()
    {
        $slider = Sliders::all();
        return view('Admin.Sliders.index')->with('sliders', $slider);
    }

    public function addNew()
    {
        return view('Admin.Sliders.addslider');
    }

    public function saveSlider(Request $request)
    {
        $validate = Validator::make($request->all(), [
            'slider_image' => 'bail|required|image|max:2048|',
            'slider_url' => 'bail|url'
        ], [
            'slider_image.image' => 'Yüklemeye çalıştığınız dosyanın formatı hatalıdır.',
            'slider_image.required'=>'Slider resim alanı zorunludur litfen bir resim seçiniz.' ,
            'slider_image.max' => 'Yüklemeye çalıştığınız dosyanın boyutu max 2mb olmalıdır.',
            'slider_url.url' => 'Url kısmı geçerli bir url olmalıdır. Girdiğiniz url geçersizdir.'
        ]);
        if ($validate->fails()) {
            $request->flash();
            return redirect(route('admin.slider.add'))->withErrors($validate);
        }

        $image = $request->file('slider_image');
        $filePath = public_path('images\sliders');
        $fileName = uniqid('SLIDER-IMG-') . '.' . $image->extension();
        $img = Image::make($image->getRealPath());
        $img->resize(900, 387, function ($const) {

        })->save( $filePath.'/'.$fileName);


        $insert = Sliders::insert([
            'slider_photo' => $fileName,
            'slider_description' => htmlspecialchars($request->slider_description),
            'slider_url' => htmlspecialchars($request->slider_url),
            'slider_header' => htmlspecialchars($request->slider_header),
            'slider_must'=>htmlspecialchars($request->slider_must)
        ]);
        if ($insert) {
            return redirect(route('admin.sliders'))->with('success', 'Slider ekleme işlemi başarılı');
        }
        return redirect(route('admin.sliders'))->with('error','Slider ekleme işlemi başarısız.');
    }
    public function edit($id){
        $slider = Sliders::find($id);
        return view('Admin.Sliders.editslider')->with('slider',$slider);
    }
    public function update(Request $request,$id){
        $update = null;
        $updateWihtImage = null;
        $validate = Validator::make($request->all(), [
            // Gelen requestlerimizi doğrulama işlemine tabii tutuyoruz..
            'slider_image' => 'bail|required|image|max:2048|',
            'slider_url' => 'bail|url'
        ], [
            'slider_image.image' => 'Yüklemeye çalıştığınız dosyanın formatı hatalıdır.',
            'slider_image.required'=>'Slider resim alanı zorunludur litfen bir resim seçiniz.' ,
            'slider_image.max' => 'Yüklemeye çalıştığınız dosyanın boyutu max 2mb olmalıdır.',
            'slider_url.url' => 'Url kısmı geçerli bir url olmalıdır. Girdiğiniz url geçersizdir.'
        ]);
        if ($validate->fails()) {
            $request->flash();
            return redirect(route('admin.slider.add'))->withErrors($validate);
        }
        if ($request->hasFile('slider_image')){
            /* Düzenleme sayfasından resimle birlikte geliyorsa bu kısım çalışıp resiimi 1600*688  olarak public\images\sliders
            * kısmına kaydedip veritabanında update işlemini gerçekleştiriyor.
            */
            $image = $request->file('slider_image');
            $filePath = public_path('images\sliders');
            $fileName = uniqid('SLIDER-IMG-') . '.' . $image->extension();
            $img = Image::make($image->getRealPath());
            $img->resize(900, 359, function ($const) {

            })->save( $filePath.'/'.$fileName);

            $updateWihtImage = Sliders::where('id',$id)->update([
                'slider_photo' => $fileName,
                'slider_description' => htmlspecialchars($request->slider_description),
                'slider_url' => htmlspecialchars($request->slider_url),
                'slider_header' => htmlspecialchars($request->slider_header),
                'slider_must'=>htmlspecialchars($request->slider_must)
            ]);

        }else{
            // Resimsiz slider güncelleme işlemi
            $update = Sliders::where('id',$id)->update([
                'slider_description' => htmlspecialchars($request->slider_description),
                'slider_url' => htmlspecialchars($request->slider_url),
                'slider_header' => htmlspecialchars($request->slider_header),
                'slider_must'=>htmlspecialchars($request->slider_must)
            ]);
        }
        if ($update){
            // Resim dosyası olmadan güncelleme işlemi
            return redirect(route('admin.sliders'))->with('success','Slider başarı ile düzenlendi');
        }elseif ($updateWihtImage && @unlink(public_path('/images/sliders/'.$request->old_image))){
            //Resim dosyası varken güncelleme ve eski dosyayı silme işlemi
            return redirect(route('admin.sliders'))->with('success','Slider başarı ile düzenlendi');
        }
        // Hata durumu
        return redirect(route('admin.sliders'))->with('error','Slider düzenleme işlemi başarısız');
    }
    public function delete($id){
        // Ajaxdan gelen id değerine göre veritabanından ve sliderlerin resminin tutulduğu dizinden dosyaları siliyor.
        $slider  =Sliders::find($id);
       if ($slider->delete() && @unlink(public_path('images/sliders/'.$slider->slider_photo))){
           return 1;
       }else{
           return  0 ;
       }
    }
}
