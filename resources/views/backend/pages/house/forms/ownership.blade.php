<div class="signle-ownership border p-3 mb-3 bg-light rounded">
    <div class="form-group row">
        <label class="col-sm-2 col-form-label font-weight-bold">Is this Union?</label>
        <div class="col-sm-9">
            <div class="btn-group btn-group-toggle" data-toggle="buttons">
                <label class="btn btn-outline-primary">
                    <input type="radio" class="is_union_radio" name="is_union_toggle[]" value="no" autocomplete="off"> No
                </label>
                <label class="btn btn-outline-primary">
                    <input type="radio" class="is_union_radio" name="is_union_toggle[]" value="yes" autocomplete="off"> Yes
                </label>
            </div>
            <small class="text-muted d-block mt-1">Please select an option to continue</small>
        </div>
        <div class="col-sm-1 text-right">
             <button type="button" class="btn btn-sm btn-danger remove-single-ownership" data-id="{{$ownership->id ?? ''}}" >X</button>
        </div>
    </div>

    <!-- Hidden by default, shown based on selection -->
    <div class="ownership_details_container" style="display:none;">
        <hr>
        <div class="form-group row system_id_group" style="display:none;">
            <label for="system_id" class="col-sm-2 col-form-label">System ID</label>
            <div class="col-sm-9">
                <input type="text" placeholder="Enter System ID (e.g. 100001)" class="form-control system_id_input" id="system_id">
                <small class="text-info">Search information by System ID</small>
            </div>
        </div>

        <div class="form-group row">
            <input type="hidden" name="id[]" value="{{$ownership->id ?? ''}}">
            <label for="name" class="col-sm-2 col-form-label">Owner Name  <span class="text-danger" title="Required" data-toggle="tooltip">*</span></label>
            <div class="col-sm-9">
                <input type="text" required name="name[]" placeholder="Owner Name" class="form-control owner_name" value="{{$ownership->name ?? ''}}" id="name">
                <small class="text-danger error name_error"></small>
            </div>
        </div>

        <div class="form-group row">
            <label for="nid" class="col-sm-2 col-form-label">NID/Bith ID</label>
            <div class="col-sm-9">
                <input type="text" name="nid[]" placeholder="NID/Birth Certificate ID" class="form-control owner_nid" value="{{$ownership->nid ?? ''}}" id="nid">
                <small class="text-danger error nid_error"></small>
            </div>
        </div>

        <div class="form-group row">
            <label for="mobile" class="col-sm-2 col-form-label">Mobile</label>
            <div class="col-sm-9">
                <input type="text" name="mobile[]" placeholder="Mobile" class="form-control owner_mobile" value="{{$ownership->mobile ?? ''}}" id="mobile">
                <small class="text-danger error mobile_error"></small>
            </div>
        </div>

        <div class="form-group row">
            <label for="address" class="col-sm-2 col-form-label">Address</label>
            <div class="col-sm-9">
                <textarea name="address[]" placeholder="Address" class="form-control owner_address" id="address">{{$ownership->address ?? ''}}</textarea>
                <small class="text-danger error address_error"></small>
            </div>
        </div>
    </div>
</div>