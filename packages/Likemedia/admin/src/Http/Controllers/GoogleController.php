<?php

namespace Admin\Http\Controllers;

use App\Http\Controllers\Controller;
use Admin\Http\Controllers\AutoUploadController;
use Admin\Http\Controllers\CurrenciesController;
use Admin\Http\Controllers\AutoMetaScriptsController;
use Admin\Http\Controllers\AdminController;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\ProductCategory;
use App\Models\Warehouse;
use App\Models\WarehousesStock;
use App\Models\Parameter;
use App\Models\ParameterValue;
use App\Models\ParameterValueProduct;
use App\Models\Promotion;
use App\Models\ProductPrice;
use App\Models\Currency;
use App\Models\SubProduct;
use App\Models\Country;
use App\Models\Lang;
use App\Models\ProductImage;
use App\Models\ProductImageTranslation;
use App\Models\AutometaScript;
use App\Models\TranslationGroup;
use App\Models\Translation;
use App\Models\TranslationLine;
use GuzzleHttp\Client;
use Revolution\Google\Sheets\Facades\Sheets;
use Edujugon\GoogleAds\GoogleAds;
use Google\AdsApi\AdWords\v201809\cm\CampaignService;

use MOIREI\GoogleMerchantApi\Facades\ProductApi;
use MOIREI\GoogleMerchantApi\Facades\OrderApi;

use Session;

class GoogleController extends Controller
{
    public $issetProducts;

    public function googleAdsMain(){}

    public function googleApiContent()
    {
        $countries = Country::where('active', 1)->get();
        $currencies = Currency::get();

        return view('admin::admin.google.apiContent.index', compact('countries', 'currencies'));
    }

    public function insertNewContent(Request $request){}
    public function insertGoogleMerchant($siteType, $lang, $currency, $country, $products = null, $prodIds = []){}

    // Post insert content
    public function insertContent(Request $request){}

    public function googleMerchantApi(){}

    public function index()
    {
        return view('admin::admin.google.index');
    }

    public function getCategoriesId()
    {
        $categories = ProductCategory::orderBy('position', 'asc')->get();
        return view('admin::admin.google.categoriesIdList', compact('categories'));
    }

    public function getTransData()
    {
        ini_set('memory_limit', '-1');
        ini_set('max_execution_time', 900);
        $translationGroups = TranslationGroup::get();
        return view('admin::admin.google.transData', compact('translationGroups'));
    }

    public function setSiteType($siteType)
    {
        $data['homewear'] = 0;
        $data['bijoux'] = 0;

        if ($siteType == 'homewear') { $data['homewear'] = 1; }
        if ($siteType == 'bijoux') { $data['bijoux'] = 1; }

        return $data;
    }

    public function uploadProducts()
    {
        $data = 'Products';
        $view = view('admin::admin.google.progressBar', compact('data'));
        echo $view->render();

        $sheets = Sheets::spreadsheet(config('sheets.post_spreadsheet_id'))
                       ->sheetById(config('sheets.post_sheet_id'))
                       ->all();

        $sheets = $this->parseSheet($sheets);
        $productsID = [];

        if (!empty($sheets)) {
            foreach ($sheets as $key => $item) {

                $siteType = $this->setSiteType($item['Type']);
                $checkProduct = Product::where('alias', $item['alias'])->where('code', $item['code_prod'])->first();

                if (is_null($checkProduct)) {
                    $product = Product::create([
                        'category_id'   => $item['category_id'],
                        'alias'         => $item['alias'],
                        'position'      => $item['position'],
                        'code'          => $item['code_prod'],
                        'homewear'      => $siteType['homewear'],
                        'bijoux'        => $siteType['bijoux'],
                        'active'        => $item['Active']
                    ]);

                    foreach ($this->langs as $key => $oneLang) {
                        $product->translation()->create([
                            'lang_id'   => $oneLang->id,
                            'name'      => $item['prodName_'.$oneLang->lang],
                            'atributes' => $item['Attributes_'.$oneLang->lang],
                        ]);
                    }

                    $productsID[] = $product->id;
                }else{
                    $checkProduct->update([
                        'category_id'   => $item['category_id'],
                        'alias'         => $item['alias'],
                        'position'      => $item['position'],
                        'code'          => $item['code_prod'],
                        'homewear'      => $siteType['homewear'],
                        'bijoux'        => $siteType['bijoux'],
                        'active'        => $item['Active']
                    ]);

                    $checkProduct->translations()->delete();

                    foreach ($this->langs as $key => $oneLang) {
                        $checkProduct->translation()->create([
                            'lang_id'   => $oneLang->id,
                            'name'      => $item['prodName_'.$oneLang->lang],
                            'atributes' => $item['Attributes_'.$oneLang->lang],
                        ]);
                    }
                }
            }
        }

        $products = Product::whereIn('id', $productsID)->get();

        $script = AutometaScript::find(1);
        if (!is_null($script)) {
            $productAll = Product::get();
            $autometa = new AutoMetaScriptsController();
            $autometa->setScriptsToProducts($productAll, $script, 'only_empty');
        }

        $autoupload = new AutoUploadController();

        foreach ($products as $key => $product) {
            // generate subproducts
            $autoupload->generateSubprodusesForProduct($product);

            // generate prices
            $autoupload->generatePrices($product);

            $warehouses = Warehouse::get();
            // generate stocks
            if ($product->subproducts) {
                foreach ($product->subproducts as $key => $subproduct) {
                    foreach ($warehouses as $key => $warehouse) {
                        WarehousesStock::create([
                            'warehouse_id' => $warehouse->id,
                            'product_id' => $product->id,
                            'subproduct_id' => $subproduct->id,
                            'stock' => 0,
                        ]);
                    }
                }
            }else{
                foreach ($warehouses as $key => $warehouse) {
                    WarehousesStock::create([
                        'warehouse_id' => $warehouse->id,
                        'product_id' => $product->id,
                        'subproduct_id' => null,
                        'stock' => 0,
                    ]);
                }
            }
        }

        $admin = new AdminController();
        $admin->checkProductsStocks();
    }

    public function uploadParameters()
    {
        $data = 'Parameters';
        $view = view('admin::admin.google.progressBar', compact('data'));
        echo $view->render();

        $sheets = Sheets::spreadsheet(config('sheets.post_spreadsheet_id'))
                       ->sheetById(1312499570)
                       ->all();

        $sheets = $this->parseSheet($sheets);

        foreach ($sheets as $key => $items) {
            foreach ($items as $key => $item) {
                $parameter = Parameter::where('key', $key)->first();
                if (!is_null($parameter)) {
                    if ($parameter->type !== 'text') {

                    $parameterProductValue = ParameterValueProduct::where('product_id', $items['Prod_ID'])->where('parameter_id', $parameter->id)->first();

                    if (is_null($parameterProductValue)) {
                         ParameterValueProduct::create([
                             'product_id' => $items['Prod_ID'],
                             'parameter_id' => $parameter->id,
                             'parameter_value_id' => $item,
                         ]);
                    }else{
                        $parameterProductValue->update([
                            'parameter_value_id' => $item,
                        ]);
                    }
                }else{
                    $parameterProductValue = ParameterValueProduct::where('product_id', $items['Prod_ID'])->where('parameter_id', $parameter->id)->first();

                    if (is_null($parameterProductValue)) {
                         $param = ParameterValueProduct::create([
                             'product_id' => $items['Prod_ID'],
                             'parameter_id' => $parameter->id,
                             'parameter_value_id' => 0,
                         ]);

                         foreach ($this->langs as $key => $lang) {
                             $param->translations()->create([
                                 'value' => $item,
                                 'lang_id' => $lang->id
                             ]);
                         }
                    }else{
                        $parameterProductValue->update([
                            'parameter_value_id' => 0,
                        ]);
                        $parameterProductValue->translations()->delete();
                        foreach ($this->langs as $key => $lang) {
                            $parameterProductValue->translations()->create([
                                'value' => $item,
                                'lang_id' => $lang->id
                            ]);
                        }
                    }
                }
            }

                }
            }
        // }
    }

    public function uploadPrices()
    {
        $data = 'Prices';
        $view = view('admin::admin.google.progressBar', compact('data'));
        echo $view->render();

        $sheets = Sheets::spreadsheet(config('sheets.post_spreadsheet_id'))
                       ->sheetById(1448833316)
                       ->all();

        $sheets = $this->parseSheet($sheets);

        foreach ($sheets as $key => $items) {
            $product = Product::where('id', $items['Prod_ID'])->first();

            if (!is_null($product)) {
                // $product->update([
                //     'discount' => $items['Discount'],
                //     'promotion_id' => $items['Promo'],
                // ]);
                $this->setProductPrices($product, $items);
            }
        }
    }

    public function setProductPrices($product, $items)
    {
        $autoupload = new AutoUploadController();
        $currencies = Currency::get();
        $mainCurrency = Currency::where('type', 1)->first();
        $mainPrice = ProductPrice::where('currency_id', $mainCurrency->id)->where('product_id', $product->id)->first();

        foreach ($currencies as $key => $currency) {
            $prodPrice = ProductPrice::where('product_id', $product->id)
                                    ->where('currency_id', $currency->id)
                                    ->first();

            if ($currency->abbr == 'EUR') {
                $prodPrice->update([
                        'old_price'     => $items["Retail_old | EUR"],
                        'price'         => $items["Retail_new | EUR"],
                        'b2b_old_price' => $items["B2B_old | EUR"],
                        'b2b_price'     => $items["B2B_new | EUR"],
                ]);
            }elseif($currency->abbr == 'MDL'){
                $prodPrice->update([
                        'old_price'     => $items["Retail_old | MDL"],
                        'price'         => $items["Retail_new | MDL"],
                        'b2b_old_price' => $items["B2B_old | MDL"],
                        'b2b_price'     => $items["B2B_new | MDL"],
                ]);
            }elseif($currency->abbr == 'RON'){
                $prodPrice->update([
                        'old_price'     => $items["Retail_old | RON"],
                        'price'         => $items["Retail_new | RON"],
                        'b2b_old_price' => $items["B2B_old | RON"],
                        'b2b_price'     => $items["B2B_new | RON"],
                ]);
            }

            $autoupload->generateDillerPrices($product->id);
        }

        // foreach ($currencies as $key => $currency) {
        //     $prodPrice = ProductPrice::where('product_id', $product->id)->where('currency_id', $currency->id)->first();
        //     if ($currency->abbr == 'EUR') {
        //         $prodPrice->update([
        //                 'old_price' => $items["Price Retail (Eur)"],
        //                 'price' => (int)$items["Price Retail (Eur)"] - ((int)$items["Price Retail (Eur)"] * $product->discount / 100),
        //                 'b2b_price' => $items["Price B2B (Eur)"],
        //                 'b2b_old_price' => $items["Price B2B (Eur)"],
        //         ]);
        //     }elseif ($currency->abbr == 'MDL') {
        //         $prodPrice->update([
        //                     'old_price' => $items["Price Retail (MDL)"],
        //                     'price' => (int)$items["Price Retail (MDL)"] - ((int)$items["Price Retail (MDL)"] * $product->discount / 100),
        //                     'b2b_price' => 0,
        //                     'b2b_old_price' => 0,
        //                 ]);
        //     }
        //     $currencies = new CurrenciesController();
        //     $autoupload = new AutoUploadController();
        //
        //     $currencies->countByRateProductsPrice($product, $mainCurrency, $currency);
        //     $autoupload->generateDillerPrices($product->id);
        // }
    }

    public function uploadStocks()
    {
        $data = 'Stocks';
        $view = view('admin::admin.google.progressBar', compact('data'));
        echo $view->render();

        $sheets = Sheets::spreadsheet(config('sheets.post_spreadsheet_id'))
                       ->sheetById(1395080368)
                       ->all();

        $sheets = $this->parseSheet($sheets);
        $warehouses = Warehouse::get();

        foreach ($sheets as $key => $item) {
            if ($item['Product ID'] !== '---') {
                $chekWarehouse = WarehousesStock::where('product_id', $item['Product ID'])
                                ->where('subproduct_id', null)
                                ->where('warehouse_id', 2)
                                ->first();

                Product::where('id', $item['Product ID'])->update([
                    'ean_code' => $item['Ean_Code'],
                ]);
                WarehousesStock::where('product_id', $item['Product ID'])->where('subproduct_id', null)->where('warehouse_id', 1)->update([
                    'stock' => $item['Stock_Frisbo'],
                ]);
                WarehousesStock::where('product_id', $item['Product ID'])->where('subproduct_id', null)->where('warehouse_id', 2)->update([
                    'stock' => 100,
                ]);
            }else{
                SubProduct::where('id', $item['Subroduct ID'])->update([
                    'ean_code' => $item['Ean_Code'],
                ]);
                WarehousesStock::where('subproduct_id', $item['Subroduct ID'])->where('warehouse_id', 1)->update([
                    'stock' => $item['Stock_Frisbo'],
                ]);
                WarehousesStock::where('subproduct_id', $item['Subroduct ID'])->where('warehouse_id', 2)->update([
                    'stock' => 100,
                ]);
            }
        }
    }

    public function uploadTranslations()
    {

        $data = 'Translations';
        $view = view('admin::admin.google.progressBar', compact('data'));
        echo $view->render();


        $sheets = Sheets::spreadsheet(config('sheets.post_spreadsheet_id'))
                       ->sheetById(1269036952)
                       ->all();

        $sheets = $this->parseSheetWithLangs($sheets);

        foreach ($sheets as $key => $sheet) {
            $checkTransGroup = TranslationGroup::where('key', $sheet['group key'])->first();

            if (!is_null($checkTransGroup)) {
                $checkTrans = Translation::where('key', $sheet['trans'])->first();
                if (!is_null($checkTrans)) {
                    foreach ($this->langs as $key => $lang) {
                        TranslationLine::where('translation_id', $checkTrans->id)
                                        ->where('lang_id', $lang->id)
                                        ->update([ 'line' => $sheet[$lang->id], ]);
                    }
                }else{
                    $trans = Translation::create([
                        'group_id' => $checkTransGroup->id,
                        'key' => $sheet['trans'],
                    ]);

                    foreach ($this->langs as $key => $lang) {
                        TranslationLine::create([
                            'translation_id' => $trans->id,
                            'lang_id' => $lang->id,
                            'line' => $sheet[$lang->id],
                        ]);
                    }
                }
            }
        }
    }

    public function uploadImages()
    {
        $data = 'Images';
        $view = view('admin::admin.google.progressBar', compact('data'));
        echo $view->render();
        $handeledImages = [];

        $sheets = Sheets::spreadsheet(config('sheets.post_spreadsheet_id'))
                       ->sheetById(903481932)
                       ->all();

        $sheets = $this->parseSheet($sheets);

        foreach ($sheets as $key => $sheet) {
            foreach (array_reverse($sheet) as $keySheet => $sheetItem) {
                $info = $this->getImageType($keySheet);
                if ($info) {
                    $this->insertImage($info, $sheet, $sheetItem);
                    $handeledImages[] = $sheetItem;
                }
            }
            if ($sheet['Video']) {
                $video = $sheet['Video'];
            }else{
                $video = null;
            }
            Product::where('id', $sheet['Prod-ID'])->update(['video' => $video]);
        }

        ProductImage::whereNotIn('href', array_filter($handeledImages))->delete();
    }

    public function insertImage($info, $sheet, $sheetItem)
    {
        if ($sheetItem) {
            // dd($info['type']);
            // Front and Facebook Images
            if ($info['row'] == 'image') {
                if ($info['type'] == 'fb') {
                    $checkFile = file_exists('images/products/fbq/'.$sheetItem);
                }else{
                    $checkFile = file_exists('images/products/og/'.$sheetItem);
                }
                $checkImage = ProductImage::where('href', $sheetItem)->where('product_id', $sheet['Prod-ID'])->first();
                if (is_null($checkImage) && $checkFile) {
                    $image = ProductImage::create([
                                                    'product_id' => $sheet['Prod-ID'],
                                                    'src' => $sheetItem,
                                                    'href' => $sheetItem,
                                                    'type' => $info['type']
                                                ]);

                    $this->setTranslation($image, $sheet['Prod-ID']);
                }elseif (!is_null($checkImage) && $checkFile) {
                    $checkImage->update([
                        'type' => $info['type']
                    ]);
                }
            }

            // Main Image
            if ($info['row'] == 'main') {
                ProductImage::where('product_id', $sheet['Prod-ID'])->where('main', 1)->update([
                    'main' => null,
                ]);
                $findMainImage = ProductImage::where('product_id', $sheet['Prod-ID'])->where('href', $sheetItem)->first();
                if (!is_null($findMainImage)) {
                    $findMainImage->update(['main' => 1, 'type' => null]);
                }else{
                    $checkMainFile = file_exists('images/products/og/'.$sheetItem);
                    if (is_null($findMainImage) &&  $checkMainFile) {
                        $image = ProductImage::create(['product_id' => $sheet['Prod-ID'], 'src' => $sheetItem, 'href' => $sheetItem, 'main' => 1]);
                        $this->setTranslation($image, $sheet['Prod-ID']);
                    }
                }
            }
            // Set Image
            if ($info['row'] == 'set') {
                // ProductImage::where('product_id', $sheet['Prod-ID'])->where('type', 'set')->update([
                //     'type' => null,
                // ]);
                $findSetImage = ProductImage::where('product_id', $sheet['Prod-ID'])
                                            ->where('type', 'set')
                                            ->where('href', $sheetItem)
                                            ->first();

                if (!is_null($findSetImage)) {
                    // $findSetImage->update(['type' => 'set']);
                }else{
                    ProductImage::where('product_id', $sheet['Prod-ID'])->where('type', 'set')->update([
                        'type' => null,
                    ]);
                    $checkFileSet = file_exists('images/products/og/'.$sheetItem);
                    if ($checkFileSet) {
                        $image = ProductImage::create(['product_id' => $sheet['Prod-ID'],'src' => $sheetItem, 'href' => $sheetItem, 'type' => 'set']);
                        $this->setTranslation($image, $sheet['Prod-ID']);
                    }
                }
            }
        }
    }

    public function getImageType($sheetOption)
    {
        $data = false;

        if (strpos($sheetOption, 'Site-im') !== false) {
            $data['type'] = null;
            $data['row'] = 'image';
        }

        if (strpos($sheetOption, 'FB-im') !== false) {
            $data['type'] = 'fb';
            $data['row'] = 'image';
        }

        if ($sheetOption == 'Main') {
            $data['type'] = null;
            $data['row'] = 'main';
        }

        if ($sheetOption == 'Set-Image') {
            $data['type'] = null;
            $data['row'] = 'set';
        }

        return $data;
    }

    public function uploadImages_()
    {
        $data = 'Images';
        $view = view('admin::admin.google.progressBar', compact('data'));
        echo $view->render();

        $sheets = Sheets::spreadsheet(config('sheets.post_spreadsheet_id'))
                        // ->sheetList();
                       ->sheetById(903481932)
                       ->all();
        $sheets = $this->parseSheet($sheets);

        foreach ($sheets as $key => $sheet) {
            $checkImage = ProductImage::where('href', $sheet['Site-im-1'])->where('product_id', $sheet['Prod-ID'])->first();
            $checkFile = file_exists('images/products/og/'.$sheet['Site-im-1']);

            if (is_null($checkImage) && $checkFile) {
                $image = ProductImage::create(['product_id' => $sheet['Prod-ID'], 'src' => $sheet['Site-im-1'], 'href' => $sheet['Site-im-1'], 'main' => 1]);
                $this->setTranslation($image, $sheet['Prod-ID']);
            }

            $checkImage = ProductImage::where('href', $sheet['Site-im-2'])->where('product_id', $sheet['Prod-ID'])->first();
            $checkFile = file_exists('images/products/og/'.$sheet['Site-im-2']);

            if (is_null($checkImage) && $checkFile) {
                $image = ProductImage::create(['product_id' => $sheet['Prod-ID'],'src' => $sheet['Site-im-2'], 'href' => $sheet['Site-im-2'],'main' => 0]);
                $this->setTranslation($image, $sheet['Prod-ID']);
            }

            $checkImage = ProductImage::where('href', $sheet['Site-im-3'])->where('product_id', $sheet['Prod-ID'])->first();
            $checkFile = file_exists('images/products/og/'.$sheet['Site-im-3']);

            if (is_null($checkImage) && $checkFile) {
                $image = ProductImage::create(['product_id' => $sheet['Prod-ID'],'src' => $sheet['Site-im-3'], 'href' => $sheet['Site-im-3'],'main' => 0]);
                $this->setTranslation($image, $sheet['Prod-ID']);
            }

            $checkImage = ProductImage::where('href', $sheet['Site-im-4'])->where('product_id', $sheet['Prod-ID'])->first();
            $checkFile = file_exists('images/products/og/'.$sheet['Site-im-4']);

            if (is_null($checkImage) && $checkFile) {
                $image = ProductImage::create(['product_id' => $sheet['Prod-ID'],'src' => $sheet['Site-im-4'], 'href' => $sheet['Site-im-4'],'main' => 0]);
                $this->setTranslation($image, $sheet['Prod-ID']);
            }

            $checkImage = ProductImage::where('href', $sheet['Site-im-5'])->where('product_id', $sheet['Prod-ID'])->first();
            $checkFile = file_exists('images/products/og/'.$sheet['Site-im-5']);

            if (is_null($checkImage) && $checkFile) {
                $image = ProductImage::create(['product_id' => $sheet['Prod-ID'],'src' => $sheet['Site-im-5'], 'href' => $sheet['Site-im-5'],'main' => 0]);
                $this->setTranslation($image, $sheet['Prod-ID']);
            }

            $checkImageFB = ProductImage::where('href', $sheet['FB-im-1'])->where('product_id', $sheet['Prod-ID'])->first();
            $checkFileFB = file_exists('images/products/fbq/'.$sheet['FB-im-1']);

            if (is_null($checkImageFB) &&  $checkFileFB) {
                $image = ProductImage::create(['product_id' => $sheet['Prod-ID'],'src' => $sheet['FB-im-1'], 'href' => $sheet['FB-im-1'], 'type' => 'fb']);
                $this->setTranslation($image, $sheet['Prod-ID']);
            }

            $checkImageFB = ProductImage::where('href', $sheet['FB-im-2'])->where('product_id', $sheet['Prod-ID'])->first();
            $checkFileFB = file_exists('images/products/fbq/'.$sheet['FB-im-2']);

            if (is_null($checkImageFB) &&  $checkFileFB) {
                $image = ProductImage::create(['product_id' => $sheet['Prod-ID'],'src' => $sheet['FB-im-2'], 'href' => $sheet['FB-im-2'], 'type' => 'fb']);
                $this->setTranslation($image, $sheet['Prod-ID']);
            }

            $checkImageFB = ProductImage::where('href', $sheet['FB-im-3'])->where('product_id', $sheet['Prod-ID'])->first();
            $checkFileFB = file_exists('images/products/fbq/'.$sheet['FB-im-3']);

            if (is_null($checkImageFB) &&  $checkFileFB) {
                $image = ProductImage::create(['product_id' => $sheet['Prod-ID'],'src' => $sheet['FB-im-3'], 'href' => $sheet['FB-im-3'], 'type' => 'fb']);
                $this->setTranslation($image, $sheet['Prod-ID']);
            }

            $checkImageFB = ProductImage::where('href', $sheet['FB-im-4'])->where('product_id', $sheet['Prod-ID'])->first();
            $checkFileFB = file_exists('images/products/fbq/'.$sheet['FB-im-4']);

            if (is_null($checkImageFB) &&  $checkFileFB) {
                $image = ProductImage::create(['product_id' => $sheet['Prod-ID'],'src' => $sheet['FB-im-4'], 'href' => $sheet['FB-im-4'], 'type' => 'fb']);
                $this->setTranslation($image, $sheet['Prod-ID']);
            }

            $checkImageFB = ProductImage::where('href', $sheet['FB-im-5'])->where('product_id', $sheet['Prod-ID'])->first();
            $checkFileFB = file_exists('images/products/fbq/'.$sheet['FB-im-5']);

            if (is_null($checkImageFB) &&  $checkFileFB) {
                $image = ProductImage::create(['product_id' => $sheet['Prod-ID'],'src' => $sheet['FB-im-5'], 'href' => $sheet['FB-im-5'], 'type' => 'fb']);
                $this->setTranslation($image, $sheet['Prod-ID']);
            }

            $checkImageFB = ProductImage::where('href', $sheet['FB-im-6'])->where('product_id', $sheet['Prod-ID'])->first();
            $checkFileFB = file_exists('images/products/fbq/'.$sheet['FB-im-6']);

            if (is_null($checkImageFB) &&  $checkFileFB) {
                $image = ProductImage::create(['product_id' => $sheet['Prod-ID'],'src' => $sheet['FB-im-6'], 'href' => $sheet['FB-im-6'], 'type' => 'fb']);
                $this->setTranslation($image, $sheet['Prod-ID']);
            }

            $checkImageFB = ProductImage::where('href', $sheet['FB-im-7'])->where('product_id', $sheet['Prod-ID'])->first();
            $checkFileFB = file_exists('images/products/fbq/'.$sheet['FB-im-7']);

            if (is_null($checkImageFB) &&  $checkFileFB) {
                $image = ProductImage::create(['product_id' => $sheet['Prod-ID'],'src' => $sheet['FB-im-7'], 'href' => $sheet['FB-im-7'], 'type' => 'fb']);
                $this->setTranslation($image, $sheet['Prod-ID']);
            }

            $checkImageFB = ProductImage::where('href', $sheet['FB-im-8'])->where('product_id', $sheet['Prod-ID'])->first();
            $checkFileFB = file_exists('images/products/fbq/'.$sheet['FB-im-8']);

            if (is_null($checkImageFB) &&  $checkFileFB) {
                $image = ProductImage::create(['product_id' => $sheet['Prod-ID'],'src' => $sheet['FB-im-8'], 'href' => $sheet['FB-im-8'], 'type' => 'fb']);
                $this->setTranslation($image, $sheet['Prod-ID']);
            }

            $checkImageFB = ProductImage::where('href', $sheet['FB-im-9'])->where('product_id', $sheet['Prod-ID'])->first();
            $checkFileFB = file_exists('images/products/fbq/'.$sheet['FB-im-9']);

            if (is_null($checkImageFB) &&  $checkFileFB) {
                $image = ProductImage::create(['product_id' => $sheet['Prod-ID'],'src' => $sheet['FB-im-9'], 'href' => $sheet['FB-im-9'], 'type' => 'fb']);
                $this->setTranslation($image, $sheet['Prod-ID']);
            }

            $checkImageFB = ProductImage::where('href', $sheet['FB-im-10'])->where('product_id', $sheet['Prod-ID'])->first();
            $checkFileFB = file_exists('images/products/fbq/'.$sheet['FB-im-10']);

            if (is_null($checkImageFB) &&  $checkFileFB) {
                $image = ProductImage::create(['product_id' => $sheet['Prod-ID'],'src' => $sheet['FB-im-10'], 'href' => $sheet['FB-im-10'], 'type' => 'fb']);
                $this->setTranslation($image, $sheet['Prod-ID']);
            }

            // Main Image
            // if (array_key_exists('Main', $sheet)) {
                ProductImage::where('product_id', $sheet['Prod-ID'])->where('main', 1)->update([
                    'main' => null,
                ]);
                $findMainImage = ProductImage::where('product_id', $sheet['Prod-ID'])->where('href', $sheet['Main'])->first();
                if (!is_null($findMainImage)) {
                    $findMainImage->update(['main' => 1]);
                }else{
                    $checkFileSet = file_exists('images/products/og/'.$sheet['Main']);
                    if (is_null($findMainImage) &&  $checkFileSet) {
                        $image = ProductImage::create(['product_id' => $sheet['Prod-ID'],'src' => $sheet['Main'], 'href' => $sheet['Main'], 'main' => 1]);
                        $this->setTranslation($image, $sheet['Prod-ID']);
                    }
                }
            // }

            // Set Image
            // if (array_key_exists('Set-Image', $sheet)) {
                ProductImage::where('product_id', $sheet['Prod-ID'])->where('type', 'set')->update([
                    'type' => 0,
                ]);

                $findSetImage = ProductImage::where('product_id', $sheet['Prod-ID'])
                                        ->where('href', $sheet['Set-Image'])
                                        ->first();

                if (!is_null($findSetImage)) {
                    $findSetImage->update(['type' => 'set']);
                }else{
                    $checkFileSet = file_exists('images/products/og/'.$sheet['Set-Image']);

                    if ($checkFileSet) {
                        $image = ProductImage::create(['product_id' => $sheet['Prod-ID'],'src' => $sheet['Set-Image'], 'href' => $sheet['Set-Image'], 'type' => 'set']);
                        $this->setTranslation($image, $sheet['Prod-ID']);
                    }
                }

            Product::where('id', $sheet['Prod-ID'])->update(['video' => $sheet['Video']]);
        }
    }

    public function setTranslation($image, $productId)
    {
        foreach ($this->langs as $lang){
            ProductImageTranslation::create( [
                'product_image_id' => $image->id,
                'lang_id' =>  $lang->id,
            ]);
        }
    }

    public function getParametersId()
    {
        $products = Product::get();
        $parameters = Parameter::orderBy('type', 'asc')->get();
        $promotions = Promotion::get();

        return view('admin::admin.google.parametersIdList', compact('products', 'parameters', 'parameterValues', 'promotions'));
    }

    public function getSubproductsId()
    {
        $products = Product::get();

        return view('admin::admin.google.subproductsIdList', compact('products'));
    }

    public function parseSheet($sheets)
    {
        $keys = $sheets[0];
        $arr = [];

        foreach ($sheets as $key => $sheet) {
            if ($key !== 0) {
                for ($i=0; $i < count($keys); $i++) {
                    if (array_key_exists($i, $sheet)) {
                        $arr[$key][$keys[$i]] = $sheet[$i];
                    }else{
                        $arr[$key][$keys[$i]] = 0;
                    }
                }
            }
        }
        return $arr;
    }

    public function parseSheetWithLangs($sheets)
    {
        $keys = $sheets[0];
        $arr = [];

        foreach ($sheets as $key => $sheet) {
            if ($key !== 0) {
                for ($i=0; $i < count($keys); $i++) {
                    $langKey = $this->getLangId($keys[$i]);
                    if ($langKey > 0) {
                        $keys[$i] = $langKey;
                    }
                    if (array_key_exists($i, $sheet)) {
                        $arr[$key][$keys[$i]] = $sheet[$i];
                    }else{
                        $arr[$key][$keys[$i]] = 0;
                    }
                }
            }
        }
        return $arr;
    }

    public function getLangId($langAbbr)
    {
        $ret = 0;
        foreach ($this->langs as $key => $lang) {
            if ($langAbbr == $lang->lang) {
                $ret = $lang->id;
            }
        }

        return $ret;
    }


    public function getProducts()
    {
        $sheets = Sheets::spreadsheet(config('sheets.post_spreadsheet_id'))
                       ->sheetById(config('sheets.post_sheet_id'))
                       ->all();

        return view('admin::admin.google.progressBar');
    }
}
