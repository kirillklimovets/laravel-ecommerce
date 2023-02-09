<?php

namespace App\Http\Controllers;

use Algolia\AlgoliaSearch\Exceptions\AlgoliaException;
use Algolia\AlgoliaSearch\Exceptions\ObjectNotFoundException;
use Algolia\AlgoliaSearch\RecommendClient;
use Algolia\AlgoliaSearch\SearchClient;
use App\Models\Product;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Log;
use Illuminate\View\View;

class ShopController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return View
     */
    public function index(): View
    {
        return view('pages.shop.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  string  $slug
     *
     * @return View
     * @throws \Algolia\AlgoliaSearch\Exceptions\ObjectNotFoundException
     */
    public function show(string $slug): View
    {
        $product         = Product::where('slug', $slug)->firstOrFail();
        $relatedProducts = $this->getRelatedProducts($product);

        return view('pages.shop.show', compact('product', 'relatedProducts'));
    }

    /**
     * Get related products for a given product.
     *
     * @param  \App\Models\Product  $product
     *
     * @return \Illuminate\Support\Collection|false
     * @throws \Algolia\AlgoliaSearch\Exceptions\ObjectNotFoundException
     */
    protected function getRelatedProducts(Product $product): Collection|false
    {
        $searchClient  = SearchClient::create(env('ALGOLIA_APP_ID'), env('ALGOLIA_SECRET'));
        $index         = $searchClient->initIndex(Product::getIndexName());
        $algoliaObject = $index->findObject(fn($object) => $object['id'] === $product->id)['object'];

        $recommendClient = RecommendClient::create(env('ALGOLIA_APP_ID'), env('ALGOLIA_SECRET'));

        try {
            return collect($recommendClient->getRelatedProducts([
                [
                    'indexName'          => Product::getIndexName(),
                    'objectID'           => $algoliaObject['objectID'],
                    'maxRecommendations' => config('shop.maxRecommendations', 4),
                ],
            ])['results'][0]['hits'])->map(fn($product) => Product::find($product['id']));
        } catch (AlgoliaException|ObjectNotFoundException $e) {
            Log::error('There is an error when retrieving related products: '.$e->getMessage());

            return false;
        }
    }
}
