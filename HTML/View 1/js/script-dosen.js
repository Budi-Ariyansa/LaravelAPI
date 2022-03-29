// GET HTML ELEMENT
const formLoginDosen = document.getElementById('form-login-dosen');

const apiDosen = {
    'login' : 'http://127.0.0.1:8000/api/login-dosen',
    'profile' : 'http://127.0.0.1:8000/api/profile-dosen',
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
if(formLoginDosen) {
    sessionStorage.clear();
    formLoginDosen.addEventListener('submit', async function(e) {
        e.preventDefault()
        const dataDosen = new FormData(formLoginDosen).entries();
        const response = await getReponse('POST', apiDosen['login'], dataDosen);
        const content = await response.json();
    
        if(!!content['access_token']) {
            sessionStorage.setItem('at', content['access_token']);
            window.location.href = 'beranda-dosen.html';
        }
    })
}

async function dataBerandaDosen() {
    const response = await getReponse('GET', apiDosen['profile']);
    const content = await response.json();
    
    document.getElementById('profile').innerHTML = content['nama_dosen']+" - "+content['nid'];
    document.getElementById('welcome').innerHTML = "Selamat Datang, "+content['nama_dosen'];
    document.getElementById('nama_dosen').value = content['nama_dosen'];
    document.getElementById('nid').value = content['nid'];
    document.getElementById('no_hp').value = content['no_hp'];
    document.getElementById('email').value = content['email'];
    document.getElementById('no_kk').value = content['no_kk'];
    document.getElementById('nik').value = content['nik'];
}

// Logout
async function logout(user) {
    const response = await getReponse('POST', apiDosen['logout']);
    const content = await response.json();

    if(!!content['success']) {
        sessionStorage.clear();
        window.location.href = 'login-dosen.html';
    }
}