<div class="card-body">

    <div class="form-group row">
        <!-- First Field -->
        <label for="house" class="col-sm-2 col-form-label text-nowrap">House/Holding Number <span class="text-danger" title="Required" data-toggle="tooltip">*</span></label>
        <div class="col-sm-3">
            <input type="text" required name="house" value="{{$house->house ?? ''}}"  placeholder="House" class="form-control" id="house">
            <small class="text-danger error house_error"></small>
        </div>

        <!-- Second Field -->
        <label for="house_bn" class="col-sm-3 col-form-label text-nowrap text-right">House/Holding Number (Bangla) <span class="text-danger" title="Required" data-toggle="tooltip">*</span></label>
        <div class="col-sm-3">
            <input type="text" required name="house_bn" value="{{$house->house_bn ?? ''}}" placeholder="House Bangla" class="form-control" id="house_bn">
            <small class="text-danger error house_bn_error"></small>
        </div>
    </div>


    <div class="form-group row">
        <!-- Village Field -->
        <label for="village_id" class="col-sm-2 col-form-label">Village</label>
        <div class="col-sm-2">
            <select class="form-control select2" name="village_id" id="village_id">
                <option value="">Village</option>
                @if (count($villages))
                    @foreach ($villages as $village)
                        <option value="{{$village->id}}" {{isset($house->village_id) ? ($village->id == $house->village_id ? 'selected' : '' ) : ''}} >{{$village->en_name}}</option>
                    @endforeach
                @endif
            </select>
        </div>

        <!-- Block Field -->
        <label for="block_section" class="col-sm-2 col-form-label text-nowrap text-right">Block/Sec/Sector</label>
        <div class="col-sm-2">
            <input type="text" name="block_section" value="{{$house->block_section ?? ''}}" placeholder="Block/Section/Sector" class="form-control" id="block_section">
        </div>

        <!-- Ward Field -->
        <label for="union_ward_id" class="col-sm-1 col-form-label text-nowrap text-right">Ward No</label>
        <div class="col-sm-2">
            <select class="form-control select2" name="union_ward_id" id="union_ward_id">
                <option value="">Select Ward</option>
                @if (count($union_wards))
                    @foreach ($union_wards as $ward)
                        <option value="{{$ward->id}}" {{isset($house->union_ward_id) ? ($ward->id == $house->union_ward_id ? 'selected' : '' ) : ''}}>{{$ward->en_ward_no}}</option>
                    @endforeach
                @endif
            </select>
        </div>
    </div>

    <!-- Removed Legacy Fields: Type, Category, Ownership Type, Mouza, BRS Khatian, BRS Dag, Land Qty, Price -->

    <div class="form-group row">
        <label for="land_quantity" class="col-sm-2 col-form-label">জমির পরিমান (Land Quantity)</label>
        <div class="col-sm-9">
            <div class="input-group">
                <input type="text" name="land_quantity" placeholder="Land Quantity" value="{{$house->land_quantity ?? ''}}" class="form-control" id="land_quantity">
                <div class="input-group-append">
                    <span class="input-group-text">একর</span>
                </div>
            </div>
            <small class="text-danger error land_quantity_error"></small>
        </div>
    </div>

    <div class="form-group row">
        <label for="land_price" class="col-sm-2 col-form-label">Total Land Price</label>
        <div class="col-sm-9">
            <div class="input-group">
                <input type="number" step="0.01" name="land_price" value="{{$house->land_price ?? ''}}" class="form-control" id="land_price" placeholder="0.00">
                <div class="input-group-append">
                    <span class="input-group-text">BDT</span>
                </div>
            </div>
            <small class="text-danger error land_price_error"></small>
        </div>
    </div>

    <div class="form-group row">
        <label for="number_of_rooms" class="col-sm-2 col-form-label">Number of Building/Structure <span class="text-danger" title="Required" data-toggle="tooltip">*</span></label>
        <div class="col-sm-9">
            <input type="number" required min="1" name="number_of_rooms" value="{{$house->number_of_rooms ?? ''}}" placeholder="Number of Rooms" class="form-control" id="number_of_rooms">
            <small class="text-danger error number_of_rooms_error"></small>
        </div>
    </div>

    <!-- Dynamic Room Container -->
    <div id="dynamic_rooms_container">
        <!-- Room cards will be injected here via JS -->
    </div>

    <div class="form-group row mt-3">
        <label for="room_usage" class="col-sm-2 col-form-label">Building/Structure Usage <span class="text-danger" title="Required" data-toggle="tooltip">*</span></label>
        <div class="col-sm-9">
            <select class="form-control select2" required name="room_usage" id="room_usage">
                <option value="">Select Usage</option>
                <option value="আবাসিক" {{ (isset($house) && $house->room_usage == 'আবাসিক') ? 'selected' : '' }}>আবাসিক (Residential)</option>
                <option value="বানিজ্যিক" {{ (isset($house) && $house->room_usage == 'বানিজ্যিক') ? 'selected' : '' }}>বানিজ্যিক (Commercial)</option>
            </select>
            <small class="text-danger error room_usage_error"></small>
        </div>
    </div>

    <div class="form-group row">
        <label for="house_price" class="col-sm-2 col-form-label">Total Building/Structure Price</label>
        <div class="col-sm-9">
            <div class="input-group">
                <input type="text" readonly name="house_price" value="{{$house->house_price ?? ''}}" class="form-control" id="house_price" placeholder="0.00">
                <div class="input-group-append">
                    <span class="input-group-text">BDT</span>
                </div>
            </div>
            <small class="text-danger error house_price_error"></small>
        </div>
    </div>

    <div class="form-group row">
        <label for="grand_total_price" class="col-sm-2 col-form-label font-weight-bold">Total Grand Price</label>
        <div class="col-sm-9">
            <div class="input-group">
                <input type="text" readonly name="grand_total_price" value="{{$house->grand_total_price ?? ''}}" class="form-control font-weight-bold" id="grand_total_price" placeholder="0.00">
                <div class="input-group-append">
                    <span class="input-group-text">BDT</span>
                </div>
            </div>
            <small class="text-danger error grand_total_price_error"></small>
        </div>
    </div>

</div>


<script>
    document.addEventListener("DOMContentLoaded", function() {
        const roomInput = document.getElementById('number_of_rooms');
        const container = document.getElementById('dynamic_rooms_container');
        
        // Existing room details for edit mode
        const existingRooms = @json(isset($house) && $house->room_details ? json_decode($house->room_details, true) : []);

        function generateRoomCards(count) {
            container.innerHTML = '';
            for (let i = 0; i < count; i++) {
                let existingArea = existingRooms[i] ? existingRooms[i].area : '';
                let existingType = existingRooms[i] ? existingRooms[i].type : '';
                let existingPrice = existingRooms[i] ? existingRooms[i].price_per_sq_ft : '';

                let cardHtml = `
                    <div class="card card-outline card-primary mb-3 mx-2">
                        <div class="card-header">
                            <h3 class="card-title">Building/Structure ${i + 1} Details</h3>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Area (Sq. Ft) <span class="text-danger">*</span></label>
                                        <input type="number" step="any" required name="room_area[]" value="${existingArea}" class="form-control" placeholder="Total Square Feet">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Type <span class="text-danger">*</span></label>
                                        <select required name="room_type[]" class="form-control">
                                            <option value="">Select Type</option>
                                            <option value="পাকা" ${existingType === 'পাকা' ? 'selected' : ''}>পাকা</option>
                                            <option value="আধা পাকা" ${existingType === 'আধা পাকা' ? 'selected' : ''}>আধা পাকা</option>
                                            <option value="টিনশেড" ${existingType === 'টিনশেড' ? 'selected' : ''}>টিনশেড</option>
                                            <option value="কাঁচা" ${existingType === 'কাঁচা' ? 'selected' : ''}>কাঁচা</option>
                                            <option value="বিল্ডিং ফ্ল্যাট" ${existingType === 'বিল্ডিং ফ্ল্যাট' ? 'selected' : ''}>বিল্ডিং ফ্ল্যাট</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Price per Sq. Ft</label>
                                        <div class="input-group">
                                            <input type="number" step="any" name="price_per_sq_ft[]" value="${existingPrice}" class="form-control" placeholder="0.00">
                                            <div class="input-group-append">
                                                <span class="input-group-text">BDT</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                `;
                container.insertAdjacentHTML('beforeend', cardHtml);
            }
        }

        const landPriceInput = document.getElementById('land_price');
        const housePriceInput = document.getElementById('house_price');
        const grandTotalPriceInput = document.getElementById('grand_total_price');

        function updateGrandTotal() {
            let landPrice = parseFloat(landPriceInput.value) || 0;
            let housePrice = parseFloat(housePriceInput.value) || 0;
            let grandTotal = landPrice + housePrice;
            grandTotalPriceInput.value = grandTotal > 0 ? grandTotal.toFixed(2) : '';
        }

        // Function to format price to 2 decimal places
        function formatPrice(input) {
            let val = parseFloat(input.value);
            if (!isNaN(val)) {
                input.value = val.toFixed(2);
            }
        }

        if (landPriceInput) {
            landPriceInput.addEventListener('input', updateGrandTotal);
            landPriceInput.addEventListener('blur', function() {
                formatPrice(this);
            });
        }

        // Initialize on load
        if (roomInput.value > 0) {
            generateRoomCards(roomInput.value);
            calculateHouseTotal();
        }

        // Listen for input changes
        roomInput.addEventListener('input', function() {
            let count = parseInt(this.value);
            if (!isNaN(count) && count > 0 && count <= 50) {
                generateRoomCards(count);
            } else {
                container.innerHTML = '';
            }
            calculateHouseTotal();
        });

        // Function to calculate Building price
        function calculateHouseTotal() {
            let total = 0;
            const areas = document.getElementsByName('room_area[]');
            const prices = document.getElementsByName('price_per_sq_ft[]');
            
            for (let i = 0; i < areas.length; i++) {
                let areaVal = parseFloat(areas[i].value) || 0;
                let priceVal = parseFloat(prices[i].value) || 0;
                total += (areaVal * priceVal);
            }
            
            housePriceInput.value = total > 0 ? total.toFixed(2) : '';
            updateGrandTotal();
        }

        // Listen for dynamic input changes in room cards
        container.addEventListener('input', function(e) {
            if (e.target.name === 'room_area[]' || e.target.name === 'price_per_sq_ft[]') {
                calculateHouseTotal();
            }
        });

        // Auto-format dynamic price inputs on blur
        container.addEventListener('blur', function(e) {
            if (e.target.name === 'price_per_sq_ft[]') {
                formatPrice(e.target);
            }
        }, true);
    });
</script>