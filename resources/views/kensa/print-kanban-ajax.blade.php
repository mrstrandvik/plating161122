@foreach ($ajax_barang as $d)
    <div class="row">
        <div class="col-md-3">
            <div class="form-group">
                <label>No. Part</label>
                <input type="text" id="no_part" name="no_part" value="{{ $d->no_part }}"
                    class="form-control typeahead" readonly>
            </div>
        </div>

        {{-- <div class="col-md-4">
            <div class="form-group">
                <label> Part Name</label> --}}
        <input type="hidden" id="part_name" name="part_name" value="{{ $d->part_name }}" class="typeahead form-control"
            placeholder="Masukkan Nama Part" readonly>
        {{-- </div>
        </div> --}}

        <div class="col-md-3">
            <label>No Kartu</label>
            <input type="text" id="no_kartu" name="no_kartu" value="{{ $kode }}" readonly
                class="form-control">
        </div>

        @if ($d->stok <= 10)
            <div class="col-md-3">
                <label>Stok <i class="fas fa-exclamation-triangle" aria-hidden="true"style="color:red"></i></label>
                <div class="input-group">
                    <input type="text" id="stok" name="stok" value="{{ $d->stok }}"
                        class="form-control bg-red" readonly>
                    <div class="input-group-prepend">
                        <span class="input-group-text">Pcs </span>
                    </div>
                </div>
            </div>
        @elseif($d->stok > 10)
            <div class="col-md-3">
                <label>Stok <i class="fas fa-check-square" aria-hidden="true"style="color:green"></i> </label>
                <div class="input-group">
                    <input type="text" id="stok" name="stok" value="{{ $d->stok }}"
                        class="form-control bg-success" readonly>
                    <div class="input-group-prepend">
                        <span class="input-group-text">Pcs </span>
                    </div>
                </div>
            </div>
        @endif

        <div class="col-md-3">
            <label>Std Qty</label>
            <div class="input-group">
                <input type="text" id="std_qty" name="std_qty" value="{{ $d->qty_trolly }}" class="form-control"
                    readonly>
                <div class="input-group-prepend">
                    <span class="input-group-text">Pcs </span>
                </div>
            </div>
        </div>

        <div class="col-md-3">
            <label>Model</label>
            <input type="text" id="model" name="model" value="{{ $d->model }}" class="form-control"
                readonly>
        </div>

        <div class="col-md-3">
            <label>Bagian</label>
            <input type="text" id="bagian" name="bagian" value="{{ $d->bagian }}" class="form-control"
                readonly>
        </div>
        @if ($d->next_process == '')
            <div class="col-sm-3">
                <!-- select -->
                <div class="form-group">
                    <label>Next Process</label>
                    <select name="next_process" id="next_process" class="form-control">
                        <option value="">----Pilih Next Process----</option>
                        <option value="assembly">ASSEMBLY</option>
                        <option value="painting">PAINTING</option>
                    </select>
                </div>
            </div>
            <div id="assy-panel" class="col-md-3" style="display:none">
                <label>Kirim Assy</label>
                <div class="input-group">
                    <input type="text" id="kirim_assy" name="kirim_assy" class="form-control"
                        value="{{ 0 }}" onkeyup="sum();">
                    <div class="input-group-prepend">
                        <span class="input-group-text">Pcs </span>
                    </div>
                </div>
            </div>
            <div id="painting-panel" class="col-md-3" style="display:none">
                <label>Kirim Painting</label>
                <div class="input-group">
                    <input type="text" id="kirim_painting" name="kirim_painting" class="form-control"
                        value="{{ 0 }}" onkeyup="sum();">
                    <div class="input-group-prepend">
                        <span class="input-group-text">Pcs </span>
                    </div>
                </div>
            </div>
            <input type="hidden" id="kirim_ppic" name="kirim_ppic" class="form-control" onkeyup="sum();"
                value="{{ 0 }}">
        @else
            <div class="col-md-3">
                <label>Next Process</label>
                <input type="text" id="next_process" name="next_process" value="{{ $d->next_process }}"
                    class="form-control" readonly>
            </div>
        @endif

        @if ($d->next_process == 'ASSEMBLY')
            <div class="col-md-3">
                <label>Qty Troly <i class="fas fa-boxes"></i></label>
                <div class="input-group">
                    <input type="number" id="kirim_assy" name="kirim_assy" class="form-control" onkeyup="sum();">
                    <div class="input-group-prepend">
                        <span class="input-group-text">Pcs </span>
                    </div>
                </div>
            </div>
            <input type="hidden" id="kirim_painting" name="kirim_painting" class="form-control" onkeyup="sum();"
                value="{{ 0 }}">
            <input type="hidden" id="kirim_ppic" name="kirim_ppic" class="form-control" onkeyup="sum();"
                value="{{ 0 }}">
        @elseif ($d->next_process == 'PAINTING')
            <div class="col-md-3">
                <label>Qty Troly <i class="fas fa-spray-can"></i></label>
                <div class="input-group">
                    <input type="text" id="kirim_painting" name="kirim_painting" class="form-control"
                        onkeyup="sum();">
                    <div class="input-group-prepend">
                        <span class="input-group-text">Pcs </span>
                    </div>
                </div>
            </div>
            <input type="hidden" id="kirim_assy" name="kirim_assy" class="form-control" onkeyup="sum();"
                value="{{ 0 }}">
            <input type="hidden" id="kirim_ppic" name="kirim_ppic" class="form-control" onkeyup="sum();"
                value="{{ 0 }}">
        @elseif ($d->next_process == 'PPIC')
            <div class="col-md-3">
                <label>Qty Troly <i class="fas fa-search-plus"></i></label>
                <div class="input-group">
                    <input type="text" id="kirim_ppic" name="kirim_ppic" class="form-control" onkeyup="sum();">
                    <div class="input-group-prepend">
                        <span class="input-group-text">Pcs </span>
                    </div>
                </div>
            </div>
            <input type="hidden" id="kirim_assy" name="kirim_assy" class="form-control" onkeyup="sum();"
                value="{{ 0 }}">
            <input type="hidden" id="kirim_painting" name="kirim_painting" class="form-control" onkeyup="sum();"
                value="{{ 0 }}">
        @endif
@endforeach

<script>
    $(document).on('click', '#next_process', function() {
        if ($(this).find(":selected").val() == 'ASSEMBLY') {
            $('#assy-panel').show();
            $('#painting-panel').hide();
        } else
        if ($(this).find(":selected").val() == 'PAINTING') {
            $('#assy-panel').hide();
            $('#painting-panel').show();
        }
    })
</script>
