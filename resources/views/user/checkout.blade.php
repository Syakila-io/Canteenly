@extends('layouts.user')

@section('title', 'Checkout')

@section('styles')
<style>
.checkout-container {
    display: flex;
    gap: 30px;
}

.checkout-form {
    flex: 2;
    background: #fff;
    border-radius: 20px;
    padding: 30px;
    box-shadow: 0 4px 10px rgba(0,0,0,0.05);
}

.checkout-summary {
    flex: 1;
    background: #fff;
    border-radius: 20px;
    padding: 30px;
    box-shadow: 0 4px 10px rgba(0,0,0,0.05);
    height: fit-content;
}

.section-title {
    color: #2b6be4;
    font-weight: 700;
    font-size: 20px;
    margin-bottom: 20px;
    display: flex;
    align-items: center;
    gap: 10px;
}

.form-group {
    margin-bottom: 20px;
}

.form-group label {
    display: block;
    margin-bottom: 8px;
    font-weight: 600;
    color: #333;
}

.form-group input, .form-group select {
    width: 100%;
    padding: 12px 15px;
    border: 2px solid #e0e6f5;
    border-radius: 10px;
    outline: none;
    font-size: 14px;
}

.form-group input:focus, .form-group select:focus {
    border-color: #2b6be4;
}

.payment-methods {
    display: grid;
    grid-template-columns: repeat(4, 1fr);
    gap: 15px;
    margin-top: 10px;
}

@media (max-width: 768px) {
    .payment-methods {
        grid-template-columns: repeat(2, 1fr);
    }
}

.payment-option {
    border: 2px solid #e0e6f5;
    border-radius: 10px;
    padding: 15px;
    text-align: center;
    cursor: pointer;
    transition: 0.3s;
}

.payment-option:hover, .payment-option.selected {
    border-color: #2b6be4;
    background: #f8faff;
}

.payment-option i {
    font-size: 24px;
    color: #2b6be4;
    margin-bottom: 8px;
}

.order-item {
    display: flex;
    align-items: center;
    gap: 15px;
    padding: 15px 0;
    border-bottom: 1px solid #f0f0f0;
}

.order-item img {
    width: 50px;
    height: 50px;
    object-fit: contain;
    border-radius: 8px;
}

.order-item-info h4 {
    margin: 0 0 5px 0;
    font-size: 16px;
}

.order-item-info p {
    margin: 0;
    color: #666;
    font-size: 14px;
}

.order-item-price {
    margin-left: auto;
    font-weight: 600;
    color: #2b6be4;
}

.total-section {
    margin-top: 20px;
    padding-top: 20px;
    border-top: 2px solid #f0f0f0;
}

.total-row {
    display: flex;
    justify-content: space-between;
    margin-bottom: 10px;
}

.total-row.final {
    font-weight: 700;
    font-size: 18px;
    color: #2b6be4;
    border-top: 1px solid #e0e6f5;
    padding-top: 10px;
}

.btn-order {
    width: 100%;
    background: #2b6be4;
    color: #fff;
    border: none;
    padding: 15px;
    border-radius: 12px;
    font-weight: 600;
    font-size: 16px;
    cursor: pointer;
    margin-top: 20px;
    transition: 0.3s;
}

.btn-order:hover {
    background: #1e56c0;
}

.upload-section {
    margin-top: 20px;
    padding: 20px;
    background: #f8faff;
    border-radius: 10px;
    border: 2px dashed #2b6be4;
    display: none;
}

.upload-section.show {
    display: block;
}

.upload-area {
    text-align: center;
    padding: 20px;
    cursor: pointer;
    transition: 0.3s;
}

.upload-area:hover {
    background: #eaf1ff;
}

.upload-area i {
    font-size: 40px;
    color: #2b6be4;
    margin-bottom: 10px;
}

.upload-preview {
    margin-top: 15px;
    text-align: center;
}

.upload-preview img {
    max-width: 200px;
    max-height: 200px;
    border-radius: 8px;
    box-shadow: 0 4px 10px rgba(0,0,0,0.1);
}
</style>
@endsection

@section('content')
<div class="checkout-container">
    <div class="checkout-form">
        <h2 class="section-title"><i class="fa fa-credit-card"></i> Checkout</h2>
        
        <form action="{{ route('checkout.store') }}" method="POST" onsubmit="return submitOrder(event)">
            @csrf
            
            <!-- Informasi Lokasi -->
            <div class="form-group">
                <label>Lokasi Sekolah</label>
                <input type="text" name="lokasi_sekolah" placeholder="Nama sekolah" required>
            </div>

            <div class="form-group">
                <label>Kelas</label>
                <input type="text" name="kelas" placeholder="Kelas" required>
            </div>

            <div class="form-group">
                <label>Ruangan</label>
                <select name="ruangan" required>
                    <option value="">Pilih ruangan</option>
                    <option value="R.01">Ruang 01</option>
                    <option value="R.02">Ruang 02</option>
                    <option value="R.03">Ruang 03</option>
                    <option value="R.04">Ruang 04</option>
                    <option value="R.05">Ruang 05</option>
                    <option value="R.06">Ruang 06</option>
                    <option value="R.07">Ruang 07</option>
                    <option value="R.08">Ruang 08</option>
                    <option value="R.09">Ruang 09</option>
                    <option value="R.10">Ruang 10</option>
                    <option value="Lab.Komp">Lab Komputer</option>
                    <option value="Lab.Bahasa">Lab Bahasa</option>
                    <option value="R.Guru">Ruang Guru</option>
                    <option value="R.TU">Ruang TU</option>
                    <option value="Perpus">Perpustakaan</option>
                    <option value="Kantin">Kantin</option>
                </select>
            </div>

            <!-- Informasi Pengambilan -->
            <div class="form-group">
                <label>Metode Pengambilan</label>
                <select name="pickup_method" onchange="toggleTimeSelection()" required>
                    <option value="">Pilih metode pengambilan</option>
                    <option value="Ambil Sekarang">Ambil Sekarang</option>
                    <option value="Ambil di Kantin">Ambil di Kantin</option>
                    <option value="Antar ke Kelas (PO)">Antar ke Kelas (PO)</option>
                </select>
            </div>

            <div class="form-group" id="time-selection">
                <label>Waktu Pengambilan</label>
                <select name="pickup_time" id="pickup_time">
                    <option value="">Pilih waktu</option>
                    <option value="Istirahat 1 (09:30-10:00)">Istirahat 1 (09:30 - 10:00)</option>
                    <option value="Istirahat 2 (12:00-12:30)">Istirahat 2 (12:00 - 12:30)</option>
                    <option value="Pulang Sekolah (15:00-15:30)">Pulang Sekolah (15:00 - 15:30)</option>
                </select>
            </div>

            <div class="form-group">
                <label>Catatan Tambahan</label>
                <input type="text" name="notes" placeholder="Catatan untuk pesanan">
            </div>

            <!-- Metode Pembayaran -->
            <div class="form-group">
                <label>Metode Pembayaran</label>
                <div class="payment-methods">
                    <div class="payment-option" onclick="selectPayment('cash')">
                        <i class="fa fa-money-bill"></i>
                        <p>Tunai</p>
                    </div>
                    <div class="payment-option" onclick="selectPayment('bca')">
                        <i class="fa fa-university"></i>
                        <p>BCA Mobile</p>
                    </div>
                    <div class="payment-option" onclick="selectPayment('mandiri')">
                        <i class="fa fa-university"></i>
                        <p>Livin Mandiri</p>
                    </div>
                    <div class="payment-option" onclick="selectPayment('bri')">
                        <i class="fa fa-university"></i>
                        <p>BRImo</p>
                    </div>
                    <div class="payment-option" onclick="selectPayment('dana')">
                        <i class="fa fa-mobile-alt"></i>
                        <p>DANA</p>
                    </div>
                    <div class="payment-option" onclick="selectPayment('gopay')">
                        <i class="fa fa-mobile-alt"></i>
                        <p>GoPay</p>
                    </div>
                    <div class="payment-option" onclick="selectPayment('ovo')">
                        <i class="fa fa-mobile-alt"></i>
                        <p>OVO</p>
                    </div>
                    <div class="payment-option" onclick="selectPayment('shopeepay')">
                        <i class="fa fa-mobile-alt"></i>
                        <p>ShopeePay</p>
                    </div>
                </div>
                <input type="hidden" name="payment_method" id="payment_method" required>
            </div>

            <!-- Upload Bukti Pembayaran -->
            <div class="upload-section" id="upload-section">
                <h4 style="color: #2b6be4; margin-bottom: 15px;">
                    <i class="fa fa-upload"></i> Upload Bukti Pembayaran
                </h4>
                <div class="upload-area" onclick="document.getElementById('bukti-file').click()">
                    <i class="fa fa-cloud-upload-alt"></i>
                    <p>Klik untuk upload bukti pembayaran</p>
                    <small style="color: #666;">Format: JPG, PNG, PDF (Max 5MB)</small>
                </div>
                <input type="file" id="bukti-file" name="bukti_pembayaran" accept="image/*,.pdf" style="display: none;" onchange="previewFile(this)">
                <div class="upload-preview" id="upload-preview"></div>
            </div>

            <button type="submit" class="btn-order">
                <i class="fa fa-check-circle"></i> Buat Pesanan
            </button>
        </form>
    </div>

    <div class="checkout-summary">
        <h3 class="section-title"><i class="fa fa-receipt"></i> Ringkasan Pesanan</h3>
        
        <div id="checkout-items">
            <!-- Items will be loaded from cart -->
        </div>

        <div class="total-section" id="checkout-total">
            <div class="total-row">
                <span>Subtotal:</span>
                <span id="subtotal">Rp 0</span>
            </div>
            <div class="total-row">
                <span>Biaya Layanan:</span>
                <span>Rp 1.000</span>
            </div>
            <div class="total-row final">
                <span>Total:</span>
                <span id="final-total">Rp 1.000</span>
            </div>
        </div>
    </div>
</div>

<script>
function toggleTimeSelection() {
    const pickupMethod = document.querySelector('select[name="pickup_method"]').value;
    const timeSelection = document.getElementById('time-selection');
    const pickupTimeSelect = document.getElementById('pickup_time');
    
    if (pickupMethod === 'Ambil Sekarang') {
        timeSelection.style.display = 'none';
        pickupTimeSelect.removeAttribute('required');
        pickupTimeSelect.value = 'Sekarang';
    } else {
        timeSelection.style.display = 'block';
        pickupTimeSelect.setAttribute('required', 'required');
        pickupTimeSelect.value = '';
    }
}

function selectPayment(method) {
    // Remove selected class from all options
    document.querySelectorAll('.payment-option').forEach(option => {
        option.classList.remove('selected');
    });
    
    // Add selected class to clicked option
    event.target.closest('.payment-option').classList.add('selected');
    
    // Set hidden input value
    document.getElementById('payment_method').value = method;
    
    // Check if pickup method is "Ambil Sekarang" for instant payment
    const pickupMethod = document.querySelector('select[name="pickup_method"]').value;
    
    // For non-cash payments, redirect to app
    if (method !== 'cash') {
        if (pickupMethod === 'Ambil Sekarang') {
            alert('Pembayaran langsung! Anda akan diarahkan ke aplikasi pembayaran.');
        } else {
            alert('Anda akan diarahkan ke aplikasi pembayaran. Setelah melakukan pembayaran, kembali ke halaman ini untuk upload bukti.');
        }
        redirectToApp(method);
        
        // Show upload section after redirect (except for instant pickup)
        if (pickupMethod !== 'Ambil Sekarang') {
            setTimeout(() => {
                document.getElementById('upload-section').classList.add('show');
            }, 3000);
        }
    } else {
        document.getElementById('upload-section').classList.remove('show');
    }
}

function redirectToApp(method) {
    const apps = {
        'bca': 'bcamobile://transfer',
        'mandiri': 'livin://transfer', 
        'bri': 'brimo://transfer',
        'dana': 'dana://pay',
        'gopay': 'gojek://gopay/pay',
        'ovo': 'ovo://pay',
        'shopeepay': 'shopeepay://pay'
    };
    
    const appUrl = apps[method];
    if (appUrl) {
        // Try to open app
        window.location.href = appUrl;
        
        // Fallback to app store if app not installed
        setTimeout(() => {
            const storeUrls = {
                'bca': 'https://play.google.com/store/apps/details?id=com.bca',
                'mandiri': 'https://play.google.com/store/apps/details?id=com.bankmandiri.livin',
                'bri': 'https://play.google.com/store/apps/details?id=com.bri.brimo',
                'dana': 'https://play.google.com/store/apps/details?id=id.dana',
                'gopay': 'https://play.google.com/store/apps/details?id=com.gojek.app',
                'ovo': 'https://play.google.com/store/apps/details?id=id.ovo.app',
                'shopeepay': 'https://play.google.com/store/apps/details?id=com.shopee.id'
            };
            
            if (confirm(`Aplikasi ${method.toUpperCase()} tidak terinstall. Download sekarang?`)) {
                window.open(storeUrls[method], '_blank');
            }
        }, 2000);
    }
}

function previewFile(input) {
    const file = input.files[0];
    const preview = document.getElementById('upload-preview');
    
    if (file) {
        const reader = new FileReader();
        
        reader.onload = function(e) {
            if (file.type.includes('image')) {
                preview.innerHTML = `
                    <img src="${e.target.result}" alt="Preview">
                    <p style="margin-top: 10px; color: #2b6be4; font-weight: 600;">
                        <i class="fa fa-check-circle"></i> ${file.name}
                    </p>
                `;
            } else {
                preview.innerHTML = `
                    <div style="padding: 20px; background: #fff; border-radius: 8px; margin-top: 10px;">
                        <i class="fa fa-file-pdf" style="font-size: 40px; color: #e74c3c;"></i>
                        <p style="margin-top: 10px; color: #2b6be4; font-weight: 600;">
                            <i class="fa fa-check-circle"></i> ${file.name}
                        </p>
                    </div>
                `;
            }
        };
        
        reader.readAsDataURL(file);
    }
}

function loadCheckoutItems() {
    const cart = JSON.parse(localStorage.getItem('cart') || '[]');
    const checkoutItems = document.getElementById('checkout-items');
    const subtotalEl = document.getElementById('subtotal');
    const finalTotalEl = document.getElementById('final-total');
    
    if (cart.length === 0) {
        checkoutItems.innerHTML = `
            <div style="text-align: center; color: #999; padding: 20px;">
                <i class="fas fa-shopping-cart" style="font-size: 40px; margin-bottom: 10px;"></i>
                <p>Keranjang kosong</p>
                <a href="{{ route('produk') }}" style="color: #2b6be4; text-decoration: none;">Tambah produk</a>
            </div>
        `;
        return;
    }
    
    let subtotal = 0;
    checkoutItems.innerHTML = cart.map(item => {
        const itemTotal = item.price * item.quantity;
        subtotal += itemTotal;
        return `
            <div class="order-item">
                <img src="${item.image}" alt="${item.name}">
                <div class="order-item-info">
                    <h4>${item.name}</h4>
                    <p>Qty: ${item.quantity}</p>
                </div>
                <div class="order-item-price">Rp ${itemTotal.toLocaleString()}</div>
            </div>
        `;
    }).join('');
    
    const serviceFee = 1000;
    const finalTotal = subtotal + serviceFee;
    
    subtotalEl.textContent = `Rp ${subtotal.toLocaleString()}`;
    finalTotalEl.textContent = `Rp ${finalTotal.toLocaleString()}`;
}

function submitOrder(event) {
    const cart = JSON.parse(localStorage.getItem('cart') || '[]');
    if (cart.length === 0) {
        alert('Keranjang kosong! Tambahkan produk terlebih dahulu.');
        event.preventDefault();
        return false;
    }
    
    const formData = new FormData(event.target);
    const paymentMethod = formData.get('payment_method');
    
    if (!paymentMethod) {
        alert('Pilih metode pembayaran terlebih dahulu!');
        event.preventDefault();
        return false;
    }
    
    // Add cart data to form
    const cartInput = document.createElement('input');
    cartInput.type = 'hidden';
    cartInput.name = 'cart_items';
    cartInput.value = JSON.stringify(cart);
    event.target.appendChild(cartInput);
    
    // Clear cart after successful submission
    localStorage.removeItem('cart');
    
    return true;
}

// Load checkout items when page loads
document.addEventListener('DOMContentLoaded', loadCheckoutItems);
</script>
@endsection