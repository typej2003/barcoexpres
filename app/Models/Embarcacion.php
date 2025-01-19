<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Cookie;

class Embarcacion extends Model
{
    use HasFactory;

    const STATUS_ACTIVE = 'active';
    const STATUS_NOACTIVE = 'noactive';

    public $currencyValue;

    protected $listeners = [
        'emitCurrency' => 'emitCurrency'
    ];

    protected $fillable = [
        'area_id',
        'user_id',
        'comercio_id',
        'category_id',
        'subcategory_id',
        'subcategories',
        'code',
        'name',
        'image_path1',
        'image_path2',
        'image_path3',
        'image_path4',
        'video_path1',
        'manufacturer_id',
        'details1',
        'condition',
        'eslora',
        'manga',
        'fe_fabricacion',
        'color',
        'material',
        'maximumcrew',
        'nroengines',
        'anno_motor',
        'enginebrand',
        'enginemodel',
        'enginetype',
        'hoursofuse',
        'power',
        'estereo',
        'negotiable',
        'additional_information',
        'currency',
        'price1',
        'price2',
        'price_offer',
        'price_divisa',
        'stock_min',
        'stock_max',
        'stock',
        'in_pickup',
        'in_delivery',
        'in_envio_nacional',
        'madein',
        'in_pedido',
        'in_offer',
        'ca_valoracion',
        'in_valido',
        'matricula',
        'distintivollamada',
        'nroomi',
        'nrommsi',
        'armador',
        'puntal',
        'arqueobruto',
        'arqueoneto',
        'capacidadcombustible',
        'capacidadalmacenamiento',
        'puertoregistro',
        'artepesca',
        'userCreated_at',
        'userUpdated_at',
    ];

    protected $appends = [
        'image1_url',
        'image2_url',
        'image3_url',
        'image4_url',
    ];
        
    public function valoracionBoat()
    {
        return $this->hasOne(ValoracionBoat::class, 'embarcacion_id', 'id')->withDefault([
            'ca_valoracion' => '0',
            'class' => 'star',
            'comment' => '',
        ]);
    }

    public function manufacturer()
    {
        return $this->hasOne(Manufacturer::class, 'manufacturer_id', 'id');
    }

    public function categories()
    {
        return $this->hasMany(Category::class, 'id', 'category_id');
    }

    public function subcategories()
    {
        return $this->hasMany(Subcategory::class, 'subcategory_id', 'id');
    }

    public function user()
    {
        return $this->hasOne(User::class, 'id', 'user_id');
    }

    public function comercio()
    {
        return $this->hasOne(Comercio::class, 'id', 'comercio_id');
    }

    public function area()
    {
        return $this->hasOne(Area::class, 'id', 'area_id');
    }

    public function getImage1UrlAttribute()
    {
        if ($this->image_path1 && Storage::disk('avatarsboats')->exists($this->image_path1)) {   
            return Storage::disk('avatarsboats')->url($this->image_path1);
        }
        return asset('noimage.png');
    }

    public function getImage2UrlAttribute()
    {
        if ($this->image_path2 && Storage::disk('avatarsboats')->exists($this->image_path2)) {   
            return Storage::disk('avatarsboats')->url($this->image_path2);
        }
        return asset('noimage.png');
    }

    public function getImage3UrlAttribute()
    {
        if ($this->image_path3 && Storage::disk('avatarsboats')->exists($this->image_path3)) {   
            return Storage::disk('avatarsboats')->url($this->image_path3);
        }
        return asset('noimage.png');
    }

    public function getImage4UrlAttribute()
    {
        if ($this->image_path4 && Storage::disk('avatarsboats')->exists($this->image_path4)) {   
            return Storage::disk('avatarsboats')->url($this->image_path4);
        }
        return asset('noimage.png');
    }

    public function getPrice1()
    {
        $settingComercio = SettingComercio::where('comercio_id', $this->comercio_id)->first();

        $setting = Setting::where('user_id', $this->user_id)->first();

        $currency = request()->cookie('currency');

        if(empty($currency) || is_null($currency) ){
            $setting = SettingComercio::where('comercio_id', 1)->first();
            $currency = $setting->currency;
        }
        
        $tasaValues = Tasa::where('comercio_id', $this->comercio_id)->where('status', 'activo')->first();

        if(!$tasaValues){
            $tasa = 1;
        }else{
            $tasa = $tasaValues->tasa;
        }
        
        switch ($currency) {
            case 'Bs':
                return round($tasa * $this->price1, 2);
                break;            
            case '$':
                return round($this->price1, 2);                
                break;
        }
    }

    public function getImpuestoProduct()
    {
        $tasa = 1;

        $settingComercio = SettingComercio::where('comercio_id', $this->comercio_id)->first();

        $setting = Setting::where('user_id', $this->user_id)->first();
        
        if(auth()->user()){
            $settingComercio = SettingComercio::where('user_id', auth()->user()->id)->first();
            if($settingComercio){
                $currency = $settingComercio->currency;
            }else{
                $currency = $setting->currency;
            }            
        }else{
            $currency = request()->cookie('currency');
        }

        switch ($currency) {
            case 'Bs':
                if($settingComercio->in_impuesto){
                    $impuesto = Impuesto::where('name', 'IVA')->first();
                    if($impuesto){
                        $result = $tasa * $this->price1*$impuesto->amount;
                    }else{
                        $result = 0;
                    }
                }
                return round($result, 2);
                break;            
            case '$':
                return round($this->price1, 2);                
                break;
        }
    }

    public function getPriceSinImpuesto()
    {
        $tasa = 1;
        $settingComercio = SettingComercio::where('comercio_id', $this->comercio_id)->first();

        $setting = Setting::where('user_id', $this->user_id)->first();
        
        if(auth()->user()){
            $settingComercio = SettingComercio::where('user_id', auth()->user()->id)->first();
            if($settingComercio){
                $currency = $settingComercio->currency;
            }else{
                $currency = $setting->currency;
            }            
        }else{
            $currency = request()->cookie('currency');
        }

        switch ($currency) {
            case 'Bs':
                if($settingComercio->in_impuesto){
                    $impuesto = Impuesto::where('name', 'IVA')->first();
                    if($impuesto){
                        $result = $tasa * $this->price1 - $tasa * $this->price1*$impuesto->amount;
                    }else{
                        $result = $tasa * $this->price1;
                    }
                }else{
                    $result = $tasa * $this->price1;
                }
                return round($result, 2);
                break;            
            case '$':
                return round($this->price1, 2);                
                break;
        }
    }

    public function getPriceIGTF()
    {
        $tasa = 1;

        $settingComercio = SettingComercio::where('comercio_id', $this->comercio_id)->first();

        $setting = Setting::where('user_id', $this->user_id)->first();
        
        if(auth()->user()){
            $settingComercio = SettingComercio::where('user_id', auth()->user()->id)->first();
            if($settingComercio){
                $currency = $settingComercio->currency;
            }else{
                $currency = $setting->currency;
            }            
        }else{
            $currency = request()->cookie('currency');
        }

        switch ($currency) {
            case 'Bs':
                if($settingComercio->in_impuesto){
                    $impuesto = Impuesto::where('name', 'IVA')->first();
                    if($impuesto){
                        $result = $tasa * $this->price1 - $tasa * $this->price1*$impuesto->amount;
                    }else{
                        $result = $tasa * $this->price1;
                    }
                }else{
                    $result = $tasa * $this->price1;
                }
                return round($result, 2);
                break;            
            case '$':
                if($settingComercio->in_impuesto){
                    $impuesto = Impuesto::where('name', 'IGTF')->first();
                    if($impuesto){
                        $result = $tasa * $this->price1*$impuesto->amount;
                    }else{
                        $result = 0;
                    }
                }else{
                    $result = 0;
                }
                return round($result, 2);
                break;
        }
    }

    public function getPrice_offer()
    {
        $settings = SettingComercio::where('user_id', $this->user_id)->first();

        $tasaValues = Tasa::where('user_id', $this->user_id)->where('status', 'activo')->first();

        if(!$tasaValues){
            $tasa = 1;
        }else{
            $tasa = $tasaValues->tasa;
        }

        switch ($settings->currency) {
            case 'Bs':
                return round($tasa * $this->price_offer, 2);
                break;            
            case '$':
                return round($this->price_offer, 2);
                break;
            case '€':
                return 0;
                break;
        }
    }

    public function showSubcategories()
    {
        $categorias = CategoriesProduct::where('product_id', $this->id)->where('comercio_id', $this->comercio_id)->get();
        return $categorias;
        
    }

}

