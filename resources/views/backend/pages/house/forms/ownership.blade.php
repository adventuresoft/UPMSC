<div class="signle-ownership border p-3 mb-3 bg-light rounded">
    <div class="form-group row">
        <label class="col-sm-2 col-form-label font-weight-bold">Is this Union?</label>
        <div class="col-sm-9">
            <input type="hidden" name="is_union[]" class="is_union_hidden" value="{{ $ownership->is_union ?? '' }}">
            <div class="btn-group btn-group-toggle" data-toggle="buttons">
                <label class="btn btn-outline-primary {{ isset($ownership) && $ownership->is_union == 'no' ? 'active' : '' }}">
                    <input type="radio" class="is_union_radio" value="no" autocomplete="off" {{ isset($ownership) && $ownership->is_union == 'no' ? 'checked' : '' }}> No
                </label>
                <label class="btn btn-outline-primary {{ isset($ownership) && $ownership->is_union == 'yes' ? 'active' : '' }}">
                    <input type="radio" class="is_union_radio" value="yes" autocomplete="off" {{ isset($ownership) && $ownership->is_union == 'yes' ? 'checked' : '' }}> Yes
                </label>
            </div>
            <small class="text-muted d-block mt-1">Please select an option to continue</small>
        </div>
        <div class="col-sm-1 text-right">
             <button type="button" class="btn btn-sm btn-danger remove-single-ownership" data-id="{{$ownership->id ?? ''}}" >X</button>
        </div>
    </div>

    <!-- Hidden by default, shown based on selection -->
    <div class="ownership_details_container" style="{{ isset($ownership) ? '' : 'display:none;' }}">
        <hr>
        <div class="form-group row system_id_group" style="{{ ($ownership->is_union ?? 'no') == 'yes' ? '' : 'display:none;' }}">
            <label for="system_id" class="col-sm-2 col-form-label">System ID</label>
            <div class="col-sm-9">
                <div class="input-group">
                    <input type="text" name="owner_id[]" placeholder="Enter System ID (e.g. 100001)" class="form-control system_id_input" value="{{ $ownership->owner_id ?? '' }}" id="system_id">
                    <div class="input-group-append">
                        <button class="btn btn-primary find_user_btn" type="button">Find By</button>
                    </div>
                </div>
                <small class="text-info">Search information by System ID</small>
            </div>
        </div>

        <div class="form-group row">
            <input type="hidden" name="id[]" value="{{$ownership->id ?? ''}}">
            <label for="name" class="col-sm-2 col-form-label">Owner Name  <span class="text-danger" title="Required" data-toggle="tooltip">*</span></label>
            <div class="col-sm-9">
                <input type="text" required name="name[]" placeholder="Owner Name" class="form-control owner_name" value="{{$ownership->name ?? ''}}" id="name" {{ ($ownership->is_union ?? 'no') == 'yes' ? 'readonly' : '' }}>
                <small class="text-danger error name_error"></small>
            </div>
        </div>

        <div class="form-group row">
            <label for="nid" class="col-sm-2 col-form-label">NID/Bith ID</label>
            <div class="col-sm-9">
                <input type="text" name="nid[]" placeholder="NID/Birth Certificate ID" class="form-control owner_nid" value="{{$ownership->nid ?? ''}}" id="nid" {{ ($ownership->is_union ?? 'no') == 'yes' ? 'readonly' : '' }}>
                <small class="text-danger error nid_error"></small>
            </div>
        </div>

        <div class="form-group row">
            <label for="mobile" class="col-sm-2 col-form-label">Mobile</label>
            <div class="col-sm-9">
                <input type="text" name="mobile[]" placeholder="Mobile" class="form-control owner_mobile" value="{{$ownership->mobile ?? ''}}" id="mobile" {{ ($ownership->is_union ?? 'no') == 'yes' ? 'readonly' : '' }}>
                <small class="text-danger error mobile_error"></small>
            </div>
        </div>

        <div class="form-group row">
            <label for="address" class="col-sm-2 col-form-label">Address</label>
            <div class="col-sm-9">
                <textarea name="address[]" placeholder="Address" class="form-control owner_address" id="address" {{ ($ownership->is_union ?? 'no') == 'yes' ? 'readonly' : '' }}>{{$ownership->address ?? ''}}</textarea>
                <small class="text-danger error address_error"></small>
            </div>
        </div>
    </div>
</div>