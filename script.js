document.addEventListener('DOMContentLoaded', function () {
    // Form validation for registration
    const daftarForm = document.querySelector('form[action="proses_daftar.php"]');
    if (daftarForm) {
        daftarForm.addEventListener('submit', function (event) {
            const password = document.querySelector('#password').value;
            if (password.length < 6) {
                event.preventDefault();
                alert('Password harus memiliki minimal 6 karakter');
            }
        });
    }

    // Form validation for login
    const masukForm = document.querySelector('form[action="proses_masuk.php"]');
    if (masukForm) {
        masukForm.addEventListener('submit', function (event) {
            const email = document.querySelector('#email').value;
            const password = document.querySelector('#password').value;
            if (!email || !password) {
                event.preventDefault();
                alert('Email dan Password tidak boleh kosong');
            }
        });
    }

    // Form validation for order
    const pesanForm = document.querySelector('form[action="proses_pesan.php"]');
    if (pesanForm) {
        pesanForm.addEventListener('submit', function (event) {
            const dokumen = document.querySelector('#dokumen').files[0];
            if (!dokumen) {
                event.preventDefault();
                alert('Anda harus mengunggah dokumen');
            }
        });
    }
});
