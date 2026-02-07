@extends('layouts/kasir-template')

@section('kasir-content')
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <div class="w-full flex flex-row gap-1 p-1 bg-gray-100 overflow-y-auto">
        <div class="w-4/6 min-h-[85vh] rounded p-4 bg-white">

            <h3>Halaman Kasir</h3>
            <span class="text-[16px]">List Jasa</span>
            <div class="w-full flex flex-row py-2">
                {{-- Tindakan List --}}
                <div class="flex flex-row flex-wrap gap-3 justify-center items-start">

                    @foreach ($procedures as $item)
                        <div class="flex flex-col w-1/4 bg-gray-100 rounded-xl p-2 gap-1">
                            <span class="text-[16px] font-bold" id="procedure_title">{{ $item->name }}</span>
                            <div class="w-full flex flex-row justify-between items-center">
                                <span class="text-[14px]">Rp. {{ number_format($item->activePrices[0]->price) }}</span>
                                <div class="bg-success p-2 rounded flex justify-center items-center cursor-pointer add-to-cart"
                                    data-toggle="tooltip" data-placement="top" title="" data-original-title="Tambah"
                                    data-id="{{ $item->id }}" data-name="{{ $item->name }}"
                                    data-price="{{ $item->activePrices[0]->price }}">
                                    <i class="fa
                                    fa-plus"></i>
                                </div>
                            </div>
                        </div>
                    @endforeach

                </div>
            </div>
        </div>
        <div class="w-2/6 min-h-[85vh] bg-white rounded flex flex-col">
            {{-- Cart List --}}
            <div class="p-2 flex flex-col h-full">

                <div class="form-group">
                    <label>Nama Pasien <span class="text-red">*</span></label>
                    <input type="input" class="form-control" name="nama_pasien" placeholder="Nama pasien" required>
                    <div class="help-block with-errors"></div>
                </div>

                <span class="text-[18px] font-semibold mt-2">Detail</span>

                <div id="detail-content" class="bg-gray-100 rounded flex flex-col gap-1 p-3 mt-2 flex-1 overflow-y-auto">
                </div>

                <!-- Voucher -->
                <div class="form-group">
                    <label>Vouchers</label>
                    <select name="voucher" class="selectpicker form-control" data-style="py-0" id="voucherSelect"
                        {{ count($vouchers) ? '' : 'disabled' }}>
                        <option>{{ count($vouchers) ? 'Choose Voucher' : 'NO VOUCHER AVAILABLE' }}</option>

                        @foreach ($vouchers as $item)
                            <option value="{{ $item->activeVouchers[0]->id }}"
                                data-type="{{ $item->activeVouchers[0]->discount_type }}"
                                data-value="{{ $item->activeVouchers[0]->discount_value }}"
                                data-max="{{ $item->activeVouchers[0]->max_discount }}">
                                {{ $item->name }}
                            </option>
                        @endforeach

                    </select>
                </div>

                <div class="flex flex-row justify-between items-center border-t border-gray-300 pt-3 mt-3">
                    <span class="font-semibold">Subtotal</span>
                    <span class="font-bold" id="subtotal">Rp 0</span>
                </div>

                <!-- Discount -->
                <div class="flex flex-row justify-between items-center border-t border-gray-300 pt-3 mt-3">
                    <span class="font-semibold">Discount</span>
                    <span class="font-bold" id="discount_value">-</span>
                </div>

                <div class="flex flex-row justify-between items-center">
                    <span class="font-semibold">Discount Total</span>
                    <span class="font-bold" id="discount_total">Rp. 0</span>
                </div>

                <!-- TOTAL -->
                <div class="flex flex-row justify-between items-center border-t border-gray-300 pt-3 mt-3">
                    <span class="font-semibold">Total</span>
                    <span class="font-bold" id="totalPrice">Rp 0</span>
                </div>

                <div class="flex flex-row justify-end items-center mt-3">
                    <div class="rounded py-1 px-4 bg-green-400 hover:bg-green-500 text-white font-semibold cursor-pointer"
                        id="btnBayar">
                        BAYAR
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection


@section('js-script')
    <script>
        let cartItems = [];
        let baseTotal = 0;

        const formatRupiah = (number) => {
            return new Intl.NumberFormat('id-ID', {
                style: 'currency',
                currency: 'IDR'
            }).format(number);
        };

        const isInCart = (id) => {
            return cartItems.some(item => item.id === id);
        };

        const toggleAddButton = (id, disabled) => {
            const btn = document.querySelector(`.add-to-cart[data-id="${id}"]`);
            if (!btn) return;

            btn.classList.toggle('opacity-50', disabled);
            btn.classList.toggle('cursor-not-allowed', disabled);
            btn.classList.toggle('pointer-events-none', disabled);
        };

        function setBaseTotal(total) {
            const subTotal = document.getElementById('subtotal');
            subTotal.innerText = formatRupiah(total);

            baseTotal = total;
            applyVoucher();
        }

        function applyVoucher() {
            const totalEl = document.getElementById('totalPrice');
            const select = document.getElementById('voucherSelect');
            const discountValue = document.getElementById('discount_value');
            const discountTotal = document.getElementById('discount_total');

            let total = baseTotal;

            if (!select || !select.value) {
                totalEl.innerText = formatRupiah(total);
                return;
            }

            const option = select.options[select.selectedIndex];

            const type = option.dataset.type;
            const value = parseFloat(option.dataset.value);
            const max = option.dataset.max ? parseFloat(option.dataset.max) : null;

            let discount = 0;

            if (type === 'percent') {
                discount = total * (value / 100);
                discountValue.innerText = value + "%"
            } else if (type === 'fixed') {
                discount = value;
                discountValue.innerText = formatRupiah(value)
            }

            if (max !== null && max > 0 && discount > max) {
                discount = max;
            }

            total = Math.max(0, total - discount);

            discountTotal.innerText = "" + formatRupiah(discount);
            totalEl.innerText = formatRupiah(total);
        }

        const renderCart = () => {
            const container = document.getElementById('detail-content');
            let total = 0;

            let html = '';

            cartItems.forEach(item => {
                total += item.price;

                html += `
                        <div class="flex justify-between items-center bg-white rounded p-2 border-b">
                            <div>
                                <span>${item.name}</span>
                                <span class="text-sm text-gray-500">${formatRupiah(item.price)}</span>
                            </div>
                            <button class="remove-item text-red-500" data-id="${item.id}">✕</button>
                        </div>
                    `;
            });

            container.innerHTML = html;
            setBaseTotal(total);

            document.querySelectorAll('.remove-item').forEach(btn => {
                btn.addEventListener('click', () => {
                    const id = btn.dataset.id;

                    cartItems = cartItems.filter(item => item.id !== id);
                    toggleAddButton(id, false);
                    renderCart();
                });
            });
        };

        document.querySelectorAll('.add-to-cart').forEach(button => {
            button.addEventListener('click', () => {
                const id = button.dataset.id;

                if (isInCart(id)) return;

                const item = {
                    id: id,
                    name: button.dataset.name,
                    price: parseInt(button.dataset.price)
                };

                cartItems.push(item);
                toggleAddButton(id, true);
                renderCart();
            });
        });

        document.getElementById('voucherSelect').addEventListener('change', () => {
            applyVoucher();
        });
    </script>

    <script>
        const bayarBtn = document.getElementById('btnBayar');
        bayarBtn.addEventListener('click', async () => {
            const patientName = document.querySelector('input[name="nama_pasien"]').value;

            if (!patientName) {
                alert('Nama pasien wajib diisi');
                return;
            }

            if (cartItems.length === 0) {
                alert('Keranjang masih kosong');
                return;
            }

            const csrfToken = document
                .querySelector('meta[name="csrf-token"]')
                .getAttribute('content');

            const payload = {
                patient_name: patientName,
                discount: getDiscountValue(),
                items: cartItems.map(item => ({
                    id: item.id,
                    name: item.name,
                    price: item.price,
                }))
            };

            try {
                console.log(payload);
                await fetch('/kasir', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': csrfToken,
                            'Accept': 'application/json'
                        },
                        body: JSON.stringify(payload)
                    })
                    .then(res => res.json())
                    .then(res => {
                        console.log(res);
                        if (res.success) {
                            window.open(res.invoice_url, '_blank');
                            refreshKasir();
                        } else {
                            console.error(res.error);
                            alert('Gagal menyimpan transaksi');
                            return;
                        }
                    });

                console.log('Done');

            } catch (err) {
                console.error(err);
                alert('Terjadi kesalahan');
            }
        });

        function getDiscountValue() {
            const el = document.getElementById('discount_total');
            if (!el) return 0;

            const value = el.innerText
                .replace(/[^\d,]/g, '')
                .replace(',', '.');

            return Math.floor(parseFloat(value)) || 0;
        }

        function refreshKasir() {
            cartItems = [];
            baseTotal = 0;

            const detail = document.getElementById('detail-content');
            if (detail) detail.innerHTML = '';

            const patientInput = document.querySelector('input[name="nama_pasien"]');
            if (patientInput) patientInput.value = '';

            const voucherSelect = document.getElementById('voucherSelect');
            if (voucherSelect) {
                voucherSelect.selectedIndex = 0;
            }

            document.getElementById('subtotal').innerText = formatRupiah(0);
            document.getElementById('discount_value').innerText = '-';
            document.getElementById('discount_total').innerText = formatRupiah(0);
            document.getElementById('totalPrice').innerText = formatRupiah(0);

            document.querySelectorAll('.add-to-cart').forEach(btn => {
                btn.classList.remove('opacity-50', 'cursor-not-allowed', 'pointer-events-none');
            });
        }
    </script>
@endsection
