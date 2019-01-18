<?php

namespace App\Console\Commands;

use App\Category;
use App\Offer;
use App\Product;
use Illuminate\Console\Command;

class FillupProducts extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'fillup:products';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Fills up DB with products from https://markethot.ru/export/bestsp';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        // заполнение БД популярными товарами
        $url = "https://markethot.ru/export/bestsp";
        $importProducts = json_decode(file_get_contents($url), true)['products'];
        foreach($importProducts as $importProduct) {

            // todo: валидация?

            // товар
            $product = Product::updateOrCreate(
                [
                    'id'            => $importProduct['id']
                ],
                [
                    'title'         => $importProduct['title'],
                    'image'         => $importProduct['image'],
                    'description'   => $importProduct['description'],
                    'first_invoice' => $importProduct['first_invoice'],
                    'url'           => $importProduct['url'],
                    'price'         => $importProduct['price'],
                    'amount'        => $importProduct['amount'],
                ]
            );

            // вариации товара
            $importOffers = $importProduct['offers'];
            foreach($importOffers as $importOffer) {
                $product->offers()->updateOrCreate(
                    [
                        'id'            => $importOffer['id']
                    ],
                    [
                        'price'         => $importOffer['price'],
                        'amount'        => $importOffer['amount'],
                        'sales'         => $importOffer['sales'],
                        'article'       => $importOffer['article'],
                    ]
                );
            }

            // категории товара
            $importCategories = $importProduct['categories'];
            $importCategoriesIds = collect($importCategories)->pluck('id')->toArray();
            foreach($importCategories as $importCategory) {
                $category = Category::updateOrCreate(
                    [
                        'id'        => $importCategory['id']
                    ],
                    [
                        'title'     => $importCategory['title'],
                        'alias'     => $importCategory['alias'],
                        'parent'    => $importCategory['parent'],
                    ]
                );
            }
            $product->categories()->sync($importCategoriesIds);
        }
        
        $this->info('DB fills up with best seller products');
    }
}
