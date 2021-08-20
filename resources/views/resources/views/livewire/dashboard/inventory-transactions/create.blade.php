
<div>
    <x-alert class="alert-success"></x-alert>

    <x-auth-validation-errors></x-auth-validation-errors>

    <div class="card card-custom">
        <!--begin::Card header-->
        <div class="card-header">
            <div class="card-title">
                <span class="card-icon">
                    {{ svg('Layers') }}
                </span>
                <h3 class="card-label">
                    {{ __('Basic Data') }}
                </h3>
            </div>
            <!--begin::Toolbar-->
            <div class="card-toolbar">
                <button type="button" class="mr-2 btn btn-info btn-sm" wire:click.prevent="submit" wire:loading.attr="disabled" wire:loading.class="spinner spinner-white spinner-left">{{ __('Save') }}</button>
            </div>
            <!--end::Toolbar-->
        </div>
        <!--end::Card header-->
        <!--begin::Card body-->
        <div class="card-body">
            <form class="form" id="kt_form1">
                <!--begin::Row-->
                <div class="row">
                    <div class="col-xl-2"></div>
                    <div class="my-2 col-xl-7">
                        <!--begin::Group-->
                        <div class="form-group row">
                            <x-label>{{ __('Supplier') }}</x-label>
                            <div class="col-9">
                                <select class="form-control @error('supplier_id') is-invalid @enderror" wire:model.defer="supplier_id">
                                    <option value=""></option>
                                    @foreach($suppliers as $supplier)
                                        <option value="{{ $supplier->id }}">{{ $supplier->name }}</option>
                                    @endforeach
                                </select>
                                <x-error field="supplier_id" />
                            </div>
                        </div>
                        <!--end::Group-->
                    </div>
                </div>
                <!--end::Row-->
                <!--begin::Row-->
                <div class="row">
                    <div class="col-xl-2"></div>
                    <div class="my-2 col-xl-7">
                        <!--begin::Group-->
                        <div class="form-group row">
                            <x-label>{{ __('Invoice Number') }}</x-label>
                            <x-input wire:model.defer="invoice_number" field='invoice_number' />
                        </div>
                        <!--end::Group-->
                    </div>
                </div>
                <!--end::Row-->
                <!--begin::Row-->
                <div class="row">
                    <div class="col-xl-2"></div>
                    <div class="my-2 col-xl-7">
                        <!--begin::Group-->
                        <div class="form-group row">
                            <x-label>{{ __('Invoice Date') }}</x-label>
                            <x-date-picker field="invoice_date" wire:model="invoice_date" />
                        </div>
                        <!--end::Group-->
                    </div>
                </div>
                <!--end::Row-->
                <!--begin::Row-->
                <div class="row">
                    <div class="col-xl-2"></div>
                    <div class="my-2 col-xl-7">
                        <!--begin::Group-->
                        <div class="form-group row">
                            <x-label>{{ __('Paid Tax') }}</x-label>
                            <x-input type="number" wire:model.defer="paid_tax" field='paid_tax' min="0" />
                        </div>
                        <!--end::Group-->
                    </div>
                </div>
                <!--end::Row-->
                <!--begin::Row-->
                <div class="row">
                    <div class="col-xl-2"></div>
                    <div class="my-2 col-xl-7">
                        <!--begin::Group-->
                        <div class="form-group row">
                            <x-label>{{ __('Notes') }}</x-label>
                            <div class="col-9">
                                <textarea class="form-control  @error('notes') is-invalid @enderror" wire:model.defer="notes"></textarea>
                                <x-error field="notes" />
                            </div>
                        </div>
                        <!--end::Group-->
                    </div>
                </div>
                <!--end::Row-->
                <!--begin::Row-->
                <div class="row">
                    <div class="col-xl-2"></div>
                    <div class="my-2 col-xl-7">
                        <!--begin::Group-->
                        <div class="form-group row">
                            <x-label>{{ __('Inventory Item') }}</x-label>
                            <div class="col-9">
                                <select class="form-control @error('inventory_item_id') is-invalid @enderror" wire:model.lazy="inventory_item_id">
                                    <option value=""></option>
                                    @foreach($inventoryItems as $inventoryItem)
                                        <option value="{{ $inventoryItem->id }}">{{ $inventoryItem->name }}</option>
                                    @endforeach
                                </select>
                                <x-error field="inventory_item_id" />
                            </div>
                        </div>
                        <!--end::Group-->
                    </div>
                </div>
                <!--end::Row-->
                <!--begin::Row-->
                <div class="row">
                    <div class="col-xl-2"></div>
                    <div class="my-2 col-xl-7">
                        <!--begin::Group-->
                        <div class="form-group row">
                            <x-label>{{ __('Quantity') }}</x-label>
                            <div class="col-9">
                                <div class="input-group">
                                    <div class="input-group-prepend"><span class="input-group-text">{{ __('Quantity') }}</span></div>
                                    <input type="number" class="form-control @error("purchase_quantity") is-invalid @enderror" wire:model.defer="purchase_quantity" min="0" />
                                    <div class="input-group-append"><span class="input-group-text">{{ $purchase_unit }}</span></div>
                                    <x-error field="purchase_quantity" />
                                </div>
                            </div>
                        </div>
                        <!--end::Group-->
                    </div>
                </div>
                <!--end::Row-->
                <!--begin::Row-->
                <div class="row">
                    <div class="col-xl-2"></div>
                    <div class="my-2 col-xl-7">
                        <!--begin::Group-->
                        <div class="form-group row">
                            <x-label>{{ __('Quantity') }}</x-label>
                            <div class="col-9">
                                <div class="input-group">
                                    <div class="input-group-prepend"><span class="input-group-text">{{ __('Quantity') }}</span></div>
                                    <input type="number" class="form-control @error("storage_quantity") is-invalid @enderror" wire:model.defer="storage_quantity" min="0" />
                                    <div class="input-group-append"><span class="input-group-text">{{ $storage_unit }}</span></div>
                                    <x-error field="storage_quantity" />
                                </div>
                            </div>
                        </div>
                        <!--end::Group-->
                    </div>
                </div>
                <!--end::Row-->
                <!--begin::Row-->
                <div class="row">
                    <div class="col-xl-2"></div>
                    <div class="my-2 col-xl-7">
                        <!--begin::Group-->
                        <div class="form-group row">
                            <x-label>{{ __('Quantity') }}</x-label>
                            <div class="col-9">
                                <div class="input-group">
                                    <div class="input-group-prepend"><span class="input-group-text">{{ __('Quantity') }}</span></div>
                                    <input type="number" class="form-control @error("ingredient_quantity") is-invalid @enderror" wire:model.defer="ingredient_quantity" min="0" />
                                    <div class="input-group-append"><span class="input-group-text">{{ $ingredient_unit }}</span></div>
                                    <x-error field="ingredient_quantity" />
                                </div>
                            </div>
                        </div>
                        <!--end::Group-->
                    </div>
                </div>
                <!--end::Row-->
                <!--begin::Row-->
                <div class="row">
                    <div class="col-xl-2"></div>
                    <div class="my-2 col-xl-7">
                        <!--begin::Group-->
                        <div class="form-group row">
                            <x-label>{{ __('Cost') }}</x-label>
                            <x-input type="number" wire:model.defer="cost" field='cost' min="0" />
                        </div>
                        <!--end::Group-->
                    </div>
                </div>
                <!--end::Row-->
                <!--begin::Row-->
                <div class="row">
                    <div class="col-xl-2"></div>
                    <div class="my-2 col-xl-7">
                        <!--begin::Group-->
                        <div class="form-group row">
                            <x-label>{{ __('Expiration Date') }}</x-label>
                            <x-date-picker field="expiration_date" wire:model="expiration_date" minDate="new Date()" />
                        </div>
                        <!--end::Group-->
                    </div>
                </div>
                <!--end::Row-->
            </form>
        </div>
        <!--begin::Card body-->
    </div>
</div>
