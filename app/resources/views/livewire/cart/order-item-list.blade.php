<div class="">
    @foreach ($orderItems as $orderItem)
        <article class="cart-order js-cart-order" wire:key="order-item-{{ $orderItem->id }}">
            @if ($editable)
                <div
                    class="cart-order__remove"
                    wire:click="removeOrderItem({{ $orderItem->id }})"
                    data-order-id="<?= $orderItem->id ?>"
                >
                    <x-icon-close class="w-3" />
                </div>
            @endif

            <div class="cart-order__data">
                <p class="font-heading-alt! text-heading-400 leading-none font-medium">
                    <a href="<?= $orderItem->product->url() ?>">{{ localized_text($orderItem->name) }}</a>
                </p>

                @if (! $orderItem->product->isEssentialOil())
                    <p class=""><?= $orderItem->quantity == 1 ? 'tanica' : 'taniche' ?> {{ __('da 5L') }}</p>
                @endif

                <p><?= $orderItem->quantity ?> x {{ price($orderItem->unit_price_net) }}</p>
            </div>

            <div class="cart-order__image">
                <img class="image-fit" src="<?= $orderItem->product->image ?>" alt="" />
            </div>
        </article>
    @endforeach
</div>
