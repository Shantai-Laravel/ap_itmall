<?php

namespace App\Http\Controllers;

use App\Http\Controllers\PagesController as PageItem;
use Illuminate\Http\Request;
use App\Models\ProductCategory;
use App\Models\Collection;
use App\Models\Product;
use App\Models\ProductTranslation;
use App\Models\SubProduct;
use App\Models\Page;
use App\Models\ParameterValueProduct;
use App\Models\ParameterValue;
use App\Models\ProductSimilar;
use App\Models\ProductPrice;
use App\Models\Set;
use App\Models\SetTranslation;
use App\Models\Promotion;
use App\Models\ProductsCategories;


class ProductsController extends Controller
{
    protected $productRelationship;
    protected $categoryRelationship;
    protected $setRelationship;
    protected $collectionRelationship;

    public function __construct()
    {
        parent::__construct();

        $this->productRelationship = [
            'category.properties.property.parameterValues.translation',
            'category.translation',
            'images',
            'mainImage',
            'setImage',
            'mainPrice',
            'personalPrice',
            'subproducts.parameterValue.translation',
            'subproducts.parameter.translation',
            'subproducts.warehouse',
            'warehouse',
            'translation',
        ];

        $this->categoryRelationship = [
            'translation',
            'children.translation',
            'products.mainImage',
            'products.translation',
            'products.mainPrice',
            'products.personalPrice',
            'params.property.translation',
            'params.property.transData',
            'params.property.parameterValues.translation',
            'params.property.parameterValues.transData',
        ];

        $this->setRelationship = [
            'translation',
            'personalPrice',
            'photos',
            'products.category',
            'products.translation',
            'products.warehouse',
            'products.mainPrice',
            'products.personalPrice',
            'products.mainImage',
            'products.setImages',
            'products.setImage',
            'products.subproducts.parameterValue.translation',
            'products.subproducts.parameter',
            'products.subproducts.warehouse',
            'collection.translation',
            'mainPhoto',
        ];

        $this->collectionRelationship = [
            'translation',
            'sets.translation',
            'sets.personalPrice',
            'sets.photos',
            'sets.mainPhoto',
            'sets.products.category',
            'sets.products.translation',
            'sets.products.warehouse',
            'sets.products.mainPrice',
            'sets.products.personalPrice',
            'sets.products.mainImage',
            'sets.products.setImages',
            'sets.products.setImage',
            'sets.products.subproducts.parameterValue.translation',
            'sets.products.subproducts.parameter',
            'sets.products.subproducts.warehouse',
            'sets.collection.translation',
        ];
    }

    /************************************ Render Methods ***********************
    *
    *  Render single product page
    */
    public function productRender(Request $request, $category, $product)
    {
        $product = Product::with($this->productRelationship)
                        ->where('alias', $product)
                        ->where('active', 1)
                        ->where($this->siteType, 1)
                        // ->where($this->warehouse, 1)
                        ->orderBy('position', 'asc')
                        ->first();

        $category = ProductCategory::where('alias', $category)->first();

        if (is_null($product) || is_null($category)) abort(404);

        $seoData = $this->_getSeo($product);
        $slidersProducts = $this->_getSlidersProducts($product);

        $similarProducts = $slidersProducts['similars'];
        $similarColorProds = $slidersProducts['someColors'];

        return view('front.'. $this->device .'.products.product', compact('seoData', 'category', 'product', 'similarProducts', 'similarColorProds'));
    }

    /**
     *  Render category product page
     */
    public function categoryRender($category)
    {
        $category = ProductCategory::with($this->categoryRelationship)
                                ->where('alias', $category)
                                ->first();

        if (is_null($category)) abort(404);

        $children = null;

        if ($category->children()->count() > 0) {
            $children = $category->children;
        }else{
            if ($category->parent()->count() > 0) {
                $children = $category->parent->children;
            }
        }

        $seoData = $this->_getSeo($category);

        $products = Product::with(['translation', 'mainPrice'])->where('category_id', $category->id)->get();
        $productList = $products;
        $list = "One cat - ".$category->translation->name;

        return view('front.'. $this->device .'.products.category', compact('seoData', 'category', 'children', 'products', 'productList', 'list'));
    }

    /**
     * Render all Products
     */
    public function categoryRenderAll()
    {
        $products = Product::with(['translation', 'mainPrice'])->orderBy('position', 'asc')->where($this->siteType, 1)->get();
        $productList = $products;
        if ($this->siteType == 'homewear') {
            $list = "AllAPL";
        }else{
            $list = "AllAPJ";
        }

        return view('front.'. $this->device .'.products.categoryAll', compact('products', 'productList', 'list'));
    }

    /**
     * Render Collection Page
     */
    public function collectionRender(Request $request, $alias)
    {
        $prodsId = [];
        $collection = Collection::with($this->collectionRelationship)
                                ->where($this->siteType, 1)
                                ->where('alias', $alias)
                                ->first();

        if (is_null($collection)) abort(404);

        $mainSet = Set::with($this->setRelationship)
                        ->where($this->siteType, 1)
                        ->where('id', $request->get('order'))
                        ->first();

        if (!is_null($mainSet)) {
            $otherSets = Set::with($this->setRelationship)
                            ->where($this->siteType, 1)
                            ->where('collection_id', $collection->id)
                            ->where('id', '!=', $mainSet->id)
                            ->get();
        }else{
            $otherSets = $collection->sets;
        }

        $similars = Set::with($this->setRelationship)
                        ->where($this->siteType, 1)
                        ->whereNotIn('id', $collection->sets()->get()->pluck('id')->toArray())
                        ->limit(5)
                        ->inRandomOrder()
                        ->get();

        $seoData = $this->_getSeo($collection);

        foreach ($otherSets as $key => $otherSet) {
            foreach ($otherSet->products as $key => $prod) {
                $prodsId[] = $prod->id;
            }
        }

        $productList = Product::with(['translation', 'mainPrice'])->whereIn('id', $prodsId)->get();
        $list = "coll-one - ". $collection->translation->name;

        return view('front.'. $this->device .'.collections.collections', compact('seoData', 'collection', 'mainSet','otherSets', 'similars', 'productList', 'list'));
    }

    /**
     *  Render New In page
     */
    public function renderNewIn()
    {
        $pageItem = new PageItem;
        $seoData = $pageItem->getPageByAlias('new');
        $list = "New";

        $products = Product::with(['translation', 'mainPrice'])
                            ->where($this->siteType, 1)
                            // ->where($this->warehouse, 1)
                            ->where('discount', 0)
                            ->orderBy('created_at', 'desc')
                            ->where('active', 1)
                            ->get();

        $productList = $products;

        return view('front.'. $this->device .'.products.new', compact('seoData', 'products', 'productList', 'list'));
    }

    /**
     *  Render Outlet page
     */
    public function renderOutlet()
    {
        $pageItem = new PageItem;
        $seoData = $pageItem->getPageByAlias('sale');

        $products = Product::with(['translation', 'mainPrice'])
                            // ->where($this->siteType, 1)
                            ->where($this->siteType, 1)
                            // ->where($this->warehouse, 1)
                            ->where('discount', '>', '0')
                            ->orderBy('discount_update', 'desc')
                            ->where('active', 1)
                            ->get();

        $productList = $products;
        $list = "Outlet";

        return view('front.'. $this->device .'.products.sale', compact('seoData', 'products', 'productList', 'list'));
    }

    /**
     * Render Promotions Page
     */
    public function renderPromotions()
    {
        $promotions = Promotion::with([
                                    'products.category.properties.property.parameterValues.translation',
                                    'products.images',
                                    'products.mainImage',
                                    'products.hoverImage',
                                    'products.category.translation',
                                    'products.subproducts.parameterValue.translation',
                                    'products.subproducts.parameter.translation',
                                    'products.translation',
                                    'products.mainPrice',
                                    'products.personalPrice'])
                                ->where($this->siteType, 1)
                                ->get();


        // dd($promotions);
        return view('front.'. $this->device .'.products.promo', compact('promotions'));
    }

    /************************************ Vue Methods **************************
     *
     *  Get categories/collections lists on home page
     */
    public function getCategoriesOnHome()
    {
        $data['cats'] = ProductCategory::with($this->categoryRelationship)
                                        ->where($this->siteType, 1)
                                        ->where('on_home', 1)
                                        ->where('active', 1)
                                        ->orderBy('position', 'asc')
                                        ->paginate(1);

        $data['cols'] = Collection::with($this->collectionRelationship)
                                    ->where($this->siteType, 1)
                                    ->where('on_home', 1)
                                    ->where('active', 1)
                                    ->orderBy('position', 'asc')
                                    ->paginate(1);
        return $data;
    }

    /**
     * search products
     */
     public function search(Request $request)
     {
         $search = $request->get('search');
         $findProducts = ProductTranslation::where('name', 'like', '%'.$search.'%')
                                        ->get()
                                        ->pluck('product_id')
                                        ->toArray();

        return Product::with($this->productRelationship)
                        ->whereIn('id', $findProducts)
                        // ->where($this->warehouse, 1)
                        ->where('active', 1)
                        ->orderBy('position', 'asc')
                        ->get();
     }

    /**
     *  get new prroducts list
     */
    public function getNewProducts(Request $request)
    {
        return   Product::with($this->productRelationship)
                        ->where($this->siteType, 1)
                        // ->where($this->warehouse, 1)
                        ->where('discount', 0)
                        ->where('active', 1)
                        ->orderBy('position', 'asc')
                        ->paginate(12);
    }

    /**
     *  get outlet products list
     */
    public function getSaleProducts(Request $request)
    {
        $productsPrices = ProductPrice::where('currency_id', @$_COOKIE['currency_id'])->get();
        $prodIds = [];

        foreach ($productsPrices as $key => $productPrice) {
            if ($productPrice->old_price !== $productPrice->price) {
                $prodIds[] = $productPrice->product_id;
            }
        }

        return   Product::with($this->productRelationship)
                            ->where($this->siteType, 1)
                            // ->where($this->warehouse, 1)
                            // ->where('discount', '>', '0')
                            ->orderBy('discount_update', 'desc')
                            ->where('active', 1)
                            ->whereIn('id', $prodIds)
                            ->get();
    }

    /**
     *  get recently view products
     */
    public function getRecentlyProducts(Request $request)
    {
        $recently = [];
        if (@$_COOKIE['view_recently'])  $recently = json_decode(@$_COOKIE['view_recently']);

        return   Product::with($this->productRelationship)
                        ->whereIn('id', $recently)
                        ->where($this->siteType, 1)
                        // ->where($this->warehouse, 1)
                        ->where('active', 1)
                        ->limit(4)
                        ->get();
    }

    /**
     * Filter product list
     */

     public function filter(Request $request)
     {
         $propsProducts =    [];
         $propsSubprods =    [];
         $params =           [];
         $subproducts =      [];
         $dependable =       0;
         $categoriesId = array_filter($request->get('categories'));
         $dependableCategory = ProductCategory::where('id', $request->get('category'))->first();

         $childCategories = ProductCategory::whereIn('parent_id', $categoriesId)->pluck('id')->toArray();

         $allCategoriesId = array_merge($categoriesId, $childCategories);


         if (!is_null($dependableCategory)) {
             if (!is_null($dependableCategory->subproductParameter)) {
                 $dependable = $dependableCategory->subproductParameter->parameter_id;
             }
         }

         foreach ($request->get('properties') as $key => $param) {
             if ($param['name'] != $dependable) {
                 $params[$param['name']][] = $param['value'];
             }else{
                 $subproducts[] = $param;
             }
         }

         foreach ($params as $param => $values) {
             $propIds = [];
             foreach ($values as $key => $value) {
                 $row = ParameterValueProduct::select('product_id')
                                 ->where('parameter_value_id', $value)
                                 ->where('parameter_id', $param)
                                 ->when(count($propsProducts) > 0, function($query) use ($propsProducts){
                                     return $query->whereIn('product_id', $propsProducts);
                                 })
                                 ->pluck('product_id')->toArray();

                 $propIds = array_merge($propIds, $row);
             }
             $propsProducts = $propIds;
         }

         foreach ($subproducts as $key => $value) {
             $row = Subproduct::select('product_id')
                                 ->whereRaw('json_contains(combination, \'{"'.$value['name'].'": '.$value['value'].'}\')')
                                 ->where('active', 1)
                                 ->where('stoc', '>', 0)
                                 ->when(count($propsProducts) > 0, function($query) use ($propsProducts){
                                    return $query->whereIn('product_id', $propsProducts);
                                 })
                                 ->pluck('product_id')->toArray();

             $propsSubprods = array_merge($propsSubprods, $row);
         }


         if ((count($request->get('properties')) > 0) && (count($propsProducts) == 0) && (count($propsSubprods) == 0)) {
             $propsProducts = [0];
         }

         $priceMax = $request->get('priceMax') ??  1000000;
         $priceMin = $request->get('priceMin') ?? 0;

         $products = Product::with($this->productRelationship)
                            ->orderBy('position', 'asc')
                            ->where($this->siteType, 1)
                            // ->where($this->warehouse, 1)
                            ->where('active', 1)
                            ->when(count($allCategoriesId) > 0, function($query) use ($allCategoriesId){
                                return $query->whereIn('category_id', $allCategoriesId);
                            })
                            ->when(count($propsProducts) > 0, function($query) use ($propsProducts){
                               return $query->whereIn('id', $propsProducts);
                           })
                           ->when(count($propsSubprods) > 0, function($query) use ($propsSubprods){
                              return $query->whereIn('id', $propsSubprods);
                            })
                            ->whereHas('personalPrice', function($query) use ($priceMin, $priceMax){
                                $query->where('price', '>=', $priceMin);
                                $query->where('price', '<=', $priceMax);
                            })
                            ->with(['category.properties.property.parameterValues.translation', 'imagesBegin', 'imagesLast', 'images', 'mainImage', 'hoverImage', 'mainPrice', 'personalPrice', 'category.translation', 'subproducts', 'translation', 'warehouse'])
                            // ->where(env('APP_SLUG'), 1)
                            ->paginate(3);

         return $products;
     }

    public function _filter(Request $request)
    {
        $parameters = [];
        $propsProducts = [];
        $dependable = 0;
        $subproducts = [];
        $propsSubprods = [];
        $categoriesId = array_filter($request->get('categories'));
        $dependableCategory = ProductCategory::where('id', $request->get('category'))->first();
        $priceMax = $request->get('priceMax') ??  1000000;
        $priceMin = $request->get('priceMin') ?? 0;

        $childCategories = ProductCategory::whereIn('parent_id', $categoriesId)->pluck('id')->toArray();
        $allCategoriesId = array_merge($categoriesId, $childCategories);

        if (!is_null($dependableCategory)) {
            if (!is_null($dependableCategory->subproductParameter)) {
                $dependable = $dependableCategory->subproductParameter->parameter_id;
            }
        }

        foreach ($request->get('properties') as $key => $param) {
            if ($param['name'] != $dependable) {
                $params[$param['name']][] = $param['value'];
            }else{
                $subproducts[] = $param;
            }
        }

        foreach ($request->get('properties') as $key => $param) {
            if ($param['name'] != $dependable) {
                $parameters[$param['name']][] = $param['value'];
            }
        }

        foreach ($subproducts as $key => $value) {
            $row = Subproduct::where('parameter_id', $value['name'])
                                ->where('value_id', $value['value'])
                                // ->whereRaw('json_contains(combination, \'{"'.$value['name'].'": '.$value['value'].'}\')')
                                ->where('active', 1)
                                // ->where('stoc', '>', 0)
                                ->when(count($propsProducts) > 0, function($query) use ($propsProducts){
                                   return $query->whereIn('product_id', $propsProducts);
                                })
                                ->first();

            if (!is_null($row->warehouse)) {
                if ($row->warehouse->stock > 0) {
                    $propsSubprods = array_merge($propsSubprods, $row->pluck('product_id')->toArray());
                }
            }
        }

        if ((count($request->get('properties')) > 0) && (count($propsProducts) == 0) && (count($propsSubprods) == 0)) {
            $propsProducts = [0];
        }

        // dd($propsProducts);

        foreach ($parameters as $param => $values) {
            $propIds = [];
            foreach ($values as $key => $value) {
                $row = ParameterValueProduct::select('product_id')
                                ->where('parameter_value_id', $value)
                                ->where('parameter_id', $param)
                                ->when(count($propsProducts) > 0, function($query) use ($propsProducts){
                                    return $query->whereIn('product_id', array_unique($propsProducts));
                                })
                                ->pluck('product_id')->toArray();

                $propIds = array_merge($propIds, $row);
            }
            $propsProducts = $propIds;
        }


        if ((count($request->get('properties')) > 0) && (count($propsProducts) == 0)) $propsProducts = [0];

        return  Product::with($this->productRelationship)
                        ->where($this->siteType, 1)
                        // ->where($this->warehouse, 1)
                        ->where('active', 1)
                        ->orderBy('position', 'asc')
                        ->when(count($allCategoriesId) > 0, function($query) use ($allCategoriesId){
                            return $query->whereIn('category_id', $allCategoriesId);
                        })
                        ->when(count($propsSubprods) > 0, function($query) use ($propsSubprods){
                            return $query->whereIn('id', array_unique($propsSubprods));
                         })
                        ->when(count($propsProducts) > 0, function($query) use ($propsProducts){
                            return $query->whereIn('id', $propsProducts);
                        })
                        ->whereHas('personalPrice', function($query) use ($priceMin, $priceMax){
                            $query->where('price', '>=', $priceMin);
                            $query->where('price', '<=', $priceMax);
                        })
                        ->paginate(3);
    }

    public function setDefaultFilter(Request $request)
    {
        $categoryChilds = ProductCategory::where('parent_id', $request->get('category'))->pluck('id')->toArray();
        $categoryChilds = array_merge($categoryChilds, [$request->get('category')]);
        $allProducts = Product::whereIn('category_id', $categoryChilds)->get(); // without pagination

        $data['parameters'] = $this->_getParametersList($allProducts, $request->get('category'));

        $maxPrice = ProductPrice::where('currency_id', $this->currency->id)
                                ->whereIn('product_id', $allProducts->pluck('id')->toArray())
                                ->max('price');

        $data['prices']['min'] = 0;
        $data['prices']['max'] = $maxPrice;

        return $data;
    }

    /**
     *  return subproduct on change size
     */
    public function getSubproductVue(Request $request)
    {
        return  SubProduct::where('product_id', $request->get('productId'))
                                ->where('parameter_id', $request->get('propertyId'))
                                ->where('value_id', $request->get('valueId'))
                                ->where('active', 1)
                                ->where('stoc', '>', 0)
                                ->first();
    }

    /**
     *  return sets by collection
     */
    public function getSets(Request $request)
    {
        return Set::with($this->setRelationship)
                ->where('collection_id', $request->get('collection_id'))
                ->where(env('APP_SLUG'), 1)
                ->paginate(3);
    }

    /************************************** Helpers Methods ********************
     * Get parameters list
     */
    private function _getParametersList($allProducts, $categoryId)
    {
        $dependable = 0;
        $parametersId = ParameterValueProduct::whereIn('product_id', array_filter($allProducts->pluck('id')->toArray()))->pluck('parameter_value_id')->toArray();
        $dependableCategory = ProductCategory::where('id', $categoryId)->first();

        if (!is_null($dependableCategory)) {
            if (!is_null($dependableCategory->subproductParameter)) {
                $dependable = $dependableCategory->subproductParameter->parameter_id;
            }
        }

        $dependebleValues = ParameterValue::where('parameter_id', $dependable)->pluck('id')->toArray();

        $parametersId = array_merge($parametersId, $dependebleValues);
        return json_encode(array_filter($parametersId));
    }

    /**
    * Get items for sliders on product page
    */
    private function _getSlidersProducts($product)
    {
        $products = ['similars', 'someColors'];
        $someColorProdIds = [];
        $category = $product->category;

        // $similarsArr = ProductSimilar::select('category_id')
        //                             ->where('product_id', $product->id)
        //                             ->pluck('category_id')->toArray();

        $similarsArr = $product->similars()->pluck('similar_id')->toArray();

        if (!count($similarsArr)) $similarsArr[] = $category->id;

        if ($product->adjacents->count() > 0) {
            $someColorProdIds = $product->adjacents->pluck('adjacent_id')->toArray();
        }else{
            $colorId = ParameterValueProduct::select('parameter_value_id')
                                        ->where('product_id', $product->id)
                                        ->where('parameter_id', 2)
                                        ->first();
            if (!is_null($colorId)) {
                if ($colorId->parameter_value_id !== 0) {
                    $someColorProdIds = ParameterValueProduct::select('product_id')
                                                        ->where('parameter_value_id', $colorId->parameter_value_id)
                                                        ->where('parameter_id', 2)
                                                        ->pluck('product_id')->toArray();
                }
            }
        }

        if (count($similarsArr) == 0) {
            $products['similars'] = Product::with($this->productRelationship)
                                        ->whereIn('id', $similarsArr)
                                        ->where('id', '!=', $product->id)
                                        ->where('active', 1)
                                        ->where($this->siteType, 1)
                                        // ->where($this->warehouse, 1)
                                        ->get();
        }else{
            $products['similars'] = Product::with($this->productRelationship)
                                        ->where('category_id', $product->category_id)
                                        ->where('id', '!=', $product->id)
                                        ->where('active', 1)
                                        ->where($this->siteType, 1)
                                        // ->where($this->warehouse, 1)
                                        ->limit(10)
                                        ->get();
        }


        $products['someColors'] = Product::with($this->productRelationship)
                                    ->whereIn('id', $someColorProdIds)
                                    ->where('id', '!=', $product->id)
                                    ->where('active', 1)
                                    ->where($this->siteType, 1)
                                    // ->where($this->warehouse, 1)
                                    ->get();
        return $products;
    }

    /**
     *  Get seo datas of categories and products
     */
    private function _getSeo($item)
    {
        $seo['title']       = $item->translation->seo_title ?? $item->translation->name;
        $seo['keywords']    = $item->translation->seo_keywords ?? $item->translation->name;
        $seo['description'] = $item->translation->seo_description ?? $item->translation->name;

        return $seo;
    }
}
