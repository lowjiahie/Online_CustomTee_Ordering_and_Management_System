<?php

namespace Database\Seeders;

use App\Models\Type;
use App\Models\Color;
use App\Models\Customer;
use App\Models\CustomTeeDesign;
use App\Models\PlainTeeSize;
use Illuminate\Database\Seeder;
use App\Models\PlainTeeTypeColor;
use App\Models\PrintingMethod;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->createType();
        $this->createColor();
        $this->createPlainTeeTypeColor();
        $this->createCustomer();
        $this->createCustomTee();
        $this->createPlainTeeSizes();
        $this->createPrintingMethods();
    }

    private function createType()
    {
        Type::create([
            'name' => 'Gildan',
            'material' => 'Cotton',
            'description' => 'Soft and comfortable',
            'detail' => 'short T-shirt',
            'price' => 10.00,
        ])->save();

        Type::create([
            'name' => 'Canvas',
            'material' => 'Wood',
            'description' => 'Hard and comfortable',
            'detail' => 'short v-shirt',
            'price' => 12.00,
        ])->save();
    }

    private function createColor()
    {
        Color::create([
            'color_name' => 'Light Green',
            'color_code' => '#2C8B47',
        ])->save();

        Color::create([
            'color_name' => 'Black',
            'color_code' => '#1C1C1C',
        ])->save();

        Color::create([
            'color_name' => 'White',
            'color_code' => '#FFFFFF',
        ])->save();

        Color::create([
            'color_name' => 'Pink',
            'color_code' => '#F37BA9',
        ])->save();

        Color::create([
            'color_name' => 'Red',
            'color_code' => '#AB1715',
        ])->save();
    }

    private function createPlainTeeTypeColor()
    {
        PlainTeeTypeColor::create([
            'plain_tee_img' => "lightGreen-shirt.jpg",
            'color_id' => 'CL00001', //light green
            'type_id' => 'TY00001', //normal shirt
        ])->save();

        PlainTeeTypeColor::create([
            'plain_tee_img' => "black-shirt.jpg",
            'color_id' => 'CL00002', //black
            'type_id' => 'TY00001', //normal shirt
        ])->save();

        PlainTeeTypeColor::create([
            'plain_tee_img' => "white-shirt.jpg",
            'color_id' => 'CL00003', //white
            'type_id' => 'TY00001', //normal shirt
        ])->save();

        PlainTeeTypeColor::create([
            'plain_tee_img' => "pink-vshirt.jpg",
            'color_id' => 'CL00004', //pink
            'type_id' => 'TY00002', //v shirt
        ])->save();

        PlainTeeTypeColor::create([
            'plain_tee_img' => "red-vshirt.jpg",
            'color_id' => 'CL00005', //red
            'type_id' => 'TY00002', //v shirt
        ])->save();
    }

    private function createCustomer()
    {
        Customer::create([
            'name' => 'John Doe',
            'address' => '91,Kampung Baru Bangi, 43000 Kajang, Selangor',
            'phone_num' => '0163762354',
            'email' => 'john@gmail.com',
            'password' => Hash::make('password')
        ])->save();

        Customer::create([
            'name' => 'Wei Jia',
            'email' => 'weijia@gmail.com',
            'password' => Hash::make('password')
        ])->save();
    }

    private function createCustomTee()
    {
        CustomTeeDesign::create([
            'name' => '123',
            'front_design_img' => 'CS00001-123-TC00001-front-preset.jpg',
            'back_design_img' => 'CS00001-123-TC00001-back-preset.jpg',
            'front_design_json' => json_encode('{"version":"5.2.4","objects":[{"type":"line","version":"5.2.4","originX":"left","originY":"top","left":111.62,"top":61.28,"width":150,"height":100,"fill":"#FFFFFF","stroke":"#00FF00","strokeWidth":3,"strokeDashArray":null,"strokeLineCap":"butt","strokeDashOffset":0,"strokeLineJoin":"miter","strokeUniform":false,"strokeMiterLimit":4,"scaleX":1,"scaleY":1,"angle":56.12,"flipX":false,"flipY":false,"opacity":1,"shadow":null,"visible":true,"backgroundColor":null,"fillRule":"nonzero","paintFirst":"fill","globalCompositeOperation":"source-over","skewX":0,"skewY":0,"x1":-75,"x2":75,"y1":-50,"y2":50},{"type":"i-text","version":"5.2.4","originX":"left","originY":"top","left":54,"top":100.93,"width":60,"height":45.2,"fill":"rgb(0,0,0)","stroke":null,"strokeWidth":1,"strokeDashArray":null,"strokeLineCap":"butt","strokeDashOffset":0,"strokeLineJoin":"miter","strokeUniform":false,"strokeMiterLimit":4,"scaleX":1.67,"scaleY":1.67,"angle":0,"flipX":false,"flipY":false,"opacity":1,"shadow":null,"visible":true,"backgroundColor":null,"fillRule":"nonzero","paintFirst":"fill","globalCompositeOperation":"source-over","skewX":0,"skewY":0,"fontFamily":"Times New Roman","fontWeight":"normal","fontSize":40,"text":"123","underline":false,"overline":false,"linethrough":false,"textAlign":"left","fontStyle":"normal","lineHeight":1.16,"textBackgroundColor":null,"charSpacing":0,"styles":[],"direction":"ltr","path":null,"pathStartOffset":0,"pathSide":"left","pathAlign":"baseline"}]}'),
            'back_design_json' => json_encode('{"version":"5.2.4","objects":[{"type":"rect","version":"5.2.4","originX":"left","originY":"top","left":20,"top":71.96,"width":100,"height":100,"fill":"#FFFFFF","stroke":"#00FF00","strokeWidth":3,"strokeDashArray":null,"strokeLineCap":"butt","strokeDashOffset":0,"strokeLineJoin":"miter","strokeUniform":false,"strokeMiterLimit":4,"scaleX":1.62,"scaleY":1.62,"angle":0,"flipX":false,"flipY":false,"opacity":1,"shadow":null,"visible":true,"backgroundColor":null,"fillRule":"nonzero","paintFirst":"fill","globalCompositeOperation":"source-over","skewX":0,"skewY":0,"rx":0,"ry":0},{"type":"i-text","version":"5.2.4","originX":"left","originY":"top","left":90,"top":107,"width":60,"height":45.2,"fill":"rgb(0,0,0)","stroke":null,"strokeWidth":1,"strokeDashArray":null,"strokeLineCap":"butt","strokeDashOffset":0,"strokeLineJoin":"miter","strokeUniform":false,"strokeMiterLimit":4,"scaleX":2.12,"scaleY":2.12,"angle":0,"flipX":false,"flipY":false,"opacity":1,"shadow":null,"visible":true,"backgroundColor":null,"fillRule":"nonzero","paintFirst":"fill","globalCompositeOperation":"source-over","skewX":0,"skewY":0,"fontFamily":"Times New Roman","fontWeight":"normal","fontSize":40,"text":"123","underline":false,"overline":false,"linethrough":false,"textAlign":"left","fontStyle":"normal","lineHeight":1.16,"textBackgroundColor":null,"charSpacing":0,"styles":[],"direction":"ltr","path":null,"pathStartOffset":0,"pathSide":"left","pathAlign":"baseline"}]}'),
            'pt_type_color_id' => 'TC00001',
            'cus_id' => 'CS00001',
        ])->save();

        CustomTeeDesign::create([
            'name' => '1234',
            'front_design_img' => 'CS00001-1234-TC00002-front-preset.jpg',
            'back_design_img' => 'CS00001-1234-TC00002-back-preset.jpg',
            'front_design_json' => json_encode('{"version":"5.2.4","objects":[{"type":"polygon","version":"5.2.4","originX":"left","originY":"top","left":34.5,"top":36.25,"width":100,"height":170,"fill":"#FFFFFF","stroke":"#00FF00","strokeWidth":3,"strokeDashArray":null,"strokeLineCap":"butt","strokeDashOffset":0,"strokeLineJoin":"miter","strokeUniform":false,"strokeMiterLimit":4,"scaleX":1.13,"scaleY":1.13,"angle":0,"flipX":false,"flipY":false,"opacity":1,"shadow":null,"visible":true,"backgroundColor":null,"fillRule":"nonzero","paintFirst":"fill","globalCompositeOperation":"source-over","skewX":0,"skewY":0,"points":[{"x":200,"y":10},{"x":250,"y":50},{"x":250,"y":180},{"x":150,"y":180},{"x":150,"y":50}]},{"type":"i-text","version":"5.2.4","originX":"left","originY":"top","left":78,"top":102.73,"width":60,"height":45.2,"fill":"rgb(0,0,0)","stroke":null,"strokeWidth":1,"strokeDashArray":null,"strokeLineCap":"butt","strokeDashOffset":0,"strokeLineJoin":"miter","strokeUniform":false,"strokeMiterLimit":4,"scaleX":1.91,"scaleY":1.91,"angle":0,"flipX":false,"flipY":false,"opacity":1,"shadow":null,"visible":true,"backgroundColor":null,"fillRule":"nonzero","paintFirst":"fill","globalCompositeOperation":"source-over","skewX":0,"skewY":0,"fontFamily":"Times New Roman","fontWeight":"normal","fontSize":40,"text":"123","underline":false,"overline":false,"linethrough":false,"textAlign":"left","fontStyle":"normal","lineHeight":1.16,"textBackgroundColor":null,"charSpacing":0,"styles":[],"direction":"ltr","path":null,"pathStartOffset":0,"pathSide":"left","pathAlign":"baseline"}]}'),
            'back_design_json' => json_encode('{"version":"5.2.4","objects":[{"type":"rect","version":"5.2.4","originX":"left","originY":"top","left":61,"top":94,"width":100,"height":100,"fill":"#FFFFFF","stroke":"#00FF00","strokeWidth":3,"strokeDashArray":null,"strokeLineCap":"butt","strokeDashOffset":0,"strokeLineJoin":"miter","strokeUniform":false,"strokeMiterLimit":4,"scaleX":1,"scaleY":1,"angle":0,"flipX":false,"flipY":false,"opacity":1,"shadow":null,"visible":true,"backgroundColor":null,"fillRule":"nonzero","paintFirst":"fill","globalCompositeOperation":"source-over","skewX":0,"skewY":0,"rx":0,"ry":0}]}'),
            'pt_type_color_id' => 'TC00002',
            'cus_id' => 'CS00001',
        ])->save();

        CustomTeeDesign::create([
            'name' => '1234',
            'front_design_img' => 'CS00002-1234-TC00001-front-preset.jpg',
            'back_design_img' => 'CS00002-1234-TC00001-back-preset.jpg',
            'front_design_json' => json_encode('{"version":"5.2.4","objects":[{"type":"ellipse","version":"5.2.4","originX":"left","originY":"top","left":11,"top":94.81,"width":160,"height":80,"fill":"#FFFFFF","stroke":"#00FF00","strokeWidth":3,"strokeDashArray":null,"strokeLineCap":"butt","strokeDashOffset":0,"strokeLineJoin":"miter","strokeUniform":false,"strokeMiterLimit":4,"scaleX":1.16,"scaleY":1.16,"angle":0,"flipX":false,"flipY":false,"opacity":1,"shadow":null,"visible":true,"backgroundColor":null,"fillRule":"nonzero","paintFirst":"fill","globalCompositeOperation":"source-over","skewX":0,"skewY":0,"rx":80,"ry":40},{"type":"image","version":"5.2.4","originX":"left","originY":"top","left":37,"top":73.96,"width":200,"height":200,"fill":"rgb(0,0,0)","stroke":null,"strokeWidth":0,"strokeDashArray":null,"strokeLineCap":"butt","strokeDashOffset":0,"strokeLineJoin":"miter","strokeUniform":false,"strokeMiterLimit":4,"scaleX":0.7,"scaleY":0.7,"angle":0,"flipX":false,"flipY":false,"opacity":1,"shadow":null,"visible":true,"backgroundColor":null,"fillRule":"nonzero","paintFirst":"fill","globalCompositeOperation":"source-over","skewX":0,"skewY":0,"cropX":0,"cropY":0,"src":"blob:http:\/\/localhost:3000\/987f1c78-3867-48e8-b2d2-6280930aa4c4","crossOrigin":null,"filters":[]}]}'),
            'back_design_json' => json_encode('{"version":"5.2.4","objects":[]}'),
            'pt_type_color_id' => 'TC00001',
            'cus_id' => 'CS00002',
        ])->save();

        CustomTeeDesign::create([
            'name' => 'qwe',
            'front_design_img' => 'CS00002-qwe-TC00003-front-preset.jpg',
            'back_design_img' => 'CS00002-qwe-TC00003-back-preset.jpg',
            'front_design_json' => json_encode('{"version":"5.2.4","objects":[{"type":"i-text","version":"5.2.4","originX":"left","originY":"top","left":49,"top":92.05,"width":60,"height":45.2,"fill":"rgb(0,0,0)","stroke":null,"strokeWidth":1,"strokeDashArray":null,"strokeLineCap":"butt","strokeDashOffset":0,"strokeLineJoin":"miter","strokeUniform":false,"strokeMiterLimit":4,"scaleX":1.99,"scaleY":1.99,"angle":0,"flipX":false,"flipY":false,"opacity":1,"shadow":null,"visible":true,"backgroundColor":null,"fillRule":"nonzero","paintFirst":"fill","globalCompositeOperation":"source-over","skewX":0,"skewY":0,"fontFamily":"Times New Roman","fontWeight":"normal","fontSize":40,"text":"123","underline":false,"overline":false,"linethrough":false,"textAlign":"left","fontStyle":"normal","lineHeight":1.16,"textBackgroundColor":null,"charSpacing":0,"styles":[],"direction":"ltr","path":null,"pathStartOffset":0,"pathSide":"left","pathAlign":"baseline"}]}'),
            'back_design_json' => json_encode('{"version":"5.2.4","objects":[{"type":"path","version":"5.2.4","originX":"left","originY":"top","left":40.99,"top":55.68,"width":768,"height":853.33,"fill":"rgb(0,0,0)","stroke":null,"strokeWidth":1,"strokeDashArray":null,"strokeLineCap":"butt","strokeDashOffset":0,"strokeLineJoin":"miter","strokeUniform":false,"strokeMiterLimit":4,"scaleX":0.19,"scaleY":0.19,"angle":0,"flipX":false,"flipY":false,"opacity":1,"shadow":null,"visible":true,"backgroundColor":null,"fillRule":"nonzero","paintFirst":"fill","globalCompositeOperation":"source-over","skewX":0,"skewY":0,"path":[["M",896,384],["L",640,384],["L",640,938.666667],["L",554.666667,938.666667],["L",554.666667,682.666667],["L",469.333333,682.666667],["L",469.333333,938.666667],["L",384,938.666667],["L",384,384],["L",128,384],["L",128,298.666667],["L",896,298.666667],["M",512,85.33333300000001],["C",534.63180721783,85.33333299999998,556.3366745186371,94.32378348000117,572.3397787791032,110.32688792800354],["C",588.3428830395692,126.32999237600595,597.3333332652165,148.03485978217,597.333333,170.66666699999996],["C",597.333333,193.29847404456893,588.3428826572699,215.00334119382967,572.3397784255498,231.00644542554983],["C",556.3366741938296,247.00954965727,534.6318070445689,256,512,256],["C",464.87170153186725,255.99999999999997,426.666667,217.79496546813277,426.666667,170.666667],["C",426.666667,123.30666700000002,464.64,85.33333400000002,512,85.33333300000002],["z"]]}]}'),
            'pt_type_color_id' => 'TC00003',
            'cus_id' => 'CS00002',
        ])->save();
    }

    private function createPlainTeeSizes()
    {
        //TC00001
        PlainTeeSize::create([
            'stocks' => 5,
            'size_name' => 'XS',
            'pt_type_color_id' => 'TC00001',
        ])->save();
        PlainTeeSize::create([
            'stocks' => 10,
            'size_name' => 'S',
            'pt_type_color_id' => 'TC00001',
        ])->save();
        PlainTeeSize::create([
            'stocks' => 10,
            'size_name' => 'M',
            'pt_type_color_id' => 'TC00001',
        ])->save();
        PlainTeeSize::create([
            'stocks' => 10,
            'size_name' => 'L',
            'pt_type_color_id' => 'TC00001',
        ])->save();

        //TC00002
        PlainTeeSize::create([
            'stocks' => 10,
            'size_name' => 'S',
            'pt_type_color_id' => 'TC00002',
        ])->save();
        PlainTeeSize::create([
            'stocks' => 10,
            'size_name' => 'M',
            'pt_type_color_id' => 'TC00002',
        ])->save();
        PlainTeeSize::create([
            'stocks' => 10,
            'size_name' => 'L',
            'pt_type_color_id' => 'TC00002',
        ])->save();
        PlainTeeSize::create([
            'stocks' => 10,
            'size_name' => 'XL',
            'pt_type_color_id' => 'TC00002',
        ])->save();

        //TC00003
        PlainTeeSize::create([
            'stocks' => 10,
            'size_name' => 'XS',
            'pt_type_color_id' => 'TC00003',
        ])->save();
        PlainTeeSize::create([
            'stocks' => 10,
            'size_name' => 'S',
            'pt_type_color_id' => 'TC00003',
        ])->save();

        //TC00004
        PlainTeeSize::create([
            'stocks' => 10,
            'size_name' => 'M',
            'pt_type_color_id' => 'TC00004',
        ])->save();
        PlainTeeSize::create([
            'stocks' => 10,
            'size_name' => 'XL',
            'pt_type_color_id' => 'TC00004',
        ])->save();

        //TC00005
        PlainTeeSize::create([
            'stocks' => 10,
            'size_name' => 'L',
            'pt_type_color_id' => 'TC00005',
        ])->save();


    }

    private function createPrintingMethods()
    {
        PrintingMethod::create([
            'name' => 'Digital Printing',
            'price' => '40.00',
            'minimum_order' => 5,
            'status' => 'active',
        ])->save();
        PrintingMethod::create([
            'name' => 'One Screen Printing',
            'price' => '50.00',
            'minimum_order' => 1,
            'status' => 'active',
        ])->save();

        PrintingMethod::create([
            'name' => 'Screen Printing',
            'price' => '30.00',
            'minimum_order' => 10,
            'status' => 'active',
        ])->save();
    }
}
