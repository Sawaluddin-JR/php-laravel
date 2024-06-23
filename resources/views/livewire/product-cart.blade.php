<div>
    <div>
        @if (session()->has('message'))
            <div class="alert alert-warning alert-dismissible fade show" role="alert">
                <div class="alert-body">
                    <span>{{ session('message') }}</span>
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
            </div>
        @endif
        <div class="table-responsive position-relative">
            <div wire:loading.flex class="col-12 position-absolute justify-content-center align-items-center" style="top:0;right:0;left:0;bottom:0;background-color: rgba(255,255,255,0.5);z-index: 99;">
                <div class="spinner-border text-primary" role="status">
                    <span class="sr-only"></span>
                </div>
            </div>
            <table class="table table-bordered">
                <thead class="thead-dark">
                <tr>
                    <th class="align-middle">Nama</th>
                    <th class="align-middle text-center">Harga</th>
                    <th class="align-middle text-center">Stok</th>
                    <th class="align-middle text-center">Jumlah</th>
                    <th class="align-middle text-center">Sub Total</th>
                    <th class="align-middle text-center">Action</th>
                </tr>
                </thead>
                <tbody>
                    @if($cart_items->isNotEmpty())
                        @foreach($cart_items as $cart_item)
                            <tr>
                                <td class="align-middle">
                                    {{ $cart_item->name }} <br>
                                    <span class="badge badge-success">
                                        {{ $cart_item->options->code }}
                                    </span>
                                    @include('livewire.includes.product-cart-modal')
                                </td>

                                <td x-data="{ open{{ $cart_item->id }}: false }" class="align-middle text-center">
                                    <span x-show="!open{{ $cart_item->id }}" @click="open{{ $cart_item->id }} = !open{{ $cart_item->id }}">{{ format_currency($cart_item->price) }}</span>

                                    <div x-show="open{{ $cart_item->id }}">
                                        @include('livewire.includes.product-cart-price')
                                    </div>
                                </td>

                                <td class="align-middle text-center text-center">
                                    <span class="badge badge-info">{{ $cart_item->options->stock . ' ' . $cart_item->options->unit }}</span>
                                </td>

                                <td class="align-middle text-center">
                                    @include('livewire.includes.product-cart-quantity')
                                </td>

                                <td class="align-middle text-center">
                                    {{ format_currency($cart_item->options->sub_total) }}
                                </td>

                                <td class="align-middle text-center">
                                    <a href="#" wire:click.prevent="removeItem('{{ $cart_item->rowId }}')">
                                        <i class="bi bi-x-circle font-2xl text-danger"></i>
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                    @else
                        <tr>
                            <td colspan="8" class="text-center">
                        <span class="text-danger">
                            Please search & select products!
                        </span>
                            </td>
                        </tr>
                    @endif
                </tbody>
            </table>
        </div>
    </div>
</div>
