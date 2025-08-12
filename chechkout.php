<form id="checkout-form">
  <label>Nama Lengkap:</label>
  <input type="text" id="nama" name="nama" required>

  <label>Alamat:</label>
  <textarea id="alamat" name="alamat" required></textarea>

  <label>No WhatsApp:</label>
  <input type="tel" id="telepon" name="telepon" required>

  <label>Catatan (Opsional):</label>
  <textarea id="catatan" name="catatan"></textarea>

  <h3>Ringkasan Pesanan:</h3>
  <ul id="summary-list"></ul>
  <p><strong>Total: Rp <span id="summary-total">0</span></strong></p>

  <input type="hidden" id="summary-data" name="summary">
  <input type="hidden" id="summary-total-hidden" name="total">

  <button type="submit">Kirim ke WhatsApp</button>
</form>

<script>
  const cart = JSON.parse(localStorage.getItem('cart')) || [];
  const summaryList = document.getElementById('summary-list');
  const summaryTotal = document.getElementById('summary-total');
  const hiddenSummary = document.getElementById('summary-data');
  const hiddenTotal = document.getElementById('summary-total-hidden');
  let total = 0;

  const summaryArray = cart.map(item => {
    total += item.price;
    return `- ${item.name} (Rp ${item.price.toLocaleString('id-ID')})`;
  });

  summaryArray.forEach(item => {
    const li = document.createElement('li');
    li.textContent = item;
    summaryList.appendChild(li);
  });

  summaryTotal.textContent = total.toLocaleString('id-ID');
  hiddenSummary.value = summaryArray.join('\n');
  hiddenTotal.value = total;

  document.getElementById('checkout-form').addEventListener('submit', function(e) {
    e.preventDefault();

    const data = new FormData(this);

    fetch('simpan_resi.php', {
      method: 'POST',
      body: data
    }).then(response => response.text())
      .then(result => {
        if (result === "OK") {
          // Kirim ke WhatsApp
          const nama = data.get('nama');
          const alamat = data.get('alamat');
          const telepon = data.get('telepon');
          const catatan = data.get('catatan');
          const pesanan = data.get('summary');
          const total = data.get('total');

          const pesan = `Halo Zenik Tailor,%0ASaya ingin memesan:%0A${encodeURIComponent(pesanan)}%0A` +
                        `Total: Rp ${total}%0A%0AData Pemesan:%0ANama: ${nama}%0AAlamat: ${alamat}%0A` +
                        `WhatsApp: ${telepon}%0ACatatan: ${catatan}`;

          window.open(`https://wa.me/6285157062544?text=${pesan}`, '_blank');
          localStorage.removeItem('cart');
          alert('Pesanan berhasil dikirim. Anda akan diarahkan ke WhatsApp.');
        } else {
          alert('Gagal menyimpan pesanan. Silakan coba lagi.');
        }
      });
  });
  
</script>

<style>
  #checkout-form {
  max-width: 600px;
  margin: 50px auto;
  padding: 30px;
  background-color: #fff3cf;
  border-radius: 12px;
  box-shadow: 0 6px 20px rgba(0, 0, 0, 0.1);
  font-family: "Lora", serif;
  color: #004D3f;
}

#checkout-form h3 {
  font-size: 24px;
  font-family: "Playfair Display", serif;
  margin-bottom: 15px;
  color: #6b4f26;
  text-align: center;
}

#checkout-form label {
  display: block;
  margin-bottom: 5px;
  font-weight: bold;
  font-family: "Montserrat", sans-serif;
}

#checkout-form input[type="text"],
#checkout-form input[type="tel"],
#checkout-form textarea {
  width: 100%;
  padding: 12px;
  margin-bottom: 20px;
  border: 1px solid #fac164;
  border-radius: 8px;
  background-color: #FFF6DA;
  box-sizing: border-box;
  font-family: "Lora", serif;
}

#checkout-form textarea {
  resize: vertical;
  height: 100px;
}

#summary-list {
  list-style-type: disc;
  margin: 10px 0 20px 20px;
  padding: 0;
}

#summary-list li {
  padding: 6px 0;
  border-bottom: 1px solid #fac164;
  font-size: 15px;
}

#summary-total {
  color: #e64a19;
  font-size: 20px;
  font-weight: bold;
}

#checkout-form button {
  width: 100%;
  padding: 14px;
  background-color: #fac164;
  color: white;
  border: none;
  font-size: 16px;
  font-weight: bold;
  border-radius: 8px;
  cursor: pointer;
  transition: background-color 0.3s ease;
  font-family: "Montserrat", sans-serif;
}

#checkout-form button:hover {
  background-color: #e1a94b;
}

/* Responsive for mobile */
@media (max-width: 600px) {
  #checkout-form {
    margin: 20px;
    padding: 20px;
  }

  #checkout-form h3 {
    font-size: 20px;
  }

  #checkout-form button {
    font-size: 15px;
    padding: 12px;
  }
}
''
</style>