require('./common');

// MY JavaScript

/************ APP.BLADE.PHP (LAYOUT BASE) ************/

// finestra dropdown di menù profilo
const controlBtn = document.querySelector('.controls');
const dropMenu = controlBtn.querySelector('.drop-menu')

if (controlBtn && dropMenu) {
    controlBtn.addEventListener('click', function() {
        dropMenu.classList.toggle('hidden');
    })
}

/************ CREATE.BLADE.PHP ************/

// bottone per aggiunta di ulteriori immagini
// const input = document.querySelector('#image');
// const preview = document.querySelector('#image-preview');
// const addButton = document.querySelector('#add-image');

// if(input && preview && addButton) {
//     input.addEventListener('change', function () {
//       preview.innerHTML = ''; // pulisce il contenitore delle anteprime
//       const files = this.files;
//       for (let i = 0; i < files.length; i++) {
//         const file = files[i];
//         const reader = new FileReader();
//         reader.onload = function (e) {
//           const img = new Image();
//           img.src = e.target.result;
//           preview.appendChild(img);
//         };
//         reader.readAsDataURL(file);
//       }
//       addButton.classList.remove('d-none'); // rende visibile il pulsante per aggiungere altre immagini
//     });

//     addButton.addEventListener('click', function () {
//       input.click(); // simula il click sull'input di file
//     });
// }

// API TomTom per ottenere latitudine e longitudine dell'indirizzo
const addressInput = document.querySelector('#address');

if (addressInput) {
    const apiKey = "pHHustjVtZP4zcljXIwtAYeEAtmslE3K"
    addressInput.addEventListener('keyup', (e) => {
        const query = e.target.value;
        if (query.length > 3) {
            getAddressList(query);
        }
    })

    function getAddressList(query) {
        const url = `https://api.tomtom.com/search/2/geocode/${query}.json?key=${apiKey}&countrySet=IT&limit=5&language=it-IT`;
        fetch(url)
            .then((response) => response.json())
            .then((data) => {
                console.log('risultati della ricerca', data); // DEBUG
                updateAddressList(data.results);
            })
    }

    function updateAddressList(results) {
        const resultsList = document.getElementById('results-list');
        resultsList.innerHTML = '';
        results.forEach((result) => {
            const resultItem = document.createElement('li');
            resultItem.innerText = result.address.freeformAddress;
            resultItem.addEventListener('click', () => {
                addressInput.value = result.address.freeformAddress;
                getCoordinates(result.address.freeformAddress);
                resultsList.innerHTML = '';
            })
            resultsList.appendChild(resultItem);
        });
    }

    function getCoordinates(address) {
        const urlCoordinate = `https://api.tomtom.com/search/2/geocode/${address}.json?key=${apiKey}&countrySet=IT&limit=5`;
        fetch(urlCoordinate)
            .then((response) => response.json())
            .then((data) => {
                assignCoordinate(data.results);
            })
    }

    function assignCoordinate(results) {
        console.log('prendo il miglior punteggio', results); // DEBUG

        const latitudeInput = document.getElementById('latitude-input');
        const longitudeInput = document.getElementById('longitude-input');
        latitudeInput.value = results[0].position.lat;
        longitudeInput.value = results[0].position.lon;

        console.log('latitudine', latitudeInput.value); // DEBUG
        console.log('longitudine', longitudeInput.value); // DEBUG
    }
}

/************ INDEX.BLADE.PHP ************/

// finestra di conferma eliminazione proprietà
const deletePopup = document.querySelector('.delete-popup-backdrop');

if (deletePopup) {
    const deleteBtn = document.querySelectorAll('.delete-button');
    deleteBtn.forEach(button => {
        button.addEventListener('click', function() {
            console.log('cliccato');
            deletePopup.classList.remove('hidden');
            document.body.style.overflow = 'hidden';
            deletePopup.querySelector('form').setAttribute('action', 'http://localhost:8000/admin/properties/' + this.dataset.id);
        });
    });

    const cancelBtn = document.querySelector('.cancel-button');
    cancelBtn.addEventListener('click', function() {
        deletePopup.classList.add('hidden');
        document.body.style.overflow = 'visible';
    });

    function hideSuccessMessage() {
        deleteSuccess.classList.add('d-none');
    };

    const deleteSuccess = document.querySelector('.alert-danger');
    if(document.body.contains(deleteSuccess)) {
        setTimeout(hideSuccessMessage, 10000);
    };
}
