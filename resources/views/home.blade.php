@extends('layouts.app')

@section('content')
@if(Session::has('message'))
<p class="alert {{ Session::get('alert-class', 'alert-info') }}">{{ Session::get('message') }}</p>
@endif
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="row">
                        <div class="col-md-3">Dashboard</div>
                        <div class="col-md-6">
                            <input type="text" class="form-control" placeholder="Search.." name="search" id="search" ng-model="searchTerm" ng-change="search(searchTerm)" ng-model-options="{debounce: 500}">
                        </div>
                        <div class="col-md-3"><button ng-click="Addinventory()" class="btn btn-primary float_right"><i class="fa fa-add"></i> Add</button></div>
                    </div>
                </div>

                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Sr.No</th>
                                <th>Item</th>
                                <th>Model</th>
                                <th>Model Year</th>
                                <th>Quantity</th>
                                <th>Price</th>
                                <th><span class="float_right">Action</span></th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr ng-repeat="inventory in inventories">
                                <td>[[$index+1]]</td>
                                <td>[[inventory.item]]</td>
                                <td>[[inventory.model]]</td>
                                <td>[[inventory.model_year]]</td>
                                <td>[[inventory.quantity_available]]</td>
                                <td>[[inventory.price]]</td>
                                <td>
                                    <div class="float_right">
                                        <button ng-click="Editinventory(inventory)" class="btn btn-primary"><i class="fa fa-edit"></i> Edit</button>
                                        <a class="delete_inventory btn btn-danger" href="inventory/delete/[[inventory.id]]"><i class="fa fa-trash"></i> Delete</a>
                                    </div>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <default-pagination currentpage="currentPaging" like="InventoryData({searchTerm},page)" paginate="paginate" range="rangepage"></default-pagination>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="inventoryModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
  aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header text-center">
                <h4 class="modal-title w-100 font-weight-bold">[[whatInventory]] Inventory</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form method="POST" action="[[whatInventory=='Add'?'inventory/store':'inventory/update/'+editInventory.id]]" id="inventoryForm" name="inventoryForm">
                {{ csrf_field() }}
                <div class="modal-body mx-3">
                    <div class="md-form mb-5">
                        <label for="item">Item</label>
                        <input type="text" id="item" name="item" value="[[editInventory.item]]" class="form-control" required>
                    </div>
                    <div class="md-form mb-5">
                        <label for="model">Model</label>
                        <input type="text" id="model" name="model" value="[[editInventory.model]]" class="form-control" required>
                    </div>
                    <div class="md-form mb-5">
                        <label for="model_year">Model Year</label>
                        <input type="number" maxlength="4" min="2000" max="2019" id="model_year" name="model_year" value="[[editInventory.model_year]]" class="form-control" required>
                    </div>
                    <div class="md-form mb-5">
                        <label for="quantity_available">Quantity</label>
                        <input type="number" id="quantity_available" name="quantity_available" value="[[editInventory.quantity_available]]" class="form-control" required>
                    </div>
                    <div class="md-form mb-5">
                        <label for="price">Price</label>
                        <input type="number" id="price" name="price" min="1" max="100" value="[[editInventory.price]]" class="form-control" required>
                    </div>
                </div>
                <div class="modal-footer d-flex justify-content-center">
                    <input type="submit" class="btn btn-primary" value="[[whatInventory]]">
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
