<?php
namespace App\Helpers;

use App\Models\Product;
use Illuminate\Support\Facades\Cookie;

class CartMangement{
    // add item to cart
    static public function addItemToCart($product_id){
       $cart_items = self::getCartItemsFromCookie();
       $exising_item = null;
       foreach($cart_items as $key => $item){
           if($item['product_id'] == $product_id){
               $exising_item = $key;
               break;
           }
       }
       if($exising_item !== null){
           $cart_items[$exising_item]['quantity']++;
           $cart_items[$exising_item]['total_amount'] = $cart_items[$exising_item]['quantity'] * $cart_items[$exising_item]['unit_amount'];
       }else{
          $product = Product::find($product_id);
          if($product){
            $cart_items[] = [
                'product_id' => $product_id,
                'product_name' => $product->name,
                'image' => $product->image,
                'quantity' => 1,
                'unit_amount' => $product->price,
                'total_amount' => $product->price
            ];
          }
       }
       self::addCartItemsToCookie($cart_items);
       return $cart_items;
    }
    // remove item from cart
    static public function removeCartItem($product_id){
        $cart_items = self::getCartItemsFromCookie();
        foreach($cart_items as $key => $item){
            if($item['product_id'] == $product_id){
                unset($cart_items[$key]);
                // break;
            }
        }
        self::addCartItemsToCookie($cart_items);
        return $cart_items;

    }
    // add cart items to cookie
    static public function addCartItemsToCookie($cart_items){
        Cookie::queue('cart_items', json_encode($cart_items),60*24*30);

    }
    // remove cart items from cookie
    static public function clearCartItemsFromCookie(){
        Cookie::queue(Cookie::forget('cart_items'));
    }
    // get all cart items from cookie
    static public function getCartItemsFromCookie(){
        $cart_items = json_decode(Cookie::get('cart_items'),true);
        if(!$cart_items){
            $cart_items = [];
        }
        return $cart_items;
    }
    // increment cart item quantity
    static public function incrementQuantityToCartItem($product_id){
        $cart_items = self::getCartItemsFromCookie();
        foreach($cart_items as $key => $item){
            if($item['product_id'] == $product_id){
                $cart_items[$key]['quantity']++;
                $cart_items[$key]['total_amount'] = $cart_items[$key]['quantity'] * $cart_items[$key]['unit_amount'];
            }
        }
        self::addCartItemsToCookie($cart_items);
        return $cart_items;

    }
    // decrement cart item quantity
    static public function decrementQuantityToCartItem($product_id){
        $cart_items = self::getCartItemsFromCookie();
        foreach($cart_items as $key => $item){
            if($item['product_id'] == $product_id){
                if($cart_items[$key]['quantity'] > 1){
                    $cart_items[$key]['quantity']--;
                    $cart_items[$key]['total_amount'] = $cart_items[$key]['quantity'] * $cart_items[$key]['unit_amount'];
                }
            }
        }
        self::addCartItemsToCookie($cart_items);
        return $cart_items;
    }
    // calculate total price
    static public function calculateGrandTotal($items){
        return array_sum(array_column($items,'total_amount'));
    }

}
