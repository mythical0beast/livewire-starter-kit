<?php

namespace App\Http\Livewire\Components;

use Illuminate\Support\Collection;
use Livewire\Component;
use Lunar\Facades\CartSession;
use Lunar\Facades\ShippingManifest;

class ShippingOptions extends Component
{
    /**
     * The chosen shipping option.
     */
    public ?string $chosenOption = null;

    /**
     * {@inheritDoc}
     */
    public function mount(): void
    {
        if ($shippingOption = $this->shippingAddress?->shipping_option) {
            $option = $this->shippingOptions->first(function ($opt) use ($shippingOption) {
                return $opt->getIdentifier() == $shippingOption;
            });
            $this->chosenOption = $option?->getIdentifier();
        }
    }

    /**
     * Return available shipping options.
     */
    public function getShippingOptionsProperty(): Collection
    {
        return ShippingManifest::getOptions(
            CartSession::current()
        );
    }

    /**
     * {@inheritDoc}
     */
    public function rules()
    {
        return [
            'chosenOption' => 'required',
        ];
    }

    /**
     * Save the shipping option.
     */
    public function save(): void
    {
        $this->validate();

        $option = $this->shippingOptions->first(fn ($option) => $option->getIdentifier() == $this->chosenOption);

        CartSession::setShippingOption($option);

        $this->emit('selectedShippingOption');
    }

    /**
     * Return whether we have a shipping address.
     */
    public function getShippingAddressProperty(): void
    {
        return CartSession::getCart()->shippingAddress;
    }

    public function render()
    {
        return view('livewire.components.shipping-options');
    }
}
