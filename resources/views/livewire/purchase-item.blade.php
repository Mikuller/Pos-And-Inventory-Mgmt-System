<div>
    <tr>
        <td>{{$product->id}}</td>
        <td> <img src="{{$product->getImageURL()}}" alt=""
                class="img-fluid img-20">
                {{$product->name}}</td>
        <td><input type="text" name="price"
                class="form-control w-100 text-center hm-30" value="{{$product->purchasePrice}}" readonly></td>
        <td><input type="number" name="Quantity"  wire:model.live="quantity"
                class="form-control w-60 text-center hm-30" value=0></td>
        <td class="text-right">{{$product->purchasePrice * $quantity}}</td>
    </tr>
</div>
