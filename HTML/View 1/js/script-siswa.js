// GET HTML ELEMENT
const formLoginSiswa = document.getElementById('form-login-siswa');

// API LINK
const apiSiswa = {
    'login' : 'http://127.0.0.1:8000/api/login-siswa',
    'profile' : 'http://127.0.0.1:8000/api/profile-siswa',
    'registrasi-ulang' : 'http://127.0.0.1:8000/api/registrasi-ulang',
    'logout' : 'http://127.0.0.1:8000/api/logout',
    'status-registrasi-ulang' : 'http://127.0.0.1:8000/api/status-registrasi-ulang',
    'kartu-studi-siswa' : 'http://127.0.0.1:8000/api/kartu-studi-siswa',
    'status-registrasi-matakuliah' : 'http://127.0.0.1:8000/api/status-registrasi-matakuliah',
    'regis-matkul' : 'http://127.0.0.1:8000/api/registrasi-matakuliah',
};

// FOR GET RESPONSE
function getReponse(method, linkApi, data) {
    const acc_tkn = sessionStorage.getItem('at');
    if(!!acc_tkn) {
        if(!!data) {
            return fetch(linkApi, {
                method: method,
                headers: {
                    'Accept': 'application/json',
                    'Authorization': 'Bearer '+ acc_tkn,
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify(Object.fromEntries(data))
            });
        } else {
            return fetch(linkApi, {
                method: method,
                headers: {
                    'Accept': 'application/json',
                    'Authorization': 'Bearer '+ acc_tkn,
                    'Content-Type': 'application/json'
                },
            });
        }
    } else {
        return fetch(linkApi, {
            method: method,
            headers: {
                'Accept': 'application/json',
                'Content-Type': 'application/json'
            },
            body: JSON.stringify(Object.fromEntries(data))
        });
    }
}

// Login
if(formLoginSiswa) {
    sessionStorage.clear();
    formLoginSiswa.addEventListener('submit', async function(e) {
        e.preventDefault()
        const dataSiswa = new FormData(formLoginSiswa).entries();
        const response = await getReponse('POST', apiSiswa['login'], dataSiswa);
        const content = await response.json();
        
        if(!!content['access_token']) {
            sessionStorage.setItem('at', content['access_token']);
            window.location.href = 'beranda-siswa.html';
        }
    });
}

// Load Data Beranda
async function dataSiswa(location) {
    const response = await getReponse('GET', apiSiswa['profile']);
    const content = await response.json();

    switch (location) {
        case 'beranda':
            document.getElementById('profile').innerHTML = content['nama_siswa']+" - "+content['nim']+"<br/>"+
                "SEMESTER "+content['semester']+"&emsp;TA "+content['tahun_ajar']+"<br/>"+
                "BEBAN MAKSIMAL SKS : "+content['beban_sks']+"<br/>"+content['fakultas']+"<br/>"+content['program_studi'];
            document.getElementById('welcome').innerHTML = "Selamat Datang, "+content['nama_siswa'];
            document.getElementById('no_hp').value = content['no_hp'];
            document.getElementById('email').value = content['email'];
            document.getElementById('no_kk').value = content['no_kk'];
            document.getElementById('nik').value = content['nik'];
            break;
        default:
            document.getElementById('profile').innerHTML = content['nama_siswa']+" - "+content['nim']+"<br/>"+
                "SEMESTER "+content['semester']+"&emsp;TA "+content['tahun_ajar']+"<br/>"+
                "BEBAN MAKSIMAL SKS : "+content['beban_sks']+"<br/>"+content['fakultas']+"<br/>"+content['program_studi'];
            break;
    }
}

// Cek Status Registrasi Ulang
async function cekStatusRegistrasiUlang() {
    dataSiswa('registrasi-ulang');

    const response = await getReponse('GET', apiSiswa['status-registrasi-ulang']);
    const content = await response.json();

    console.log(content);

    if(content['kondisi'] == 'False') {
        document.getElementById('regis-ulang-container').innerHTML = 
        `<h2><b>Registrasi Ulang</b></h2><br><br>
        <h3>Registrasi ulang belum dimulai. Dapat melakukan registrasi ulang setelah melakukan perwalian dan lunas pembayaran</h3>`;
    } else {
        if(content['status'] == null) {
            document.getElementById('regis-ulang-container').innerHTML = 
            `<h2><b>Registrasi Ulang</b></h2><br><br>
            <form id="form-registrasi-ulang">
                <div class="row align-items-center">
                    <div class="col-md-2"><label for="">Jenis Regitrasi</label></div>
                    <div class="col-md-3 pl-0">
                        <select name="jenis_registrasi" class="form-control">
                            <option value=""></option>
                            <option value="KULIAH">KULIAH (6 SKS)</option>
                            <option value="ULANG">ULANG (6 SKS)</option>
                        </select>
                    </div>
                    <div class="col-md-1">
                        <button class="btn btn-dark">OK</button>
                    </div>
                </div>
            </form>`;  

            // Registrasi Ulang
            const formRUSiswa = document.getElementById('form-registrasi-ulang');
            formRUSiswa.addEventListener('submit', async function(e) {
                e.preventDefault();
                const jenisRegis = new FormData(formRUSiswa).entries();
                const response = await getReponse('POST', apiSiswa['registrasi-ulang'], jenisRegis);
                const content = await response.json();
                location.reload();
            });
        } else {
            document.getElementById('regis-ulang-container').innerHTML = 
            `<h2><b>Registrasi Ulang</b></h2><br><br>
            <h3>Anda telah melakukan registrasi ulang...</h3>`;
        }
    }
    
}

async function statusregismatkul() {
    dataSiswa('registrasi-matakuliah');

    const respone = await getReponse('GET','status-registrasi-matakuliah');
    const content = await response.json();

    if(content['belum']){
        document.getElementById('regis-ulang-container').innerHTML = 
        `<h2><b>Registrasi Ulang</b></h2><br><br>
        <h3>Registrasi Matakuliah belum dimulai. Dapat melakukan registrasi ulang setelah melakukan perwalian dan lunas pembayaran</h3>`;
    } else {
        
        const respone = await getReponse('GET','regis-matkul');
        const content = await response.json();

        const tbodyRef = document.getElementById('table-matkul').getElementsByTagName('tbody')[0];

        for (let index = 0; index < content.nama_matkul.length; index++) {
            var newRow = tbodyRef.insertRow();

            newRow.insertCell().appendChild(document.createTextNode(index+1));
            newRow.insertCell().appendChild(document.createTextNode(content['kode_matkul'][index])).href("");
            newRow.insertCell().appendChild(document.createTextNode(content['nama_matkul'][index]));
            newRow.insertCell().appendChild(document.createTextNode(content['jumlah_sks'][index]));

        }

    }
}

async function jadwalKuliah() {
    dataSiswa('jadwal-kuliah');

    const response = await getReponse('GET', 'http://127.0.0.1:8000/api/jadwal-kuliah');
    const content = await response.json();

    const tbodyRef = document.getElementById('table-jadwal').getElementsByTagName('tbody')[0];

    for (let index = 0; index < content.matkul.length; index++) {
        var newRow = tbodyRef.insertRow();
        var presensi = document.createElement("a");
        presensi.innerText = "Presensi";
        presensi.id = "presensi-jadwal";
        presensi.href = "";

        newRow.insertCell().appendChild(document.createTextNode(index+1));
        newRow.insertCell().appendChild(document.createTextNode(content['kode_matkul'][index]));
        newRow.insertCell().appendChild(document.createTextNode(content['matkul'][index]));
        newRow.insertCell().appendChild(document.createTextNode(content['kode_dosen'][index]));
        newRow.insertCell().appendChild(document.createTextNode(content['dosen'][index]));
        newRow.insertCell().appendChild(document.createTextNode(content['hari_kuliah'][index]));
        newRow.insertCell().appendChild(document.createTextNode(content['jam_kuliah'][index]));
        newRow.insertCell().appendChild(document.createTextNode(content['ruangan'][index]));
        newRow.insertCell().appendChild(document.createTextNode("1 dari 2"));
        newRow.insertCell().appendChild(presensi);
    }
    const btnPresensi = document.getElementById('presensi-jadwal');
    btnHapus.addEventListener('click', async function(e) {
        e.preventDefault();
        console.log('aaa');
    });
}
    

async function kartuStudiSiswa() {
    dataSiswa('kartu-studi-siswa');

    const response = await getReponse('GET', apiSiswa['kartu-studi-siswa']);
    const content = await response.json();
    
    const tbodyRef = document.getElementById('table-kst').getElementsByTagName('tbody')[0];

    for (let index = 0; index < content.bu.length; index++) {
        var newRow = tbodyRef.insertRow();
        var hapus = document.createElement("a");
        hapus.innerText = "Hapus";
        hapus.id = "hapus-kst";
        hapus.href = "";
        
        newRow.insertCell().appendChild(document.createTextNode(index+1));
        newRow.insertCell().appendChild(document.createTextNode(content['kode_matkul'][index]));
        newRow.insertCell().appendChild(document.createTextNode(content['matkul'][index]));
        newRow.insertCell().appendChild(document.createTextNode(content['bu'][index]));
        newRow.insertCell().appendChild(document.createTextNode(content['sksa'][index]));
        newRow.insertCell().appendChild(document.createTextNode(content['sksb'][index]));
        newRow.insertCell().innerHTML = 
        content['kode_dosen'][index]+"<br/>"+content['dosen'][index]+"<br/>"+
        content['ruangan'][index]+"<br/>"+content['hari_kuliah'][index]+"<br/>"+
        content['jam_kuliah'][index]+"<br/>";
        newRow.insertCell().appendChild(hapus);
    }

    const btnHapus = document.getElementById('hapus-kst');
    btnHapus.addEventListener('click', async function(e) {
        e.preventDefault();
        console.log('aaa');
    });
}


// Logout
async function logout(user) {
    const response = await getReponse('POST', apiSiswa['logout']);
    const content = await response.json();

    if(!!content['success']) {
        sessionStorage.clear();
        window.location.href = 'login-siswa.html';
    }
}