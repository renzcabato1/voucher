
<div class="modal" id="new_request" tabindex="-1" role="dialog"  >
    <div class="modal-dialog modal-lg " role="document">
        <div class="modal-content">
            <div class="modal-header">
                <div class='col-md-10'>
                    <h5 class="modal-title" id="exampleModalLabel">New Request</h5>
                </div>
                <div class='col-md-2'>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close" >
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            </div>
            <form method='Post' action='new-request' onsubmit='show();'  enctype="multipart/form-data" >
                <div class="modal-body">
                    {{ csrf_field() }}
                     <div class='col-md-12'>
                        Supplier :
                        <input type="text" class="form-control" name='supplier' placeholder="Supplier" required>
                     </div>
                     <div class='col-md-12'>
                        Item :
                        <select class="form-control" name="item" placeholder="Item" required>
                            <option value=""></option>
                            <option value="MW">MW</option>
                            <option value="LOCC">LOCC</option>
                        </select>
                     </div>
                     <div class='col-md-12'>
                        SCF # :
                        <input type="number" class="form-control" name='scf' placeholder="SCF #" required>
                     </div>
                     <div class='col-md-12'>
                        Gross :
                        <input type="number" min="0"  step="0.01" class="form-control" name='gross' placeholder="Gross" required>
                     </div>
                     <div class='col-md-12'>
                        MC :
                        <input type="number" min="0"  step="0.01" class="form-control" name='mc' placeholder="MC" required>
                     </div>
                     <div class='col-md-12'>
                        Unit Price :
                        <input type="number" min="0"  step="0.01" class="form-control" name='unit_price' placeholder="Unit Price" required>
                     </div>
                     <div class='col-md-12'>
                        Checked By :
                        <input type="text" class="form-control" name='checked_by' @if($last_request != null) value="{{$last_request->check_by}}" @endif placeholder="Checked By" required>
                     </div>
                     <div class='col-md-12'>
                        Approved By :
                        <input type="text" class="form-control" name='approved_by' @if($last_request != null) value="{{$last_request->verified_by}}" @endif placeholder="Approved By" required>
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
