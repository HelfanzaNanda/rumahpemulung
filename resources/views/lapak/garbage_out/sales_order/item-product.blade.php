<table class="table">
    <thead>
      <tr>
        <th scope="col"></th>
        <th scope="col">Product</th>
        <th scope="col">Price</th>
        <th scope="col">Qty</th>
        <th scope="col">Sub Total</th>
        <th scope="col">Keterangan</th>
      </tr>
    </thead>
    <tbody>
        @foreach ($rubbishs as $key => $rubbish)
            <tr>
                <th scope="row">{{ $loop->iteration }}</th>
                <td>{{ $rubbish->typeof_rubbish }}</td>
                <td>
                    <input value="{{ $rubbish->id_rubbish }}"type="hidden" name="rubbish_id[]">
                    <input data-price="{{ $rubbish->prices }}" value="{{ number_format($rubbish->prices) }}" readonly type="text" class="form-control price" name="price[]" id="price-{{ $key }}">
                </td>
                <td>
                    <input data-key="{{ $key }}" type="tel" class="form-control qty" name="qty[]" id="qty-{{ $key }}">
                </td>
                <td>
                    <input readonly type="text" class="form-control sub-total" name="sub_total[]" id="sub-total-{{ $key }}">
                </td>
                <td>
                    <textarea name="note[]" id="note-{{ $key }}" class="form-control"></textarea>
                </td>
            </tr>  
        @endforeach
        <tr>
            <td colspan="4" class="text-right"><h3>Total</h3></td>
            <td><h3 id="text-total">Rp. 0</h3></td>
            <input type="hidden" name="total" id="total">
        </tr>
    </tbody>
  </table>