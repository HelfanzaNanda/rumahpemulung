@extends('layoutadmin.main')

@section('title','Sales Order')
    
@section('contents')
    <!-- Begin Page Content -->
    <div class="container-fluid">

        <!-- Page Heading -->
        <h1 class="h3 mb-2 text-gray-800">Entry Sales</h1>

        <div class="card">
            <div class="card-body">
                <p>Silahkan melengkapi from Purchase Order. Semua fieds wajib diisi.</p>
                <hr>
                <form id="form">
                    @csrf
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="">Tanggal</label>
                                <input type="text" readonly name="date" id="date" class="form-control datepicker" style="background: white">
                            </div>
                            
                            <div class="form-group">
                                <label for="">Factory Name</label>
                                <select name="factory_name" id="factory_name" class="custom-select">
                                    <option value="" selected disabled>- Pilih Customer -</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="">Phone</label>
                                <input type="tel" readonly name="phone" id="phone" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="">Email</label>
                                <input type="email" readonly name="email" id="email" class="form-control">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="">Alamat Pengiriman</label>
                                <div class="custom-control custom-radio address-register">
                                    <input onclick="setAddress()" type="radio" class="custom-control-input" id="address-register" name="address-checkbox" checked>
                                    <label class="custom-control-label" for="address-register">gunakan alamat ketika registrasi</label>
                                    <p id="text-address-register"></p>
                                </div>
                                <div class="custom-control custom-radio mb-3">
                                    <input onclick="setAddress()" type="radio" class="custom-control-input" id="address-history" name="address-checkbox">
                                    <label class="custom-control-label" for="address-history">gunakan alamat yang sudah ada</label>
                                    <select name="address_history" id="select-address-history" class="custom-select">
                                        <option value="" selected disabled>- Pilih Alamat -</option>
                                        <option value="aa" >aa -</option>
                                        <option value="ac" >ac -</option>
                                    </select>
                                </div>
                                <div class="custom-control custom-radio mb-3">
                                    <input onclick="setAddress()" type="radio" class="custom-control-input" id="address-new" name="address-checkbox">
                                    <label class="custom-control-label" for="address-new">gunakan alamat yang baru</label>
                                    <textarea name="address-new" id="input-address-new"  class="form-control"></textarea>
                                </div>
                                <input type="hidden" name="address" id="address-fixed">
                            </div>
                        </div>
                    </div>
                   @include('lapak.garbage_out.sales_order.item-product')
                   <div class="col-md-12">
                       <button type="submit" class="btn btn-primary float-right">Simpan</button>
                       <a href="{{ route('lapak.sales.order') }}" class="btn btn-secondary mr-3 float-right">Batal</a>
                   </div>
                </form>
            </div>
        </div>
    </div>
    <x-modal-error/>
    <x-modal-success/>
@endsection

@push('scripts')
    <script>
        $(document).ready(function(){
            $('.datepicker').datepicker({
                autoclose : true
            });
        })
        $("#factory_name").select2({
            width: '100%',
            minimumInputLength: 2,
            minimumResultsForSearch: '',
            ajax: {
                url: "{{ route('lapak.sales.factory.get') }}",
                dataType: "json",
                type: "GET",
                data: function (params) {
                    var queryParameters = {
                    name: params.term
                    }
                    return queryParameters
                },
                processResults: function (data) {
                    
                    return {
                        results: $.map(data, function (item) {
                            return {
                                id: item.id,
                                phone: item.phone_factory,
                                text: item.nameof_factory,
                                email: item.email_factory,
                                address: item.address_factory
                            }
                        })
                    }
                }
            }
        });

        $("#factory_name").on('change', function(e) {
            $("#phone").val($(this).select2('data')[0]['phone']);
            $("#email").val($(this).select2('data')[0]['email']);
            let address_register = $(this).select2('data')[0]['address'];
            $("#text-address-register").text(address_register);
            $('#address-fixed').val(address_register)
        });

        function setAddress(){
            if ($('#address-register').is(':checked')) {
                $('#select-address-history').val('').trigger('change')
                $('#address-fixed').val($('#text-address-register').text())
            }else if($('#address-history').is(':checked')){
                $(document).on('change', '#select-address-history', function(){
                    $('#address-fixed').val($(this).val())
                })
                
            }else if($('#address-new').is(':checked')){
                $('#select-address-history').val('').trigger('change')
                $(document).on('change', '#input-address-new', function(){
                    $('#address-fixed').val($(this).val())
                })
            }
        }


        $('.qty').keyup(function() {
            $(this).val(isNumberAndDot($(this).val()))
            let qty = $(this).val();
            let key = $(this).data('key')
            let price = $('#price-'+key).data('price')
            let sub_total = qty * price
            //console.log(sub_total);
            let text_sub_total = (sub_total/1000).toFixed(3);
            if (text_sub_total == 0.000) {
                text_sub_total = 0
            }
            $('#sub-total-'+key).val(text_sub_total)
            $('#sub-total-'+key).data('sub-total', sub_total);
            calculateTotal()
        })

        function isNumberAndDot(str) {
            const regex = /[^\d.]|\.(?=.*\.)/g;
            const subst=``;
            return str.replace(regex, subst);
        }

        function calculateTotal(){
            let total = 0
            $('.sub-total').each(function(){
                let subtotal = $(this).data('sub-total');
                if (subtotal == undefined) {
                    subtotal = 0;
                }
                total += subtotal;
            })
            let total_fix = (total/1000).toFixed(3);
            if (total_fix == 0.000) {
                total_fix = 0
            }
            $('#text-total').text('Rp. '+total_fix);
            $('#total').val(total);
        }

        $('form#form').submit(function(e){
            e.preventDefault()
            let form_data = new FormData(this)
            if (!validated()) {
                return false
            }
            $.ajax({
                url : "{{ route('lapak.sales.order.store') }}",
                type: 'post',
                data: form_data,
                cache: false,
                contentType: false,
                processData: false,
                dataType: 'json',
                success : function(res) {
                    if (res.status) {
                        $('.text-successfully').text(res.message)
                        $('#modal-success').modal('show')
                        setTimeout(() => {
                            $('#modal-success').modal('hide')
                            window.location.href = "{{ route('lapak.sales.order') }}"
                        }, 1000);
                    }
                    console.log(res);
                },
                error : function(xhr){
                    console.log(xhr);
                }
            })
        })

        function validated(){
            let date = $('#date').val()
            let address = $('#address-fixed').val()
            let total = $('#total').val()
            let factory_name = $('#factory_name').val()
            if (date == '') {
                $('.text-error').text('Tanggal harus di isi!')
                $('#modal-error').modal('show')
                return false
            }else if (address == '') {
                $('.text-error').text('Alamat harus di isi!')
                $('#modal-error').modal('show')
                return false
            }else if (total == '') {
                $('.text-error').text('Item harus di isi minimal satu!')
                $('#modal-error').modal('show')
                return false
            }else if (factory_name == null) {
                $('.text-error').text('Factory name harus di isi!')
                $('#modal-error').modal('show')
                return false
            }else{
                return true
            }
            
        }
    </script>
@endpush