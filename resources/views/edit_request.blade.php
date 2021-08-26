
<div class="modal" id="edit_data{{$request->id}}" tabindex="-1" role="dialog"  >
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <div class='col-md-10'>
                    <h5 class="modal-title" id="exampleModalLabel">Edit Request (<b>{{date('Y-m',strtotime($request->date_encode))}}-{{str_pad($request->code, 5, '0', STR_PAD_LEFT)}}</b>)</h5>
                </div>
                <div class='col-md-2'>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close" >
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            </div>
            <form method='Post' action='edit-request/{{$request->id}}' onsubmit='show();'  enctype="multipart/form-data" >
                <div class="modal-body">
                    {{ csrf_field() }}
                    <div class="row">
                        <div class="col-sm-3">
                            <div class="form-group"><label>Supplier Name</label> <input  type="text" value="{{$request->supplier}}" name="supplier_name" placeholder="" class="form-control upperText" required></div>
                        </div>
                        <div class="col-sm-3">
                            <div class="form-group"><label>Driver's Name</label> <input type="text" value="{{$request->driver_name}}" name="driver_name" placeholder="" class="form-control upperText" required></div>
                        </div>
                        <div class="col-sm-3">
                            <div class="form-group"><label>Plate No.</label> <input type="text" value="{{$request->plate_number}}" name="plate_number" placeholder="" class="form-control upperText" required></div>
                        </div>
                        <div class="col-sm-3">
                            <div class="form-group"><label>Truck Type</label> <input type="text" value="{{$request->truck_type}}" name="truck_type" placeholder="" class="form-control upperText" required></div>
                        </div> 
                        <div class="col-sm-2">
                            <div class="form-group"><label>Material Type</label> 
                                <select class="form-control" name="item" placeholder="Item" required>
                                    <option value=""></option>
                                    <option value="LOCC" {{ ($request->material_type == "LOCC") ? 'selected="selected"' : '' }} >LOCC</option>
                                    <option value="MW" {{ ($request->material_type == "MW") ? 'selected="selected"' : '' }}>MW</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-sm-2">
                            <div class="form-group"><label>Gross Weight</label> 
                                <div class="input-group m-b">
                                    <input type="number" value="{{$request->gross}}" name="gross" placeholder="" class="form-control" required><span class="input-group-addon">KG</span> 
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-2">
                            <div class="form-group"><label>TARE WEIGHT</label>
                                <div class="input-group m-b">
                                    <input type="number" name="tare" value="{{$request->tare}}" placeholder="" class="form-control" required><span class="input-group-addon">KG</span> 
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-1">
                            <div class="form-group"> <label>MC</label> 
                                <div class="input-group m-b">
                                <input type="number" min="0"  step="0.01" value="{{$request->mc}}" name="mc" placeholder="" class="form-control" required><span class="input-group-addon">%</span> 
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-1">
                            <div class="form-group"> <label>OT</label> 
                                <div class="input-group m-b">
                                <input type="number" min="0"  step="0.01"  name="ot" value="{{$request->ot}}" placeholder="" class="form-control" required><span class="input-group-addon">%</span> 
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-1">
                            <div class="form-group"> <label>PM</label> 
                                <div class="input-group m-b">
                                <input type="number" min="0"  step="0.01"  name="pm" value="{{$request->pm}}"placeholder="" class="form-control" required><span class="input-group-addon">%</span> 
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-3">
                            <div class="form-group"> <label>Unit Price</label> 
                                <div class="input-group m-b">
                                    <span class="input-group-addon"> &#8369;</span> <input type="number" min="0" value="{{$request->unit_price}}"  step="0.01"  name="unit_price"  placeholder="" class="form-control" required>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-3">
                            <div class="form-group"><label>Prepared By</label> <input type="text"  placeholder="" class="form-control upperText" value="{{auth()->user()->name}}" readonly></div>
                        </div>
                        <div class="col-sm-3">
                            <div class="form-group"><label>Checked By</label>  
                                <input type="text" class="form-control upperText" name='checked_by' value="{{$request->check_by}}" placeholder="Checked By" required>
                            </div>
                        </div>
                        <div class="col-sm-3">
                            <div class="form-group"><label>Approved By</label>  
                                <input type="text" class="form-control upperText" name='approved_by' value="{{$request->verified_by}}" placeholder="Approved By" required>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type='submit'  class="btn btn-primary" >Submit</button>
                </div>
            </form>
        </div>
    </div>
</div>
