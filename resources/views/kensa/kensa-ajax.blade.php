@foreach ($ajax_barang as $d)
    <div class="row">
        <input type="hidden" id="no_part" name="no_part" value="{{ $d->no_part }}" class="form-control typeahead"
            readonly>
        <input type="hidden" id="part_name" name="part_name" value="{{ $d->part_name }}" class="typeahead form-control"
            placeholder="Masukkan Nama Part" readonly>

        <div class="col-md-4">
            <div class="form-group">
                <label>No. Bar</label>
                <input type="text" name="no_bar" value="{{ old('no_bar') }}" class="form-control"
                    placeholder="Masukkan No. Bar">
            </div>
        </div>

        <div class="col-md-4">
            <Label> Qty Bar</Label>
            <div class="input-group">
                <input type="text" id="qty_bar" name="qty_bar" value="{{ $d->qty_bar }}" onkeyup="sum();"
                    class="form-control">
                <div class="input-group-prepend">
                    <span class="input-group-text">Pcs </span>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <!-- select -->
            <div class="form-group">
                <label>Cycle</label>
                <select name="cycle" class="form-control">
                    <option value="">----Pilih Cycle----</option>
                    <option>C1</option>
                    <option>C2</option>
                    <option>CS</option>
                    <option>FS</option>
                </select>
            </div>
        </div>
    </div>
@endforeach
